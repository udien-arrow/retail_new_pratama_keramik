<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                <td align="center"><strong>No</strong></td>
                                <td align="center"><strong>Nama Barang</strong></td>
                                <td align="center"><strong>Satuan</strong></td>
                                <td align="center"><strong>Qty</strong></td>
                                <td align="center"><strong>Keterangan</strong></td>
                                </tr>
                                <?php 
								$supp=$db->select("tx_retur_pem a
JOIN tx_retur_pem_dtl b ON a.no_retur = b.no_retur
JOIN m_barang_gudang c ON b.id_barang = c.id_barang
AND a.id_gudang = c.id_gudang
JOIN m_satuan d ON c.id_satuan = d.id_satuan","a.no_retur,
a.id_gudang,
b.qty_kembali,
b.ket,
c.kode_barang,
c.nama_barang,
d.nama_satuan","a.no_retur='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center"><?=$no?></td>
                                <td align="center"><?=$valsupp['kode_barang']."-".$valsupp['nama_barang']?></td>
                                <td align="center"><?=$valsupp['nama_satuan']?></td>
                                <td align="center"><?=number_format($valsupp['qty_kembali'])?></td>
                                <td align="center"><?=$valsupp['ket']?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table> 
<br>

      
