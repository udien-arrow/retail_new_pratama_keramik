<?php if($_GET[slug]==''){?>   
    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Valuta</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_valuta","*","id_valuta='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=valuta_s" id="formku" name="formku" method="post">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Valuta</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_valuta']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_valuta']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=valuta'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>					
		</div>
        <div class="col-lg-7">
   		<form action="index.php?x=valuta" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Valuta</h5>
					</div>                  
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                               <th width="13%">Kode </th>
                              <th width="50%">Nama Valuta</th>
                              <th width="25%">Detil Kurs</th>
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
		$where = array("id_valuta" => $_POST['id']);
		$db->delete("m_valuta",$where);
		echo "<script>window.location='index.php?x=valuta'</script>";
		}
  }
  if($_GET[slug]==1){
 ?>   
   

		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Valuta</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_valuta","*","id_valuta='$_GET[id]'");
					foreach($sat as $val){}
					
					$sub=$db->select("m_valuta_dtl","*","id_dtl='$_POST[id]'");
					foreach($sub as $valsub){}
					?>
					<form class="form-horizontal" action="index.php?x=valuta_s" id="formku" method="post">
							<fieldset class="content-group">
								
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Valuta </label>
									<div class="col-lg-5">
									  <input type="text" name="nama_valuta" id="nama_valuta" class="form-control" autocomplete="off" required value="<?php echo $val['nama_valuta']?>" readonly>
							      </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Kurs</label>
								  <div class="col-lg-5">
									  <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required value="<?php echo $valsub['kurs']?>">
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?php echo $valsub['id_dtl']?>" required>
								    <input type="hidden" name="kode_dep" id="kode_dep" class="form-control" required value="<?php echo $val['id_valuta']?>">
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
                                       <button class="btn btn-success" type="button" onClick="window.location='index.php?x=valuta'">
										 Batal 
                                        </button>
									</div>
								</div>
                                
					</form>
					</div>	
				</div>					
		</div>
         <div class="col-lg-7">
   			 <form action="index.php?x=valuta&slug=<?=$_GET[slug]?>&id=<?=$_GET[id]?>" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Valuta</h5>
							<div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Back" onClick="window.location='index.php?x=valuta'"></button></li>
							</ul>
                            </div>
					</div>
					 <table id="example5" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr >
                              <th width="13%">Kode </th>
                              <th width="50%">Nama Valuta</th>
                              <th width="50%">Kurs</th>
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
		$db->delete("m_valuta_dtl",$where);
		 echo "<script>	window.location='index.php?x=valuta&slug=$_GET[slug]&id=$_GET[id]'</script>";
 	}
  }
 ?> 
 

    
