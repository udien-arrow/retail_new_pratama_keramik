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
						<h5 class="panel-title">View Penerimaan Barang Non Dagang</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Penerimaan Barang Non Dagang" onClick="window.location='index.php?x=brgmasuknon'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="30%">No Masuk</th>
                                <th width="30%">No Ref</th>
                              	<th width="10%">Tanggal</th>
                                <th width="20%">No Bukti</th>
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
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Stok Opname</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	<?php
					$supp=$db->select("tx_brg_masuk a
JOIN m_gudang c ON a.id_gudang = c.id_gudang","a.*,
c.nama_gudang as darigudang","a.no_masuk='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
				  <div class="panel-body">
                                 <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Gudang</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['darigudang']?></b>
                                  
                                </div>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Tgl </b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['tgl']?></b>
                                  
                                </div>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Ket </b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['ket']?></b>
                                  
                                </div>
                                <div class="form-group">
								<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                <td align="center"><strong>No</strong></td>
                                <td align="center"><strong>Nama Barang</strong></td>
                                <td align="center"><strong>Qty</strong></td>
                                <td align="center"><strong>Qty Terima</strong></td>
                                <td align="center"><strong>Harga</strong></td>
                                </tr>
                                <?php 
								$supp=$db->select("tx_brg_masuk a
JOIN tx_brg_masuk_dtl b ON a.no_masuk = b.no_masuk
join tx_order_dtl d on a.no_ref=d.no_order
LEFT JOIN m_barang_gudang c ON b.id_barang = c.id_barang
AND a.id_gudang = c.id_gudang","a.*,
b.qty,
b.qty_terima,
b.harga_beli,c.nama_barang,c.kode_barang","a.no_masuk='$_GET[id]' group by b.id_barang");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center"><?=$no?></td>
                                <td align="center"><?=$valsupp['kode_barang'].'-'.$valsupp['nama_barang']?></td>
                                <td align="center"><?=number_format($valsupp['qty'])?></td>
                                <td align="center"><?=number_format($valsupp['qty_terima'])?></td>
                                <td align="center"><?=number_format($valsupp['harga_beli'])?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table> 
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
