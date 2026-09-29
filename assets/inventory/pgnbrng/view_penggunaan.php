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
    <div class="col-lg-7">
		<form action="index.php?x=pricel_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Penggunaan Barang</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Penggunaan Barang" onClick="window.location='index.php?x=pgnbrng'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="20%">No Penggunaan</th>
                              	<th width="20%">Nama Gudang</th>
                                <th width="20%">Nama Cabang</th>
                                <th width="10%">Tgl</th>                                
                                <th width="1%">#</th>
                            </tr>
                        </thead>

                    </table>
		   			<!--<input type="hidden" name="harga_in" id="harga_in"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>-->
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=pgnbrng" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Penggunaan Barang</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <?php
					$supp=$db->select("tx_usage_dtl a
					JOIN tx_usage b ON a.id_usage = b.id_usage
					JOIN m_barang c ON a.id_barang = c.id_barang
					JOIN m_satuan e ON c.id_satuan = e.id_satuan
					JOIN m_cabang d ON b.id_cabang = d.id_cabang
					JOIN m_gudang f ON b.id_gudang = f.id_gudang",
					"a.id_usage AS id_usage,
					a.no_usage AS no_usage,
					d.nama_cabang AS nama_cabang,
					f.nama_gudang AS nama_gudang,
					b.tgl_input AS tgl_input,
					c.nama_barang AS nama_barang,
					e.nama_satuan AS nama_satuan,
					a.qty_awal AS qty_awal,
					a.qty_masuk AS qty_masuk,
					a.qty_keluar AS qty_keluar,
					a.qty_waste AS qty_waste,
					a.qty_sisa AS qty_sisa","a.no_usage='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
				  <div class="panel-body">
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Penggunaan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['no_usage']?></b>
                                  
                                </div>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Nama Cabang</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['nama_cabang']?></b>
                                  
                                </div>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Nama Unit</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['nama_gudang']?></b>
                                  
                                </div>                                
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Tgl </b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['tgl_input']?></b>
                                  
                                </div>
                                <div class="form-group">
								<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" width="5%"><strong>No</strong></td>
                                    <td align="center" width="20%">Nama Barang</td>
                                    <td align="center" width="10%">Satuan</td>
                                    <td align="center" width="10%">Total Penerimaan Barang</td>
                                    <td align="center" width="10%">Sisa</td>
                                    <td align="center" width="10%">Waste</td>
                                    <td align="center" width="10%">Terpakai</td>
                                </tr>
                                <?php 
								$supp=$db->select("tx_usage_dtl a
													JOIN tx_usage b ON a.id_usage = b.id_usage
													JOIN m_barang c ON a.id_barang = c.id_barang
													JOIN m_satuan e ON c.id_satuan = e.id_satuan
													JOIN m_cabang d ON b.id_cabang = d.id_cabang
													JOIN m_gudang f ON b.id_gudang = f.id_gudang",
													"a.id_usage AS id_usage,
													a.no_usage AS no_usage,
													d.nama_cabang AS nama_cabang,
													f.nama_gudang AS nama_gudang,
													b.tgl_input AS tgl_input,
													c.nama_barang AS nama_barang,
													e.nama_satuan AS nama_satuan,
													a.qty_awal AS qty_awal,
													a.qty_masuk AS qty_masuk,
													a.qty_keluar AS qty_keluar,
													a.qty_waste AS qty_waste,
													a.qty_sisa AS qty_sisa","a.no_usage='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center"><?=$no?></td>
                                <td align="center"><?=$valsupp['nama_barang']?></td>
                                <td align="center"><?=$valsupp['nama_satuan']?></td>
                                <td align="center"><?=number_format($valsupp['qty_masuk'])?></td>
                                <td align="center"><?=number_format($valsupp['qty_sisa'])?></td>
                                <td align="center"><?=number_format($valsupp['qty_waste'])?></td>
                                <td align="center"><?=number_format($valsupp['qty_keluar'])?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table> 
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
