<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
	</style>

<?php
 if($_GET['cd']==''){
	
	echo "<script>location.href='index.php?x=pegawai&cd=k2';</script>"; 
 }
 if($_GET['cd']=='k2'){
 ?>
 <form class="form-horizontal" action="index.php?x=pegawai_s" name="formku" id="formku" method="post" enctype="multipart/form-data">
		<div class="col-lg-9">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
                         <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Master Pegawai" onClick="window.location='index.php?x=pegawai&cd=b2'"></button></li>
							</ul>
                            </div>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_pegawai","*","id_pegawai='$_POST[id]'");
					foreach($sat as $val){}
					?>
                     
					
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-2">Nama</label>
									<div class="col-lg-4">
										<input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" autocomplete="off" value="<?=$val['nama_pegawai']?>" >
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_pegawai']?>" readonly >
									</div>
                                    <label class="control-label col-lg-2">Cabang</label>
								  <div class="col-lg-4">
								    <select class="select" name="id_cabang" id="id_cabang" >
								      <option value="">--Cabang--</option>
								      <?php
											$query=$db->select("m_cabang","*");
											foreach($query as $sel){	
			                            ?>
								      <option value="<?=$sel['id_cabang']?>"  <?php if($sel['id_cabang']==$val['id_cabang']){echo "selected";}?>>
								        <?=$sel['nama_cabang']?>
							          </option>
								      <?php } ?>
							        </select>
								  </div> 
					  </div>
                      <div class="form-group">
									<label class="control-label col-lg-2">No ktp</label>
									<div class="col-lg-4">
										<input type="text" name="no_ktp" id="no_ktp" class="form-control" autocomplete="off" value="<?=$val['no_ktp']?>" >
									</div>
                                    <label class="control-label col-lg-2">Divisi</label>
									<div class="col-lg-4">
									  <select class="select" name="id_divisi" id="id_divisi" >
									    <option value="">--Divisi--</option>
									    <?php
											$query1=$db->select("m_divisi","*");
											foreach($query1 as $sel1){	
			                            ?>
									    <option value="<?=$sel1['id_divisi']?>"  <?php if($sel1['id_divisi']==$val['id_divisi']){echo "selected";}?>>
									      <?=$sel1['nama_divisi']?>
								        </option>
									    <?php } ?>
								      </select>
						  </div>                                   
					  </div>
                                <div class="form-group">
                                <label class="control-label col-lg-2">Alamat</label>
									<div class="col-lg-4">
										<input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" value="<?=$val['alamat']?>" >
									</div>
                                   <label class="control-label col-lg-2">Jabatan</label>
									<div class="col-lg-4">
									  <select class="select" name="id_jabatan" id="id_jabatan" >
									    <option value="">--Jabatan--</option>
									    <?php
											$query3=$db->select("m_jabatan","*");
											foreach($query3 as $sel3){	
			                            ?>
									    <option value="<?=$sel3['id_jabatan']?>"  <?php if($sel3['id_jabatan']==$val['id_jabatan']){echo "selected";}?>>
									      <?=$sel3['nama_jabatan']?>
								        </option>
									    <?php } ?>
								      </select>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-2">Telp</label>
									<div class="col-lg-4">
										<input type="text" name="telp" id="telp" class="form-control" autocomplete="off" value="<?=$val['telp']?>" >
									</div>
                                    <label class="control-label col-lg-2">Domisili</label>
									<div class="col-lg-4">
										<input type="text" name="domisili" id="domisili" class="form-control" autocomplete="off" value="<?=$val['domisili']?>" >
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-2">Jenis Kelamin</label>
									<div class="col-lg-4">
										<select class="select" name="jk" id="dk">
                                      		 <option value="">--Jenis kelamin--</option>
											<option value="1" <?php if ($val['jk']==1){ echo "selected"; }?>>Laki-Laki</option>
											<option value="2" <?php if ($val['jk']==2){ echo "selected"; }?>>Perempuan</option>
									</select>
									</div>
                                    <label class="control-label col-lg-2">Tgl Kontrak</label>
									<div class="col-lg-4">
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                      <input type="text" class="form-control datepicker-menus" name="tgl_kontrak" id="tgl_kontrak" value="<?=$val['tgl_kontrak']?>" >
                                      </div>
                                   </div>
								</div>
                                
                                <div class="form-group">
                                 <label class="control-label col-lg-2"> Tgl Lahir</label>
									<div class="col-lg-4">
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                      <input type="text" class="form-control datepicker-menus" name="ttl" id="ttl"  value="<?=$val['ttl']?>"  >
                                      </div>
                                   </div>
                                 <label class="control-label col-lg-2"> Tgl PDPMP</label>
									<div class="col-lg-4">
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                      <input type="text" class="form-control datepicker-menus" name="tgl_pdmp" id="tgl_pdmp" value="<?=$val['tgl_pdmp']?>" >
                                      </div>
                                   </div>  
                                    
                                  
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-2">Pendidikan</label>
									<div class="col-lg-4">
									  <select class="select" name="pendidikan" id="pendidikan">
									    <option value="">--pilih--</option>
									    <option value="1" <?php if ($val['pendidikan']==1){ echo "selected"; }?>>D3</option>
									    <option value="2" <?php if ($val['pendidikan']==2){ echo "selected"; }?>>S1</option>
                                         <option value="3" <?php if ($val['pendidikan']==3){ echo "selected"; }?>>S2</option>
                                          <option value="4" <?php if ($val['pendidikan']==4){ echo "selected"; }?>>SMA</option>
								      </select>
									</div>
                                    <label class="control-label col-lg-2">Tgl tetap</label>
									<div class="col-lg-4">
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                      <input type="text" class="form-control datepicker-menus" name="tgl_tetap" id="tgl_tetap" value="" >
                                      </div>
                                  </div>
								</div>
                                <div class="form-group">
                                  <label class="control-label col-lg-2">Status keluarga</label>
									<div class="col-lg-4">
									  
									    <select class="select" name="status_keluarga" id="status_keluarga">
									      <option value="">--Status--</option>
									      <option value="k0" <?php if ($val['status_keluarga']=='k0'){ echo "selected"; }?>>k0</option>
									      <option value="k1" <?php if ($val['status_keluarga']=='k1'){ echo "selected"; }?>>k1</option>
									      <option value="tk" <?php if ($val['status_keluarga']=='tk'){ echo "selected"; }?>>tk</option>
									    
								        </select>
								     
									</div>
                                    <label class="control-label col-lg-2">Tgl Pangkat</label>
									<div class="col-lg-4">
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                      <input type="text" class="form-control datepicker-menus" name="tgl_pangkat" id="tgl_pangkat" value="<?=$val['tgl_pdmp']?>" >
                                      </div>
                                   </div>
								</div>
                                
                                 <div class="form-group">
                                 <label class="control-label col-lg-2">Tgl Pensiun</label>
									<div class="col-lg-4">
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                      <input type="text" class="form-control datepicker-menus" name="tgl_pensiun" id="tgl_pensiun" value="<?=$val['tgl_pensiun']?>" >
                                      </div>
                                   </div>
                                   <label class="control-label col-lg-2">Tgl Penempatan</label>
									<div class="col-lg-4">
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                      <input type="text" class="form-control datepicker-menus" name="tgl_penempatan" id="tgl_penempatan" value="<?=$val['tgl_penempatan']?>" >
                                      </div>
                                   </div>
								</div>
                                 <div class="form-group">
                                  <label class="control-label col-lg-2">Kode Bank</label>
									<div class="col-lg-4">
									 <input type="text" name="kode_bank" id="kode_bank" class="form-control" autocomplete="off" value="<?=$val['kode_bank']?>" >
									</div>
                                   <label class="control-label col-lg-2">Tgl Jabatan</label>
									<div class="col-lg-4">
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                      <input type="text" class="form-control datepicker-menus" name="tgl_jabatan" id="tgl_jabatan" value="<?=$val['tgl_jabatan']?>" >
                                      </div>
                                   </div>
								</div>
                                <div class="form-group">
                                  <label class="control-label col-lg-2">No Jamsostek</label>
									<div class="col-lg-4">
									 <input type="text" name="no_jamsostek" id="no_jamsostek" class="form-control" autocomplete="off" value="<?=$val['no_jamsostek']?>" >
									</div>
                                   <label class="control-label col-lg-2">Pangkat</label>
									<div class="col-lg-4">
									  <select class="select" name="pangkat" id="pangkat">
									    <option value="">--status--</option>
									    <option value="1" <?php if ($val['pangkat']==1){ echo "selected"; }?>>Eselon 1</option>
									    <option value="2" <?php if ($val['pangkat']==2){ echo "selected"; }?>>Eselon 2</option>
									    <option value="3" <?php if ($val['pangkat']==3){ echo "selected"; }?>>Pelaksana</option>
								      </select>
									</div>
								</div>
                                <div class="form-group">
                                  <label class="control-label col-lg-2">No Bumi Putera</label>
									<div class="col-lg-4">
									 <input type="text" name="no_bumiputera" id="no_bumiputera" class="form-control" autocomplete="off" value="<?=$val['no_bumiputera']?>" >
									</div>
                                   <label class="control-label col-lg-2">Active</label>
									<div class="col-lg-4">
									  <select class="select" name="active" id="active">
									    <option value="">--status--</option>
									    <option value="1" <?php if ($val['active']==1){ echo "selected"; }?>>Active</option>
									    <option value="2" <?php if ($val['active']==2){ echo "selected"; }?>>PHK</option>
									    <option value="3" <?php if ($val['active']==3){ echo "selected"; }?>>Resign</option>
									   
								      </select>
									</div>
								</div>
                                <div class="form-group">
                                  <label class="control-label col-lg-2">No Car</label>
									<div class="col-lg-4">
									 <input type="text" name="no_car" id="no_car" class="form-control" autocomplete="off" value="<?=$val['no_car']?>" >
									</div>
                                   <label class="control-label col-lg-2">Status Pegawai</label>
									<div class="col-lg-4">
									  <select class="select" name="status_pegawai" id="status_pegawai" >
									    <option value="">--status pegawai--</option>
									    <option value="1" <?php if ($val['status_pegawai']==1){ echo "selected"; }?>>Kontrak</option>
									    <option value="2" <?php if ($val['status_pegawai']==2){ echo "selected"; }?>>PDMP</option>
									    <option value="3" <?php if ($val['status_pegawai']==3){ echo "selected"; }?>>Tetap</option>
								      </select>
									</div>
								</div>
                                <div class="form-group">
                                  <label class="control-label col-lg-2">Keterangan</label>
									<div class="col-lg-4">
									 <textarea rows="3" name="keterangan" class="form-control"> </textarea>
									</div>
                                    <label class="control-label col-lg-2"></label>
									<div class="col-lg-4">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=pegawai'">
										 Batal 
                                        </button>
									</div>
								</div>  
                                 <div class="form-group">
                                  <label class="control-label col-lg-2">Golongan</label>
									<div class="col-lg-4">
									  <select class="select" name="id_golongan" id="id_golongan" >
									    <option value="">--Golongan--</option>
									    <?php
											$query1=$db->select("m_golongan","*");
											foreach($query1 as $sel1){	
			                            ?>
									    <option value="<?=$sel1['id_golongan']?>"  <?php if($sel1['id_golongan']==$val['id_golongan']){echo "selected";}?>>
									      <?=$sel1['nama_golongan']?>
								        </option>
									    <?php } ?>
								      </select>
									</div> 
								</div>
                                 
                                    
                                  
								</div>
                                
                               
                      <div class="form-group">
									   
					
					</div>	
                    
				</div>		
                </div>			
		</div>
        <div class="col-lg-3">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Foto Pegawai</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="panel-body">
                    	<?php if($val[foto]==''){?>
                        <div class="form-group">
							<div class="col-lg-12">
									<input type="file" name="foto" id="foto" class="file-input">
							</div>
                         </div>
                         <?php }else{?>
                         <div class="form-group" >
						  <div class=" col-lg-3" >
                            </div>
                            <div class="thumbnail col-lg-6" >
							
							<img width="200" height="200" src="images/<?=$val['foto']?>">
                            </div>
                          <div class=" col-lg-3" >
                            </div>
						</div>
                     <?php }?>
                    </div>
            	</div>        
        </div>   
        </form>         
 <?php }if($_GET['cd']=='b2'){?>
            <div class="col-lg-8">
		<form action="index.php?x=pegawai&cd=k2" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Data Pegawai</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Master Pegawai" onClick="window.location='index.php?x=pegawai&cd=k2'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                               <th width="10%">NIK</th>
                               <th width="30%">Nama Pegawai</th>
                               <th width="20%">Cabang</th>
                               <th width="20%">Divisi</th>
                               <th width="20%">Jabatan</th>
                               <th width="10%">Telp</th>
                               <th width="10%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  >
            		<input type="hidden" name="id" id="id"  value=""  >
   		  </div>
			</form>
		</div>
        <div class="col-lg-4">
        <?php
                        $peg=$db->select("m_pegawai a 
						left join m_cabang b on a.id_cabang=b.id_cabang
						left join m_divisi c on a.id_divisi=c.id_divisi
						left join m_jabatan d on a.id_jabatan=d.id_jabatan
						","a.*,nama_cabang,nama_jabatan,nama_divisi","id_pegawai='$_GET[id]'");
						foreach($peg as $pegval){}
						?>
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Detil Pegawai</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="panel-body">
                    	<div class="form-group" >
						  <div class=" col-lg-3" >
                            </div>
                            <div class="thumbnail col-lg-6" >
							
							<img width="200" height="200" src="images/<?=$pegval['foto']?>">
                            </div>
                          <div class=" col-lg-3" >
                            </div>
						</div>	
                        
                        <div class="form-group" >
                        <div class=" col-lg-12" >
                        <div class=" table-responsive pre-scrollable">
                        
                       		<table width="100%" border="1" cellpadding="0" cellspacing="0" >
                                <tr>
                                      <td width="29%"align="left">&nbsp;Nama</td>
                                      <td width="71%" align="left">&nbsp; <b><?=$pegval['nama_pegawai']?></b></td>
                                </tr>
                                   
                                <tr>
                                      <td align="left">&nbsp;NIK</td>
                                      <td align="left">&nbsp; <b>
                                        <?=$pegval['nik']?>
                                      </b></td>
                              </tr>
                                <tr>
                                  <td align="left">&nbsp;No KTP</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['no_ktp']?>
                                  </b></td>
                                </tr>
                                <tr>
                                      <td align="left">&nbsp;Cabang</td>
                                      <td align="left">&nbsp; <b>
                                        <?=$pegval['nama_cabang']?>
                                      </b></td>
                              </tr>
                                <tr>
                                      <td align="left">&nbsp;Divisi</td>
                                      <td align="left">&nbsp; <b>
                                        <?=$pegval['nama_divisi']?>
                                      </b></td>
                              </tr>
                                <tr>
                                  <td align="left">&nbsp;Jabatan</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['nama_jabatan']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Jenis kelamin</td>
                                  <td align="left">&nbsp; <b>
                                    <?php
                                    if($pegval['jk']==1){
										echo "Pria";
									}
									if($pegval['jk']==2){
										echo "Wanita";
									}
									
									?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Alamat</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['alamat']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;No telp</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['telp']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Tgl Lahir</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['ttl']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Pendidikan</td>
                                  <td align="left">&nbsp;<b>
                                    <?php
                                    if($pegval['pendidikan']==1){
										echo "D3";
									}
									if($pegval['pendidikan']==2){
										echo "S1";
									}
									if($pegval['pendidikan']==3){
										echo "S2";
									}
									if($pegval['pendidikan']==4){
										echo "SMA";
									}
									
									?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Domisili</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['domisili']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Status keluarga</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['status_keluarga']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">Status Pegawai</td>
                                  <td align="left">&nbsp;<b>
                                    <?php
                                    if($pegval['status_pegawai']==1){
										echo "Kontrak";
									}
									if($pegval['status_pegawai']==2){
										echo "PDMP";
									}
									if($pegval['status_pegawai']==3){
										echo "Tetap";
									}
									
									
									?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Tgl Kontrak</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['tgl_kontrak']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Tgl PDMP</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['tgl_pdmp']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Tgl Tetap</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['tgl_tetap']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Tgl Pensiun</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['tgl_pensiun']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Pangkat</td>
                                  <td align="left">&nbsp;<b>
                                    <?php
                                    if($pegval['pangkat']==1){
										echo "Eselon 1";
									}
									if($pegval['pangkat']==2){
										echo "Eselon 2";
									}
									if($pegval['pangkat']==3){
										echo "Pelaksana";
									}
									
									
									?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Tgl Pangkat</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['tgl_pangkat']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Tgl Jabatan</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['tgl_jabatan']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Status Active</td>
                                  <td align="left">&nbsp;<b>
                                    <?php
                                    if($pegval['active']==1){
										echo "Active";
									}
									if($pegval['active']==2){
										echo "PHK";
									}
									if($pegval['active']==3){
										echo "Resign";
									}
									
									
									?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Tgl Penempatan</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['tgl_penempatan']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Kode Bank</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['kode_bank']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;Norek</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['norek']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;No Jamsostek</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['no_jamsostek']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;No Bumiputera</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['no_bumiputera']?>
                                  </b></td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;No Car</td>
                                  <td align="left">&nbsp; <b>
                                    <?=$pegval['no_car']?>
                                  </b></td>
                                </tr>
                                
                                 
                            </table>
                       </div>
                       </div>
                        </div>		
                                    
                  </div>
                    </div>
            	</div>        
        </div> 

<?php
 }
if($_POST[aksi]=='hapus'){
	$where = array("id_pegawai" => $_POST['id']);
	$db->delete("m_pegawai",$where);
	echo "<script>window.location='index.php?x=pegawai'</script>";
}
?>