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
		<form action="index.php?x=tkbmbeli_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Data TKBM</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input TKBM Pembelian" onClick="window.location='index.php?x=tkbmbeli'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="20%">No Masuk</th>
                              	<th width="20%">No SPJ</th>
                                <th width="20%">Tgl</th>
                                <th width="30%">Cabang</th>
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
						<h5 class="panel-title">View Detil</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <?php
					$supp=$db->select("v_tkbm_pembelian","*","no_masuk='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
				  <div class="panel-body">
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Masuk</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['no_masuk']?></b>
                                  
                                </div>
                                 <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No SPJ</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['no_spj']?></b>
                                  
                                </div>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Cabang</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['nama_cabang']?></b>
                                  
                                </div>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Tgl </b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['tgl']?></b>
                                  
                                </div>
                                <div class="form-group">
								<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                <td align="center"><strong>No</strong></td>
                                <td align="center"><strong>Jenis</strong></td>
                                <td align="center"><strong>Nama Barang</strong></td>
                                <td align="center"><strong>Kendaraan</strong></td>
                                <td align="center"><strong>Berat</strong></td>
                                <td align="center"><strong>Nilai/kg</strong></td>
                                <td align="center"><strong>Qty</strong></td>
                                <td align="center"><strong>Total</strong></td>
                                </tr>
                                <?php 
								$supp=$db->select("tx_tkbm_pembelian_dtl a 
								join m_barang b on a.id_barang=b.id_barang
								join m_satuan c on b.id_satuan=c.id_satuan
								left join m_kendaraan d on a.id_jenis_kendaraan=d.id
								","a.*,b.nama_barang,d.nopol","a.id_tkbm_b='$valsupp[id_tkbm_b]'");
							  	$no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center"><?=$no?></td>
                                <td align="left"><?php
                                if($valsupp['jenis_tkbm']==1){
									echo 'Forklif';
								}if($valsupp['jenis_tkbm']==2){
									echo 'Bongkar';
								}if($valsupp['jenis_tkbm']==3){
									echo 'POK';
								}
								?></td>
                                <td align="left"><?=$valsupp['nama_barang']?></td>
                                <td align="left"><?=$valsupp['nopol']?></td>
                                <td align="right"><?=$valsupp['berat']?></td>
                                <td align="right"><?=$valsupp['nilai']?></td>
                                <td align="right"><?=number_format($valsupp['qty'])?></td>
                                <td align="right"><?=number_format($valsupp['total'])?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table> 
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
