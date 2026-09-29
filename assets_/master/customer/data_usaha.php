<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <?php if($_POST['id']==''){?>
                                <div class="form-group">
									<label class="control-label col-lg-2">Header</label>
									<div class="col-lg-4">
									  <select class="select-search" name="head" id="head" onChange="hit(head.value)">
									    <option value="">--Customer--</option>
									    <?php
											$query=$db->select("m_customer","*","status=1 and head='' and id_cabang='$_SESSION[ID_CABANG]'");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_cus'].'_'.$sel['kode_cus']?>"  <?php if($sel['id_cus'].'_'.$sel['kode_cus']==$_GET['head']){echo "selected";}?>>
									      <?=$sel['nama_usaha']?>
								        </option>
									    <?php } ?>
								      </select>
									</div>
</div>
								<?php }?>
                                <div class="form-group">
                                <?php 
									$scp=explode("_",$_GET['head']);
											$ck=$db->select("m_customer","*","id_cus='$scp[0]'");
											foreach($ck as $xca){} 
									?>
									<label class="control-label col-lg-2">Cabang*</label>
									<div class="col-lg-4">
										<select class="select-search" name="cabang" id="cabang">
                                      		 
											<?php
											if($_GET['head']==''){
												if($_POST['id']==''){
													$query=$db->select("m_cabang","*","id_cabang='$_SESSION[ID_CABANG]'");
												}else{
													$query=$db->select("m_cabang","*","(id_cabang='$val[id_cabang]')");
												}
											}else{
												
												$query=$db->select("m_cabang","*","id_cabang='$xca[id_cabang]'");
											}
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_cabang']?>"  <?php if($sel['id_cabang']==$val['id_cabang'] or $xca['id_cabang']==$sel['id_cabang']){echo "selected";}?>><?=$sel['nama_cabang']?></option> <?php } ?>
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
                                    <?php 
									$en=explode(". ",$val['nama_usaha']);
									if($en[1]==''){
										$nm=$val['nama_usaha'];	
									}else{
										$nm=$en[1];	
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
                                     <label class="control-label col-lg-2">No SIUP</label>
									<div class="col-lg-4">
										<input type="text" name="no_siup" id="no_siup" class="form-control" autocomplete="off" value="<?=$val['no_siup']?>" >
									</div>
                                    </div>
                                    <div class="form-group">
									<label class="control-label col-lg-2">Nama Usaha*</label>
									<div class="col-lg-4">
										<input type="text" name="nama_usaha" id="nama_usaha" class="form-control" autocomplete="off" value="<?=$nm?>" required>
									</div>
                                    <label class="control-label col-lg-2">Menempati Sejak</label>
									<div class="col-lg-4">
										<input type="text" name="menempati_sejak" id="menempati_sejak" class="form-control" autocomplete="off" value="<?=$val['menempati_sejak']?>" >
									</div>
                                    </div>
                                     
                                    <div class="form-group">
									<label class="control-label col-lg-2">Alamat Usaha*</label>
									<div class="col-lg-4">
										<input type="text" name="alamat_usaha" id="alamat_usaha" class="form-control" autocomplete="off" value="<?=$val['alamat_usaha']?>" required>
									</div>
                                     <label class="control-label col-lg-2">NPWP</label>
									<div class="col-lg-4">
										<input type="text" name="npwp" id="npwp" class="form-control" autocomplete="off" value="<?=$val['npwp']?>" >
									</div>
                                    </div>
                                    <div class="form-group">
                                    <label class="control-label col-lg-2">Kabupaten</label>
									<div class="col-lg-4">
										<input type="text" name="kabupaten" id="kabupaten" class="form-control" autocomplete="off" value="<?=$val['kabupaten']?>">
									</div>
                                 <label class="control-label col-lg-2">SPPKP</label>
									<div class="col-lg-4">
										<input type="text" name="sppkp" id="sppkp" class="form-control" autocomplete="off" value="<?=$val['sppkp']?>" >
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
                                 <label class="control-label col-lg-2">Kode Pos</label>
									<div class="col-lg-4">
										<input type="text" name="kode_pos" id="kode_pos" class="form-control" autocomplete="off" value="<?=$val['kode_pos']?>" >
                                  
									</div>
                                    <label class="control-label col-lg-2">TDP</label>
									<div class="col-lg-4">
										<input type="text" name="tdp" id="tdp" class="form-control" autocomplete="off" value="<?=$val['tdp']?>" >
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-2">Telp Usaha</label>
									<div class="col-lg-4">
										<input type="text" name="no_telp_usaha" id="no_telp_usaha" class="form-control" autocomplete="off" value="<?=$val['no_telp_usaha']?>" >
									</div>
                                    
                                    <label class="control-label col-lg-2">Akta Notaris</label>
									<div class="col-lg-4">
										<input type="text" name="akta_notaris" id="akta_notaris" class="form-control" autocomplete="off" value="<?=$val['akta_notaris']?>" >
									</div>
                                    </div>
                                     <div class="form-group">
									<label class="control-label col-lg-2">No Fax</label>
									<div class="col-lg-4">
										<input type="text" name="no_fax" id="no_fax" class="form-control" autocomplete="off" value="<?=$val['no_fax']?>" >
									</div>
                                    <label class="control-label col-lg-2">Pkp*</label>
									<div class="col-lg-4">
                                    <select class="select" name="pkp" id="pkp" required>
                                  	<option value="1" <?php if ($val['pkp']==1){ echo "selected"; }?>>Ya</option>
                                    <option value="2" <?php if ($val['pkp']==2){ echo "selected"; }?>>Tidak</option>
																	 
									</select>
                                    </div>
                                   <!--  <label class="control-label col-lg-2">Ship to</label>
									<div class="col-lg-4">
										<input type="text" name="ship_to" id="ship_to" class="form-control" autocomplete="off" value="<?=$val['ship_to']?>" >
									</div>-->
                                    </div>
                                    <div class="form-group">
                                    <label class="control-label col-lg-2">Email 1</label>
									<div class="col-lg-4">
										<input type="text" name="email1" id="email1" class="form-control" autocomplete="off" value="<?=$val['email1']?>" >
									</div>
                                    <label class="control-label col-lg-2">Acc Code*</label>
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
                               
                        <div class="form-group">
                         <label class="control-label col-lg-2">Email 2</label>
									<div class="col-lg-4">
										<input type="text" name="email2" id="email2" class="form-control" autocomplete="off" value="<?=$val['email2']?>" >
                                        </div>
                           <label class="control-label col-lg-2">PPH</label>
									<div class="col-lg-1">
										<input type="text" name="pph" id="pph" class="form-control" autocomplete="off" value="<?=$val['pph']?>" placeholder="%" >
									</div>  
                                    <div class="col-lg-3">
										<select name="pphakun" class="select-search">
                                        <option value="">Pilih Akun PPh</option>
										<?php 
										foreach($db->select("ak_umpph","*") as $pp){
											?>
											<option value="<?=$pp['account']?>" <?php if($val['account_pph']==$pp['account']){echo "selected";}?>><?=$pp[jenis_um]?></option>
                                            <?php
											}
										?>
                                        </select>
									</div>             
                          <div class=" col-lg-3" >
                            </div>
						</div>
                         <div class="form-group">
                         <?php if($val[foto]==''){?>
                                     <label class="control-label col-lg-2">Foto</label>
							<div class="col-lg-4">
									<input type="file" name="foto" id="foto" class="file-input">
							</div>
                                   
							 <?php }else{?>
                            <div class="thumbnail col-lg-4" >
							
							<img src="images/<?=$val['foto']?>">
                            </div>
                                    <?php }?>
						</div>
                     