    <!-- Theme JS files -->

		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah </h5>
                        </div>
                    <div class="dataTables_wrapper"></div>
					<div class="table-responsive pre-scrollable">
                    <div class="panel-body">
                    <?php
                    $sat=$db->select("m_satuan","*","id_satuan='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=upahhar_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                 <div class="form-group">
									<label  class="control-label col-lg-3">Cabang</label>
									<div class="col-lg-5">
                                    <select name="cabang" id="cabang" class="select">
										<option value="">---Pilih Cabang---</option>
										<?php
											$query=$db->select("m_cabang","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_cabang']?>" <?php if($sel['id_cabang']==$val['id_cabang']){echo "selected";}?>><?=$sel['nama_cabang']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-3">Nominal Bulan</label>
								  <div class="col-lg-5">
									<input type="text" name="nominal_bulan" id="nominal_bulan" class="form-control" autocomplete="off" value="0" required >
                                    <input type="hidden" name="kode" id="kode"  class="form-control" value="<?=$id?>"  required>
                                  </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-3">Nominal Hari</label>
									
                                  <div class="col-lg-3">
									<input type="text" name="nominal_hari" id="nominal_hari" class="form-control" autocomplete="off" value="0"  >
                                  </div>
								</div>
                              
                                 <div class="form-group">
									<label class="control-label col-lg-3">Nominal Lembur</label>
									
                                  <div class="col-lg-3">
									<input type="text" name="nominal_lembur" id="nominal_lembur" class="form-control" autocomplete="off" value="0"  >
                                   </div>
								</div>
                                 <hr> 
                                 <?php  
								 
								 $kon=$db->select("m_jabatan","*","id_divisi='2'");
								 $jum=count($kon);
								 ?>
                                 <table width="100%" border="1" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td colspan="3" align="left"><b>&nbsp;Jabatan</b></td>
                                      </tr>
                                      <tr>
                                        <td width="14%" align="left">&nbsp;<input type="checkbox"  value="<?=$d['nama_gudang']?>" onclick="checkedAll(<?=$jum?>)" id="call"></td>
                                        <td width="86%" align="center"><strong>Nama Jabatan</strong></td>
                                      </tr>
                                      <?php
                                      $no=1;
                                      foreach($kon as $d){  
									  ?>
                                      <tr>
                                        <td>&nbsp;<input type="checkbox" <?php if($valcek[id_barang]!=''){echo "checked";}?> name="id_jabatan[<?=$no?>]" id="split<?=$no?>" value="<?=$d['id_jabatan']?>"></td>
                                        <td width="86%" align="left">&nbsp;<?=$d['nama_jabatan']?></td>
                                      </tr>
                                      <?php
									  $no++;
									  $valcek[id_barang]='';
									  $valcek['min']='';
									  $valcek['max']='';
									   } ?>
                                    </table>
                                <br>
                                <div class="form-group">
									<label class="control-label col-lg-2"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=barang'">
										 Batal 
                                        </button>
									</div>
								</div>  
                                 
					</form>
					</div>	
				</div>
                </div>					
		</div>
       
        <div class="col-lg-6">
		<form action="index.php?x=barang&cd=k2" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Upah Harian</h5>
                        </div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="10%">Cabang </th>
                              	<th width="20%">Jabatan</th>
                                <th width="10%"> Nominal Bulan</th>
                                <th width="10%">Nominal Hari</th>
                                <th width="10%">Nominal Lembur</th>
                            </tr>
                        </thead>
                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
			</form>
		</div>
       <div class="col-lg-1">
        
        </div>

<?php
if($_POST[aksi]=='hapus'){
	$data = array("status" => 0);
	$db->update("m_barang",$data,"id_barang='$_POST[id]'");
	echo "<script>window.location='index.php?x=barang'</script>";
}
?>