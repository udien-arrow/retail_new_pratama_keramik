
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-2">No KTP</label>
									<div class="col-lg-6">
										<input type="text" name="no_ktp" id="no_ktp" class="form-control" autocomplete="off" value="<?=$val['no_ktp']?>" >
									</div></div>
                                    <div class="form-group">
									<label class="control-label col-lg-2">Nama Customer</label>
									<div class="col-lg-6">
										<input type="text" name="nama_cus" id="nama_cus" class="form-control" autocomplete="off" value="<?=$val['nama_cus']?>" >
									</div>
                                    </div>
                                    <div class="form-group">
									<label class="control-label col-lg-2">Alamat</label>
									<div class="col-lg-4">
										<input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" value="<?=$val['alamat']?>" >
									</div>
                                    </div>
                                     <div class="form-group">
									<label class="control-label col-lg-2">Tempat Tgl Lahir</label>
                                    <?php 
									$spli=explode(",-",$val['ttl']);
									?>
									<div class="col-lg-4">
										<input type="text" name="ttl" id="ttl" class="form-control" autocomplete="off" value="<?=$spli[0]?>" >
                                        
									</div>
                                    <div class="col-lg-3">
                                     <div class="input-group">
                      <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                     <input type="text" class="form-control datepicker-menus" name="ttl2" id="ttl2"  value="<?=$spli[1]?>"  >
                     				 </div>
                                     </div>
                                    </div>
                                    <div class="form-group">
                                 <label class="control-label col-lg-2">Jenis Kelamin</label>
									<div class="col-lg-4">
									  <select name="jk" id="jk" class="select">
									    <option value="">---Pilih Jenis---</option>
									    <option value="1" <?php if($val[jk]==1){echo "selected";}?>>Pria</option>
									    <option value="2" <?php if($val[jk]==2){echo "selected";}?>>Wanita</option>
									    
								    </select>
									</div>
                                    </div>
                                    <div class="form-group">
									<label class="control-label col-lg-2">Negara</label>
									<div class="col-lg-5">
									  <select class="select-search" name="negara" id="negara">
									    <option value="">--Negara--</option>
									    <?php
											$query=$db->select("m_negara","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_negara']?>"  <?php if($sel['id_negara']==$val['id_negara']){echo "selected";}?>>
									      <?=$sel['nama_negara']?>
								        </option>
									    <?php } ?>
								      </select>
									</div>
                                    </div>
                                <div class="form-group">
                                   <label class="control-label col-lg-2">Kebangsaan</label>
									<div class="col-lg-5">
									  <select name="bangsa" id="bangsa" class="select">
									    <option value="">---Pilih Kebangsaan---</option>
									    <option value="1" <?php if($val[bangsa]==1){echo "selected";}?>>WNI</option>
									    <option value="2" <?php if($val[bangsa]==2){echo "selected";}?>>WNA</option>
									    
								      </select>
									</div>
								</div>
                                
                                <div class="form-group">
                                   <label class="control-label col-lg-2">Pendidikan</label>
									<div class="col-lg-5">
									  <select name="pendidikan" id="pendidikan" class="select">
									    <option value="">---Pilih Tipe---</option>
									    <option value="1" <?php if($val[pendidikan]==1){echo "selected";}?>>SMA</option>
									    <option value="2" <?php if($val[pendidikan]==2){echo "selected";}?>>SMK</option>
									    <option value="3" <?php if($val[pendidikan]==3){echo "selected";}?>>D1</option>
                                        <option value="4" <?php if($val[pendidikan]==4){echo "selected";}?>>D2</option>
                                         <option value="5" <?php if($val[pendidikan]==5){echo "selected";}?>>D3</option>
                                         <option value="6" <?php if($val[pendidikan]==6){echo "selected";}?>>S1</option>
                                        <option value="7" <?php if($val[pendidikan]==7){echo "selected";}?>>S2</option>
                                         <option value="8" <?php if($val[pendidikan]==8){echo "selected";}?>>S3</option>
                                         <option value="9" <?php if($val[pendidikan]==9){echo "selected";}?>>Lain2</option>
								      </select>
									</div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-2">Status Rumah</label>
									<div class="col-lg-5">
									  <select name="status_rumah" id="status_rumah" class="select">
									    <option value="">---Pilih Status---</option>
									    <option value="1" <?php if($val[status_rumah]==1){echo "selected";}?>>Milik Sendiri</option>
									    <option value="2" <?php if($val[status_rumah]==2){echo "selected";}?>>Milik Orang Tua</option>
									    
								      </select>
									</div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-2">No Telp</label>
									<div class="col-lg-5">
										<input type="text" name="no_telp" id="no_telp" class="form-control" autocomplete="off" value="<?=$val['no_telp']?>" >
									</div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-2">No Hp</label>
									<div class="col-lg-5">
										<input type="text" name="no_hp" id="no_hp" class="form-control" autocomplete="off" value="<?=$val['no_hp']?>" >
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-2">NPWP</label>
									<div class="col-lg-6">
										<input type="text" name="npwp_pemilik" id="npwp_pemilik" class="form-control" autocomplete="off" value="<?=$val['npwp_pemilik']?>" >
									</div></div>