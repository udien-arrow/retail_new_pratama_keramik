<?php 
session_start ();
require( 'webclass.php' );
$db=new kelas;
?>
<style>
table {
		  border-collapse: collapse;
	  }
table, td, th {
				  border: 1px solid #DDD ;
				  padding:1px;
			  }
.th2{	
		border-top: 0px;
		border-left: 0px;
		border-right: 0px;	
	}
.kop{
	border: 0px;
}
</style>
<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  <?php 
$z=$db->select("m_cabang","*","id_cabang='$_GET[cab]'");
foreach($z as $zoro){}
if($_GET['jenis']=='KM'){
   $jn="KAS MASUK";
}elseif($_GET['jenis']=='BM'){
	$jn="BANK MASUK";
}elseif($_GET['jenis']=='KK'){
	$jn="KAS KELUAR";
}elseif($_GET['jenis']=='BK'){
	$jn="BANK KELUAR";	
}
?>

  <td colspan="14" align="center" class="th2">
  <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop" align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
   <b>Laporan Kas Bank  <?=$jn?> CABANG <?=$zoro['nama_cabang']?><br><br>
	PERIODE <?=date("d-m-Y",strtotime($_GET['a']))?> s/d <?=date("d-m-Y",strtotime($_GET['b']))?></b><br>&nbsp;</td>
  </tr>
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center""><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No Trans</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Tanggal</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Jumlah</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Uraian</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Jenis Transaksi</b></td>
  </tr>
<?php 
$aa=date("Y-m-d",strtotime($_GET['a']));
	  $bb=date("Y-m-d",strtotime($_GET['b']));
	  if($_GET['jenis']=='KM' || $_GET['jenis']=='BM'){
		 $dat=$db->select("ak_kas_masuk a join m_cabang b on a.id_cab=b.id_cabang join ak_paruskas c on a.type=c.id_param","a.*,a.idkm as id,b.nama_cabang,c.nama","a.id_cab='$_GET[cab]' and substr(IDKM,1,2)='$_GET[jenis]' and a.tgl_tran between '$aa' and '$bb'");
	  }elseif($_GET['jenis']=='KK' || $_GET['jenis']=='BK'){
		 $dat=$db->select("ak_kas_keluar a join m_cabang b on a.id_cabang=b.id_cabang join ak_paruskas c on a.type=c.id_param","a.*,a.idkk as id,b.nama_cabang,c.nama","a.id_cabang='$_GET[cab]' and substr(IDKK,1,2)='$_GET[jenis]' and a.tgl_tran between '$aa' and '$bb'"); 
	  }
	  $no=1;
	  $total=0;
	  foreach($dat as $dat2){
		  $total=$total+$dat2['JUMLAH'];
?>
  <tr>
  	<td style="width:3%;font-size:9px;text-align:center"><?=$no?></td>
    <td style="width:20%;font-size:9px;text-align:left"><?=$dat2['id']?></td>
    <td style="width:15%;font-size:9px;text-align:center"><?=date("d-m-Y",strtotime($dat2['TGL']))?></td>
    <td style="width:15%;font-size:9px;text-align:right"><?=number_format($dat2['JUMLAH'])?></td>
    <td style="width:15%;font-size:9px;text-align:left"><?=$dat2['URAIAN']?></td>
    <td style="width:20%;font-size:9px;text-align:left"><?=$dat2['nama']?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="3" style="width:3%;font-size:9px;text-align:center"></td>
    <td style="width:3%;font-size:9px;text-align:right"><?=number_format($total)?></td>
    <td colspan="2" style="width:3%;font-size:9px;text-align:center"></td>
</tr>
</table>