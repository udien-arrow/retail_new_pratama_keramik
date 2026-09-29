<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tables">
                                <tr>
                                <td align="center" class="tables" width="5%"><strong>No</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Nama Barang</strong></td>
                                <td align="center" class="tables" width="15%"><strong>Satuan</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Harga</strong></td>
                                </tr>
                                <tr>
                                </tr>
                                <?php 
								$supp=$db->select("m_pricelist a join m_pricelist_dtl b on a.id_price=b.id_price join m_barang c on b.id_barang=c.id_barang JOIN m_satuan d on sat=d.id_satuan","b.*,c.nama_barang,d.nama_satuan","a.kode_price='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center" class="tables"><?=$no?></td>
                                <td align="left" class="tables"><?=$valsupp['nama_barang']?></td>
                                <td align="center" class="tables"><?=$valsupp['nama_satuan']?></td>
                                <td align="right" class="tables"><?=number_format($valsupp['harga'])?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table>
      
