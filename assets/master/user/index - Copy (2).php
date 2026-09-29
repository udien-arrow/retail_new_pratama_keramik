<div class="col-lg-7">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
                    <div class="panel-body">
					<?php
                    $sat=$db->select("r_user_login a LEFT JOIN r_hak_menu b on a.ID=b.ID_USER","a.*,b.ID_MENU","a.ID='$_POST[id]'");
					foreach($sat as $val){}
					?>
                    <form class="form-horizontal" action="index.php?x=user_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
                    <div class="col-lg-6">
                    		<div class="form-group">
									<label class="control-label col-lg-4">Nama Pegawai</label>
								 	<div class="col-lg-8">
										<select class="select-search" name="pegawai" id="pegawai">
                                      		 <option value="">---Pilih Pegawai---</option>
											<?php
											$query1=$db->select("m_pegawai","*");
											foreach($query1 as $sel1){	
			                            ?>
                                        	<option value="<?=$sel1['id_pegawai']?>"  <?php if($sel1['id_pegawai']==$val['ID_PEGAWAI']){echo "selected";}?>><?=$sel1['nama_pegawai']?></option> <?php } ?>
									</select>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['ID']?>"  required>
									
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
										<input type="password" name="password" id="password" class="form-control" autocomplete="off" value="<?=$val['PASSWORD']?>" required>
								      
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Verifikasi Password</label>
									<div class="col-lg-8">
										<input type="password" name="password2" id="password2" class="form-control" autocomplete="off" value="<?=$val['PASSWORD']?>" required>
								      
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
					<div class="table-responsive pre-scrollable">
					<font size="2px"><table class="table" width="100%">
						<thead>
							<tr>
								<th width="2%">#</th>
								<th width="98%">Nama Menu</th>
							</tr>
                           
						</thead>
                        <?php 
						
						 $men=$db->select("r_hak_menu","*","ID_USER='$_POST[id]' order by ID_MENU");
											foreach($men as $mens){
											$wow="$mens[ID_MENU]";
											
											}
											
						
						?>
                        <?php
										$query2=$db->select("r_main_menu","*","PARENT=0 AND STATUS=1");
											foreach($query2 as $sel2){	
			                            ?> 
                        <tr><td  colspan="2" align="center"><b><?=$sel2['NAMA'];?></b></td></tr>
						<tbody>
                          <?php 
						 
									$query4=$db->select("r_main_menu a LEFT JOIN r_hak_menu b on a.ID=b.ID_MENU and b.ID_USER=$_POST[id]","a.ID,a.NAMA,b.ID_MENU","PARENT='$sel2[ID]' AND STATUS=1");
											foreach($query4 as $sel4){	
										
									?>
							<tr>
								<td><input type="checkbox" class="control-primary" name="hak[]" id="hak[]" value="<?php $sel4['ID'] ?>" <?=$sex?>> </td>		
								<td><a href="#"><?=$sel4['NAMA']?></a><?=$query9['ID_MENU'];?></td>
							</tr>
                            <?php }} ?>
						</tbody>
					</table></font></form>
                    </div>
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
                              <th width="10%">Divisi</th>
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
	$where = array("id_cabang" => $_POST['id']);
	$db->delete("m_cabang",$where);
	echo "<script>window.location='index.php?x=cabang'</script>";
}
?>