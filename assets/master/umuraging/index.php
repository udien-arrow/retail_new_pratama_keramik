<?php if($_GET[slug]==''){?>   
    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Umur Aging</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_umur","*","id_aging='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=umuraging_s" id="formku" name="formku" method="post">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Aging</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_aging']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_aging']?>"  required>
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Jenis</label>
									<div class="col-lg-5">
										<select class="select" name="jenis" id="jenis">
                                        	<option value="1" <?php if($val['jenis']==1){echo "selected";}?>>Piutang Usaha</option>
                                        	<option value="2"<?php if($val['jenis']==2){echo "selected";}?>>Hutang</option>
                                        </select>
                                        
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=umuraging'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>		
                </div>			
		</div>
        <div class="col-lg-7">
   		<form action="index.php?x=umuraging" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Umur Aging</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                               <th width="40%">Nama <span class="form-group">Aging</span></th>
                              <th width="20%">Jenis</th>
                              <th width="25%">Detil</th>
                              <th width="12%">Aksi</th>
                            </tr>
                        </thead>
                    </table><input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
				</div>
                </form>
		</div>
 <?php 
 		if($_POST['aksi']!=''){
		$where = array("id_aging" => $_POST['id']);
		$db->delete("m_umur",$where);
		$db->delete("m_umur_dtl",$where);
		
		echo "<script>window.location='index.php?x=umuraging'</script>";
		}
  }
  if($_GET[slug]==1){
 ?>   
   
<div class="col-lg-2">
</div>
		<div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Umur Aging</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                   	
					?>
					<form class="form-horizontal" action="index.php?x=umuraging_s" id="formku" method="post">
							<fieldset class="content-group">
								
                                <div class="form-group">
                                </div>
                                <?php
                                for($i=1;$i<=6;$i++){
									$sub=$db->select("m_umur_dtl","*","id_aging='$_GET[id]' and urut='$i'");
									foreach($sub as $valsub){}	
								?>
                                <div class="form-group">
									<label class="control-label col-lg-3">Umur <?=$i?></label>
									<div class="col-lg-2">
									  <input type="text" name="awal<?=$i?>" id="awal<?=$i?>" class="form-control" autocomplete="off"  value="<?php echo $valsub['awal']?>">
							          <span class="col-lg-5">
							          <input type="hidden" name="urut<?=$i?>" id="urut<?=$i?>" class="form-control" required value="<?php echo $valsub['urut'];?>">
						          </span></div>
                                  <div class="col-lg-2">
									  <input type="text" name="akhir<?=$i?>" id="akhir<?=$i?>" class="form-control" autocomplete="off" value="<?php echo $valsub['akhir']?>" >
							      </div>
								</div>
                                <?php }?>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                      <button class="btn btn-success" type="button" onClick="window.location='index.php?x=umuraging'">
										 Batal 
                                        </button>
                                       <input type="hidden" name="kode_dep" id="kode_dep" class="form-control" required value="<?php echo $_GET['id']?>">
                                       <input type="hidden" name="slug" id="slug" class="form-control" value="<?=$_GET['slug']?>"  required>
                                    </div>
								</div>
                                
					</form>
					</div>	
                    </div>
				</div>					
		</div>
         <div class="col-lg-7"></div>
 <?php 
  }
 ?> 
 

 
    
