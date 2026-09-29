    <!-- Theme JS files -->
	<style>
			.tables, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
			table, tr, td {
			border: none;
		}
	</style>
    <div class="col-lg-7">
		<form action="index.php?x=delivo_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Delivery Order" onClick="window.location='index.php?x=delivo'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="20%">No DO</th>
                              	<th width="20%">Gudang</th>
                                <th width="20%">No Reff</th>
                                <th width="30%">Status</th>
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
         <form class="form-horizontal" action="index.php?x=delivo_v" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-5">
				<div class="panel panel-flat">
                <?php
					$supp=$db->select("v_do_v","*","no_do='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
					<div class="panel-heading">
						<h5 class="panel-title">View <?=$title?>
                        <?php 
						if($valsupp['status_do']==1){
						?>
                        <button style="float:right" class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
										 Barang Keluar 
                                        </button>
                        <input type="hidden" name="ids" id="ids"  value="<?=$_GET['id']?>"  required>
                    <?php } else {} ?>
                    </h5>
					</div>
                    <div class="dataTables_wrapper"></div>
				  <div class="panel-body">
                  <table width="400px" cellspacing="0" cellpadding="0">
                  <tr>
                                   <td><b>No DO</b></td>
                                   <td><b>: <?=$valsupp['no_do']?></b></td>
                              
                            
                  </tr>
                  <tr>
                                   <td><b>No SPJ</b></td>
                                   <td><b>: <?=$valsupp['no_spj']?></b></td>
                              
                            
                  </tr>
                  <tr>
                                   <td><b>Gudang</b></td>
                                   <td><b>: <?=$valsupp['nama_gudang']?></b></td>
                              
                            
                  </tr>
                   <tr>
                                   <td><b>Customer</b></td>
                                   <td><b>: <?=$valsupp['nama_usaha']?></b></td>
                              
                            
                  </tr>
                                  <td><b>Tgl </b></td>
                                  <td> <b>: <?=$valsupp['tgl_do']?></b></td>
                  </tr>
                  </tr>
                                  <td><b>Jenis Kendaraan </b></td>
                                  <td> <b>: <?=$valsupp['nama']?></b></td>
                  </tr>
                    </table>
                    <br>
                                <div class="form-group">
								<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tables">
                                <tr>
                                <td class="tables" align="center"><strong>No</strong></td>
                                <td align="center" class="tables"><strong>Nama Barang</strong></td>
                                <td align="center" class="tables"><strong>Satuan</strong></td>
                                <td align="center" class="tables"><strong>Qty</strong></td>
                                </tr>
                                <tr>
                                </tr>
                                <?php 
								$supp=$db->select("tx_do a
								JOIN tx_do_dtl b ON a.no_do = b.no_do
								JOIN m_barang_gudang c ON b.id_barang = c.id_barang and a.id_gudang=c.id_gudang
								JOIN m_satuan d ON b.id_satuan = d.id_satuan","b.id_dtl,
								b.id_do,
								b.no_do,
								b.id_barang,
								b.qty,
								b.harga,
								b.id_satuan,
								b.`status`,
								c.kode_barang,
								c.nama_barang,
								d.nama_satuan","b.no_do='$_GET[id]' and a.id_gudang='$_GET[gudang]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center" class="tables"><?=$no?></td>
                                <td align="center" class="tables"><?=$valsupp['nama_barang']?></td>
                                <td align="center" class="tables"><?=$valsupp['nama_satuan']?></td>
                                <td align="center" class="tables"><?=number_format($valsupp['qty'])?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table> 
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
<?php
if($_POST[simpan]){
	echo "a";
	
}
?>
</form>
