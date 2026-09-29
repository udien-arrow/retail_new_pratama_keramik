<div class="table-responsive pre-scrollable">
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="5%"align="center"><strong>No</strong></td>
          <td align="center" width="20%"><strong>No Billing</strong></td>
          <td align="center" width="10%"><strong>Claim</strong></td>
          <td align="center" width="20%"><strong>Sub Total</strong></td>
          <td width="26%" align="center"><strong>Total</strong></td>
          <td width="5%" align="center"><strong>#</strong></td>
    </tr>
        <?php
		$kon=$db->select("ex_order_tagihan_tmp","*");
        $no=1;
		$jwa['totalclaim']='';
		$kurang=0;
        foreach($kon as $d){ 
		$jw=$db->select("ex_expediture a
JOIN tx_po b ON a.no_so = b.no_jwa
OR a.no_so = b.no_so
LEFT JOIN tx_brg_masuk c ON c.no_ref = b.no_po
LEFT JOIN m_gudang e ON c.id_gudang = e.id_gudang
LEFT JOIN tx_retur_pem f on c.no_masuk=f.no_ref
LEFT JOIN tx_retur_pem_dtl g on f.no_retur=g.no_retur
LEFT JOIN ex_claim_pab h on h.no_ref=f.no_retur
LEFT JOIN ex_claim_pab_dtl i on h.no_claim=i.no_claim","b.no_jwa AS no_so,
c.*,
e.nama_gudang,
i.no_claim,
i.qty_retur,
i.qty_claim,
i.total as totalclaim","no_expediture='$d[no_expediture]'");
$jwa['totalclaim']='';
	foreach($jw as $jwa){}
	
	$kurang=0;
	$kurang=$kurang+$jwa['totalclaim'];
	$total=$d['total_ao']-$kurang;
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td><a data-toggle="modal" id="mod" data-target="#datapelanggan" onClick="cekPel('<?=$d[no_expediture]?>')"><?=$d['no_expediture']?></a></td>
          <td align="right"><?=number_format($kurang);?>
          <input type="hidden" name="returs[]" id="returs" value="<?=$kurang?>" style="width:80px;">&nbsp;</td>
          <td align="right"><?=number_format($d['total_ao'])?>&nbsp;
          <input type="hidden" name="ids[]" id="ids" value="<?=$d['id_expediture']?>">
          <input type="hidden" name="totals[]" id="total" value="<?=$d['total_ao']-$kurang?>">
          <input type="hidden" name="totao[]" id="totao" value="<?=$d['total_ao']?>">
          </td>
          <td align="right"><?=number_format($d['total_ao']-$kurang)?>&nbsp;</td>
          <td align="center">&nbsp;<a href="javascript:void(0)" onclick="hapus(<?php echo $d['id_tmp'];?>)">hapus</a>&nbsp;</td>
     </tr>
        <?php
			
			$totjum=$totjum+($d['total_ao']-$kurang);
		 $no++;} ?>
          <tr>
          <td colspan="4" align="center">&nbsp;</td>
          <td align="right"><?=number_format($totjum)?>&nbsp;</td>
          <td align="right">&nbsp;</td>
    </tr>
</table>	
</div>