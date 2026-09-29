<?php if($_GET[slug]==''){?>   
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                    <?php
                    $sat=$db->select("hr_penghargaan","*","id_penghargaan='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=penghargaan_s" id="formku" name="formku" method="post">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Pegawai</label>
									<div class="col-lg-7">
										<select class="select-search" name="pegawai" id="pegawai" required>
									    <option value="">--Pegawai--</option>
									    <?php
											$query1=$db->select("m_pegawai","*");
											foreach($query1 as $sel1){	
			                            ?>
									    <option value="<?=$sel1['id_pegawai']?>"  <?php if($sel1['id_pegawai']==$val['id_pegawai']){echo "selected";}?>>
									      <?=$sel1['nik'].'-'.$sel1['nama_pegawai']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Jenis Penghargaan</label>
									<div class="col-lg-5">
										<select class="select" name="penghargaan" id="penghargaan" required>
									    <option value="">--penghargaan--</option>
									    <?php
											$query1=$db->select("hr_m_penghargaan","*");
											foreach($query1 as $sel1){	
			                            ?>
									    <option value="<?=$sel1['id_jenispeng']?>"  <?php if($sel1['id_jenispeng']==$val['jenis_penghargaan']){echo "selected";}?>>
									      <?=$sel1['nama_jenispeng']?>
								        </option>
									    <?php } ?>
								    </select>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_penghargaan']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tgl </label>
								   <div class="col-lg-5">
										<input type="text" name="tgl" id="tgl" class="form-control datepicker" autocomplete="off" value="<?=$val['tgl']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">SK Penghargaan</label>
								   <div class="col-lg-5">
										<input type="text" name="skpel" id="skpel" class="form-control" autocomplete="off" value="<?=$val['sk_penghargaan']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Keterangan</label>
								   <div class="col-lg-5">
										<textarea type="text" name="ket" id="ket" class="form-control" autocomplete="off" value="" required><?=$val['ket_penghargaan']?></textarea>
									</div>
								</div>
                               <!--<div class="form-group">
									<label class="control-label col-lg-4">tes</label>
								   <div class="col-lg-5">
										<select name="aaa" id="aaa">
                                        	<option value="">--</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                        
									</div>
								</div>
                                
                                <div class="form-group" style="display:none" id="coba">
									<label class="control-label col-lg-4">Keterangan</label>
								   <div class="col-lg-5" >
										<textarea type="text" name="ket11" id="ket11" class="form-control" autocomplete="off" value="" required><?=$val['ket_penghargaan']?></textarea>
									</div>
								</div>-->
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=penghargaan'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>					
		</div>
        <div class="col-lg-7">
   		<form action="index.php?x=penghargaan" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Master penghargaan" onClick="window.location='index.php?x=penghargaan&slug=1'"></button></li>
							</ul>
                            </div>
					</div>                  
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                               <th width="50%">Nama Pegawai</th>
                               <th width="50%">Jenis penghargaan</th>
                               <th width="50%">SK </th>
                             
                              <th width="50%">Keterangan</th>
                              <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                    </table><input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
				</div>
                </form>
		</div>
 <?php 
 		if($_POST['aksi']!=''){
		$where = array("id_penghargaan" => $_POST['id']);
		$db->delete("hr_penghargaan",$where);
		echo "<script>window.location='index.php?x=penghargaan'</script>";
		}
  }
  if($_GET[slug]==1){
 ?>   
   

		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Master penghargaan</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                    <?php
                   
					$sub=$db->select("hr_m_penghargaan","*","id_jenispeng='$_POST[id]'");
					foreach($sub as $valsub){}
					?>
					<form class="form-horizontal" action="index.php?x=penghargaan_s" id="formku" method="post">
							<fieldset class="content-group">
								
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Jenis</label>
									<div class="col-lg-5">
									  <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required value="<?php echo $valsub['nama_jenispeng']?>">
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nilai</label>
								  <div class="col-lg-5">
									  <textarea type="text" name="ket" id="ket" class="form-control" autocomplete="off" required><?php echo $valsub['ket']?></textarea>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?php echo $valsub['id_jenispeng']?>" required>
									<input type="hidden" name="slug" id="slug" class="form-control" value="<?=$_GET['slug']?>"  required>
								  </div>
								</div>
                             <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                       <button class="btn btn-success" type="button" onClick="window.location='index.php?x=penghargaan&slug=<?=$_GET['slug']?>'">
										 Batal 
                                        </button>
									</div>
								</div>
                                
					</form>
					</div>	
				</div>					
		</div>
         <div class="col-lg-7">
   			 <form action="index.php?x=penghargaan&slug=<?=$_GET[slug]?>&id=<?=$_GET[id]?>" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Master penghargaan</h5>
							<div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Back" onClick="window.location='index.php?x=penghargaan'"></button></li>
							</ul>
                            </div>
					</div>
					 <table id="example5" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr >
                              <th width="20%">Nama Jenis </th>
                              <th width="70%">Keterangan</th>
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
 $where = array("id_jenispeng" => $_POST['id']);
		$db->delete("hr_m_penghargaan",$where);
		 echo "<script>	window.location='index.php?x=penghargaan&slug=$_GET[slug]'</script>";
 	}
  }
 ?> 
 

    
