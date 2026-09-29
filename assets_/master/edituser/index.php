<div class="col-lg-7">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
                    <div class="panel-body">
					<?php
                    $sat=$db->select("r_user_login a LEFT JOIN m_pegawai b on a.ID_PEGAWAI=b.id_pegawai","a.USERNAME,a.PASSWORD,a.ID,b.nama_pegawai","a.ID=$_SESSION[ID_LOGIN]");
					foreach($sat as $val){}
					?>
                    <form class="form-horizontal" action="index.php?x=edituser_s" method="post" id="formID" type="post">
                    <div class="form-group">
									<label class="control-label col-lg-4">Username</label>
									<div class="col-lg-8">
										<input type="text" name="username" id="username" class="form-control" autocomplete="off" value="<?=$val['USERNAME']?>" readonly>
                                        <input type="hidden" name="id" id="id" class="form-control" autocomplete="off" value="<?=$_SESSION['ID_LOGIN']?>" readonly>
								     	</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Pegawai</label>
									<div class="col-lg-8">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$_SESSION ['NAMA_PEG']?>" readonly>
								      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Password</label>
									<div class="col-lg-8">
										<input type="password" name="password1" id="password1" class="form-control" autocomplete="off" required>
								      
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Verifikasi Password</label>
									<div class="col-lg-8">
										<input type="password" name="password2" id="password2" class="form-control" autocomplete="off"required>
								      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-8">
										<button class="btn btn-primary" type="submit" name="daftar" id="daftar">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=edituser'">
										 Batal 
                                        </button>
									</div>
								</div>
                   </div>
                    </div>
                    </div>
                    </div>
                    	
		</div>
        
       
		</div>
<?php
if($_POST[aksi]=='hapus'){
	$where = array("id_cabang" => $_POST['id']);
	$db->delete("m_cabang",$where);
	echo "<script>window.location='index.php?x=cabang'</script>";
}
?>