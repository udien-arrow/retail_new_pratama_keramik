  <style>
  .scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap
}
  </style> 
		<div class="col-lg-4">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_kendaraan","*","id='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=kendaraan_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">NIA</label>
									<div class="col-lg-8">
									  <select class="select-search" name="nia" id="nia" onChange="pindahData(nia.value)" required>
									    <option value="">-- NIA --</option>
									    <?php
											$query=$db->select("am_asset","*","ID_AMODEL='4' and ID_NIA not in(select nia from m_kendaraan)");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['ID_NIA']?>" <?php if($_GET['nia']==$sel['ID_NIA']){echo "selected";} ?>>
									      <?=$sel['ID_NIA']." - ".$sel['ASSET_NAME']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Cabang</label>
									<div class="col-lg-7">
									  <select class="select" name="id_cabang" id="id_cabang" required>
									    <option value="">--Cabang--</option>
									    <?php
											$query=$db->select("m_cabang","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_cabang']?>"  <?php if($sel['id_cabang']==$val['id_cabang']){echo "selected";}?>>
									      <?=$sel['nama_cabang']?>
								        </option>
									    <?php } ?>
								    </select>
								
									  <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id']?>"  required>
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Jenis</label>
									<div class="col-lg-7">
									  <select class="select" name="id_jenis" id="id_jenis" required>
									    <option value="">--Jenis--</option>
									    <?php
											$query=$db->select("m_jenis_kendaraan","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_jenis']?>"  <?php if($sel['id_jenis']==$val['id_jenis']){echo "selected";}?>>
									      <?=$sel['nama']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Supir</label>
									<div class="col-lg-7">
									  <select class="select" name="id_supir" id="id_supir" required>
									    <option value="">--Nama Supir--</option>
									    <?php
											$query=$db->select("m_pegawai","*","id_jabatan='8'");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_pegawai']?>"  <?php if($sel['id_pegawai']==$val['id_pegawai']){echo "selected";}?>>
									      <?=$sel['nama_pegawai']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Jenis Angkutan</label>
									<div class="col-lg-7">
									  <select class="select" name="jenis_angkutan" id="jenis_angkutan" required>
									    <option value="">--Jenis Angkutan--</option>
									   <option value="1"  <?php if($val['jenis_angkutan']=='1'){echo "selected";}?>>
									      Expeditur
								        </option>
                                        <option value="2"  <?php if($val['jenis_angkutan']=='2'){echo "selected";}?>>
									      Tidak
								        </option>
								    </select>
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">NIK</label>
									<div class="col-lg-5">
										<input type="text" name="nik" id="nik" class="form-control" autocomplete="off" value="<?=$val['nik']?>" >
								      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nopol</label>
									<div class="col-lg-5">
                                    <?php 
									$cek=$db->select("am_asset a JOIN am_asset_dtl b on a.ID_AMASSET=b.id_asset join am_katagori_dtl c on b.id_kategori_dtl=c.id_dtl","c.id_dtl,c.keterangan,b.nilai","a.ID_NIA='$_GET[nia]' and c.id_dtl='7'");
		foreach($cek as $kas){}
									?>
										<input type="text" name="nopol" id="nopol" class="form-control" autocomplete="off" value="<?=$kas['nilai']?>" readonly>
								      
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">No Mesin</label>
									<div class="col-lg-6">
                                    <?php 
									$cek=$db->select("am_asset a JOIN am_asset_dtl b on a.ID_AMASSET=b.id_asset join am_katagori_dtl c on b.id_kategori_dtl=c.id_dtl","c.id_dtl,c.keterangan,b.nilai","a.ID_NIA='$_GET[nia]' and c.id_dtl='5'");
		foreach($cek as $kas){}
									?>
										<input type="text" name="nomesin" id="nomesin" class="form-control" autocomplete="off" value="<?=$kas['nilai']?>" readonly>
								      
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Tahun Buat</label>
									<div class="col-lg-5">
                                    <?php 
									$cek=$db->select("am_asset a JOIN am_asset_dtl b on a.ID_AMASSET=b.id_asset join am_katagori_dtl c on b.id_kategori_dtl=c.id_dtl","c.id_dtl,c.keterangan,b.nilai","a.ID_NIA='$_GET[nia]' and c.id_dtl='8'");
		foreach($cek as $kas){}
									?>
										<input type="text" name="tahunbuat" id="tahunbuat" class="form-control" autocomplete="off" value="<?=$kas['nilai']?>" readonly>
								      
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">NOSASIS</label>
									<div class="col-lg-7">
                                    <?php 
									$cek=$db->select("am_asset a JOIN am_asset_dtl b on a.ID_AMASSET=b.id_asset join am_katagori_dtl c on b.id_kategori_dtl=c.id_dtl","c.id_dtl,c.keterangan,b.nilai","a.ID_NIA='$_GET[nia]' and c.id_dtl='6'");
		foreach($cek as $kas){}
									?>
										<input type="text" name="nosasis" id="nosasis" class="form-control" autocomplete="off" value="<?=$kas['nilai']?>" readonly>
								      
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">STNK</label>
									<div class="col-lg-5">
                                    <?php 
									$cek=$db->select("am_asset a JOIN am_asset_dtl b on a.ID_AMASSET=b.id_asset join am_katagori_dtl c on b.id_kategori_dtl=c.id_dtl","c.id_dtl,c.keterangan,b.nilai","a.ID_NIA='$_GET[nia]' and c.id_dtl='9'");
		foreach($cek as $kas){}
									?>
										<input type="text" name="stnk" id="stnk" class="form-control" autocomplete="off" value="<?=$kas['nilai']?>" readonly>
								      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">BBM /Km</label>
									<div class="col-lg-5">
										<input type="text" name="km" id="km" class="form-control" autocomplete="off" value="<?=$val['km']?>" >
								      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Muatan</label>
									<div class="col-lg-5">
										<input type="text" name="muatan" id="muatan" class="form-control" autocomplete="off" value="<?=$val['muatan']?>" >
								      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=kendaraan'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>		
                </div>			
		</div>
        <div class="col-lg-8">
		<form action="index.php?x=kendaraan" id="form_index" method="post">
   		  <div class="panel panel-flat scrolls">
					<div class="panel-heading">
						<h5 class="panel-title">Master Kendaraan</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="1%">Nia</th>
                              	<th width="10%">Nopol</th>
                                <th width="10%">Nik</th>
                                <th width="10%">Jenis</th>
                                <th width="5%">Tahun </th>
                                <th width="5%">No Mesin</th>
                                <th width="10%">Nosasis</th>
                                <th width="10%">STNK</th>
                                <th width="10%">Cabang</th>
                                <th width="10%">Nama Supir</th>
                                <th width="10%">Jenis Angkutan</th>
                                <th width="7%">Bbm /Km</th>
                                <th width="7%">Muatan</th>
                                <th width="7%">Aksi</th>
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
	$where = array("id" => $_POST['id']);
	$db->delete("m_kendaraan",$where);
	echo "<script>window.location='index.php?x=kendaraan'</script>";
}
?>