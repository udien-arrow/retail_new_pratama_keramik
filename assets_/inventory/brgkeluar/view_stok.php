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
						<h5 class="panel-title">View Pengeluaran Barang</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Barang Keluar" onClick="window.location='index.php?x=brgkeluar'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="20%">No Keluar</th>
                              	<th width="20%">Dari Gudang</th>
                                <th width="20%">Ke Gudang</th>
                                <th width="10%">Tgl</th>
                                <th width="20%">Status</th>
                                <th width="1%">#</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="harga_in" id="harga_in"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=brgkeluar" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Barang Keluar</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <?php
					$supp=$db->select("tx_brg_keluar a
					JOIN tx_brg_keluar_dtl b ON a.no_keluar = b.no_keluar
					LEFT JOIN m_gudang d on a.id_gudang=d.id_gudang
					LEFT JOIN m_gudang e on a.kpd_id_gudang=e.id_gudang","a.id_gudang,
					a.kpd_id_gudang,
					a.no_ref,
					a.ket,
					b.id_dtl,
					b.id_keluar,
					b.no_keluar,
					b.id_barang,
					b.qty,
					b.hpp,
					b.total,
					b.`status`,
					a.tgl,
					(d.nama_gudang) as darigudang,
					(e.nama_gudang) as kegudang","a.no_keluar='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
				  <div class="panel-body">
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Keluar</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['no_keluar']?></b>
                                  
                                </div>
                                 <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Dari Gudang</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['darigudang']?></b>
                                  
                                </div>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Ke Gudang</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['kegudang']?></b>
                                  
                                </div>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Tgl </b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['tgl']?></b>
                                  
                                </div>
                                <div class="form-group">
								<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                <td align="center"><strong>No</strong></td>
                                <td align="center"><strong>Nama Barang</strong></td>
                                <td align="center"><strong>Satuan</strong></td>
                                <td align="center"><strong>Qty</strong></td>
                                </tr>
                                <?php 
								$supp=$db->select("tx_brg_keluar a
								JOIN tx_brg_keluar_dtl b ON a.no_keluar = b.no_keluar
								JOIN m_barang_gudang c ON b.id_barang = c.id_barang
								AND a.id_gudang = c.id_gudang 
								JOIN m_satuan d on b.sat=d.id_satuan
								","a.id_gudang,
								a.kpd_id_gudang,
								a.no_ref,
								a.ket,
								b.id_dtl,
								b.id_keluar,
								b.no_keluar,
								b.id_barang,
								b.qty,
								b.hpp,
								b.total,
								b.`status`,
								b.sat,
								c.nama_barang,
								d.nama_satuan,
								a.tgl","a.no_keluar='$_GET[id]' and a.id_gudang='$_GET[gudang]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center"><?=$no?></td>
                                <td align="center"><?=$valsupp['nama_barang']?></td>
                                <td align="center"><?=$valsupp['nama_satuan']?></td>
                                <td align="center"><?=number_format($valsupp['qty'])?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table> 
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
