
                                <div class="form-group">
                                </div>
                                
                                    <div class="form-group">
									<label class="control-label col-lg-2">Nama Keluarga</label>
									<div class="col-lg-6">
										<input type="text" name="nama_keluarga" id="nama_keluarga" class="form-control" autocomplete="off" value="<?=$val['nama_keluarga']?>" >
									</div>
                                    
                                    </div>
                                     <div class="form-group">
									<label class="control-label col-lg-2">Hubungan </label>
									<div class="col-lg-4">
                                         <select  class="select" title=""  name="hubungan_keluarga" id="hubungan_keluarga">
                                        <option value="">-Pilih Hubungan-</option>
                                        <option value="1" <?php if($val['hubungan_keluarga']==1){echo "selected";}?> >Ayah</option>
                                        <option value="2" <?php if($val['hubungan_keluarga']==2){echo "selected";}?> >Ibu</option>
                                        <option value="3" <?php if($val['hubungan_keluarga']==3){echo "selected";}?> >Saudara Kandung</option>
                                        <option value="4" <?php if($val['hubungan_keluarga']==4){echo "selected";}?> >Saudara</option>
                                        <option value="5" <?php if($val['hubungan_keluarga']==5){echo "selected";}?> >Teman</option>
                                        <option value="6" <?php if($val['hubungan_keluarga']==6){echo "selected";}?> >Suami</option>
                                        <option value="7" <?php if($val['hubungan_keluarga']==7){echo "selected";}?> >Istri</option>
                                        <option value="8" <?php if($val['hubungan_keluarga']==8){echo "selected";}?> >Anak</option>
                                        <option value="9" <?php if($val['hubungan_keluarga']==9){echo "selected";}?> >Lain2</option>
                                      </select>

									</div>
                                    </div>
                                    <div class="form-group">
									<label class="control-label col-lg-2">Alamat</label>
									<div class="col-lg-6">
										<input type="text" name="alamat_keluarga" id="alamat_keluarga" class="form-control" autocomplete="off" value="<?=$val['alamat_keluarga']?>" >
									</div></div>
                                    
                                
                                <div class="form-group">
                                   <label class="control-label col-lg-2">No Telp </label>
									<div class="col-lg-5">
										<input type="text" name="no_telp_keluarga" id="no_telp_keluarga" class="form-control" autocomplete="off" value="<?=$val['no_telp_keluarga']?>" >
									</div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-2">No Hp</label>
									<div class="col-lg-5">
										<input type="text" name="no_hp_keluarga" id="no_hp_keluarga" class="form-control" autocomplete="off" value="<?=$val['no_hp_keluarga']?>">
									</div>
								</div>
                                 <div class="form-group">
                                   <label class="control-label col-lg-2">No Telp Kantor</label>
									<div class="col-lg-5">
										<input type="text" name="no_telp_kantor" id="no_telp_kantor" class="form-control" autocomplete="off" value="<?=$val['no_telp_kantor']?>" >
									</div>
								</div>
                                