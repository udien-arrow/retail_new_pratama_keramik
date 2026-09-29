    	<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("am_kategori","*","ID_AKATAGORI='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=asetkategori_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Kategori</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['NAMA_AKATAGORI']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['ID_AKATAGORI']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=asetkategori'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>	
                </div>				
		</div>
        <div class="col-lg-7">
		<form action="index.php?x=asetkategori" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                             	<th width="12%">Nama Kategori</th>
                                <th width="12%">Status Kategori</th>
                                <th width="12%">Tanggal Input</th>	
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
                   <!-- <a data-toggle='modal' id='mod' data-target='#datapelanggan' href='javascript:void(0)'  class='icon-list' style='cursor:pointer'>aa</a>-->
                    

   		  </div>
			</form>
		</div>
<div id="datapelanggan" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h6 class="modal-title">Detil</h6>
							</div>
							<div class="modal-body" id="hahaha">
                            
															
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								
							</div>
						</div>
					</div>
				</div>

       
<?php
if($_POST[aksi]=='hapus'){
	$ck=$db->select("am_katagori","*","ID_AKATAGORI='$_POST[id]'");
	foreach($ck as $cak){}
	if($cak['STATUS_AKATAGORI']=='2'){
	$st=1;
	}else{
	$st=2;
	}
	$field = array("STATUS_AKATAGORI" => $st);
	$db->update("am_katagori",$field,"ID_AKATAGORI='$_POST[id]'");
	echo "<script>window.location='index.php?x=asetkategori'</script>";
}
?>