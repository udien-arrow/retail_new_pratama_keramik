<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("hr_m_jamsos","*","id_jamsos='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=parjam_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tarif Perusahaan</label>
									<div class="col-lg-5">
										<input type="text" name="per" id="per" class="form-control" autocomplete="off" value="<?=$val['tarif_perusahaan']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_jamsos']?>"  required>
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Umr</label>
									<div class="col-lg-5">
										<input type="text" name="umr" id="umr" class="form-control" autocomplete="off" value="<?=$val['umr']?>" required>
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Tarif Bayar</label>
									<div class="col-lg-5">
										<input type="text" name="bayar" id="bayar" class="form-control" autocomplete="off" value="<?=$val['tarif_bayar']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tanggal Berlaku</label>
									<div class="col-lg-5">
										<input type="text" name="berlaku" id="berlaku" class="form-control datepicker" autocomplete="off" value="<?=$val['tgl_berlaku']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=parjam'">
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
		<form action="index.php?x=parjam" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View <?=$title?></h5>
					</div>
                    <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th width="13%">ID</th>
                                <th width="15%">Tarif Perusahaan</th>
                                <th width="10%">Umr</th>
                                <th width="15%">Tarif Bayar</th>
                                <th width="15%">Tanggal Berlaku</th>
                                <th width="3%">Aksi</th>
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
	$where = array("id_satuan" => $_POST['id']);
	$db->delete("m_satuan",$where);
	echo "<script>window.location='index.php?x=parjam'</script>";
}
?>