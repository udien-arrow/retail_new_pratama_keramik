<?php if($_GET[slug]==''){?>   
    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit hargabbm</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_bmm","*","id_bbm='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=hargabbm_s" id="formku" name="formku" method="post">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Cabang</label>
									<div class="col-lg-6">
									  <select class="select" name="cabang" id="cabang">
									    <option value="">--Cabang--</option>
									    <?php
											$query=$db->select("m_cabang","*","id_cabang not in (select id_cabang from m_bbm)");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_cabang']?>"  <?php if($sel['id_cabang']==$val['id_cabang']){echo "selected";}?>>
									      <?=$sel['nama_cabang']?>
								        </option>
									    <?php } ?>
								    </select>
								
									  <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_bbm']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Keterangan</label>
									<div class="col-lg-5">
										<input type="text" name="ket" id="ket" class="form-control" autocomplete="off" value="<?=$val['keterangan']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=hargabbm'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>					
		</div>
        <div class="col-lg-7">
   		<form action="index.php?x=hargabbm" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Harga BBM</h5>
					</div>                  
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                               <th width="13%">Kode </th>
                              <th width="50%">Nama Cabang</th>
                              <th width="25%">Keterangan</th>
                              <th width="25%">Detil Harga</th>
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
		$where = array("id_bbm" => $_POST['id']);
		$db->delete("m_bmm",$where);
		echo "<script>window.location='index.php?x=hargabbm'</script>";
		}
  }
  if($_GET[slug]==1){
 ?>   
   

		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Harga</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                    <?php
                    $sat=$db->select("v_bbm","*","id_bbm='$_GET[id]'");
					foreach($sat as $val){}
					
					$sub=$db->select("m_bmm_dtl","*","id_dtl='$_POST[id]'");
					foreach($sub as $valsub){}
					?>
					<form class="form-horizontal" action="index.php?x=hargabbm_s" id="formku" method="post">
							<fieldset class="content-group">
								
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Cabang </label>
									<div class="col-lg-5">
									  <input type="text" name="nama_cabang" id="nama_cabang" class="form-control" autocomplete="off" required value="<?php echo $val['nama_cabang']?>" readonly>
							      </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Harga</label>
								  <div class="col-lg-5">
									  <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required value="<?php echo $valsub['harga']?>">
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?php echo $valsub['id_dtl']?>" required>
								    <input type="hidden" name="kode_dep" id="kode_dep" class="form-control" required value="<?php echo $val['id_bbm']?>">
									<input type="hidden" name="slug" id="slug" class="form-control" value="<?=$_GET['slug']?>"  required>
								  </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tanggal Berlaku</label>
										<div class="col-lg-5">
                                        <div class="input-group">
                                        
											<span class="input-group-addon"><i class="icon-calendar22"></i></span>
											<input type="text" class="form-control daterange-single" name="tgl" id="tgl" value="<?php echo date("Y-m-d")?>">
                                            </div>
										</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                       <button class="btn btn-success" type="button" onClick="window.location='index.php?x=hargabbm'">
										 Batal 
                                        </button>
									</div>
								</div>
                                
					</form>
					</div>	
				</div>					
		</div>
         <div class="col-lg-7">
   			 <form action="index.php?x=hargabbm&slug=<?=$_GET[slug]?>&id=<?=$_GET[id]?>" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master hargabbm</h5>
							<div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Back" onClick="window.location='index.php?x=hargabbm'"></button></li>
							</ul>
                            </div>
					</div>
					 <table id="example5" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr >
                              <th width="13%">Kode </th>
                              <th width="50%">Harga</th>
                              <th width="50%">Tgl Berlaku</th>
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
 $where = array("id_dtl" => $_POST['id']);
		$db->delete("m_bmm_dtl",$where);
		 echo "<script>	window.location='index.php?x=hargabbm&slug=$_GET[slug]&id=$_GET[id]'</script>";
 	}
  }
 ?> 
 

    
