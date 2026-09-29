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
  <td colspan="10" align="center" class="th2">
  <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop"align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
  <b><br>LAPORAN DETIL PENJUALAN CABANG <?=$zoro['nama_cabang']?><br><br>
	PERIODE <?=$_GET['a']?> s/d <?=$_GET['b']?></b><br>&nbsp;</td>
  </tr>
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center""><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Customer</b></td>
    <td style="width:9%;font-size:10px;text-align:center"><b>Jenis Kirim</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No SPJ</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Tanggal SPJ</b></td>
    <td style="width:5%;font-size:10px;text-align:center"><b>No Ref</b></td>
    <td style="width:3%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:3%;font-size:10px;text-align:center"><b>Qty</b></td>
    <td style="width:3%;font-size:10px;text-align:center"><b>Harga</b></td>
    <td style="width:3%;font-size:10px;text-align:center"><b>Jumlah</b></td>
    
  </tr>
<?php 
if($_GET['cab']=='0'){
$where2="date(tgl_spj) BETWEEN '$_GET[a]' AND '$_GET[b]'";
}else{
$where2="id_cabang='$_GET[cab]' AND date(tgl_spj) BETWEEN '$_GET[a]' AND '$_GET[b]'";
}
$z=$db->select("v_l_do","*",$where2);
$no=1;
$total=0;
foreach($z as $zoro){
$a=explode('_',$zoro['gab']);
$total=$total+$a[1];
?>
  <tr>
  	<td style="width:3%;font-size:9px;text-align:center"><?=$no?></td>
    <td style="width:13%;font-size:9px;text-align:left"><?=$zoro['nama_usaha']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=$zoro['jenis_kirim']?></td>
    <td style="width:14%;font-size:9px;text-align:center"><?=$zoro['no_spj']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=$zoro['tgl_spj']?></td>
    <td style="width:15%;font-size:9px;text-align:center"><?=$zoro['no_ref']?></td>
    <td style="width:10%;font-size:9px;text-align:left"><?=$zoro['nama_barang']?></td>
    <td style="width:8%;font-size:9px;text-align:right"><?=$zoro['qty']?></td>
    <td style="width:10%;font-size:9px;text-align:right"><?=number_format($zoro['harga'])?></td>
    <td style="width:10%;font-size:9px;text-align:right"><?=number_format($a[1])?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="9" style="width:3%;font-size:9px;text-align:right"></td>
    <td style="width:3%;font-size:9px;text-align:right"><?=number_format($total)?></td>
</tr>
</table>