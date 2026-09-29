<div class="col-lg-7">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
                    <div class="panel-body">
					<?php
                    $sat=$db->select("m_role a LEFT JOIN m_role_dtl b on a.id_role=b.id_role","a.*,b.id_menu","a.id_role='$_POST[id]'");
					foreach($sat as $val){}
					?>
                    <form class="form-horizontal" action="index.php?x=role_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
                    <div class="col-lg-6">
                            <div class="form-group" id="st" style="display:none">
                            </div>
                            <div class="form-group">
									<label class="control-label col-lg-4">Nama</label>
									<div class="col-lg-8">
										<input type="text" name="username" id="username" class="form-control" autocomplete="off" value="<?=$val['nama_role']?>" required>
								     	</div>
                                         <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_role']?>">
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-8">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=role'">
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
										$query2=$db->select("r_main_menu","*","PARENT=0 AND STATUS=1");
											foreach($query2 as $sel2){	
											
			                            ?> 
                        <tr><td  colspan="2" align="center"><b><?=$sel2['NAMA'];?></b></td></tr>
						<tbody>
                          <?php 
						 	$query4=$db->select("r_main_menu a LEFT JOIN m_role_dtl b on a.ID=b.id_menu and b.id_role='$_POST[id]'","a.ID,a.NAMA,b.id_menu,a.PARENT,a.PARENT_SUB","PARENT='$sel2[ID]' AND STATUS=1 AND SLUG!='' order by a.ID");
											foreach($query4 as $sel4){	
									?>
							<tr>
								<td><input type="checkbox" class="control-primary" name="hak[]" id="hak[]" value="<?php echo $sel4['PARENT']."_".$sel4['ID']."_".$sel4['PARENT_SUB']; ?>"  <?php if($sel4['id_menu']<>''){echo "checked";} ?>> </td>		
								<td><a href="#"><?=$sel4['NAMA']?></a><?=$query9['id_menu'];?></td>
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
		<form action="index.php?x=role" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                              <th width="50%">Nama</th>
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
	$where = array("id_role" => $_POST['id']);
	$db->delete("m_role_dtl",$where);
	
	$where = array("id_role" => $_POST['id']);
	$db->delete("m_role",$where);
	
	echo "<script>window.location='index.php?x=role'</script>";
}
?>