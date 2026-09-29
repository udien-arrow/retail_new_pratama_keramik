
		<div class="col-lg-4">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
					if($_POST[id]!=''){
                    $sat=$db->select("tx_buku_bg","*","id_buku='$_POST[id]'");
					foreach($sat as $val){}
					}
					//echo $val['cabang'].'a';
					?>
                    
					<form class="form-horizontal" action="index.php?x=bukubg_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                  <div class="col-lg-3"></div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">No Seri BG</label>
                                    <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_buku']?>"  required="required" />
                                    
									<div class="col-lg-5">
					     	        <input type="text" name="nobg" id="nobg" class="form-control" autocomplete="off" value="<?=$val['no_seribg']?>" required>
								  </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Bank</label>
									<div class="col-lg-5">
										<input type="text" name="bank" id="bank" class="form-control" autocomplete="off" value="<?=$val['id_bank']?>" required>
								  </div>
								</div> 
                                <div class="form-group">
									<label class="control-label col-lg-4">Nominal</label>
									<div class="col-lg-5">
										<input type="text" name="nominal" id="nominal" class="form-control" autocomplete="off" value="<?=number_format($val['nilai_bg'])?>" required>
								  </div>
								</div>                                    
                      			<div class="form-group">
									<label class="control-label col-lg-4">Status</label>
									<div class="col-lg-7">
									  <select class="select-search" name="st" id="st">
									    <option value="0" <?php if($val['a.status'] == '0'){echo "selected";} ?>>Blm Cair</option>
									    <option value="1" <?php if($val['a.status'] == '1'){echo "selected";} ?>>Cair</option>
									    <option value="2" <?php if($val['a.status'] == '2'){echo "selected";} ?>>Batal</option>
									    <option value="3" <?php if($val['a.status'] == '3'){echo "selected";} ?>>Pindah</option>

								      </select>
									</div>
                                </div>
                       			<div class="form-group">
									<label class="control-label col-lg-4">Customer</label>
									<div class="col-lg-7">
									  <select class="select-search" name="cus" id="cus">
												<?php
											    $sat2=$db->select("m_customer","*");
												foreach($sat2 as $val2){
												?>
									   			<option value= <?=$val2['id_cus']?> <?php if($val2['id_cus'] == $val['id_cus']){echo "selected";} ?>><?=$val2['nama_usaha']?></option>";	
												<?php
                                                	}	

												?>
								      </select>
									</div>
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tgl BG</label>
									<div class="col-lg-5">
										<input type="text" name="tgl1" id="tgl1" class="form-control datepicker" autocomplete="off" value="<?=$val['tgl_bg']?>" required>
								  </div>
								</div> 
                                <div class="form-group">
									<label class="control-label col-lg-4">Tgl Tempo BG</label>
									<div class="col-lg-5">
										<input type="text" name="tgl2" id="tgl2" class="form-control datepicker" autocomplete="off" value="<?=$val['jatuh_tempo']?>" required>
								  </div>
								</div>                                   
                                <div class="form-group"></div>
                                <div class="form-group">
                                  <div class="col-lg-5"></div>
					  </div>
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=bukubg'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
                    </div>
				</div>					
		</div>
    <div class="col-lg-8">
		<form action="index.php?x=bukubg" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master BUKU BG</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">ID</th>
                              <th width="5%">No BG</th>
                              <th width="5%">Bank</th>
                              <th width="5%">No Faktur</th>
                                <th width="5%">Nominal</th>
                                <th width="10%">Nama Usaha</th>
                                <th width="5%">Tgl BG</th>
                                <th width="5%">Status</th>
                                <th width="4%">Aksi</th>
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
	$where = array("id_buku" => $_POST['id']);
	$db->delete("tx_buku_bg",$where);
	echo "<script>window.location='index.php?x=bukubg'</script>";
}
?>