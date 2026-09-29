<?php if($_GET[slug]==''){?>   
    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Marchandise</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_dep","*","id_dep='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=marchandise_s" id="formku" name="formku" method="post">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Golongan</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_dep']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_dep']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=marchandise'">
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
   		<form action="index.php?x=marchandise" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Marchandise</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                               <th width="13%">Kode </th>
                              <th width="50%">Nama <span class="form-group">Golongan</span></th>
                              <th width="25%">Sub Golongan</th>
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
		$where = array("id_dep" => $_POST['id']);
		$db->delete("m_dep",$where);
		echo "<script>window.location='index.php?x=marchandise'</script>";
		}
  }
  if($_GET[slug]==1){
 ?>   
   

		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Marchandise</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_dep","*","id_dep='$_GET[id]'");
					foreach($sat as $val){}
					
					$sub=$db->select("m_subdep","*","id_sub='$_POST[id]'");
					foreach($sub as $valsub){}
					?>
					<form class="form-horizontal" action="index.php?x=marchandise_s" id="formku" method="post">
							<fieldset class="content-group">
								
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama  Golongan</label>
									<div class="col-lg-5">
									  <input type="text" name="nama_dep" id="nama_dep" class="form-control" autocomplete="off" required value="<?php echo $val['nama_dep']?>" readonly>
							      </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Sub Golongan</label>
								  <div class="col-lg-5">
									  <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required value="<?php echo $valsub['nama_sub']?>">
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?php echo $valsub['id_sub']?>" required>
								    <input type="hidden" name="kode_dep" id="kode_dep" class="form-control" required value="<?php echo $val['id_dep']?>">
									<input type="hidden" name="slug" id="slug" class="form-control" value="<?=$_GET['slug']?>"  required>
								  </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                       <button class="btn btn-success" type="button" onClick="window.location='index.php?x=marchandise'">
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
   			 <form action="index.php?x=marchandise&slug=<?=$_GET[slug]?>&id=<?=$_GET[id]?>" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Marchandise</h5>
							<div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Back" onClick="window.location='index.php?x=marchandise'">
                                </li>
							</ul>
                            </div>
					</div>
					 <table id="example5" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr >
                              <th width="13%">Kode </th>
                              <th width="50%">Nama Golongan</th>
                              <th width="50%">Nama Sub</th>
                              <th width="25%">Kategori</th>
                              <th width="12%">Aksi</th>
                            </tr>
                        </thead>
                        
                    </table>
					 <input type="hidden" name="aksi" id="aksi"  value=""  required>
                     <input type="hidden" name="id" id="id"  value=""  required>
				</div>
               </form> 
		</div>
 <?php 
 if($_POST['aksi']!=''){
 $where = array("id_sub" => $_POST['id']);
		$db->delete("m_subdep",$where);
		 echo "<script>	window.location='index.php?x=marchandise&slug=$_GET[slug]&id=$_GET[id]'</script>";
 	}
  }
 ?> 
 
<?php 
 if($_GET[slug]==2){
?>   
   

		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Marchandise</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_subdep","*","id_sub='$_GET[idsub]'");
					foreach($sat as $val){}
					
					$sub=$db->select("m_kat","*","id_kat='$_POST[id]'");
					foreach($sub as $valsub){}
					?>
					<form class="form-horizontal" action="index.php?x=marchandise_s" id="formku" method="post">
							<fieldset class="content-group">
								
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Sub Golongan</label>
									<div class="col-lg-5">
									  <input type="text" name="nama_dep" id="nama_dep" class="form-control" autocomplete="off" required value="<?php echo $val['nama_sub']?>" readonly>
							      </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Kategori</label>
								  <div class="col-lg-5">
									  <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required value="<?php echo $valsub['nama_kat']?>">
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?php echo $valsub['id_kat']?>" required>
								    <input type="hidden" name="kode_dep" id="kode_dep" class="form-control" required value="<?php echo $val['id_dep']?>">
									<input type="hidden" name="slug" id="slug" class="form-control" value="<?=$_GET['slug']?>"  required>
								    <input type="hidden" name="kode_sub" id="kode_sub" class="form-control" required value="<?php echo $val['id_sub']?>">
								  </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                       <button class="btn btn-success" type="button" onClick="window.location='index.php?x=marchandise&slug=1&id=<?=$_GET[id]?>'">
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
   			 <form action="index.php?x=marchandise&slug=<?=$_GET[slug]?>&id=<?=$_GET[id]?>&idsub=<?=$_GET[idsub]?>" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Marchandise</h5>
							<div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Back" onClick="window.location='index.php?x=marchandise&slug=1&id=<?=$_GET[id]?>'"></button></li>
							</ul>
                            </div>
					</div>
					 <table id="example6" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr >
                              <th width="13%">Kode </th>
                              <th width="20%">Nama Sub</th>
                              <th width="25%">Kategori</th>
                              <th width="12%">Aksi</th>
                            </tr>
                        </thead>
                        
                    </table>
					 <input type="hidden" name="aksi" id="aksi"  value=""  required>
                     <input type="hidden" name="id" id="id"  value=""  required>
				</div>
               </form> 
		</div>
 <?php 
 if($_POST['aksi']!=''){
 $where = array("id_kat" => $_POST['id']);
		$db->delete("m_kat",$where);
		 echo "<script>	window.location='index.php?x=marchandise&slug=$_GET[slug]&id=$_GET[id]&idsub=$_GET[idsub]'</script>";
 	}
  }
 ?> 
 
    
