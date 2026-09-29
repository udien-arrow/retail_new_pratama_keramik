<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("ak_umpph a JOIN ak_acc b ON a.account=b.account","jenis_um,b.account,b.description","id_jenisum='$_POST[id]'");
					
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=pph_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Jenis Uang Muka PPh</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['jenis_um']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$_POST['id']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Kode rekening</label>
									<div class="col-lg-5">
										<input type="text" name="akun" id="akun" class="form-control" autocomplete="off" value="<?=$val['account']." - ".$val[description]?>" required>
									</div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=grup_inven'">
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
  <form action="index.php?x=pph" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Parameter Uang Muka</h5>
					</div>
                    
					 <table width="100%" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" id="example4" >
                        <thead>
                            <tr>
                            	<th width="6%">No</th>
                                <th width="41%">Jenis Uang Muka </th>
                              	<th width="41%">Kode Rekening</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
			</form>
		</div>

