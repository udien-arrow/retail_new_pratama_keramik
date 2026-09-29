    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("hr_m_nilaidasar","*","id_nilaidasar='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=nilaidasar_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nilai Dasar</label>
									
<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nilaidasar']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_nilaidasar']?>"  required>
									</div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Tingkat Golongan</label>
								   <div class="col-lg-6">
										<select class="select" name="gol" id="gol">
                                      		 <option value="">-- Golongan --</option>
											<?php
											$query=$db->select("hr_m_tingkat_golongan","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_tingkat_gol']?>"  <?php if($sel['id_tingkat_gol']==$val['id_tingkat_gol']){echo "selected";}?>><?=$sel['tingkat_golongan']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Tgl Berlaku</label>
								   <div class="col-lg-4">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php 
								  if($val['tgl_berlaku']==''){
								  	echo date("d-m-Y");
								  }else{
									echo $val['tgl_berlaku'];  
								  }
								  ?>">
                                  </div>
                               </div>
								</div>
                             
                              
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=nilaidasar'">
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
		<form action="index.php?x=nilaidasar" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">Kode </th>
                              <th width="25%">Nilai Dasar</th>
                              <th width="25%">Tingkat Golongan</th>
                              <th width="25%">Tgl Berlaku</th>
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
	$where = array("id_nilaidasar" => $_POST['id']);
	$db->delete("hr_m_nilaidasar",$where);
	echo "<script>window.location='index.php?x=nilaidasar'</script>";
}
?>