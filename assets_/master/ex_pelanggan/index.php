<style>
.scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap;}
</style>
        <div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Pelanggan Expediture</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("ex_customer","*","id_ex='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=expelanggan_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Supplier</label>
								   <div class="col-lg-6">
										<select class="select-search" name="id_cus" id="id_cus">
                                      		 <option value="">--Supplier--</option>
											<?php
											$query=$db->select("m_supplier","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_supp']?>"  <?php if($sel['id_supp']==$val['id_supp']){echo "selected";}?>><?=$sel['nama_usaha']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Limit PKB</label>
								   <div class="col-lg-6">
										<input type="text" name="pkb" id="pkb" class="form-control" value="<?=$val['limit_pkb']?>"  required>
                                        
								   </div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Limit PKC</label>
								   <div class="col-lg-6">
										<input type="text" name="pkc" id="pkc" class="form-control" value="<?=$val['limit_pkc']?>"  required>
                                        
								   </div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Tempo Normal (Hari)</label>
								   <div class="col-lg-6">
										<input type="text" name="tempo_n" id="tempo_n" class="form-control" value="<?=$val['tempo_normal']?>"  required>
                                        
								   </div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Tempo Tambahan (Hari)</label>
								   <div class="col-lg-6">
										<input type="text" name="tempo_t" id="tempo_t" class="form-control" value="<?=$val['tempo_tambahan']?>"  required>
                                        
								   </div>
								</div>
                                 <div class="form-group">
                                   <label class="control-label col-lg-4">Keterangan</label>
								   <div class="col-lg-6">
										<textarea rows="2" cols="50" name="keterangan" class="form-control"><?=$val['keterangan']?></textarea>
                                        <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_ex']?>"  required>
								   </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=expelanggan'">
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
		<form action="index.php?x=expelanggan" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">Supplier</th>
                                <th width="13%">Alamat</th>
                                <th width="13%">Limit PKB</th>
                                <th width="13%">Limit PKC</th>
                                <th width="13%">Limit Plafon</th>
                                <th width="13%">Tempo Normal</th>
                                <th width="13%">Tempo Tambahan</th>
                                <th width="13%">Tempo Pembayaran</th>
                                <th width="13%">Keterangan</th>
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
	$where = array("id_ex" => $_POST['id']);
	$db->delete("ex_customer",$where);
	echo "<script>window.location='index.php?x=expelanggan'</script>";
}
?>