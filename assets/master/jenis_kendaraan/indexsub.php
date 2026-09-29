    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Jenis Kendaraan</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_jenis_kendaraan_dtl","*","id_dtl='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=jen_kend_ds" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Perbandingan</label>
									<div class="col-lg-5">
										<input type="text" name="bbm" id="bbm" class="form-control" autocomplete="off" value="<?=$val['bbm']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_dtl']?>"  required>
                                      <input type="hidden" name="id_jenis" id="id_jenis" class="form-control" value="<?=$_GET['id_jen']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Total Muatan</label>
									<div class="col-lg-5">
										<input type="text" name="muatan" id="muatan" class="form-control" autocomplete="off" value="<?=$val['muatan']?>" required>
									</div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=jen_kend_d&id_jen=<?=$_GET['id_jen']?>'">
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
		<form action="index.php?x=jen_kend_d&id_jen=<?=$_GET['id_jen']?>" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th width="50%">Perbandingan</th>
                              <th width="40%">Total Muatan</th>
                              <th width="10%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
                    <input type="hidden" name="idnya" id="idnya"  value="<?=$_GET['id_jen']?>"  required>
   		  </div>
			</form>
		</div>
       
<?php
if($_POST[aksi]=='hapus'){
	$where = array("id_dtl" => $_POST['id']);
	$db->delete("m_jenis_kendaraan_dtl",$where);
	echo "<script>window.location='index.php?x=jen_kend_d&id_jen=$_POST[idnya]'</script>";
}
?>