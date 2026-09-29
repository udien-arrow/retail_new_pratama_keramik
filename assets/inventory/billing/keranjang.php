<?php
$kon=$db->select("tx_brg_masuk a 
		left join tx_brg_masuk_dtl b on a.no_masuk=b.no_masuk
		left join m_barang c on b.id_barang=c.id_barang
		left join m_satuan d on b.sat=d.id_satuan","a.no_masuk,a.tgl,a.surat_jalan,b.qty_terima,b.harga_beli,b.total,b.qty,b.sat,b.id_barang,c.nama_barang,d.nama_satuan,a.id_cabang","a.no_ref='$_GET[noref]' and a.surat_jalan not in (select ifnull(0,no_spj) from tx_billing_dtl) order by a.surat_jalan asc");
		$jum=count($kon);
?>
<div class="table-responsive pre-scrollable">
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="5%" align="center"><input type="checkbox"  value="<?=$d['nama_gudang']?>" onclick="checkedAll(<?=$jum?>)" id="call"></td>
          <td align="center" width="10%"><strong>No Masuk</strong></td>
          <td width="10%"align="center"><strong>Tgl Masuk</strong></td>
          <td width="10%" align="center"><strong>No SPJ</strong></td>
          <td width="20%" align="center"><strong>Item</strong></td>
          <td width="5%" align="center"><strong>Sat</strong></td>
          <td width="5%" align="center"><strong>Qty</strong></td>
          <td width="10%" align="center"><strong>Harga</strong></td>
          <td width="10%" align="center"><strong>Total</strong></td>
          <td width="10%" align="center"><strong>No faktur Pajak</strong></td>
    </tr>
        <?php
		
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><input type="checkbox" <?php if($valcek[id_barang]!=''){echo "checked";}?> name="no_spj[<?=$no?>]" id="split<?=$no?>" value="<?=$d['surat_jalan']?>" onClick="hit(<?=$no?>)">&nbsp;</td>
          <td>&nbsp;<?=$d['no_masuk']?>&nbsp;
          <input type="hidden" name="no_masuk[<?=$no?>]" value="<?=$d['no_masuk']?>">
          <input type="hidden" name="id_barang[<?=$no?>]" value="<?=$d['id_barang']?>">
          <input type="hidden" name="id_satuan[<?=$no?>]" value="<?=$d['sat']?>">
          <input type="hidden" name="qty[<?=$no?>]" value="<?=$d['qty_terima']?>">
          <input type="hidden" name="tgl_masuk[<?=$no?>]" value="<?=$d['tgl']?>">
          <input type="hidden" name="harga[<?=$no?>]" value="<?=$d['harga_beli']?>">
          <input type="hidden" name="total[<?=$no?>]" id="total<?=$no?>" value="<?=$d['total']?>">
          <input type="hidden" name="id_cabang[<?=$no?>]" id="id_cabang<?=$no?>" value="<?=$d['id_cabang']?>">
          </td>
          <td align="left">&nbsp;
          <?=date("d-m-Y",strtotime($d['tgl']))?></td>
          <td align="center">&nbsp;<?=$d['surat_jalan']?>&nbsp;</td>
          <td align="left">&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="center"><?=$d['nama_satuan']?></td>
          <td align="right"><?=number_format($d['qty_terima'])?>&nbsp;</td>
          <td align="right"><?=number_format($d['harga_beli'])?>&nbsp;</td>
          <td align="right"><?=number_format($d['total'])?>&nbsp;</td>
          <td align="right"><input type="text" size="12" class="form-control"  name="nof[<?=$no?>]" id="nof_<?=$no.'_'.$d['surat_jalan']?>" value="" onKeyUp="fak(<?=$no?>,'<?=$d['surat_jalan']?>')"></td>
     </tr>
        <?php
			$totq=$totq+$d['qty_terima'];
			$totjum=$totjum+$d['total'];
		 $no++;
		 } ?>
          <tr>
          <td colspan="6" align="center"><input type="hidden" name="jumrow" id="jumrow" value="<?=$no?>">
            <input type="hidden" name="faktur_in" id="faktur_in" value=""></td>
          <td align="right"><?=number_format($totq)?>&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td align="right"><?=number_format($totjum)?>&nbsp;</td>
    </tr>
</table>	
</div>