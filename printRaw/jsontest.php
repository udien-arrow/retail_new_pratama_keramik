<?php 
error_reporting(0);
require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$str = file_get_contents( 'http://'.$_GET[ip].'/assets/plugin/printRaw/json.php?id='.$_GET[id].'');
$str2 = file_get_contents( 'http://'.$_GET[ip].'/assets/plugin/printRaw/json_head.php?id='.$_GET[id].'');
$str3 = file_get_contents( 'http://'.$_GET[ip].'/assets/plugin/printRaw/json_pref.php?id='.$_GET[id].'');



$json=json_decode($str,true);
$json2=json_decode($str2,true);
$json3=json_decode($str3,true);

try {
	// Enter the share name for your USB printer here
	//$connector = new WindowsPrintConnector("smb://192.168.9.5/kasir");
	$connector = new WindowsPrintConnector("80Printer");
	//$connector = new NetworkPrintConnector("10.x.x.x", 9100);
	$printer = new Printer($connector);
	//49
	/* Print some bold text */
	$printer -> setEmphasis(true);
	$printer -> setTextSize(1,1);
	$printer -> setEmphasis(false);
	
	$integer=1;
	
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	
	$printer -> text("".$json3[0][nama_perusahaan]."\n");
	$printer -> text("".$json3[0][alamat]."\n");
	$printer -> text("".$json3[0][no_telp]."\n");
	//$printer -> text("NOMOR TELP\n");		
	$printer -> feed(2);
	
	$printer -> setJustification(Printer::JUSTIFY_LEFT);
	$printer -> text(sprintf("%-20s %-5s", "Nomor Transaksi","".$json2[0][no_penjualan]."\n"));		
	$printer -> text(sprintf("%-20s %-5s", "Tgl","".$json2[0][tgl_penjualan]."\n"));		
	$printer -> text(sprintf("%-20s %-5s", "Kasir","".$json2[0][nama_pegawai]."\n"));		
	
	//$printer -> text("abcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*()-+\n");
	//$printer -> text("$d\n");
	//$printer -> text("Receipt for whatever\n");
	$headl=sprintf("%-20s %-5s %-10s %-10s", "Barang","Qty", "Disc","Jumlah");
	$separator="------------------------------------------------";
	
	$printer -> text("$separator\n");
	$printer -> text("$headl\n");
	$printer -> text("$separator\n");
	
	
	foreach($json as $vj => $key){
	//echo $key[nm_brg]." $key[qty_jual]<br>";
	
	$d=sprintf("%-20s %5d %5s %15s", $key[nm_brg],"$key[qty_jual]", "$key[discprs]%",number_format($key[dtl_total]));
	$printer -> text("$d\n");
	$subto+=$key[dtl_total];

	}

	
	

	//-------------------------------
	$printer -> text("$separator\n");
	$d1=sprintf("%-5s %-5s %20s %15s"," ", " ", "Sub Total",number_format($subto));
	$printer -> text("$d1\n");
	$d1=sprintf("%-5s %-5s %20s %15s", " ", " ","Disc (%)",$json2[0][disc_prs]);
	$printer -> text("$d1\n");
	$gtot=$subto-($subto*($val[disc_prs]/100));
	$d1=sprintf("%-5s %-5s %20s %15s", " ", " ","Grand Total",number_format($gtot));
	$printer -> text("$d1\n");
	$d1=sprintf("%-5s %-5s %20s %15s", " ", " ","Bayar Tunai",number_format($json2[0][bayar_tunai]));
	$printer -> text("$d1\n");
	$d1=sprintf("%-5s %-5s %20s %15s", " ", " ","Bayar dg Kartu",number_format($json2[0][bayar_card]));
	$printer -> text("$d1\n");
	$d1=sprintf("%-5s %-5s %20s %15s", " ", " ","Kembalian",number_format($json2[0][kembali_tunai]));
	$printer -> text("$d1\n");
	
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> text("\n\nTerima Kasih\n");
	$printer -> text("Atas Kunjungan Anda\n");
	$printer -> text("Silahkan Datang Kembali\n");
	
	$printer -> setJustification(Printer::JUSTIFY_RIGHT);



	//$printer -> feed(2);

	/* Bar-code at the end */

	$printer -> feed(3);
	$printer -> cut();
	/* Close printer */
	$printer -> close();
} catch(Exception $e) {
	echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}



?>
<script>
//window.close();
</script>