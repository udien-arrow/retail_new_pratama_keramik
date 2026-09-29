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
$z=$db->select("m_customer","*","id_cus='$_GET[cab]'");
foreach($z as $zoro){}?>
  <td colspan="9" align="center" class="th2">
  <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop" align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
  <b><br>LAPORAN BIAYA PENGIRIMAN CABANG <?=$zoro['nama_usaha']?><br><br>
	PERIODE <?=$_GET['a']?> s/d <?=$_GET['b']?></b><br>&nbsp;</td>
  </tr>
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center""><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No SB</b></td>
    <td style="width:9%;font-size:10px;text-align:center"><b>Tgl</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Customer</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Truck</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Supir</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Biaya Switch</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Biaya Lain</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Biaya UJS</b></td>
    
  </tr>
<?php 
$where2="id_cabang='$_GET[cab]' AND date(tgl) BETWEEN '$_GET[a]' AND '$_GET[b]'";
$z=$db->select("v_l_ujs","*",$where2);
$no=1;
$total=0;
$totalswitch=0;
$totallain=0;
foreach($z as $zoro){
$totalswitch=$totalswitch+$zoro['biaya_switch'];
$totallain=$totallain+$zoro['biaya_lain'];
$total=$total+$zoro['biaya_ujs'];
?>
  <tr>
  	<td style="width:3%;font-size:9px;text-align:center"><?=$no?></td>
    <td style="width:14%;font-size:9px;text-align:center"><?=$zoro['no_sb']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=$zoro['tgl']?></td>
    <td style="width:14%;font-size:9px;text-align:center"><?=$zoro['nama_usaha']?></td>
    <td style="width:15%;font-size:9px;text-align:center"><?=$zoro['nama_truk']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=$zoro['nama_pegawai']?></td>
    <td style="width:12%;font-size:9px;text-align:center"><?=number_format($zoro['biaya_switch'])?></td>
    <td style="width:12%;font-size:9px;text-align:center"><?=number_format($zoro['biaya_lain'])?></td>
    <td style="width:12%;font-size:9px;text-align:center"><?=number_format($zoro['biaya_ujs'])?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="6" style="width:3%;font-size:9px;text-align:right"></td>
    <td style="width:3%;font-size:9px;text-align:center"><?=number_format($totalswitch)?></td>
    <td style="width:3%;font-size:9px;text-align:center"><?=number_format($totallain)?></td>
    <td style="width:3%;font-size:9px;text-align:center"><?=number_format($total)?></td>
</tr>
</table>