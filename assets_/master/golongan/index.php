    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_golongan","*","id_golongan='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=golongan_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Kode</label>
								   <div class="col-lg-5">
										<input type="text" name="kode" id="kode" class="form-control" autocomplete="off" value="<?=$val['id_golongan']?>" required>
								      
								     <input type="hidden" name="jenis" id="jenis" class="form-control" autocomplete="off" value="<?=$_POST[jenis]?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_golongan']?>" required>
								      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=golongan'">
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
		<form action="index.php?x=golongan" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">Kode </th>
                              <th width="75%">Nama</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
                    <input type="hidden" name="jenis" id="jenis2"  value=""  required>
   		  </div>
			</form>
		</div>

<?php
if($_POST[aksi]=='hapus'){
	$where = array("id_golongan" => $_POST['id']);
	$db->delete("m_golongan",$where);
	echo "<script>window.location='index.php?x=golongan'</script>";
}
?>