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
  <td colspan="12" align="center" class="th2">
  <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop" align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
   <b><br>
   LAPORAN SUMMARY PENJUALAN
   <br>PERIODE <?=$_GET['a']?> s/d <?=$_GET['b']?></b><br>&nbsp;</td>
  </tr>
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
  	<th style="width:10%; font-size:10px; text-align:center">Nomer penjualan </th>
    <th style="width:10%; font-size:10px; text-align:center"  >Tgl Penjualan</th>
    <th style="width:10%; font-size:10px; text-align:center" >Jenis Jual</th>
    <th style="width:10%;font-size:10px; text-align:center" >Jenis Bayar</th>
    <th style="width:15%;font-size:10px; text-align:center" >Total Jual</th> 
    <th style="width:5%;font-size:10px; text-align:center" >Disc</th>
    <th style="width:10%; font-size:10px; text-align:center" >Grant</th>
    <th style="width:10%; font-size:10px; text-align:center" >Total Bayar</th>
    <th style="width:10%;font-size:10px; text-align:center" >Kembali</th>
  </tr>
<?php 
if($_GET['jenis']=='2'){
	
$where2="date(tgl_penjualan) BETWEEN '$_GET[a]' AND '$_GET[b]' and jenis_jual='$_GET[jenis_jual]'";
}
else if($_GET['jenis']=='3'){
	
$where2="date(tgl_penjualan) BETWEEN '$_GET[a]' AND '$_GET[b]' and jenis_bayar='$_GET[jenis_bayar]'";
}

$z=$db->select("pj_penjualan","*",$where2);
$no=1;
$total=0;
foreach($z as $zoro){
$total=$total+$zoro['grantot_jual'];
?>
  <tr>
  	<td style="width:3%;font-size:9px;text-align:center"><?=$no?></td>
    <td style="width:15%;font-size:9px;text-align:center" ><?php echo ucfirst(strtolower($zoro['no_penjualan']));?></td>
    <td style="width:10%;font-size:9px;text-align:center" ><?php echo ucfirst(strtolower($zoro['tgl_penjualan']));?></td>
    <td style="width:10%;font-size:9px;text-align:center">
           <?php $a= $zoro['jenis_jual'];
		 if ($a == 1) {
			 $a ='Retail';
			 }else if($a == 2){
				$a='Grosir';
			}
		 ?>
     <?=$a?>
    </td>
    <td style="width:10%;font-size:9px;text-align:center">
           <?php $a= $zoro['jenis_bayar'];
		 if ($a == 1) {
			 $a ='Langsung';
			 }else if($a == 2){
				$a='Kredit';
			}
		 ?>
     <?=$a?>
    </td>
    <td style="width:10%;font-size:9px;text-align:center"><?=number_format($zoro['total_jual'])?></td>
    <td style="width:5%;font-size:9px;text-align:center"><?=$zoro['disc_prs']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=number_format($zoro['grantot_jual'])?></td>
    <td style="width:5%;font-size:9px;text-align:center"><?=number_format($zoro['bayar_tunai']+=$zoro['bayar_card'])?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=number_format($zoro['kembali_tunai'])?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="9" style="width:3%;font-size:9px;text-align:center">Total</td>
    <td style="width:3%;font-size:9px;text-align:center"><?=number_format($total)?></td>
</tr>
</table>