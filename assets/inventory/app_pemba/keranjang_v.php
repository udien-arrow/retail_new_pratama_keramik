<?php
		$kon=$db->select("tx_order_tagihan a JOIN tx_order_tagihan_dtl b on a.no_pt=b.no_pt","a.id_supp,b.*","b.no_pt='$_GET[id]' group by b.no_billing");
        foreach($kon as $d){  
		?>
&nbsp;<b>No Billing</b> : <?=$d['no_billing'];?> 
<input type="hidden" name="no_billing[]" style="width:80px;" value="<?=$d['no_billing']?>">
<a data-toggle="modal" id="mod" data-target="#datapelanggan" onClick="viewdk('<?=$d[no_billing]?>','<?=$_GET[id]?>','<?=$d[id_supp]?>')">
                        <input style="float:right;width:80px;" value="K/D Note" class="btn btn-primary" readonly></a>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="10%" align="center"><strong>No SPJ</strong></td>
          <td width="10%"align="center"><strong>Qty</strong></td>
          <td width="10%" align="center"><strong>Harga</strong></td>
          <td width="10%" align="center"><strong>Total</strong></td>
          <td width="15%" align="center"><strong>Status</strong></td>
    </tr>
   <?php 
   $ce=$db->select("tx_billing_dtl a LEFT JOIN tx_brg_masuk b on a.no_spj=b.surat_jalan","a.*,b.no_masuk","a.no_billing='$d[no_billing]'");
   $no=1;
   foreach($ce as $cak){
	   $ss=$db->select("tx_order_tagihan_dtl","sum(retur) as ret,sum(koreksi_habel) as korek","no_billing='$d[no_billing]'");
	   foreach($ss as $jk){}
	   $hit=0;
		$tam=0;
	if($cak['no_masuk']==''){
		$ck="<font color='red'>Belum Diterima</font>";
		}else{ $ck="<font color='green'>Sudah Diterima</font>"; }
   ?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?=$cak['no_spj'];?>&nbsp;</td>
          <td align="right">&nbsp;<?=number_format($cak['qty'])?>
          <input type="hidden" name="qty[]" style="width:80px;" value="<?=$cak['qty']?>"></td>
          <td align="right">&nbsp;<?=number_format($cak['harga'])?>&nbsp;
          <input type="hidden" name="harga[]" style="width:80px;" value="<?=$cak['harga']?>"></td>
          <td align="right">&nbsp;<?=number_format($cak['total'])?>&nbsp;
          <input type="hidden" name="total[]" style="width:80px;" value="<?=$cak['total']?>"></td>
          <td align="center">&nbsp;<?=$ck?>&nbsp;</td>
     </tr>
        <?php $no++;
		$kmtg=$db->select("m_klaim_ktg ORDER BY tgl_berlaku desc LIMIT 1","*");
		foreach($kmtg as $kmt){}
		$kd=$db->select("tx_order_tagihan_kd_tmp","*","digunakan_bill='$d[no_billing]'");
foreach($kd as $kdn){
	
	if($kdn['jenis']==0)
{
	$hit=($kdn['claim_utuh']*$kdn['harga'])+($kdn['claim_ktg']*$kmt['harga']);
}elseif($kdn['jenis']==1)
{
	$hit=$kdn['total'];
}elseif($kdn['jenis']==2){
	$tam=$kdn['total'];
}
 	}
		$tot=$tot+$sub;
		$all=$all+$cak['total'];
		$qty=$qty+$cak['qty'];
		$hargas=$hargas+$cak['harga'];
   }  ?>
   	<tr>
    <td colspan="2" align="right"><b>Sub Total</b></td>
    <td align="right"><?=number_format($qty)?></td>
    <td align="right"><?=number_format($hargas)?></td>
    <td align="right"><?=number_format($all)?></td>
    <td></td>
    </tr>
    <tr>
    <td colspan="4" align="right"><b>Total Retur</b></td>
    <td align="right"><?=number_format($jk['ret'])?></td>
    <td></td>
    </tr>
    <tr>
    <td colspan="4" align="right"><b>Total Koreksi</b></td>
    <td align="right"><?=number_format($jk['korek'])?></td>
    <td></td>
    </tr>
    <tr>
    <td colspan="4" align="right"><b>Total</b></td>
    <td align="right"><?=number_format($all-$jk['ret']+$jk['korek'])?></td>
    <td></td>
    </tr>
</table>
<?php $kd=$db->select("tx_order_tagihan_kd_tmp","*","digunakan_bill='$d[no_billing]' and (jenis='0' or jenis='1')");
foreach($kd as $kdn){} 
if(count($kd)!='0'){
?>
&nbsp;<b>Kredit Note</b>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
<tr>
<td align="center"><strong>No Billing</strong></td>
<td align="center"><strong>No SPJ</strong></td>
<td align="center"><strong>Qty</strong></td>
<td align="center"><strong>Harga</strong></td>
<td align="center"><strong>Sub Total</strong></td>
<td align="center"><strong>Claim Ktg</strong></td>
<td align="center"><strong>Claim Utuh</strong></td>
<td align="center"><strong>Total</strong></td>
<td align="center"><strong>Aksi</strong></td>
</tr>
<?php $kd=$db->select("tx_order_tagihan_kd_tmp","*","digunakan_bill='$d[no_billing]' and (jenis='0' or jenis='1')");
foreach($kd as $kdn){ ?>
<tr>
<td><?=$kdn['no_billing']?></td>
<td><?=$kdn['no_spj']?></td>
<td align="right"><?=number_format($kdn['qty'])?></td>
<td align="right"><?=number_format($kdn['harga'])?></td>
<td align="right"><?=number_format($kdn['total'])?></td>
<td align="right"><?=number_format($kdn['claim_ktg'])?></td>
<td align="right"><?=number_format($kdn['claim_utuh'])?></td>
<?php 
if($kdn['jenis']==0)
{
	$hit=($kdn['claim_utuh']*$kdn['harga'])+($kdn['claim_ktg']*1000);
}elseif($kdn['jenis']==1)
{
	$hit=$kdn['total'];
}
?>
<td align="right"><?=number_format($hit)?></td>
<td align="center"><ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='hapus(<?php echo $kdn['id'];?>)' class='icon-subtract' style='cursor:pointer'></a></li>
			</ul></td>
</tr>
<?php } ?>
</table>
<?php } ?> 
<?php $kd=$db->select("tx_order_tagihan_kd_tmp","*","digunakan_bill='$d[no_billing]' and (jenis='2' or jenis='3)'");
foreach($kd as $kdn){} 
if(count($kd)!='0'){
?>
&nbsp;<b>Debet Note</b>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
<tr>
<td align="center"><strong>No Billing</strong></td>
<td align="center"><strong>No SPJ</strong></td>
<td align="center"><strong>Qty</strong></td>
<td align="center"><strong>Harga</strong></td>
<td align="center"><strong>Sub Total</strong></td>
<td align="center"><strong>Claim Ktg</strong></td>
<td align="center"><strong>Claim Utuh</strong></td>
<td align="center"><strong>Total</strong></td>
<td align="center"><strong>Aksi</strong></td>
</tr>
<?php $kd=$db->select("tx_order_tagihan_kd_tmp","*","digunakan_bill='$d[no_billing]' and (jenis='2' or jenis='3')");
foreach($kd as $kdn){ ?>
<tr>
<td><?=$kdn['no_billing']?></td>
<td><?=$kdn['no_spj']?></td>
<td align="right"><?=number_format($kdn['qty'])?></td>
<td align="right"><?=number_format($kdn['harga'])?></td>
<td align="right"><?=number_format($kdn['total'])?></td>
<td align="right"><?=number_format($kdn['claim_ktg'])?></td>
<td align="right"><?=number_format($kdn['claim_utuh'])?></td>
<?php 
if($kdn['jenis']==2)
{
	$hit=$kdn['total'];
}elseif($kdn['jenis']==3)
{
	$hit=$kdn['total'];
}
?>
<td align="right"><?=number_format($hit)?></td>
<td align="center"><ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='hapus(<?php echo $kdn['id'];?>)' class='icon-subtract' style='cursor:pointer'></a></li>
			</ul></td>
</tr>
<?php } ?>
</table>
<?php } ?>
<hr style='background-color:#000000;border-width:0;color:#000000;height:2px;line-height:0;text-align:left;'/>
<?php } ?>	
<br>
<div id="datapelanggan" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h6 class="modal-title">Detil</h6>
							</div>
							<div class="modal-body" id="hahaha">
                            
															
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								
							</div>
						</div>
					</div>
				</div>

      
