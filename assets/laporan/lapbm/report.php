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
<table cellpadding="0" cellspacing="0" style="width:98%">
  <tr>
  <?php 
$z=$db->select("m_cabang","*","id_cabang='$_GET[cab]'");
foreach($z as $zoro){}?>
  <td colspan="12" align="center" class="th2">
  <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop" align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
  <b><br>LAPORAN PENERIMAAN <?php 
							  if($_GET['jenis']==2){
								  echo "SEMEN";
							  }elseif($_GET['jenis']==1){
								  echo "NON SEMEN";
							  }elseif($_GET['jenis']==3){
								  echo "TAK BERTUAN";
							  }elseif($_GET['jenis']==4){
								  echo "TRANSIT";	
							  }?> CABANG <?=$zoro['nama_cabang']?><br><br>
	PERIODE <?=$_GET['a']?> s/d <?=$_GET['b']?></b><br>&nbsp;</td>
  </tr>
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center""><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No BM</b></td>
    <td style="width:5%;font-size:10px;text-align:center"><b>Tgl</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No Ref</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Surat Jalan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Dari</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Gudang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:3%;font-size:10px;text-align:center"><b>Satuan</b></td>
    <td style="width:5%;font-size:10px;text-align:center"><b>Qty</b></td>
    <td style="width:6%;font-size:10px;text-align:center"><b>Qty Terima</b></td>
  </tr>
<?php 
$z=$db->select("v_l_bm","*","id_cabang='$_GET[cab]' AND tgl BETWEEN '$_GET[a]' AND '$_GET[b]' and jenis='$_GET[jenis]'");
$no=1;
foreach($z as $zoro){
?>
  <tr>
  	<td style="width:3%;font-size:9px;text-align:center""><?=$no?></td>
    <td style="width:13%;font-size:9px;text-align:center"><?=$zoro['no_masuk']?></td>
    <td style="width:7%;font-size:9px;text-align:center""><?=$zoro['tgl']?></td>
    <td style="width:12%;font-size:9px;text-align:center""><?=$zoro['no_ref']?></td>
    <td style="width:7%;font-size:9px;text-align:center""><?=$zoro['surat_jalan']?></td>
    <td style="width:10%;font-size:9px;text-align:center""><?=$zoro['dari_siapa']?></td>
    <td style="width:10%;font-size:9px;text-align:center""><?=$zoro['nama_gudang']?></td>
    <td style="width:10%;font-size:9px;text-align:center""><?=$zoro['nama_barang']?></td>
    <td style="width:6%;font-size:9px;text-align:center""><?=$zoro['nama_satuan']?></td>
    <td style="width:5%;font-size:9px;text-align:center""><?=$zoro['qty']?></td>
    <td style="width:5%;font-size:9px;text-align:center""><?=$zoro['qty_terima']?></td>
  </tr>
<?php $no++;} ?>
</table>