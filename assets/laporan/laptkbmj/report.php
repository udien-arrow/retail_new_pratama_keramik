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
  <td colspan="11" align="center" class="th2">
  <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop" align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
   <b><br>LAPORAN BONGKAR/MUAT PENJUALAN  CABANG 
    <?=$zoro['nama_cabang']?><br><br>
	PERIODE <?=$_GET['a']?> s/d <?=$_GET['b']?></b><br>&nbsp;</td>
  </tr>
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center""><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No SO</b></td>
    <td style="width:9%;font-size:10px;text-align:center"><b>Tgl</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No SPJ</b></td>
    <td style="width:5%;font-size:10px;text-align:center"><b>Jenis</b></td>
    <td style="width:5%;font-size:10px;text-align:center"><b>Kendaraan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:5%;font-size:10px;text-align:center"><b>Berat</b></td>
    <td style="width:5%;font-size:10px;text-align:center"><b>Qty</b></td>
    <td style="width:5%;font-size:10px;text-align:center"><b>Nilai/kg</b></td>
    <td style="width:3%;font-size:10px;text-align:center"><b>Jumlah</b></td>
    
  </tr>
<?php 
$where2="id_cabang='$_GET[cab]' AND date(tgl) BETWEEN '$_GET[a]' AND '$_GET[b]' and jenis_jual='$_GET[jen]'";
$z=$db->select("v_l_tkbmj","*",$where2);
$no=1;
$total=0;
foreach($z as $zoro){
$total=$total+$zoro['total'];
?>
  <tr>
  	<td style="width:3%;font-size:9px;text-align:center"><?=$no?></td>
    <td style="width:14%;font-size:9px;text-align:center"><?=$zoro['no_so']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=$zoro['tgl']?></td>
    <td style="width:14%;font-size:9px;text-align:center"><?=$zoro['no_spj']?></td>
    <td style="width:8%;font-size:9px;text-align:center"><?php if($zoro['jenis_tkbm']==1){
				$d="Forklif";	
			}
			if($zoro['jenis_tkbm']==2){
				$d="MUAT";	
			}
			if($zoro['jenis_tkbm']==3){
				$d="POK";	
			}echo $d;?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=$zoro['nama']?></td>
    <td style="width:12%;font-size:9px;text-align:center"><?=$zoro['nama_barang']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=$zoro['berat']?></td>
    <td style="width:5%;font-size:9px;text-align:center"><?=$zoro['qty']?></td>
    <td style="width:7%;font-size:9px;text-align:center"><?=$zoro['nilai']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=number_format($zoro['total'])?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="10" style="width:3%;font-size:9px;text-align:right"></td>
    <td style="width:3%;font-size:9px;text-align:center"><?=number_format($total)?></td>
</tr>
</table>