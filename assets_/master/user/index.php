<div class="col-lg-7">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
                    <div class="panel-body">
					<?php
                    $sat=$db->select("r_user_login","*","ID='$_POST[id]'");
					//echo "select a.*,b.ID_MENU from r_user_login a LEFT JOIN m_role_dtl b on a.ID=b.ID_USER where a.ID='$_POST[id]'";
					//echo "select a.id_pegawai,a.nama_pegawai,a.id_jabatan,b.status from m_pegawai a left join m_jabatan b on a.id_jabatan=b.id_jabatan where a.id_pegawai not in (select ID_PEGAWAI from r_user_login) and a.id_jabatan!=''";
					//echo "$_SESSION[ID_ROLE]";
					foreach($sat as $val){}
					?>
                    <form class="form-horizontal" action="index.php?x=user_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
                    <div class="col-lg-8">
                    		<div class="form-group">
									<label class="control-label col-lg-4">Nama Pegawai</label>
								 	<div class="col-lg-8">
										<select class="select-search" name="pegawai" id="pegawai"  onChange="call(pegawai.value)">
                                      		 <option value="">---Pilih Pegawai---</option>
											<?php

											if($val['ID_PEGAWAI']==''){
											$query1=$db->select("m_pegawai a left join m_jabatan b on a.id_jabatan=b.id_jabatan","a.id_pegawai,a.nama_pegawai,a.id_jabatan,b.status","a.id_pegawai not in (select ID_PEGAWAI from r_user_login) and a.id_jabatan!=''");}else{
											$query1=$db->select("m_pegawai a left join m_jabatan b on a.id_jabatan=b.id_jabatan","a.id_pegawai,a.nama_pegawai,a.id_jabatan,b.status","a.id_jabatan!=''");}
											
											foreach($query1 as $sel1){	
			                            ?>
                                        	<option value="<?=$sel1['id_pegawai'].'_'.$sel1['status']?>"  <?php if($sel1['id_pegawai']==$val['ID_PEGAWAI']){echo "selected";}?>><?=$sel1['nama_pegawai']?></option> <?php } ?>
									</select>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['ID']?>"  >
									
							 	 </div>   
                            </div>
                            <div class="form-group" id="st" style="display:none">
									<label class="control-label col-lg-4">Gudang</label>
								 	<div class="col-lg-8">
                                    	<select name="gud" id="gud" class="select-search" onChange="pindahData2(jenis.value,spb.value)">
										<option value="">---Gudang---</option>
										<?php
											$query=$db->select("m_gudang","id_gudang,nama_gudang","status='1'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_gudang']?>"><?=$sel['nama_gudang']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
                            </div>
                            <div class="form-group">
									<label class="control-label col-lg-4">Role</label>
									<div class="col-lg-8">
										<select class="select-search" name="role" id="role" required onChange="call(pegawai.value)">
                                      		 <option value="">---Pilih Akses---</option>
											<?php
											$query1=$db->select("m_role","*");
											foreach($query1 as $sel1){	
			                            ?>
                                        	<option value="<?=$sel1['id_role']?>"  <?php if($sel1['id_role']==$val['ID_ROLE']){echo "selected";}?>><?=$sel1['nama_role']?></option> <?php } ?>
									</select>
								     	</div>
								</div>
                            <div class="form-group">
									<label class="control-label col-lg-4">Username</label>
									<div class="col-lg-8">
										<input type="text" name="username" id="username" class="form-control" autocomplete="off" value="<?=$val['USERNAME']?>" required>
								     	</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Password</label>
									<div class="col-lg-8">
										<input type="password" name="password" id="password" class="form-control" autocomplete="off"  required>  
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Verifikasi Password</label>
									<div class="col-lg-8">
										<input type="password" name="password2" id="password2" class="form-control" autocomplete="off"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-8">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=user'">
										 Batal 
                                        </button>
									</div>
								</div>     
					
                   </div>
                    <div class="col-lg-6">
					</form>
                    
                    </div>
                    </div>
                    </div>
                    </div>			
		</div>
        
        
    <div class="col-lg-5">
		<form action="index.php?x=user" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="50%">Username </th>
                              <th width="10%">Nama</th>
                              <th width="15%">Aksi</th>
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
	$where = array("id_user" => $_POST['id']);
	$db->delete("r_hak_menu",$where);
	
	$where = array("id" => $_POST['id']);
	$db->delete("r_user_login",$where);
	
	echo "<script>window.location='index.php?x=user'</script>";
}
?>