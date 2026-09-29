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
						<h5 class="panel-title">Tambah / Edit daerah</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("ex_tarif_oa","*","id='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=expricelist_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Tujuan</label>
								   <div class="col-lg-6">
										<select class="select" name="tujuan" id="tujuan">
                                      		 <option value="">--Tujuan--</option>
											<?php
											$query=$db->select("ex_lokasi_kirim","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id']?>"  <?php if($sel['id']==$val['id_lokasi']){echo "selected";}?>><?=$sel['lokasi_kirim']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                 <div class="form-group">
                                   <label class="control-label col-lg-4">Pelanggan</label>
								   <div class="col-lg-6">
										<select class="select-search" name="cus" id="cus">
                                      		 <option value="">--Pelanggan--</option>
											<?php
											$query=$db->select("ex_customer a join m_supplier b on a.id_supp=b.id_supp","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_supp']?>"  <?php if($sel['id_supp']==$val['id_supp']){echo "selected";}?>><?=$sel['nama_usaha']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tarif OA</label>
									<div class="col-lg-5">
										<input type="text" name="tarifoa" id="tarifoa" class="form-control" autocomplete="off" value="<?=$val['tarif_oa']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Gaji Sopir</label>
									<div class="col-lg-5">
										<input type="text" name="gaji_sopir" id="gaji_sopir" class="form-control" autocomplete="off" value="<?=$val['gaji_sopir']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id']?>"  required>
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Gaji Kernet</label>
									<div class="col-lg-5">
										<input type="text" name="gaji_kernet" id="gaji_kernet" class="form-control" autocomplete="off" value="<?=$val['gaji_kernet']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">UJS</label>
									<div class="col-lg-5">
										<input type="text" name="ujs" id="ujs" class="form-control" autocomplete="off" value="<?=$val['ujs']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">KM</label>
									<div class="col-lg-5">
										<input type="text" name="km" id="km" class="form-control" autocomplete="off" value="<?=$val['km']?>" required>
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Kosongan</label>
									<div class="col-lg-5">
										<input type="text" name="kosongan" id="kosongan" class="form-control" autocomplete="off" value="<?=$val['kosongan']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Premi</label>
									<div class="col-lg-5">
										<input type="text" name="premi" id="premi" class="form-control" autocomplete="off" value="<?=$val['premi']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tgl Berlaku</label>
									<div class="col-lg-5">
										<input type="text" name="tgl_berlaku" id="tgl_berlaku" class="form-control datepicker" autocomplete="off" value="<?=$val['tgl_berlaku']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=daerah'">
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
		<form action="index.php?x=expricelist" id="form_index" method="post">
   		  <div class="panel panel-flat scrolls">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">Tujuan</th>
                                <th width="25%">Pelanggan</th>
                                <th width="15%">OA</th>
                                <th width="15%">Gaji Supir</th>
                             	<th width="15%">Gaji Kernet</th>
                             	<th width="12%">UJS</th>
                                <th width="12%">KM</th>
                                <th width="12%">Kosongan</th>
                                <th width="12%">Premi</th>
                                <th width="12%">Tgl</th>
                                <th width="12%">Status</th>
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
if($_POST[aksi]=='hapus'){
	$where = array("id" => $_POST['id']);
	$db->delete("ex_tarif_oa",$where);
	echo "<script>window.location='index.php?x=expricelist'</script>";
}
?>