	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
	</style>
 <?php
              $kon=$db->select("tx_sales_order a join 
	tx_sales_biaya_dtl b on a.no_sales=b.no_so
LEFT JOIN m_customer c ON b.id_cus = c.id_cus","a.status_so,
	b.*, c.nama_usaha,
	c.kode_cus,a.jenis_jual","b.id_cabang='$_SESSION[ID_CABANG]' and b.no_sb='$valsupp[no_ref]' order by b.biaya_retri asc");	
			  $nom=1;
			  $i=1;
			  $cek=0;
              foreach($kon as $konval){
				foreach($db->select("m_customer_plafon","tempo_normal,tempo_tambahan","jenis_plafon='$konval[jenis_jual]' and id_cus='$konval[id_cus]'")as $pl);  
              $tot=0;
              ?>
              <table width="100%" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="59" colspan="7"align="left"><b>&nbsp;<?php echo ucfirst(strtoupper($konval['no_so'].' - '.$konval['kode_cus'].' - '.$konval['nama_usaha']));?> 
                    <input type="hidden" name="ids" id="ids<?=$i?>" value="<?=$konval['no_so']?>">
                    <input type="hidden" name="nospb" value="<?=$_GET['id']?>">
                    <?php if($konval['status_so']=='3'){ ?>
                    <input type="text" value="<?=$pl['tempo_normal']?>" id="tn_<?=$i?>" size="5">
                    <input type="hidden" value="<?=$pl['tempo_tambahan']?>" id="tt_<?=$i?>" size="5">
                    <button style="float:right" class="btn btn-primary" type="submit" name="simpan" value="simpan" onclick="pindahk(<?=$i?>)">Barang Keluar</button>
					<?php }if($konval['status_so']=='4'){?>
                    <a href='javascript:void(0)' onClick=window.open('index.php?x=cetakspj_c&id=<?=$konval['no_so']?>') >
                    <button style="float:right" class="btn btn-primary" type="button">Cetak SPJ</button></a><?php } $i++?>
                    </td>
                </tr>
                  <tr>
                        <td width="4%"align="center"><strong>No</strong></td>
                        <td width="37%" align="center"><strong>Nama Barang</strong></td>
                        <td width="6%"align="center"><strong>#</strong></td>
                        <td width="4%" align="center"><strong>Qty</strong></td>
                        <td width="9%" align="center"><b>Stok Digudang</b></td>
                        <td width="9%" align="center"><strong>Harga</strong></td>
                        <td width="15%" align="center"><strong>Jumlah</strong></td>
                  </tr>
                  <?php
                      $kon=$db->select("tx_sales_order_dtl a 
					  join m_barang b on a.id_barang=b.id_barang
					  join m_satuan c on c.id_satuan=a.id_satuan
					  ","c.nama_satuan,a.id_barang,b.kode_barang,b.nama_barang,a.qty,a.harga","a.no_sales='$konval[no_so]'");
                      $no=1;
                      foreach($kon as $d){  
                      ?>
                  <tr>
                        <td align="center"><?php echo $no?>&nbsp;</td>
                        <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
                        <td align="left">&nbsp;<?=$d['nama_satuan']?></td>
                        <td align="right"><?=$d['qty']?>&nbsp;</td>
                        <td align="right">
						<?php
                        foreach($kon=$db->select("v_notif","akhir","id_gudang='$konval[id_gudang]' and id_barang='$d[id_barang]'")as $stok);
						echo $stok['akhir'];
						
						if($d['qty']>$stok['akhir']){
							$cek=$cek+1;
						}
						?>
                        </td>
                        <td align="right"><?=number_format($d['harga'],2)?>&nbsp;</td>
                        <td align="right"><?php
                        echo number_format($sub=$d['harga']*$d['qty'],2);
                        ?>&nbsp;</td>
                 </tr>
                      <?php $no++;
                      $tot=$tot+$sub;
                      } 
					  
					  ?>
                    
                    <tr>
                        <td colspan="6" align="right"><b> Total</b>&nbsp;</td>
                        <td align="right"><b><?php echo number_format($tot,2)?></b>&nbsp;</td>
                </tr>
              </table>	
              <?php
               $nom++;
               }
               ?>
               <input type="hidden" id="idnyas" name="idnyas" value="">
               <input type="hidden" id="tn" name="tn" value="">
               <input type="hidden" id="tt" name="tt" value="">
               <input type="hidden" id="cek" name="cek" value="<?=$cek?>">