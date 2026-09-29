<?php 
require( 'webclass.php' );
$db=new kelas;
session_start();
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
</style>
<?php
					$kon=$db->select("v_report_penjualan","*","id_pj='$_GET[id_pj]'");
					foreach($kon as $val){

?>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
<td style="width:90%;font-size:20px;" align="center" class="td2"><b>KWITANSI</b><br></td>
</tr>
</table><br>

<table cellpadding="0"  cellspacing="0" style="width:98%;">
<tr>
          <td colspan="3"style="width:50%;">Tanggal : <?=$val['tgl_penjualan']?></td>
          <td>Nomer :<?=$val['no_penjualan']?></td>
          
  </tr>
  <tr>
  <td class="td2" align="Center" style="font-size:11px;"></td>
</tr>
<tr>
 

  <td class="td2" align="left" style="font-size:11px;"></td>
</tr>
</table>
<br>

<table cellpadding="0" cellspacing="0" style="width:98%;" class="table" border="1">
  <tr>
  	<td style="width:10%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:20%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:20%;font-size:10px;text-align:center"><b>Qty</b></td>
    <td style="width:20%;font-size:10px;text-align:center"><b>Harga</b></td>
    <td style="width:20%;font-size:10px;text-align:center"><b>Total</b></td>
  </tr>
  <?php
$no=1;
?>			
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:30%;font-size:11px;text-align:left"><?=$val['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$val['qty_jual']?></td>
    <td style="width:10%;font-size:11px;text-align:center"><?=number_format($val['harga_jual'])?></td>
    <td style="width:10%;font-size:11px;text-align:center"><?=number_format($val['dtl_total'])?></td>
  </tr>
<tr>
  	<td colspan="5" style="width:3%;font-size:11px;text-align:right">&nbsp;</td>
  </tr>
</table>
<table width="97%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="3"style="width:40%;">Subtotal: <?=number_format($val['total_jual'])?></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="3"style="width:40%;">Disc: <?=$val['disc_prs']?></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="3"style="width:40%;">Grandtotal: <?=number_format($val['grantot_jual'])?></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="3"style="width:40%;">Bayar: <?=number_format($val['bayar_tunai']+$val['bayar_card'])?></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="3"style="width:40%;">Kembali&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?=number_format($val['kembali_tunai'])?></td>
                        </tr>
</table>
<?php $no++;

}?>
<p>
<font size="-1">
<i>Dicetak pada tanggal : <?php echo date("d-m-Y H:i:s")?></i> 
</font>
</p>
