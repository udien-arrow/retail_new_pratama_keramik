<?php 
session_start ();
require( 'webclass.php' );
$db=new kelas;
?>
<style>
table {
		  border-collapse: collapse;
	  }
.table, .td, .th {
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

<table cellpadding="0" cellspacing="0" style="width:100%;" border="">
  <tr>
  <?php 
$z=$db->select("m_cabang","*","id_cabang='$_GET[cab]'");
foreach($z as $zoro){}
/*if($_GET['jenis']=='KM'){
   $jn="KAS MASUK";
}elseif($_GET['jenis']=='BM'){
	$jn="BANK MASUK";
}elseif($_GET['jenis']=='KK'){
	$jn="KAS KELUAR";
}elseif($_GET['jenis']=='BK'){
	$jn="BANK KELUAR";	
}*/
?>

  <td align="center" class="th2" style="width:100%;">
  <table align="left">
     <tr >
       <td class="kop" ><img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='80' height='80'/></td>
       <td class="kop" align="left"><p><b><?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br><?php echo"$_SESSION[ALAMAT]";?></p></td>
     </tr>
   </table>
   <b>LAPORAN JURNAL UMUM CABANG  <?=$zoro['nama_cabang']?><br><br>
	PERIODE <?=date("d-m-Y",strtotime($_GET['a']))?> s/d <?=date("d-m-Y",strtotime($_GET['b']))?></b><br>&nbsp;</td>
  </tr>
  
  <?php 
$aa=date("Y-m-d",strtotime($_GET['a']));
$bb=date("Y-m-d",strtotime($_GET['b']));

	  /*if($_GET['jenis']=='KM' || $_GET['jenis']=='BM'){
		 $dat=$db->select("ak_kas_masuk a join m_cabang b on a.id_cab=b.id_cabang join ak_paruskas c on a.type=c.id_param","a.*,a.idkm as id,b.nama_cabang,c.nama","a.id_cab='$_GET[cab]' and substr(IDKM,1,2)='$_GET[jenis]' and a.tgl_tran between '$aa' and '$bb'");
	  }elseif($_GET['jenis']=='KK' || $_GET['jenis']=='BK'){
		 $dat=$db->select("ak_kas_keluar a join m_cabang b on a.id_cabang=b.id_cabang join ak_paruskas c on a.type=c.id_param","a.*,a.idkk as id,b.nama_cabang,c.nama","a.id_cabang='$_GET[cab]' and substr(IDKK,1,2)='$_GET[jenis]' and a.tgl_tran between '$aa' and '$bb'"); 
	  }*/
	  $dat3=$db->select("ak_jurnal a join ak_jurnal_dtl b on a.NO_JURNAL=b.NO_JURNAL left JOIN ak_acc c ON c.account=b.acc_code LEFT JOIN m_cabang d on b.ID_CAB=d.id_cabang","a.IDKM as IDKM,b.no_jurnal as no_jurnal, b.tgl_jurnal as tgl_jurnal, b.acc_code as acc_code,d.nama_cabang, b.KET_DTL as KET_DTL, b.debet, b.kredit, c.description as desk","b.NO_JURNAL='$_GET[id]' AND date(a.tgl_jurnal) between '$aa' AND '$bb' and d.id_cabang='$_GET[cab]'");
	  ;
	  foreach($dat3 as $dats3){}
?>
<tr>
    <td style="width:100%;">
   	 Tanggal : <?=date("d-m-Y",strtotime($dats3['tgl_jurnal']))?>
    </td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" style="width:100%;" border="1">
<tr>
    <td style="width:5%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No Jurnal</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No Reff</b></td>        
    <td style="width:20%;font-size:10px;text-align:center"><b>COA</b></td>
    <td style="width:25%;font-size:10px;text-align:center"><b>Deskripsi</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Debet</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Kredit</b></td>           
</tr>
 <?php
	$dat=$db->select("ak_jurnal a join ak_jurnal_dtl b on a.NO_JURNAL=b.NO_JURNAL left JOIN ak_acc c ON c.account=b.acc_code LEFT JOIN m_cabang d on b.ID_CAB=d.id_cabang","a.IDKM as IDKM,b.no_jurnal as no_jurnal, b.tgl_jurnal as tgl_jurnal, b.acc_code as acc_code,d.nama_cabang, b.KET_DTL as KET_DTL, b.debet, b.kredit, c.description as desk","b.NO_JURNAL='$_GET[id]' AND date(a.tgl_jurnal) between '$aa' AND '$bb' and d.id_cabang='$_GET[cab]'");
		  ;
	  $no=1;
	  $total=0;
	  $total1=0;
	  foreach($dat as $dat2){
		  $total=$total+$dat2['debet'];
		  $total1=$total+$dat2['kredit'];
	?>
<tr>  
 
  	<td style="font-size:9px;text-align:center"><?=$no?></td>
    <td style="font-size:9px;text-align:left"><?=$dat2['no_jurnal']?></td>
    <td style="font-size:9px;text-align:left"><?=$dat2['IDKM']?></td>    
    <td style="font-size:9px;text-align:left"><?=$dat2['acc_code']?></td>
    <td style="font-size:9px;text-align:left"><?=$dat2['desk']?></td>
    <td style="font-size:9px;text-align:right"><?=number_format($dat2['debet'])?></td>
    <td style="font-size:9px;text-align:right"><?=number_format($dat2['kredit'])?></td>
</tr>
<?php $no++;} ?>
<tr>
  	<td colspan="5" style="width:3%;font-size:9px;text-align:center">Total</td>
    <td style="width:3%;font-size:9px;text-align:right"><?=number_format($total)?></td>
    <td style="width:3%;font-size:9px;text-align:right"><?=number_format($total1)?></td>
    <!--<td colspan="2" style="width:3%;font-size:9px;text-align:center"></td>-->
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" style="width:100%;" border="">
<tr>
	<td align="left" class="td2" colspan="5">
    	Keterangan : <?=$dat2['KET_DTL']?>
    
    </td>
</tr>
<tr>
    <td style="width:20%;" align="center" class="td2" colspan="">Di buat oleh,</td>
    <td style="width:10%;" align="center" class="td2"><br><br>&nbsp;</td>
    <td style="width:20%;" align="center" class="td2" colspan="">Penerima</td>
    <td style="width:10%;" align="center" class="td2"><br><br>&nbsp;</td>
    <td style="width:20%;" align="center" class="td2" colspan="">Diketahui</td>
</tr>

<tr>
    <td style="width:20%;" align="center" class="td3" colspan=""></td>
    <td style="width:10%;" align="center" class="td2"><br><br>&nbsp;</td>
    <td style="width:20%;" align="center" class="td3" colspan=""></td>
    <td style="width:10%;" align="center" class="td2"><br><br>&nbsp;</td>
    <td style="width:20%;" align="center" class="td3" colspan=""></td>
</tr>
<tr>
    <td style="width:20%;" align="center" class="td3" colspan=""></td>
    <td style="width:10%;" align="center" class="td2"><br><br>&nbsp;</td>
    <td style="width:20%;" align="center" class="td3" colspan=""></td>
    <td style="width:10%;" align="center" class="td2"><br><br>&nbsp;</td>
    <td style="width:20%;" align="center" class="td3" colspan=""></td>
</tr>
<tr>
    <td style="width:20%;" align="center" class="td3" colspan="">--------------</td>
    <td style="width:10%;" align="center" class="td2"><br><br>&nbsp;</td>
    <td style="width:20%;" align="center" class="td3" colspan="">--------------</td>
    <td style="width:10%;" align="center" class="td2"><br><br>&nbsp;</td>
    <td style="width:20%;" align="center" class="td3" colspan="">--------------</td>
</tr>
</table>