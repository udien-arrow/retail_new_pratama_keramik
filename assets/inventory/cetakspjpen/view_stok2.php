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
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Approve Permintaan" onClick="window.location='index.php?x=cetakspj'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="20%">No Keluar</th>
                              	<th width="20%">Dari Gudang</th>
                                <th width="20%">Unit</th>
                                <th width="10%">Tgl</th>
                                <th width="1%">No Ref</th>
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
					$supp=$db->select("tx_do_dtl a 
					left join m_barang b on a.id_barang=b.id_barang 
					left join tx_do aa on a.no_spj=aa.no_spj 
					left join m_satuan c on b.id_satuan=c.id_satuan","a.*,b.nama_barang,c.nama_satuan,aa.tgl_spj","a.no_spj='$_GET[id]'");
					foreach($supp as $valsupp){}
					
					
					?>
				  <div class="panel-body">
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Keluar</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['no_spj']?></b>
                                  
                                </div>
                                 <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Tgl </b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=date("d-m-Y",strtotime($valsupp['tgl_spj']))?></b>
                                  
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
								$supp=$db->select("tx_do_dtl a 
					left join m_barang b on a.id_barang=b.id_barang 
					left join tx_do aa on a.no_spj=aa.no_spj 
					left join m_satuan c on b.id_satuan=c.id_satuan","a.*,b.nama_barang,c.nama_satuan,aa.tgl_spj","a.no_spj='$_GET[id]'");
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
