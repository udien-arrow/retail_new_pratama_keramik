<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
					$p="";
                    
					$sat=$db->select("ak_parameterjur a JOIN ak_acc b ON a.acc_code = b.account","id_akunparam,id_m_parameterjur,CONCAT(acc_code, ' - ', description) AS te","a.id_akunparam = '$_POST[id]'");
					foreach($sat as $val){
						$p="id_parameter='$val[id_m_parameterjur]'";
						}
						
					?>
					<form class="form-horizontal" action="index.php?x=pakun_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Jenis Parameter</label>
									<div class="col-lg-6">
										<select name="jenis" class="select-search">
                                        
                                        <?php
										if(empty($p)){echo"<option value=\"\">Pilih Jenis Parameter</option>";}
										$pjur=$db->select("ak_m_parameterjur","*",$p);
										foreach($pjur as $valp){
											?>
                                            <option value="<?=$valp['id_parameter']?>" <?php if($valp[id_parameter]=$val[id_m_parameterjur]) {echo"selected";}?>><?=$valp['nama_parameter']?></option>
                                            
                                            <?php
											}
										?>
                                        </select>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_akunparam']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Kode Rekening</label>
									<div class="col-lg-6">
										<input type="text" name="korek" id="korek" class="form-control" autocomplete="off" value="<?=$val[te]?>" required>
								     
									</div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=pakun'">
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
  <form action="index.php?x=pakun" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Akun Default</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>

                              	<th width="20%">Nama</th>
                                <th width="20%">Kode Akun</th>
                                <th width="20%">Deskripsi</th>
                                <th width="1%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
			</form>
		</div>

