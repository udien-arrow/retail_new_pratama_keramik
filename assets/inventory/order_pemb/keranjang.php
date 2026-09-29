
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="5%"align="center"><strong>No</strong></td>
          <td align="center" width="30%"><strong>No Billing</strong></td>
          <td align="center" width="30%"><strong>No SPJ</strong></td>
          <td align="center" width="10%"><strong>Total</strong></td>
          <td align="center" width="10%"><strong>Retur</strong></td>
          <td align="center" width="10%"><strong>Koreksi Harga</strong></td>
          <td width="10%" align="center"><strong>Total</strong></td>
         <!-- <td width="10%" align="center"><b>Koreksi Hutang</b></td>-->
          <td width="10%" align="center"><strong>Total Billing</strong></td>
          <td width="10%" align="center"><strong>Dibayar</strong></td>
          <td width="5%" align="center"><strong>Selisih (+/-)</strong></td>
          <td width="5%" align="center"><strong>#</strong></td>
    </tr>
        <?php
		$kon=$db->select("tx_order_tagihan_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
        $no=1;
        foreach($kon as $d){
		$bil=$db->select("tx_billing_dtl","*","no_billing='$d[no_billing]'");
		$kurang=0;
		$kurang1=0;
		
		foreach($bil as $bills){
		
		foreach($db->select("tx_koreksi_hutang","selisih","no_spj='$bills[no_spj]'")as $kh);
		//$totkh=0;	
		$abs=substr($kh[selisih],0,1);
		$kh['selisih']=abs($kh[selisih]);
		//echo $kh['selisih'].'a';
		
		$re=$db->select("tx_billing a
JOIN tx_brg_masuk b ON a.no_ref = b.no_ref
JOIN tx_brg_masuk_dtl d on b.no_masuk=d.no_masuk
LEFT JOIN tx_retur_pem c ON d.no_masuk = c.no_ref
LEFT JOIN tx_retur_pem_dtl e on c.no_retur=e.no_retur and d.id_barang=e.id_barang
LEFT JOIN tx_koreksi_habel f on b.no_masuk=f.no_ref
LEFT JOIN tx_koreksi_habel_dtl g on f.no_koreksi=g.no_koreksi and d.id_barang=g.id_barang","d.harga_beli,e.qty_kembali,g.total","no_billing = '$d[no_billing]'
	and d.id_barang='$bills[id_barang]' and b.surat_jalan='$bills[no_spj]'");
	foreach($re as $ret){
		$kurang=$ret['qty_kembali']*$ret['harga_beli'];
		$kurang1=$kurang1+$kurang;
		} 
		$totall=$bills['total']-$kurang1+$ret['total'];
		
		
		
		
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;
          <a data-toggle="modal" id="mod" data-target="#datapelanggan" onClick="cekPel('<?=$d[no_billing]?>')"><?=$d['no_billing']?></a>
          <input type="hidden" name="nobi[<?=$no?>]" id="nobi<?=$bills['no_billing']?>"  value="<?=$bills['no_billing']?>"  required>
          <input type="hidden" name="spjs[<?=$no?>]" id="spjs<?=$bills['no_spj']?>"  value="<?=$bills['no_spj']?>"  required>
          </td>
          <td><?=$bills['no_spj']?>
          </td>
          <td align="right"><?=number_format($bills['total'])?></td>
          <td align="right">
		  <input type="hidden" name="returs[<?=$no?>]" id="returs"  value="<?=$kurang1?>"  required>
          <input type="hidden" name="idbill[<?=$no?>]" id="idbill"  value="<?=$bills['id_dtl']?>"  required>
          <input type="hidden" name="idbilling[<?=$no?>]" id="idbilling"  value="<?=$bills['id_billing']?>"  required>
		  <?=number_format($kurang1)?></td>
           <td align="right">
		  <?=number_format($ret['total'])?>
		  <input type="hidden" name="kohabel[<?=$no?>]" id="kohabel"  value="<?=$ret['total']?>"  required="required" /></td>
      <td align="right"><input type="hidden" name="total[<?=$no?>]" id="total"  value="<?=$bills['total']?>"  required>
          <input type="hidden" name="cab[<?=$no?>]" id="cab"  value="<?=$bills['id_cabang']?>"  required="required" />
	    <?=number_format($totall)?></td>
     <!-- <td align="right"><?php
						  			
					/*if($abs=='-'){
						  if($totkh==0){
								$totkhi=$kh['selisih'];
						  }elseif($totkh>=0){
								$totkhi=$totkh;
						  }else{
							  $totkhi=0;
							  $totkh="";
						  }
							
						  if($totkhi >= $totall){
								$isi=0-$totall;  
								echo  number_format($isi);
								$totkh=$totkhi-$totall;
						  }else{
							    $isi=0-$totkhi;
								echo  number_format($isi);
								
								$totkh="-99999";
								$totkhi="";
						  }
					}else{
						  		if($khp<$kh['selisih']){
									$isi=$kh['selisih'];
								}else{
									$isi=0;
								}
								echo number_format($isi);
								$khp+=$kh['selisih'];
					}*/
					
	  ?><input type="hidden" name="korhut[<?=$no?>]" id="korhut"  value="<?=$isi?>"  required>
        
      </td>-->
      <td align="right">
	  <input type="hidden" name="totalper[<?=$no?>]" id="totalper<?=$no?>"  value="<?=$totall?>"  required="required" />
	  <?=number_format($totall,2)?></td>
          <td align="right"><input type="text" style="width:100px" name="totb[<?=$no?>]" class="harga" id="totb<?=$no?>"  value="<?=$totall?>"  required onkeyup="pin(<?=$no?>)" autocomplete="off"></td>
          <td align="right"><input type="text" style="width:100px" name="sel[<?=$no?>]" class="harga" id="sel<?=$no?>"  value="0"  required="required" readonly="readonly" /></td>
          <td align="right"><a href="javascript:void(0)" onclick="hapus(<?php echo $d['id_tmp'];?>)">hapus</a></td>
  </tr>
        <?php
			$kurang1=0;
			$ret['total']=0;
			$totjum=$totjum+$totall;
			$no++;
			//$isi=0; 
			$kh['selisih']=0;
		 }
		
		 
		  } ?>
          <tr>
          <td colspan="6" align="center"></td>
          <td align="right"></td>
          <input type="hidden" name="nobis" id="nobis"  value=""  required>
    </tr>
</table>	
