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
		<form action="index.php?x=biayasup_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Biaya Supir</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Biaya Supir" onClick="window.location='index.php?x=biayasup'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <th width="20%">No</th>
                              	<th width="40%">Nama Pegawai</th>
                                <th width="25%">Cabang</th>
                                <th width="1%">#</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="harga_in" id="harga_in"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
                    
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=biayasup_v" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
<?php 
if($_POST['kod']=='hapus'){
		$where = array("id_biaya" => $_POST['idn']);
		$where2 = array("id" => $_POST['idn']);
		$exec= $db->delete("m_biayasupir_dtl",$where);
		$exec= $db->delete("m_biayasupir",$where2);
}

?>
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Biaya Supir</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <?php
					$supp=$db->select("m_biayasupir a
					LEFT JOIN m_cabang b ON a.id_cabang = b.id_cabang
					LEFT JOIN m_pegawai c ON a.id_pegawai = c.id_pegawai ","a.id,
					a.id_pegawai,
					a.id_cabang,
					b.nama_cabang,
					c.nama_pegawai","a.id='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
				  <div class="panel-body">
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Nama Pegawai</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['nama_pegawai']?></b>
                                  
                                </div>
                                 <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Cabang</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$valsupp['nama_cabang']?></b>
                                  
                                </div>
                                <div class="form-group">
								<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                <td align="center"><strong>No</strong></td>
                                <td align="center"><strong>Nama Barang</strong></td>
                                <td align="center"><strong>Harga</strong></td>
                                </tr>
                                <?php 
								$supp=$db->select("m_biayasupir a
								JOIN m_biayasupir_dtl b ON a.id = b.id_biaya
								LEFT JOIN m_barang_gudang c ON b.id_barang = c.id_barang
								AND a.id_cabang = c.id_cabang
								","b.id_dtl,
								b.id_biaya,
								b.id_barang,
								b.biaya,
								c.kode_barang,
								c.nama_barang","id_biaya='$_GET[id]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <tr>
                                <td align="center"><?=$no?></td>
                                <td><?=$valsupp['kode_barang']." - ".$valsupp['nama_barang']?></td>
                                <td align="center"><?=$valsupp['biaya']?></td>
                                </tr>
                                <?php $no++; } ?>
                                </table> 
                               </div>
                      <input type="hidden" name="id2" id="id2"  value=""  required>
                      <input type="hidden" name="cab2" id="cab2"  value=""  required>
                      <input type="hidden" name="kod" id="kod"  value="" required>
                      <input type="hidden" name="idn" id="idn2"  value="" required>
				  </div>	
                    
				</div>					
		</div>
</form>
