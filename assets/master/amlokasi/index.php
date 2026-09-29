    	<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("am_lokasi","*","ID_ALOKASI='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=asetlokasi_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Lokasi</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['NAMA_ALOKASI']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['ID_ALOKASI']?>"  required>
									</div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Cabang Lokasi</label>
								   <div class="col-lg-6">
										<select class="select" name="subjenis" id="subjenis">
                                      		 <option value="">--Cabang--</option>
											<?php
											$query=$db->select("m_cabang","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_cabang']?>"  <?php if($sel['id_cabang']==$val['CAB_ALOKASI']){echo "selected";}?>><?=$sel['nama_cabang']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=asetsubjenis'">
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
		<form action="index.php?x=asetlokasi" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                             	<th width="12%">Nama Lokasi</th>
                                <th width="12%">Cabang Lokasi</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
			</form>
		</div>
       
<?php
if($_POST[aksi]=='hapus'){
	$where = array("ID_ALOKASI" => $_POST['id']);
	$db->delete("am_lokasi",$where);
	echo "<script>window.location='index.php?x=asetlokasi'</script>";
}
?>