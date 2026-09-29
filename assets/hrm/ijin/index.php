    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
	</style>
<?php
if($_POST[simpan]){
	include("assets/hrm/ijin/simpan2.php");	
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("hr_ijin_tmp",$where);
	echo "<script>window.location='index.php?x=ijin&id=$_POST[idp]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("hr_ijin_tmp",$where);
	echo "<script>window.location='index.php?x=ijin&id=$_POST[idp]'</script>";
}else{
?>	
	
    <div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah 
					    <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Laporan ijin Pegawai" onClick="window.location='index.php?x=ijin_v'"></button></li>
							</ul>
                            </div>
					</div>
                    
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                   
					<form class="form-horizontal" action="index.php?x=ijin_s" id="formku2" name="formku2" method="post">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Pegawai</label>
									<div class="col-lg-5">
										<select class="select-search" name="pegawai" id="pegawai" required>
									    <option value="">--Pegawai--</option>
                                        <option value="all">--Semua Pegawai--</option>
									    <?php
											$query1=$db->select("m_pegawai","*","id_aktif='1' or id_aktif='2'");
											foreach($query1 as $sel1){	
			                            ?>
									    <option value="<?=$sel1['id_pegawai']?>"  <?php if($sel1['id_pegawai']==$_GET['id']){echo "selected";}?>>
									      <?=$sel1['nama_pegawai']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
								</div>
                                 <div class="form-group">
								  <label class="control-label col-lg-4">Jenis</label>
								   <div class="col-lg-5">
									 <select class="select-search" name="jenis" id="jenis" required onChange="pindah2()">
									    <option value="">--Jenis--</option>
									    <?php
											$query1=$db->select("hr_jenis_absen","*","id_jenis!=1");
											foreach($query1 as $sel1){	
			                            ?>
									    <option value="<?=$sel1['kode']?>" >
									      <?=$sel1['nama_jenis']?>
								        </option>
									    <?php } ?>
								    </select>
								   </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tgl </label>
								   <div class="col-lg-2">
										<input type="text" name="tgl" id="tgl" class="form-control datepicker" autocomplete="off" required>
									</div>
                                  <div class="col-lg-2" id="tglrc" style="display:none">
										<input type="text" name="tglr" id="tglr" class="form-control datepicker" autocomplete="off" >
									</div>
								</div>
                               
                      <div class="form-group">
									<label class="control-label col-lg-4">Keterangan</label>
								   <div class="col-lg-6">
										<textarea  name="ket" id="ket" class="form-control" autocomplete="off" ></textarea>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=ijin'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>					
		</div>			
	 <div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang 
						  <?=$title?>
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body">
                    	<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=ijin" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			
</div>
<?php }?>
