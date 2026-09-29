    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
	</style>
    <div class="col-lg-6">
		<form action="index.php?x=pricel_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Koreksi Harga Beli</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Koreksi Harga Beli" onClick="window.location='index.php?x=korhabel'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="30%">No Koreksi</th>
                                <th width="20%">Tgl</th>
                              	<th width="30%">Supplier</th>
                                <th width="15%">Status</th>
                                <th width="5%">#</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="harga_in" id="harga_in"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=appso_v" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Koreksi Harga Beli</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                    
                    
                  	<?php
					$supp=$db->select("tx_koreksi_habel a join m_supplier b on a.id_supp=b.id_supp","a.*,b.nama_usaha","no_koreksi='$_GET[id]'");
					foreach($supp as $valsupp){}
					
					?>
				  <div class="panel-body">
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Koreksi</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['no_koreksi']?></b>
                                  
                                </div>
                                 <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Reff</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['no_ref']?></b>
                                  
                                </div>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Supplier</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['nama_usaha']?></b>
                                  
                                </div>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Tanggal</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['tgl_koreksi']?></b>
                                  
                                </div>
                                 <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Keterangan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['ket']?></b>
                                  
                                </div>
                                <div class="form-group">
								<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td colspan="8" align="center">
                                 <!-- <a href='javascript:void(0)' onClick=window.open('cetak.php?page=korhabel&id=<?=$valsupp['no_koreksi']?>)' >
                    <button style="float:right" class="btn btn-primary" type="button">Cetak Koreksi</button></a> -->
                                  </td>
                                  </tr>
                                <tr>
                                <td align="center"><strong>No</strong></td>
                                <td align="center"><strong>Nama Barang</strong></td>
                                <td align="center"><strong>Satuan</strong></td>
                                <td align="center"><strong>Qty</strong></td>
                                <td align="center"><strong>Harga Awal</strong></td>
                                <td align="center"><strong>Diganti Harga</strong></td>
                                <td align="center"><strong>Ket</strong></td>
                                <td align="center"><strong>Jumlah</strong></td>
                                </tr>
                                <?php 
								$supp=$db->select("tx_koreksi_habel a
JOIN tx_koreksi_habel_dtl b ON a.no_koreksi = b.no_koreksi
JOIN m_barang c ON b.id_barang = c.id_barang
JOIN m_satuan d ON c.id_satuan = d.id_satuan","a.no_koreksi,

b.qty,
b.harga_awal,
b.harga_ganti,
b.ket,
c.kode_barang,
c.nama_barang,
d.nama_satuan","a.no_koreksi='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                               
                                <tr>
                                <td align="center"><?=$no?></td>
                                <td align="center"><?=$valsupp['kode_barang']."-".$valsupp['nama_barang']?></td>
                                <td align="center"><?=$valsupp['nama_satuan']?></td>
                                <td align="right"><?=number_format($valsupp['qty'])?></td>
                                <td align="right"><?=number_format($valsupp['harga_awal'])?></td>
                                <td align="right"><?=number_format($valsupp['harga_ganti'])?></td>
                                <td align="left"><?=$valsupp['ket']?></td>
                              <td align="right"><?=number_format($sub=$valsupp['harga_ganti']*$valsupp['qty'])?></td>
                                </tr>
                                <?php $no++; 
								$tot=$tot+$sub;
								} ?>
                                 <tr>
                                  <td colspan="6" align="center">Total</td>
                                  <td align="right">&nbsp;</td>
                                  <td align="right"><?=number_format($tot)?></td>
                                </tr>
                                </table>
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
