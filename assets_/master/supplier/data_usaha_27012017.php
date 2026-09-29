<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									
                                    <label class="control-label col-lg-2">Bidang Usaha</label>
									<div class="col-lg-4">
										<input type="text" name="bidang_usaha" id="bidang_usaha" class="form-control" autocomplete="off" value="<?=$val['bidang_usaha']?>" >
								      <input type="hidden" name="kode" id="kode" class="form-control" autocomplete="off" value="<?=$_POST['id']?>" >
                                        <input type="hidden" name="kode2" id="kode2" class="form-control" autocomplete="off" value="<?=$val['kode_supp']?>" >
                                    </div>
                                     <label class="control-label col-lg-2">Jenis Pembayaran</label>
									<div class="col-lg-4">
										<select class="select" name="jenis_pemb" id="jenis_pemb" required>
                                      		 <option value="">--Jenis Pembayaran--</option>
											<option value="1" <?php if ($val['jenis_pemb']==1){ echo "selected"; }?>>Cash</option>
											<option value="2" <?php if ($val['jenis_pemb']==2){ echo "selected"; }?>>Credit</option>
									</select>
									</div>
									
                                    </div>
                                     <div class="form-group">
                                    <label class="control-label col-lg-2">Badan Usaha</label>
                                    <?php 
									$en=explode(". ",$val['nama_usaha']);
									if($en[0]!='PT'){
										$en=explode("PT ",$val['nama_usaha']);	
										if(strlen($en[0])>5){
											$en[1]=$val['nama_usaha'];		
										}
									}
									?>
                                    <div class="col-lg-4">
                                         <select  class="select" title=""  name="entitas_usaha" id="entitas_usaha">
                                        <option value="">-Pilih Nama Badan Usaha-</option>
                                        <option value="PT" <?php if($en[0]=='PT'){echo "selected";}?> >PT</option>
                                        <option value="CV" <?php if($en[0]=='CV'){echo "selected";}?> >CV</option>
                                        <option value="Fa" <?php if($en[0]=='Fa'){echo "selected";}?> >Firma</option>
                                        <option value="PO" <?php if($en[0]=='PO'){echo "selected";}?> >Perusahaan Perorangan</option>
                                      </select>
									</div> 
                                     <!--<label class="control-label col-lg-2">Limit Plafon</label>
									<div class="col-lg-4">
										<input ="text" name="limit_plafon" id="limit_plafon" class="form-control" autocomplete="off" value="<?=$val['limit_plafon']?>" >
									</div>-->
                                    </div>
                                    <div class="form-group">
									<label class="control-label col-lg-2">Nama Usaha</label>
									<div class="col-lg-4">
										<input type="text" name="nama_usaha" id="nama_usaha" class="form-control" autocomplete="off" value="<?=$en[1]?>" required>
									</div>
                                    <label class="control-label col-lg-2">TOP</label>
									<div class="col-lg-4">
										<input ="text" name="term" id="term" class="form-control" autocomplete="off" value="<?=$val['term']?>" >
									</div>
                                    </div>
                                    <div class="form-group">
									<label class="control-label col-lg-2">Alamat Usaha</label>
									<div class="col-lg-4">
										<input type="text" name="alamat_usaha" id="alamat_usaha" class="form-control" autocomplete="off" value="<?=$val['alamat_usaha']?>" required>
									</div>
                                     <label class="control-label col-lg-2">Pkp</label>
									<div class="col-lg-4">
                                    <select class="select" name="pkp" id="pkp" required>
                                    <option value="">----PKP----</option>
											<option value="1" <?php if ($val['pkp']==1){ echo "selected"; }?>>Ya</option>
											<option value="2" <?php if ($val['pkp']==2){ echo "selected"; }?>>Tidak</option>										 
									</select>
                                    </div>
									</div>	 
                                    <div class="form-group">
                                    <label class="control-label col-lg-2">Kota</label>
									<div class="col-lg-4">
									  <select class="select-search" name="kota" id="kota">
									    <option value="">-Kota--</option>
									    <?php
											$query=$db->select("m_cabang","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_cabang']?>"  <?php if($sel['id_cabang']==$val['id_kota']){echo "selected";}?>>
									      <?=$sel['nama_cabang']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
                                     <label class="control-label col-lg-2">NPWP</label>
									<div class="col-lg-4">
										<input type="text" name="npwp" id="npwp" class="form-control" autocomplete="off" value="<?=$val['npwp']?>" >
									</div>
                                    </div>
                                    <div class="form-group">
									
									<label class="control-label col-lg-2">Kabupaten</label>
									<div class="col-lg-4">
										<input type="text" name="kabupaten" id="kabupaten" class="form-control" autocomplete="off" value="<?=$val['kabupaten']?>" >
									</div>
                                    <label class="control-label col-lg-2">No SIUP</label>
									<div class="col-lg-4">
										<input type="text" name="no_siup" id="no_siup" class="form-control" autocomplete="off" value="<?=$val['no_siup']?>" >
									</div>
									</div>
                                     <div class="form-group">
									<label class="control-label col-lg-2">Kode POS</label>
									<div class="col-lg-4">
										<input type="text" name="kode_pos" id="kode_pos" class="form-control" autocomplete="off" value="<?=$val['kode_pos']?>">
									</div>
                                    <label class="control-label col-lg-2">SPPKP</label>
									<div class="col-lg-4">
										<input type="text" name="sppkp" id="sppkp" class="form-control" autocomplete="off" value="<?=$val['sppkp']?>">
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
                                 <label class="control-label col-lg-2">No Fax</label>
									<div class="col-lg-4">
										<input type="text" name="no_fax" id="no_fax" class="form-control" autocomplete="off" value="<?=$val['no_fax']?>" >
									</div>
                                     <label class="control-label col-lg-2">SPPKP</label>
									<div class="col-lg-4">
										<input type="text" name="sppkp" id="sppkp" class="form-control" autocomplete="off" value="<?=$val['sppkp']?>" >
									</div>
                                    </div>
                                    
                                    <div class="form-group">
									<label class="control-label col-lg-2">Email 1</label>
									<div class="col-lg-4">
										<input type="text" name="email1" id="email1" class="form-control" autocomplete="off" value="<?=$val['email1']?>" >
									</div>
                                    
                                 <label class="control-label col-lg-2">Valuta</label>
									<div class="col-lg-4">
									<select name="id_valuta" id="id_valuta" class="select-search" onChange="tampildepp(this.value)" required>
										<option value="">----Valuta----</option>
										<?php
											$query=$db->select("m_valuta","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_valuta']?>" <?php if($sel['id_valuta']==$val['id_valuta']){echo "selected";}?>><?=$sel['nama_valuta']?></option>
                                        
                                        <?php }?>    
									</select>
                                    
									</div>
                                    
                                    </div>
                                     <div class="form-group">
									
                                </div>
                               <div class="form-group">
                                <label class="control-label col-lg-2">Email 2</label>
									<div class="col-lg-4">
										<input type="text" name="email2" id="email2" class="form-control" autocomplete="off" value="<?=$val['email2']?>" >
									</div>
                                <label class="control-label col-lg-2">Kode Akun Hutang</label>
                                    <div class="col-lg-4">
										<select class="select-search" name="account" id="account" required>
									    <option value="">-Account--</option>
									    <?php
											$query=$db->select("ak_acc","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['account']?>" <?php if($sel['account']==$val['account']){echo "selected";}?>>
									      <?=$sel['account'].'-'.$sel['description']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
								</div>
                                <?php if($val[foto]==''){?>
                        <div class="form-group">
                         <label class="control-label col-lg-2">Jenis Supplier</label>
							<div class="col-lg-4">
									 <select class="select" name="utama" id="utama" required>
                                    <option value="">----Jenis Supplier----</option>
											<option value="1" <?php if ($val['utama']==1){ echo "selected"; }?>>Primary</option>
											<option value="2" <?php if ($val['utama']==2){ echo "selected"; }?>>Secondary</option>										 
									</select>
							</div>
                        </div>
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
					 
                     