<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-2">Cabang</label>
									<div class="col-lg-4">
										<select class="select" name="cabang" id="cabang">
                                      		 <option value="">--Cabang--</option>
											<?php
											$query=$db->select("m_cabang","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_cabang']?>"  <?php if($sel['id_cabang']==$val['id_cabang']){echo "selected";}?>><?=$sel['nama_cabang']?></option> <?php } ?>
									</select>
								      <input type="hidden" name="kode" id="kode" class="form-control" autocomplete="off" value="<?=$_POST['id']?>" >
									  <input type="hidden" name="kode2" id="kode2" class="form-control" autocomplete="off" value="<?=$val['kode_cus']?>" >
									</div>
                                    <label class="control-label col-lg-2">Bidang Usaha</label>
									<div class="col-lg-4">
										<input type="text" name="bidang_usaha" id="bidang_usaha" class="form-control" autocomplete="off" value="<?=$val['bidang_usaha']?>" >
									</div>
									
                                    </div>
                                     <div class="form-group">
                                    <label class="control-label col-lg-2">Badan Usaha</label>
                                    <div class="col-lg-4">
                                         <select  class="select" title=""  name="entitas_usaha" id="entitas_usaha">
                                        <option value="">-Pilih Nama Badan Usaha-</option>
                                        <option value="1" <?php if($val['entitas_usaha']==1){echo "selected";}?> >PT</option>
                                        <option value="2" <?php if($val['entitas_usaha']==2){echo "selected";}?> >CV</option>
                                        <option value="3" <?php if($val['entitas_usaha']==3){echo "selected";}?> >Firma</option>
                                        <option value="4" <?php if($val['entitas_usaha']==4){echo "selected";}?> >Perusahaan Perorangan</option>
                                      </select>

									</div>
                                     <label class="control-label col-lg-2">No SIUP</label>
									<div class="col-lg-4">
										<input type="text" name="no_siup" id="no_siup" class="form-control" autocomplete="off" value="<?=$val['no_siup']?>" >
									</div>
                                    </div>
                                    <div class="form-group">
									<label class="control-label col-lg-2">Nama Usaha</label>
									<div class="col-lg-4">
										<input type="text" name="nama_usaha" id="nama_usaha" class="form-control" autocomplete="off" value="<?=$val['nama_usaha']?>" required>
									</div>
                                    <label class="control-label col-lg-2">Menempati Sejak</label>
									<div class="col-lg-4">
										<input type="text" name="menempati_sejak" id="menempati_sejak" class="form-control" autocomplete="off" value="<?=$val['menempati_sejak']?>" >
									</div>
                                    </div>
                                     
                                    <div class="form-group">
									<label class="control-label col-lg-2">Alamat Usaha</label>
									<div class="col-lg-4">
										<input type="text" name="alamat_usaha" id="alamat_usaha" class="form-control" autocomplete="off" value="<?=$val['alamat_usaha']?>" required>
									</div>
                                     <label class="control-label col-lg-2">No NPWP</label>
									<div class="col-lg-4">
										<input type="text" name="npwp" id="npwp" class="form-control" autocomplete="off" value="<?=$val['npwp']?>" >
									</div>
                                    </div>
                                    <div class="form-group">
                                 <label class="control-label col-lg-2">Telp Usaha</label>
									<div class="col-lg-4">
										<input type="text" name="no_telp_usaha" id="no_telp_usaha" class="form-control" autocomplete="off" value="<?=$val['no_telp_usaha']?>" >
									</div>
                                    <label class="control-label col-lg-2">TDP</label>
									<div class="col-lg-4">
										<input type="text" name="tdp" id="tdp" class="form-control" autocomplete="off" value="<?=$val['tdp']?>" >
									</div>
                                    </div>
                                    <div class="form-group">
									<label class="control-label col-lg-2">Status Tempat</label>
									<div class="col-lg-4">
										<input type="text" name="status_tempat" id="status_tempat" class="form-control" autocomplete="off" value="<?=$val['status_tempat']?>" >
									</div>
                                     <label class="control-label col-lg-2">STPG</label>
									<div class="col-lg-4">
										<input type="text" name="stpg" id="stpg" class="form-control" autocomplete="off" value="<?=$val['stpg']?>" >
									</div>
                                    </div>
                                     <div class="form-group">
									
                                </div>
                               
                               
                                <div class="form-group">
                                   <label class="control-label col-lg-2">Ship to</label>
									<div class="col-lg-4">
										<input type="text" name="ship_to" id="ship_to" class="form-control" autocomplete="off" value="<?=$val['ship_to']?>" >
									</div>
                                    <label class="control-label col-lg-2">Akta Notaris</label>
									<div class="col-lg-4">
										<input type="text" name="akta_notaris" id="akta_notaris" class="form-control" autocomplete="off" value="<?=$val['akta_notaris']?>" >
									</div>
								</div>
                                <?php if($val[foto]==''){?>
                        <div class="form-group">
                         <label class="control-label col-lg-2">Foto</label>
							<div class="col-lg-4">
									<input type="file" name="foto" id="foto" class="file-input">
							</div>
                            
                         </div>
                         <?php }else{?>
                         <div class="form-group" >
                         <label class="control-label col-lg-2">Foto</label>
						 
                            <div class="thumbnail col-lg-4" >
							
							<img src="images/<?=$val['foto']?>">
                            </div>
                          <div class=" col-lg-3" >
                            </div>
						</div>
                     <?php }?>