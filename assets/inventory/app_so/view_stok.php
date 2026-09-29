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
						<h5 class="panel-title">View Stok Opname</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Stok Opname" onClick="window.location='index.php?x=appso'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="5%">ID</th>
                                <th width="30%">ID Stok Opname</th>
                              	<th width="30%">Nama Gudang</th>
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
         <form class="form-horizontal" action="index.php?x=appso_v" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Stok Opname</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	<?php
					$supp=$db->select("tx_stok_opname_dtl a join tx_stok_opname b on a.id_stok_opname=b.id_stok_opname join m_gudang c on b.id_gudang=c.id_gudang join m_barang_gudang d on a.kd_brg=d.id_barang","a.id_stok_opname,
					a.kd_brg,
					a.stok_fisik,
					a.stok_sys,
					a.selisih,
					a.status,
					a.ket,
					a.hpp_akhir,
					a.id,
					d.nama_barang,
					b.tgl,
					c.nama_gudang","a.id_stok_opname='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
				  <div class="panel-body">
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>ID Stok Opname</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['id_stok_opname']?></b>
                                  
                                </div>
                                 <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Nama Gudang</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['nama_gudang']?></b>
                                  
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
                                <td align="center"><strong>Stok Sistem</strong></td>
                                <td align="center"><strong>Stok Fisik</strong></td>
				<td align="center"><strong>Selisih</strong></td>
                                <td align="center"><strong>Keterangan</strong></td>
                                </tr>
                                <?php 
								$supp=$db->select("tx_stok_opname_dtl a join tx_stok_opname b on a.id_stok_opname=b.id_stok_opname join m_gudang c on b.id_gudang=c.id_gudang join m_barang_gudang d on a.kd_brg=d.id_barang","a.id_stok_opname,
							  a.kd_brg,
							  a.stok_fisik,
							  a.stok_sys,
							  a.selisih,
							  a.status,
							  a.ket,
							  a.hpp_akhir,
							  a.id,
							  d.nama_barang,
							  c.nama_gudang","a.id_stok_opname='$_GET[id]' and d.id_gudang='$_GET[gudang]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td><?=$no?></td>
                                <td align="center"><?=$valsupp['nama_barang']?></td>
                                <td align="center"><?=number_format($valsupp['stok_sys'])?></td>
                                <td align="center"><?=number_format($valsupp['stok_fisik'])?></td>
				<td align="center"><?=number_format($valsupp['selisih'])?></td>
                                <td align="center"><?=$valsupp['ket']?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table> 
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
