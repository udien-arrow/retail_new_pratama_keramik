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
  <td colspan="11" align="center" class="th2">
  <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop"align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
  <b><br>LAPORAN PEMBELIAN 
                                <?php foreach($db->select("m_supplier","nama_usaha","id_supp='$_GET[jenis]'")as $cb); echo $cb['nama_usaha'];?><br><br>
	PERIODE <?=$_GET['a']?> s/d <?=$_GET['b']?></b><br>&nbsp;</td>
  </tr>
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center""><b>No</b></td>
    <td style="width:8%;font-size:10px;text-align:center"><b>Cabang</b></td>
    <td style="width:13%;font-size:10px;text-align:center"><b>No PO</b></td>
    <td style="width:7%;font-size:10px;text-align:center"><b>Tgl</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Supplier</b></td>
    <td style="width:7%;font-size:10px;text-align:center"><b>Shipto</b></td>
    <td style="width:7%;font-size:10px;text-align:center"><b>Kode </b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:6%;font-size:10px;text-align:center"><b>Qty</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Harga</b></td>
    <td style="width:8%;font-size:10px;text-align:center"><b>Jumlah</b></td>
    
  </tr>
<?php 
$where2="id_supp='$_GET[jenis]' AND tgl_po BETWEEN '$_GET[a]' AND '$_GET[b]'";
$z=$db->select("v_l_po","*",$where2);
$no=1;
$total=0;
foreach($z as $zoro){
$a=explode("_",$zoro['gab']);
$total=$total+$a[1];
?>
  <tr>
  	<td style="width:3%;font-size:9px;text-align:center"><?=$no?></td>
    <td style="width:10%;font-size:9px;text-align:left"><?=$zoro['nama_cabang']?></td>
    <td style="width:10%;font-size:9px;text-align:left"><?=$zoro['no_po']?></td>
    <td style="width:8%;font-size:9px;text-align:left"><?=date("d-m-Y",strtotime($zoro['tgl_po']))?></td>
    <td style="width:10%;font-size:9px;text-align:left"><?=$zoro['nama_usaha']?></td>
    <td style="width:7%;font-size:9px;text-align:left"><?=$zoro['shipto_code']?></td>
    <td style="width:10%;font-size:9px;text-align:left"><?=$zoro['kode_barang']?></td>
    <td style="width:12%;font-size:9px;text-align:left"><?=$zoro['nama_barang']?></td>
    <td style="width:5%;font-size:9px;text-align:left"><?=$zoro['qty']?></td>
    <td style="width:5%;font-size:9px;text-align:center"><?=number_format($zoro['harga_beli'])?></td>
    <td style="width:6%;font-size:9px;text-align:center"><?=number_format($a[1])?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="10" style="width:3%;font-size:9px;text-align:center"></td>
    <td style="width:3%;font-size:9px;text-align:center"><?=number_format($total)?></td>
</tr>
</table>