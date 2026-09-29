<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
                    <div class="panel-body">
					<?php
					if($_POST[id]!=''){
                    $sat=$db->select("ak_acc","*","account='$_POST[id]'");
					foreach($sat as $val){}
					}
					?>
                    <form class="form-horizontal" action="index.php?x=koder_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
                    <?php
					if(!empty($_POST[id])){
						$t="edit";
						} else {
							$t="add";
							}
							
					?>
                    <div class="col-lg-12">
                    <div class="form-group">
									<label class="control-label col-lg-4">Kelompok Perkiraan</label>
					  <div class="col-lg-4">
                     					<input type="hidden" name="t" value="<?=$t?>" />
										<select class="select-search" name="kel" id="kel" required>
                                      		 <option value="">Please select</option>
											<?php

												
													$query1=$db->select("ak_acc_group","*");
											foreach($query1 as $sel1){	
			                            ?>
                                        	<option value="<?=$sel1['id_group']?>" <?php if($sel1['id_group']==$val['type']){echo "selected";}?>><?=$sel1['nama']?></option> <?php } ?>
									</select>
                                    </div>
                                    
					  </div>
                      <div class="form-group" id="jen1">
                                	<label class="control-label col-lg-4">Jenis</label>
									<div class="col-lg-4">
										<select class="select" name="jenis" id="jenis1" onChange="">
											 <option value="">Please select</option>
                                             <?php
											 if(!empty($_POST[id])){
												 $qq=$db->select("ak_acc_type","*","id_group='$val[type]'");
												 foreach($qq as $v){
													 ?>
													 <option value="<?=$v['id_param']?>" <?php if($v['id_param']==$val['LR'])
													 {echo "selected";}?>><?=$v['nama']?></option>
													 <?php
												 }}
											 ?>
                                      </select>    
                                  </div>
					  </div>
                      
                      <div class="form-group" id="sub1">
                           		  <label class="control-label col-lg-4">Sub Account</label>
									<div class="col-lg-4">
										<select class="select-search" name="head" id="head1" onChange="">
											 <option value="0">Please select</option>
                                             <?php
											 if(!empty($_POST[id])){
												 $qq=$db->select("ak_acc","*","type='$val[type]' OR LR='$val[LR]'");
												 foreach($qq as $v1){
													 ?>
													 <option value="<?=$v1['account']?>" <?php if($v1['account']==$val['parent'])
													 {echo "selected";}?>><?=$v1['account']." - ".$v1['description']?></option>
													 <?php
												 }}
											 ?>
                                      </select>    
                                  </div>
					  </div>
                      <div class="form-group">
								  <label class="control-label col-lg-4">Header</label>
									<div class="col-lg-4">
									  <select class="select" name="parent" id="parent" onchange="">
									    <option name="yes" value="1">Yes</option>
									    <option name="no" value="0">No</option>
								      </select>
									</div>
					  </div>          
               		  <div class="form-group">
						<label class="control-label col-lg-4">Kode Perkiraan</label>
									<div class="col-lg-6">
									  <input type="text" name="kd_per" id="kd_per" class="form-control" autocomplete="off" value="<?=$val['account']?>" required />
									</div>
					  </div>
                                
                      <div class="form-group">
							  <label class="control-label col-lg-4">Nama Perkiraan</label>
									<div class="col-lg-6">
										<input type="text" name="nm_per" id="nm_per" class="form-control" autocomplete="off" value="<?=$val['description']?>" required>
				     	</div>
					  </div>
                    		
                                
                                
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-8">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=koder'">
										 Batal 
                                        </button>
									</div>
								</div>     
					
                   </div>
                    </form>
                    <div class="col-lg-6">
					
                    </div>                    
                    </div>
					</div>
                    </div>			
</div>
        
        
    <div class="col-lg-6">
		<form action="index.php?x=koder" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                               <th width="20%">Account</th>
                               <th width="50%">Description</th>
                              <th width="15%">Nama</th>
                              <th width="10%">Aksi</th>
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
	$where = array("account" => $_POST['id']);
	$db->delete("ak_acc",$where);
	echo "<script>window.location='index.php?x=koder'</script>";
}
?>