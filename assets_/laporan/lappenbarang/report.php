<?php 
session_start ();
require( 'webclass.php' );
$db=new kelas;
error_reporting(0);
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
   <b><br>LAPORAN DETAIL PENJUALAN
   <br>PERIODE <?=$_GET['a']?> s/d <?=$_GET['b']?></b><br>&nbsp;</td>
  </tr>
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
  	<th style="width:10%; font-size:10px; text-align:center">Nomer penjualan </th>
    <th style="width:10%; font-size:10px; text-align:center"  >Tgl Penjualan</th>
    <th style="width:10%; font-size:10px; text-align:center" >Jenis Jual</th>
    <th style="width:10%;font-size:10px; text-align:center" >Jenis Bayar</th>
    <th style="width:15%;font-size:10px; text-align:center" >Nama Barang</th> 
    <th style="width:5%;font-size:10px; text-align:center" >Qty</th>
    <th style="width:10%; font-size:10px; text-align:center" >Harga Jual</th>
    <th style="width:5%; font-size:10px; text-align:center" >Disc</th>
    <th style="width:10%;font-size:10px; text-align:center" >Disc Rupiah</th>
    <th style="width:10%; font-size:10px; text-align:center" >Total</th> 
  </tr>
<?php 
	if($_GET['jenis']=='2'){
		if($_GET['jenis_jual']=='x'){
			$isi="";	
		}else{
			$isi=" and jenis_jual='$_GET[jenis_jual]'";	
		}		
		$where2="date(tgl_penjualan) BETWEEN '$_GET[a]' AND '$_GET[b]' $isi";
	}else if($_GET['jenis']=='3'){
		if($_GET['jenis_bayar']=='x'){
			$isi="";	
		}else{
			$isi=" and jenis_bayar='$_GET[jenis_bayar]'";	
		}
		$where2="date(tgl_penjualan) BETWEEN '$_GET[a]' AND '$_GET[b]' $isi";
	}

$z=$db->select("pj_penjualan a left join pj_penjualan_dtl b on a.id_pj=b.id_pj join m_barang c on b.id_barang=c.id_barang", "a.*,b.*,c.nama_barang", $where2);
$no=1;
$total=0;
foreach($z as $zoro){
$total=$total+$zoro['total_jual'];
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
    <td style="width:10%;font-size:9px;text-align:center"><?=$zoro['nama_barang']?></td>
    <td style="width:5%;font-size:9px;text-align:center"><?=$zoro['qty_jual']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=number_format($zoro['harga_jual'])?></td>
    <td style="width:5%;font-size:9px;text-align:center"><?=$zoro['discprs']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=number_format($zoro['discrp'])?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=number_format($zoro['total_jual'])?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="10" style="width:3%;font-size:9px;text-align:center">Total</td>
    <td style="width:3%;font-size:9px;text-align:center"><?=number_format($total)?></td>
</tr>
</table>