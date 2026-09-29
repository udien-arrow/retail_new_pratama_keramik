<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:1px;
			}
	</style>
 
              <table width="100%" border="1" cellpadding="1" cellspacing="1">
                  <tr>
                    <td height="59" colspan="7" align="left"><b>&nbsp;
					<?php if($valsupp['status_so']=='3'){?>
                    
                    <button style="float:right" class="btn btn-primary" type="submit" name="simpan" value="simpan">Barang Keluar</button>
                    <?php }else{?>
                    <?php } ?>
                    </td>
                </tr>
                  <tr>
                        <td width="4%"align="center"><strong>No</strong></td>
                        <td width="37%" align="center"><strong>Nama Barang</strong></td>
                        <td width="6%"align="center"><strong>#</strong></td>
                        <td width="4%" align="center"><strong>Qty</strong></td>
                        <td width="9%" align="center"><b>Stok Digudang</b></td>
                        <td width="5%" align="center"><b>Status</b></td>
                        <td width="5%" align="center"><b>Qty Beri</b></td>
                  </tr>
                  <?php
                      $kon=$db->select("tx_sales_order_dtl a 
					  join m_barang b on a.id_barang=b.id_barang
					  join m_satuan c on c.id_satuan=a.id_satuan
					  ","c.nama_satuan,a.id_barang,b.kode_barang,b.nama_barang,a.qty,a.harga,a.status","a.no_sales='$valsupp[no_sales]'");
                      $no=1;
					  $cek=0;
                      foreach($kon as $d){  
                      ?>
                  <tr>
                        <td align="center"><?php echo $no?>&nbsp;</td>
                        <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
                        <td align="left">&nbsp;<?=$d['nama_satuan']?></td>
                        <td align="right"><?=$d['qty']?>&nbsp;</td>
                        <td align="right">
						<?php
                        foreach($kon=$db->select("v_notif","akhir","id_gudang='$valsupp[id_gudang]' and id_barang='$d[id_barang]'")as $stok);
						echo $stok['akhir'];
						?>
						<input type="hidden" size="8" id="qtystok<?=$no?>" value="<?=$stok['akhir']?>"
                        <?php if($d['status']==1){echo "readonly";}else{}?>
                        >
                        </td>
                        <td align="left" <?php if($d['status']==1){?> bgcolor="#CCFF99" <?php }?>>&nbsp;<?php
                        if($d['status']==0){
							echo "Belum";
						}if($d['status']==1){
							echo "Sudah";
						}
						?></td>
                        <td align="center">
						<input type="text" size="8" name="qty_beri[]" id="qty_beri<?=$no?>" value="0"
                        <?php if($d['status']==1){echo "readonly";}else{}?>
                        onKeyUp="pindahD('<?=$no?>')" autocomplete="off">
						<input type="hidden" size="8" name="idbar[]" id="idbar" value="<?=$d['id_barang']?>" <?php if($d['status']==1){echo "readonly";}else{}?>>
                        </td>
                 </tr>
                      <?php $no++;
                      $tot=$tot+$sub;
                      } ?>
                    
                    <tr>
                    
                        <td colspan="5" align="right">&nbsp;</td>
                         <td colspan="6" align="right">&nbsp;</td>
                </tr>
              </table>	
              <?php
               $nom++;
			  
			   ?>
               <input type="hidden" id="idnyas" name="idnyas" value="<?=$valsupp['no_sales'];?>">
                <input type="hidden" id="aksi" name="aksi" value="setuju">
              
              <input type="hidden" id="jenis" name="jenis" value="<?=$valsupp['jenis'];?>">
              