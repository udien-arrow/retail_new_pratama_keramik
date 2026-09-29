<div class="table-responsive pre-scrollable">
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="14%"align="center"><strong>No</strong></td>
          <td align="center" width="55%"><strong>No Billing</strong></td>
          <td align="center" width="10%"><strong>Retur</strong></td>
          <td width="26%" align="center"><strong>Total Bil</strong></td>
          <td width="26%" align="center"><strong>Total</strong></td>
          <td width="5%" align="center"><strong>#</strong></td>
    </tr>
        <?php
		$kon=$db->select("tx_order_tagihan_tmp","*");
        $no=1;
        foreach($kon as $d){
		$bil=$db->select("tx_billing_dtl","*","no_billing='$d[no_billing]'");
		$kurang=0;
		$kurang1=0;
		foreach($bil as $bills){
		$re=$db->select("tx_billing a
JOIN tx_brg_masuk b ON a.no_ref = b.no_ref
JOIN tx_brg_masuk_dtl d on b.no_masuk=d.no_masuk
LEFT JOIN tx_retur_pem c ON d.no_masuk = c.no_ref
LEFT JOIN tx_retur_pem_dtl e on c.no_retur=e.no_retur and d.id_barang=e.id_barang","d.harga_beli,e.qty_kembali","no_billing = '$d[no_billing]'
	and e.id_barang='$bills[id_barang]'");
	foreach($re as $ret){
		$kurang=$ret['qty_kembali']*$ret['harga_beli'];
		$kurang1=$kurang1+$kurang;
		} 
		$totall=$d['total_bil']-$kurang1;

	} 
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;
          <a data-toggle="modal" id="mod" data-target="#datapelanggan" onClick="cekPel('<?=$d[no_billing]?>')"><?=$d['no_billing']?></a>
          <input type="hidden" name="nobi[]" id="nobi<?=$d['no_billing']?>"  value="<?=$d['no_billing']?>"  required>
          </td>
          <td align="right">
		  <input type="hidden" name="returs[]" id="returs"  value="<?=$kurang1?>"  required>
          <input type="hidden" name="idbill[]" id="idbill"  value="<?=$d['id_billing']?>"  required>
		  <?=number_format($kurang1)?>&nbsp;</td>
          <td align="right"><?=number_format($d['total_bil'])?>&nbsp;</td>
          <td align="right"><input type="hidden" name="totalper[]" id="totalper"  value="<?=$totall?>"  required>
		  <?=number_format($totall)?>&nbsp;
          </td>
          <td align="right">&nbsp;<a href="javascript:void(0)" onclick="hapus(<?php echo $d['id_tmp'];?>)">hapus</a>&nbsp;</td>
     </tr>
        <?php
			
			$totjum=$totjum+$totall;
		 $no++;} ?>
          <tr>
          <td colspan="4" align="center"></td>
          <td align="right"><?=number_format($totjum)?>&nbsp;</td>
          <td align="right"></td>
          <input type="hidden" name="nobis" id="nobis"  value=""  required>
    </tr>
</table>	
</div>