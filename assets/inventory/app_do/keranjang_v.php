<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tables">
                                <tr>
                                <td align="center" class="tables"><strong>No</strong></td>
                                <td align="center" class="tables"><strong>Nama Barang</strong></td>
                                <td align="center" class="tables"><strong>Satuan</strong></td>
                                <td align="center" class="tables"><strong>Qty</strong></td>
                                </tr>
                                <tr>
                                </tr>
                                <?php 
								$supp=$db->select("tx_do a
								JOIN tx_do_dtl b ON a.no_do = b.no_do
								JOIN m_barang_gudang c ON b.id_barang = c.id_barang and a.id_gudang=c.id_gudang
								JOIN m_satuan d ON b.id_satuan = d.id_satuan","b.id_dtl,
								b.id_do,
								b.no_do,
								b.id_barang,
								b.qty,
								b.harga,
								b.id_satuan,
								b.`status`,
								c.kode_barang,
								c.nama_barang,
								d.nama_satuan","b.no_do='$_GET[id]' and a.id_gudang='$_GET[gudang]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center" class="tables"><?=$no?></td>
                                <td align="center" class="tables"><?=$valsupp['nama_barang']?></td>
                                <td align="center" class="tables"><?=$valsupp['nama_satuan']?></td>
                                <td align="center" class="tables"><?=number_format($valsupp['qty'])?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table>
      
