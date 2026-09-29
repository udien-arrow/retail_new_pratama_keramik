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
						<h5 class="panel-title">View Penerimaan Barang Transit</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Transit Barang" onClick="window.location='index.php?x=brg_masuk_transit'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="30%">No Masuk</th>
                                <th width="30%">No Ref</th>
                              	<th width="10%">Tanggal</th>
                                <th width="20%">Surat Jalan</th>
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
						<h5 class="panel-title">View Detil Penerimaan</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	<?php
					$supp=$db->select("tx_brg_masuk a
JOIN tx_brg_keluar b ON a.no_ref = b.no_keluar
JOIN m_gudang c ON b.id_gudang = c.id_gudang","a.*,
c.nama_gudang as darigudang","a.id_masuk='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
				  <div class="panel-body">
                                 <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Dari Gudang</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['darigudang']?></b>
                                  
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
                                <td align="center"><strong>Qty</strong></td>
                                <td align="center"><strong>Qty Terima</strong></td>
                                </tr>
                                <?php 
								$supp=$db->select("tx_brg_masuk a
JOIN tx_brg_masuk_dtl b ON a.no_masuk = b.no_masuk
LEFT JOIN m_barang_gudang c ON b.id_barang = c.id_barang
AND a.id_gudang = c.id_gudang","*","a.id_masuk='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td><?=$no?></td>
                                <td align="center"><?=$valsupp['nama_barang']?></td>
                                <td align="center"><?=number_format($valsupp['qty'])?></td>
                                <td align="center"><?=number_format($valsupp['qty_terima'])?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table> 
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
