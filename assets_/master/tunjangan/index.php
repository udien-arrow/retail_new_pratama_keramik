<?php if($_GET[slug]==''){?>   
    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit tunjangan</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                    <?php
                    $sat=$db->select("hr_m_tunjangan","*","id_tunjangan='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=tunjangan_s" id="formku" name="formku" method="post">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama tunjangan</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['tunjangan']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_tunjangan']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=tunjangan'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>					
		</div>
        <div class="col-lg-7">
   		<form action="index.php?x=tunjangan" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master tunjangan</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Tingkat Tunjangan" onClick="window.location='index.php?x=tunjangan&slug=1'"></button></li>
							</ul>
                            </div>
					</div>                  
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                               <th width="13%">Kode </th>
                              <th width="50%">Nama Tunjangan</th>
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
		$where = array("id_tunjangan" => $_POST['id']);
		$db->delete("hr_m_tunjangan",$where);
		echo "<script>window.location='index.php?x=tunjangan'</script>";
		}
  }
  if($_GET[slug]==1){
 ?>   
   

		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit tunjangan</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                    <?php
                    $sat=$db->select("hr_m_tunjangan","*","id_tunjangan='$_GET[id]'");
					foreach($sat as $val){}
					
					$sub=$db->select("hr_tunjangan","*","id_tdtunjangan='$_POST[id]'");
					foreach($sub as $valsub){}
					?>
					<form class="form-horizontal" action="index.php?x=tunjangan_s" id="formku" method="post">
							<fieldset class="content-group">
								
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama tunjangan </label>
									<div class="col-lg-5">
									  <select class="select" name="tunj" id="tunj" required onChange="pindah(tunj.value)">
									    <option value="">--Tunjangan--</option>
									    <?php
											$query1=$db->select("hr_m_tunjangan","*");
											foreach($query1 as $sel1){	
			                            ?>
									    <option value="<?=$sel1['id_tunjangan']?>"  <?php if($sel1['id_tunjangan']==$_GET['t']){echo "selected";}?>>
									      <?=$sel1['tunjangan']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
								</div>
                                <?php if($_GET['t']==1 || $_GET['t']==3){?>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Golongan</label>
										<div class="col-lg-4">
									  <select class="select-search" name="id_golongan" id="id_golongan" required>
									    <option value="">--Golongan--</option>
									    <?php
											$query1=$db->select("hr_m_tingkat_golongan","*");
											foreach($query1 as $sel1){	
			                            ?>
									    <option value="<?=$sel1['id_tingkat_gol']?>"  <?php if($sel1['id_tingkat_gol']==$valsub['id_tingkat_gol']){echo "selected";}?>>
									      <?=$sel1['tingkat_golongan']?>
								        </option>
									    <?php } ?>
								      </select>
									</div> 
								</div>
                                <?php }?>
                                <?php if($_GET['t']==5){?>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Cabang</label>
										<div class="col-lg-4">
									  <select class="select-search" name="cabang" id="cabang" >
									    <option value="">--Cabang--</option>
									    <?php
											$query1=$db->select("m_cabang","*");
											foreach($query1 as $sel1){	
			                            ?>
									    <option value="<?=$sel1['id_cabang']?>"  <?php if($sel1['id_cabang']==$valsub['id_cabang']){echo "selected";}?>>
									      <?=$sel1['nama_cabang']?>
								        </option>
									    <?php } ?>
								      </select>
									</div> 
								</div>
                                <?php }?>
                                <?php if($_GET['t']==4 || $_GET['t']==2){?>
                                <div class="form-group">
									<label class="control-label col-lg-4">Pangkat</label>
										<div class="col-lg-4">
									  <select class="select-search" name="pangkat" id="pangkat" >
									    <option value="">--Pangkat--</option>
									    <?php
											$query1=$db->select("hr_m_pangkat","*");
											foreach($query1 as $sel1){	
			                            ?>
									    <option value="<?=$sel1['id_pangkat']?>"  <?php if($sel1['id_pangkat']==$valsub['id_pangkat']){echo "selected";}?>>
									      <?=$sel1['pangkat']?>
								        </option>
									    <?php } ?>
								      </select>
									</div> 
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">St Jabatan</label>
										<div class="col-lg-4">
									  <select class="select-search" name="jabatan" id="jabatan" >
									    <option value="">--Jabatan--</option>
									    <?php
											$query1=$db->select("hr_st_jabatan","*");
											foreach($query1 as $sel1){	
			                            ?>
									    <option value="<?=$sel1['id_st_jabatan']?>"  <?php if($sel1['id_st_jabatan']==$valsub['id_mjabatan']){echo "selected";}?>>
									      <?=$sel1['st_jabatan']?>
								        </option>
									    <?php } ?>
								      </select>
									</div> 
								</div>
                                <?php }?>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nilai</label>
								  <div class="col-lg-5">
									  <input type="text" name="nama" id="nama" class="form-control harga" autocomplete="off" required value="<?php echo $valsub['nominal']?>">
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?php echo $valsub['id_tdtunjangan']?>" required>
								    <input type="hidden" name="kode_dep" id="kode_dep" class="form-control" required value="<?php echo $val['id_tunjangan']?>">
									<input type="hidden" name="slug" id="slug" class="form-control" value="<?=$_GET['slug']?>"  required>
								  </div>
								</div>
                                 <div class="form-group">
                                   <label class="control-label col-lg-4">Tgl Berlaku</label>
								   <div class="col-lg-4">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php if($valsub['tgl_berlaku']==''){
								  	echo date("d-m-Y");
								  }else{
									echo $valsub['tgl_berlaku'];  
								  }?>">
                                  </div>
                               </div>
								</div>
                              <!--  <div class="form-group">
									<label class="control-label col-lg-4">Tanggal Berlaku</label>
										<div class="col-lg-5">
                                        <div class="input-group">
                                        
											<span class="input-group-addon"><i class="icon-calendar22"></i></span>
											<input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php if($valsub['id_dtl']==''){echo date("Y-m-d");}else{echo $valsub['tgl_berlaku'];}?>">
                                            </div>
										</div>
								</div>-->
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                       <button class="btn btn-success" type="button" onClick="window.location='index.php?x=tunjangan'">
										 Batal 
                                        </button>
									</div>
								</div>
                                
					</form>
					</div>	
				</div>					
		</div>
         <div class="col-lg-7">
   			 <form action="index.php?x=tunjangan&slug=<?=$_GET[slug]?>&id=<?=$_GET[id]?>" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master tunjangan</h5>
							<div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Back" onClick="window.location='index.php?x=tunjangan'"></button></li>
							</ul>
                            </div>
					</div>
					 <table id="example5" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr >
                              <th width="15%">Nama Tunjangan</th>
                              <th width="10%">Tgl Berlaku</th>
                              <th width="5%">Nilai</th>
                              <th width="8%">Golongan</th>
                              <th width="12%">Pangkat Jabatan</th>
                              <th width="12%">Cabang</th>
                              <th width="8%">Aksi</th>
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
 $where = array("id_tdtunjangan" => $_POST['id']);
		$db->delete("hr_tunjangan",$where);
		 echo "<script>	window.location='index.php?x=tunjangan&slug=$_GET[slug]'</script>";
 	}
  }
 ?> 
 

    
