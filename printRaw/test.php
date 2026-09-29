<?php
error_reporting(0);
session_start ();
require( 'webclass.php' );
$db=new kelas;

$kon=$db->select("pj_penjualan","*","no_penjualan='TX/01/201705/0001'");
foreach($kon as $val){}
require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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
	
	$printer -> text("$_SESSION[NAMA_PERUSAHAAN]\n");
	$printer -> text("$_SESSION[ALAMAT]\n");
	//$printer -> text("NOMOR TELP\n");		
	$printer -> feed(2);
	
	$printer -> setJustification(Printer::JUSTIFY_LEFT);
	$printer -> text(sprintf("%-20s %-5s", "Nomor Transaksi","$val[no_penjualan]\n"));		
	$printer -> text(sprintf("%-20s %-5s", "Tgl","$val[tgl_penjualan]\n"));		
	$printer -> text(sprintf("%-20s %-5s", "Kasir","$val[tgl_penjualan]\n\n\n"));		
	
	//$printer -> text("abcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*()-+\n");
	//$printer -> text("$d\n");
	//$printer -> text("Receipt for whatever\n");
	$headl=sprintf("%-20s %-5s %-10s %-10s", "Barang","Qty", "Disc","Jumlah");
	$separator="------------------------------------------------";
	
	$printer -> text("$headl\n");
	$printer -> text("$separator\n");
	
	$dtl=$db->select("pj_penjualan_dtl a JOIN m_barang b ON a.id_barang=b.id_barang","nama_barang as nm_brg, qty_jual, discprs, dtl_total","a.id_pj='$val[id_pj]'");
	echo "select * from pj_penjualan_dtl a JOIN m_barang b ON a.id_barang=b.id_barang where a.id_pj='$val[id_pj]'";
	foreach($dtl as $val2){
	//echo "nama barang". @$val2[nm_brg];
	//Ganti dengan for dari detil penjualan
	$d=sprintf("%-20s %5d %5s %15s", $val2[nm_brg],"$val2[qty_jual]", "$val2[discprs]%",number_format($val2[dtl_total]));
	$printer -> text("$d\n");
	$subto+=$val2[dtl_total];
	}
	

	//-------------------------------
	$printer -> text("$separator\n");
	$d1=sprintf("%-5s %-5s %20s %15s"," ", " ", "Sub Total",number_format($subto));
	$printer -> text("$d1\n");
	$d1=sprintf("%-5s %-5s %20s %15s", " ", " ","Disc (%)",$val[disc_prs]);
	$printer -> text("$d1\n");
	$gtot=$subto-($subto*($val[disc_prs]/100));
	$d1=sprintf("%-5s %-5s %20s %15s", " ", " ","Grand Total",number_format($gtot));
	$printer -> text("$d1\n");
	$d1=sprintf("%-5s %-5s %20s %15s", " ", " ","Bayar Tunai",number_format($val[bayar_tunai]));
	$printer -> text("$d1\n");
	$d1=sprintf("%-5s %-5s %20s %15s", " ", " ","Bayar dg Kartu",number_format($val[bayar_card]));
	$printer -> text("$d1\n");
	$d1=sprintf("%-5s %-5s %20s %15s", " ", " ","Kembalian",number_format($val[kembali_tunai]));
	$printer -> text("$d1\n");
	
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> text("\n\nTerima Kasih\n");
	
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