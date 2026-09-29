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
  <td colspan="7" align="center" class="th2">
  <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop" align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
   <b><br>LAPORAN PERMINTAAN PENJUALAN NON SEMEN <?php echo"$_SESSION[NAMA_PERUSAHAAN]";?> CABANG <?=$zoro['nama_cabang']?><br><br>
	PERIODE <?=$_GET['a']?> s/d <?=$_GET['b']?></b><br>&nbsp;</td>
  </tr>
  <tr>
  	<td width="10%" ><?php echo ucfirst(strtolower($d['no_penjualan']));?></td>
    <td width="5%" ><?php echo ucfirst(strtolower($d['tgl_penjualan']));?></td>
    <td width="10%"><?=$d['id_customer']?></td>
    
  </tr>
<?php 
if($_GET['cab']=='0'){
$where2="date(tgl_spj) BETWEEN '$_GET[a]' AND '$_GET[b]' and jenis_jual=1";
}else{
$where2="id_cabang='$_GET[cab]' AND date(tgl_spj) BETWEEN '$_GET[a]' AND '$_GET[b]' and jenis_jual=2";
}
$z=$db->select("v_ltx_do","*",$where2);
$no=1;
$total=0;
foreach($z as $zoro){
$total=$total+$zoro['jumlah_so'];
?>
  <tr>
  	<td style="width:3%;font-size:9px;text-align:center"><?=$no?></td>
    <td style="width:13%;font-size:9px;text-align:center"><?=$zoro['nama_usaha']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=$zoro['jenis_kirim']?></td>
    <td style="width:18%;font-size:9px;text-align:center"><?=$zoro['no_spj']?></td>
    <td style="width:18%;font-size:9px;text-align:center"><?=$zoro['tgl_spj']?></td>
    <td style="width:5%;font-size:9px;text-align:center"><?=$zoro['no_ref']?></td>
    <td style="width:17%;font-size:9px;text-align:center"><?=number_format($zoro['jumlah_so'])?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="6" style="width:3%;font-size:9px;text-align:right"></td>
    <td style="width:3%;font-size:9px;text-align:center"><?=number_format($total)?></td>
</tr>
</table>