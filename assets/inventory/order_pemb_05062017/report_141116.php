<?php 
require( 'webclass.php' );
$db=new kelas;
session_start();
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
		border-top: 1px solid #ddd;	
	}
.td2 {
			   
               border: 0px solid #666; font-size:12px; 
               vertical-align:middle; padding:0px;line-height:15px;
           }
</style>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
<td style="width:100%;font-size:15px;" align="center" class="td2"><b>PERMINTAAN PEMBAYARAN BILLING TAGIHAN</b></td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
 <?php
					$supp=$db->select("v_order_tag","*","no_pt='$_GET[id]'");
					foreach($supp as $valsupp){}
					
					
					?>
<td class="td2" align="left" style="font-size:11px;">
No  :<b> <?=$valsupp['no_pt']?></b><br>
Supplier  :<b> <?=$valsupp['nama_usaha']?></b>
  <br>Tanggal :<b> <?=date("d-m-Y",strtotime($valsupp['tgl_pt']))?></b>
</td>

</tr>
</table>
<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  <td rowspan="2" style="width:20%;font-size:10px;text-align:left"><p><b>Jenis Pembayaran</b></p>
    <p> <input type="checkbox" name="cek" value="Pengadaan"/>Pengadaan<br/>
<input type="checkbox" name="cek" value="Biaya"/>Biaya<br/>
<input type="checkbox" name="cek" value="Investasi"/>Investasi<br/>
<input type="checkbox" name="cek" value="Lain-Lain"/>Lain-Lain<br/> </p></td>
  	<td rowspan="2" style="width:20%;font-size:10px;text-align:left"><p><b>Jenis Pembayaran</b></p>
  <p> <input type="checkbox" name="cek" value="Tunai"/>Tunai<br/>
<input type="checkbox" name="cek" value="Cek"/>Cek<br/>
<input type="checkbox" name="cek" value="Giro"/>Giro<br/>
<input type="checkbox" name="cek" value="Transfer"/>Transfer<br/> </p>
   </td>
    <td rowspan="2" style="width:30%;font-size:10px;text-align:left"><p><b>Dibayar Kepada</b>    </p>
      <p><?=$valsupp['nama_usaha']?></p>
      <p>&nbsp;</p>
    </td>
    <td style="width:30%;font-size:10px;text-align:left"><p><b>Anggaran</b></p>
    <p>Rp.</p></td>
  </tr>
 
  <tr>
  	

    <td style="width:10%;font-size:10px;text-align:left"><p><b>Anggaran</b></p>
    <p>Rp.</p></td>
  </tr>


</table>
<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No Billing</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No SPJ</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Jumlah</b></td>
  </tr>
 <?php
	$kon=$db->select("tx_order_tagihan_dtl","*","no_pt='$_GET[id]'");
	$no=1;
	$tot=0;
	foreach($kon as $dtl){	
	$tot+=$dtl['total_bil'];		
	?>
  <tr>
  	<td style="width:5%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:25%;font-size:11px;text-align:left"><?=$dtl['no_billing']?></td>
    <td style="width:40%;font-size:11px;text-align:left"><?=$dtl['no_spj']?></td>
    <td style="width:30%;font-size:11px;text-align:right"><?=number_format($dtl['total_bil'])?></td>
  </tr>
<?php $no++; } ?>
<tr>
  	
    <td colspan="3 " style="width:20%;font-size:11px;text-align:right"><b>Jumlah</b></td>
    <td style="width:30%;font-size:11px;text-align:right"><?=number_format($tot)?></td>
</tr>
<tr>
  	<td colspan="3" style="width:3%;font-size:11px;text-align:right"><b>PPN 10%</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($tot)?></td>
</tr>
<tr>
  	<td colspan="3" style="width:3%;font-size:11px;text-align:right"><b>Dibayar</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($tot)?></td>
</tr>
</table><br>