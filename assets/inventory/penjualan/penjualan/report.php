<?php 
session_start ();
require( 'webclass.php' );
$db=new kelas;
error_reporting();
?>
<style>
table {
		  border-collapse: collapse;
	  }
.table, {
				  border: 1px solid #DDD ;
				  padding:1px;
			  }
.th2{	
		border-top: 1px solid #ddd;	
	}
.td2 {
			   
               border: 0px solid #666; font-size:12px; 
               vertical-align:middle; padding:0px;line-height:15px;
           }
.kop{
	border: 0px;
}
</style>
  <?php 
$kon=$db->select("v_report_penjualan","*","no_penjualan='$_GET[no_pj]'");
					foreach($kon as $val){}
$no=1;
?>
 <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop" align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
   
<table cellpadding="0" cellspacing="0" style="width:50%;" class="table" border="1" align="left">
<tr>
  	<td style="width:25%;font-size:12px;text-align:center"><b>Tanggal</b></td>
    <td style="width:40%;font-size:12px;text-align:left"><?=$val['tgl_penjualan']?></td>
 </tr>
 <tr>
  	<td style="width:25%;font-size:12px;text-align:center"><b>Nomer</b></td>
    <td style="width:40%;font-size:12px;text-align:left"><?=$val['no_penjualan']?></td>
 </tr>
 <?php if($val['id_customer']!=''){?>
  <tr>
  	<td style="width:25%;font-size:12px;text-align:center"><b>Customer</b></td>
    <td style="width:40%;font-size:12px;text-align:left"><?=$val['nama_usaha']?></td>
 </tr>
 <tr>
  	<td style="width:25%;font-size:12px;text-align:center"><b>Alamat</b></td>
    <td style="width:40%;font-size:12px;text-align:left"><?=$val['alamat_usaha']?></td>
 </tr>
 <?php }?>
</table>
<br><br>


<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
<td style="width:90%;font-size:20px;" align="center" class="td2"><b>KWITANSI</b><br></td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:100%;" class="table" border="1">
  <tr>
  	<td style="width:5%;font-size:12px;text-align:center"><b>No</b></td>
    <td style="width:30%;font-size:12px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:15%;font-size:12px;text-align:center"><b>Qty</b></td>
    <td style="width:10%;font-size:12px;text-align:center"><b>Disc</b></td>
    <td style="width:20%;font-size:12px;text-align:center"><b>Harga</b></td>
    <td style="width:20%;font-size:12px;text-align:center"><b>Total</b></td>
  </tr>

<?php 

$kon=$db->select("pj_penjualan a left join pj_penjualan_dtl b on a.id_pj=b.id_pj left join m_barang c on b.id_barang=c.id_barang","a.*,b.*,c.nama_barang","a.no_penjualan='$_GET[no_pj]'");
foreach($kon as $val2){

?>
  <tr>
  	<td style="width:3%;font-size:12px;text-align:center"><?=$no?></td>

    <td style="width:20%;font-size:12px;text-align:left"><?=$val2['nama_barang']?></td>
    <td style="width:8%;font-size:12px;text-align:center"><?=$val['qty_jual']?></td>
    <td style="width:8%;font-size:12px;text-align:center"><?=$val['disc_prs']?>%</td>
    <td style="width:5%;font-size:12px;text-align:right"><?=number_format($val['harga_jual'])?></td>
    <td style="width:5%;font-size:12px;text-align:right"><?=number_format($val['dtl_total'])?></td>
  </tr>
<?php $no++;

}
 ?>
</table><br>


<table cellpadding="0" cellspacing="0" style="width:50%;" class="table" border="1" align="right">
<tr>
  	<td style="width:35%;font-size:12px;text-align:center"><b>Subtotal</b></td>
    <td style="width:40%;font-size:12px;text-align:right"><?=number_format($val['total_jual'])?></td>
 </tr>
 <tr>
  	<td style="width:35%;font-size:12px;text-align:center"><b>Disc</b></td>
    <td style="width:40%;font-size:12px;text-align:right"><?=$val['disc_rp']?></td>
 </tr>
 <tr>
  	<td style="width:35%;font-size:12px;text-align:center"><b>Grandtotal</b></td>
    <td style="width:40%;font-size:12px;text-align:right"><?=number_format($val['grantot_jual'])?></td>
 </tr>
 
 <tr>
  	<td style="width:35%;font-size:12px;text-align:center"><b>Bayar</b></td>
    <td style="width:40%;font-size:12px;text-align:right"><?=number_format($val['bayar_tunai'])?></td>
 </tr>
 
 <tr>
  	<td style="width:35%;font-size:12px;text-align:center"><b>Kembali</b></td>
    <td style="width:40%;font-size:12px;text-align:right"><?=number_format($val['kembali_tunai'])?></td>
 </tr>

 
</table>
<br>


<p>
<font size="-1">
<i>Dicetak pada tanggal : <?php echo date("d-m-Y H:i:s")?></i> 
</font>
</p>
