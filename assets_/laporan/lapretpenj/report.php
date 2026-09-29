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
foreach($z as $zoro){}?>
  <td colspan="14" align="center" class="th2">
  <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop" align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
  <b><br>
  LAPORAN RETUR PENJUALAN  CABANG 
  <?=$zoro['nama_cabang']?><br><br>
	PERIODE <?=$_GET['a']?> s/d <?=$_GET['b']?></b><br>&nbsp;</td>
  </tr>
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center""><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No Retur</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Tanggal</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No Ref</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Suppplier</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Satuan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty Jual</b></td>
    <td style="width:3%;font-size:10px;text-align:center"><b>Qty Retur</b></td>
    
  </tr>
<?php 
$where2="id_cabang='$_GET[cab]' AND tgl_retur BETWEEN '$_GET[a]' AND '$_GET[b]'";
$z=$db->select("v_l_retpenj","*",$where2);
$no=1;
$total=0;
foreach($z as $zoro){
$total=$total+$zoro['qty_kembali'];
?>
  <tr>
  	<td style="width:3%;font-size:9px;text-align:center"><?=$no?></td>
    <td style="width:13%;font-size:9px;text-align:center"><?=$zoro['no_retur']?></td>
    <td style="width:8%;font-size:9px;text-align:center"><?=$zoro['tgl_retur']?></td>
    <td style="width:15%;font-size:9px;text-align:center"><?=$zoro['no_ref']?></td>
    <td style="width:15%;font-size:9px;text-align:center"><?=$zoro['nama_usaha']?></td>
    <td style="width:15%;font-size:9px;text-align:center"><?=$zoro['nama_barang']?></td>
    <td style="width:5%;font-size:9px;text-align:center"><?=$zoro['nama_satuan']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=number_format($zoro['qty_terima'])?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=number_format($zoro['qty_kembali'])?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="8" style="width:3%;font-size:9px;text-align:center"></td>
    <td style="width:3%;font-size:9px;text-align:center"><?=number_format($total)?></td>
</tr>
</table>