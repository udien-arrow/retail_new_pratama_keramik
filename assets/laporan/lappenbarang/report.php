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
   <b><br>LAPORAN PENJUALAN
   <br>PERIODE <?=$_GET['a']?> s/d <?=$_GET['b']?></b><br>&nbsp;</td>
  </tr>
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
  	<th style="width:10%; font-size:10px; text-align:center">Tgl penjualan </th>
    <th style="width:10%; font-size:10px; text-align:center"  >No Dokumen</th>
    <th style="width:10%; font-size:10px; text-align:center" >Nama Toko</th>
    <th style="width:10%;font-size:10px; text-align:center" >Alamat Toko</th>
    <th style="width:10%;font-size:10px; text-align:center" >Nama Barang</th> 
    <th style="width:5%;font-size:10px; text-align:center" >Qty</th>
    <th style="width:8%; font-size:10px; text-align:center" >Harga</th>
    <th style="width:8%; font-size:10px; text-align:center" >Total</th>
    <th style="width:8%;font-size:10px; text-align:center" >Nama Sales</th>
    <th style="width:8%; font-size:10px; text-align:center" >DPP</th> 
    <th style="width:8%; font-size:10px; text-align:center" >PPN</th> 
  </tr>
<?php 
if($_GET['a']!=''){
 if($_GET['jenis']=='1'){
 if($_GET['barang'] =='0'){	
 $where2="date(tgl_penjualan) BETWEEN '$_GET[a]' AND '$_GET[b]'"; 
}
else{
$where2="date(tgl_penjualan) BETWEEN '$_GET[a]' AND '$_GET[b]' and id_barang='$_GET[barang]'";	
	
	}
}
else if($_GET['jenis']=='2'){
if($_GET['toko'] =='0'){	
 $where2="date(tgl_penjualan) BETWEEN '$_GET[a]' AND '$_GET[b]'"; 
}
else{	
$where2="date(tgl_penjualan) BETWEEN '$_GET[a]' AND '$_GET[b]' and id_customer='$_GET[toko]'";
}
}
}

$z=$db->select("v_penjualan_dtl","*",$where2);
$no=1;
$total=0;
foreach($z as $zoro){
$total=$total+$zoro['dtl_total'];
$dpp= $zoro['dtl_total']*1.1;
$ppn= $zoro['dtl_total']*10/100;
?>
  <tr>
  	<td style="width:3%;font-size:9px;text-align:center"><?=$no?></td>
    <td style="width:5%;font-size:9px;text-align:left" ><?php echo ucfirst(strtolower($zoro['tgl_penjualan']));?></td>
    <td style="width:12%;font-size:9px;text-align:left" ><?php echo ucfirst(strtolower($zoro['no_penjualan']));?></td>
    
    <td style="width:5%;font-size:9px;text-align:center"><?=$zoro['nama_cus']?></td>
    
    <td style="width:13%;font-size:9px;text-align:center"><?=$zoro['alamat_usaha']?></td>
    <td style="width:5%;font-size:9px;text-align:center"><?=$zoro['nama_barang']?></td>
    <td style="width:5%;font-size:9px;text-align:right"><?=number_format($zoro['qty_jual'])?></td>
    <td style="width:5%;font-size:9px;text-align:right"><?=number_format($zoro['harga_jual'])?></td>
    <td style="width:5%;font-size:9px;text-align:right"><?=number_format($zoro['dtl_total'])?></td>
    <td style="width:5%;font-size:9px;text-align:center"> </td>
    <td style="width:5%;font-size:9px;text-align:right"><?=number_format($dpp)?></td>
    <td style="width:5%;font-size:9px;text-align:right"><?=number_format($ppn)?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="8" style=" background-color:#CCC; width:3%;font-size:11px;text-align:center">Total</td>
    <td colspan="4"style="width:3%;font-size:11px;text-align:right"><?=number_format($total)?></td>
</tr>
</table>