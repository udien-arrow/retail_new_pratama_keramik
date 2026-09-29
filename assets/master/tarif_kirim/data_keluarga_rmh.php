
                                <div class="form-group">
                                </div>
                                
                                    <div class="form-group">
									<label class="control-label col-lg-2">Nama Keluarga</label>
									<div class="col-lg-6">
										<input type="text" name="nama_keluarga_rmh" id="nama_keluarga_rmh" class="form-control" autocomplete="off" value="<?=$val['nama_keluarga_rmh']?>" >
									</div>
                                    
                                    </div>
                                    <div class="form-group">
									<label class="control-label col-lg-2">Hubungan </label>
									<div class="col-lg-4">
                                         <select  class="select" title=""  name="hubungan_keluarga_rmh" id="hubungan_keluarga_rmh">
                                        <option value="">-Pilih Hubungan-</option>
                                        <option value="1" <?php if($val['hubungan_keluarga_rmh']==1){echo "selected";}?> >Ayah</option>
                                        <option value="2" <?php if($val['hubungan_keluarga_rmh']==2){echo "selected";}?>>Ibu</option>
                                        <option value="3" <?php if($val['hubungan_keluarga_rmh']==3){echo "selected";}?>>Saudara Kandung</option>
                                        <option value="4" <?php if($val['hubungan_keluarga_rmh']==4){echo "selected";}?>>Saudara</option>
                                        <option value="5" <?php if($val['hubungan_keluarga_rmh']==5){echo "selected";}?>>Teman</option>
                                        <option value="6" <?php if($val['hubungan_keluarga_rmh']==6){echo "selected";}?>>Suami</option>
                                        <option value="7" <?php if($val['hubungan_keluarga_rmh']==7){echo "selected";}?>>Istri</option>
                                        <option value="8" <?php if($val['hubungan_keluarga_rmh']==8){echo "selected";}?> >Anak</option>
                                        <option value="9" <?php if($val['hubungan_keluarga_rmh']==9){echo "selected";}?>>Lain2</option>
                                      </select>

									</div>
                                    </div>
                                    
                                
                                <div class="form-group">
                                   <label class="control-label col-lg-2">No Telp </label>
									<div class="col-lg-5">
										<input type="text" name="no_telp_keluarga_rmh" id="no_telp_keluarga_rmh" class="form-control" autocomplete="off" value="<?=$val['no_telp_keluarga_rmh']?>" >
									</div>
								</div>
                               <div class="form-group">
									<label class="control-label col-lg-2">Jenis kelamin </label>
									<div class="col-lg-4">
                                         <select  class="select" title=""  name="jenis_kelamin_rmh" id="jenis_kelamin_rmh">
                                        <option value="">-Pilih Hubungan-</option>
                                        <option value="1" <?php if($val['jenis_kelamin_rmh']==1){echo "selected";}?>>Laki-laki</option>
                                         <option value="2" <?php if($val['jenis_kelamin_rmh']==2){echo "selected";}?>>Perempuan</option>
                                      </select>

									</div>
                                    </div>