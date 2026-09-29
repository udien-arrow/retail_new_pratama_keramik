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
  <td colspan="7" align="center" class="th2">
  <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop" align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
  <b><br>LAPORAN ASSET  <br><br>
	PERIODE <?=$_GET['a']?> s/d <?=$_GET['b']?></b><br>&nbsp;</td>
  </tr>
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center""><b>No</b></td>
    <td style="width:3%;font-size:10px;text-align:center"><b>Tempat Permintaan Lokasi</b></td>
    <td style="width:3%;font-size:10px;text-align:center"><b>Nama Asset</b></td>
    <td style="width:3%;font-size:10px;text-align:center"><b>Tanggal Request</b></td>
    <td style="width:3%;font-size:10px;text-align:center"><b>Keterangan Request</b></td>
<td style="width:3%;font-size:10px;text-align:center"><b>User Request</b></td>
    
  </tr>
<?php 
$where2="DEPLOY_DATE BETWEEN '$_GET[a]' AND '$_GET[b]'";
$z=$db->select("v_deployin","*",$where2);
$no=1;
$total=0;
foreach($z as $zoro){
$total=$total+$zoro['ID_DEPLOY'];
?>
  <tr>
  	<td style="width:3%;font-size:9px;text-align:center"><?=$no?></td>
    <td style="width:25%;font-size:9px;text-align:center"><?=$zoro['NAMA_ALOKASI']?></td>
    <td style="width:28%;font-size:9px;text-align:center"><?=$zoro['ASSET_NAME']?></td>
    <td style="width:16%;font-size:9px;text-align:center"><?=$zoro['DEPLOY_DATE']?></td>
    <td style="width:15%;font-size:9px;text-align:center"><?=$zoro['DEPLOY_KETERANGAN']?></td>
    <td style="width:15%;font-size:9px;text-align:center"><?=$zoro['USERNAME']?></td>
  </tr>
<?php $no++;} ?>
<tr>
</tr>
</table>