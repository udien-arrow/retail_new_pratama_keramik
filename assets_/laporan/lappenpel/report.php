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
  <td colspan="6" align="center" class="th2">
 <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop"align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
  <b><br>LAPORAN PENJUALAN SEMEN PELANGGAN <?=$zoro['nama_usaha']?><br><br>
	PERIODE <?=$_GET['a']?> s/d <?=$_GET['b']?></b><br>&nbsp;</td>
  </tr>
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center""><b>No</b></td>
    <td style="width:18%;font-size:10px;text-align:center"><b>Cabang</b></td>
    <td style="width:9%;font-size:10px;text-align:center"><b>Jenis Kirim</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No SPJ</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No Ref</b></td>
    <td style="width:3%;font-size:10px;text-align:center"><b>Jumlah</b></td>
    
  </tr>
<?php 
$where2="id_cus='$_GET[cab]' AND date(tgl_spj) BETWEEN '$_GET[a]' AND '$_GET[b]' and jenis_jual=1";
$z=$db->select("v_lappenpel","*",$where2);
$no=1;
$total=0;
foreach($z as $zoro){
$total=$total+$zoro['jumlah_so'];
?>
  <tr>
  	<td style="width:3%;font-size:9px;text-align:center"><?=$no?></td>
    <td style="width:20%;font-size:9px;text-align:center"><?=$zoro['nama_cabang']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=$zoro['jenis_kirim']?></td>
    <td style="width:20%;font-size:9px;text-align:center"><?=$zoro['no_spj']?></td>
    <td style="width:20%;font-size:9px;text-align:center"><?=$zoro['no_ref']?></td>
    <td style="width:17%;font-size:9px;text-align:center"><?=number_format($zoro['jumlah_so'])?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="5" style="width:3%;font-size:9px;text-align:right"></td>
    <td style="width:3%;font-size:9px;text-align:center"><?=number_format($total)?></td>
</tr>
</table>