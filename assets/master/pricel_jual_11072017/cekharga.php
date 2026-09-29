<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	
?>
<div class="table-responsive">
<div class="table-responsive pre-scrollable">
  <table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
    <thead>
                                           <tr>
                                            <td colspan="6"><strong>Rekap Perubahan Harga Retail</strong></td>
                                          </tr>   
                                          <tr bgcolor="#28343a">
                                            <td align="center"><strong>No</strong></td>
                                            <td align="center"><strong>Kode Barang</strong></td>
                                            <td align="center"><strong>Nama Barang</strong></td>
                                            <td align="center"><strong>Satuan </strong></td>
                                            <td align="center"><strong>Tgl Berlaku </strong></td>
                                            <td align="center"><strong>Harga</strong></td>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          <?php
                                          $kon=$db->select("m_pricelist_jual a 
										inner join m_pricelist_jual_dtl b on a.id_price = b.id_price
										inner join m_barang c on b.id_barang = c.id_barang
										inner join m_satuan d on c.id_satuan = d.id_satuan 
										   ","c.kode_barang,c.nama_barang,d.nama_satuan,a.kode_price,a.tgl_berlaku,b.harga,b.harga_cetak","a.jenis = 1 and b.id_barang = $_GET[id]  order by a.tgl_berlaku desc");
                                          $no=1;
										 // echo "select c.kode_barang,c.nama_barang,d.nama_satuan,a.kode_price,a.tgl_berlaku,b.harga,b.harga_cetak from m_pricelist_jual a 
										//inner join m_pricelist_jual_dtl b on a.id_price = b.id_price
										//inner join m_barang c on b.id_barang = c.id_barang
										//inner join m_satuan d on c.id_satuan = d.id_satuan where a.jenis = 1 and b.id_barang = $_GET[id]  order by a.tgl_berlaku desc";
										 
                                          foreach($kon as $d){  ?>
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['kode_barang'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['nama_barang'];?>&nbsp;</td>
                                            <td align="left"><?=$d['nama_satuan']?></td>
                                            <td>&nbsp;<?php echo $d['tgl_berlaku'];?>&nbsp;</td>
                                            <td align="right"><?=number_format($d['harga'])?>                                              &nbsp;</td>
                                          </tr>
                                          <?php $no++;} ?>
                                        </tbody>
                                        </table>     
                    
				</div>					
		</div>

<div class="table-responsive">
<div class="table-responsive pre-scrollable">
  <table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
    <thead>
                                           <tr>
                                            <td colspan="6"><strong>Rekap Perubahan Harga Grosir</strong></td>
                                          </tr>   
                                          <tr bgcolor="#28343a">
                                            <td align="center"><strong>No</strong></td>
                                            <td align="center"><strong>Kode Barang</strong></td>
                                            <td align="center"><strong>Nama Barang</strong></td>
                                            <td align="center"><strong>Satuan </strong></td>
                                            <td align="center"><strong>Tgl Berlaku </strong></td>
                                            <td align="center"><strong>Harga</strong></td>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          <?php
                                          $kon=$db->select("m_pricelist_jual a 
										inner join m_pricelist_jual_dtl b on a.id_price = b.id_price
										inner join m_barang c on b.id_barang = c.id_barang
										inner join m_satuan d on c.id_satuan = d.id_satuan 
										   ","c.kode_barang,c.nama_barang,d.nama_satuan,a.kode_price,a.tgl_berlaku,b.harga,b.harga_cetak","a.jenis = 2 and b.id_barang = $_GET[id]  order by a.tgl_berlaku desc");
                                          $no=1;
										 // echo "select c.kode_barang,c.nama_barang,d.nama_satuan,a.kode_price,a.tgl_berlaku,b.harga,b.harga_cetak from m_pricelist_jual a 
										//inner join m_pricelist_jual_dtl b on a.id_price = b.id_price
										//inner join m_barang c on b.id_barang = c.id_barang
										//inner join m_satuan d on c.id_satuan = d.id_satuan where a.jenis = 1 and b.id_barang = $_GET[id]  order by a.tgl_berlaku desc";
										 
                                          foreach($kon as $d){  ?>
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['kode_barang'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['nama_barang'];?>&nbsp;</td>
                                            <td align="left"><?=$d['nama_satuan']?></td>
                                            <td>&nbsp;<?php echo $d['tgl_berlaku'];?>&nbsp;</td>
                                            <td align="right"><?=number_format($d['harga'])?>                                              &nbsp;</td>
                                          </tr>
                                          <?php $no++;} ?>
                                        </tbody>
                                        </table>     
                    
				</div>					
		</div>