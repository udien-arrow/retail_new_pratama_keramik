<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tables">
                                <tr>
                                <td align="center" class="tables"><strong>No</strong></td>
                                <td align="center" class="tables"><strong>Pelanggan</strong></td>
                                <td align="center" class="tables"><strong>NO FJ</strong></td>
                                <td align="center" class="tables"><strong>NO SPJ</strong></td>
                                <td align="center" class="tables"><strong>Total Piutang</strong></td>
                                <td align="center" class="tables"><strong><input type="checkbox" name="select-all" id="select-all" /></strong></td>
                                </tr>
                                <tr>
                                </tr>
                                <?php 
								$supp=$db->select("tx_buku_tagihan_dtl a left join m_customer b on a.id_cus=b.id_cus","a.*,b.nama_usaha","a.no='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center" class="tables"><?=$no?></td>
                                <td align="center" class="tables"><?=$valsupp['nama_usaha']?></td>
                                <td align="center" class="tables"><?=$valsupp['no_fj']?></td>
                                <td align="center" class="tables"><?=$valsupp['no_spj']?></td>
                                <td align="center" class="tables"><?=number_format($valsupp['total_piutang'])?></td>
                                <td align="center" class="tables">
                                <?php if($valsupp['status']==0){?>
                                <input type="checkbox" class="control-primary" name="app[]" id="app[]" value="<?=$valsupp['no_fj']?>"></td>
                                <?php }else{} ?>
                                </tr>
                                <?php $no++; } ?>
                                </table>
      
