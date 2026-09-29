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
                    $sat=$db->select("m_cutomer_deposit","*","id_deposit='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=deposit_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Customer</label>
									<div class="col-lg-7">
									  <select class="select-search" name="id_cus" id="id_cus" required>
									    <option value="">--Customer--</option>
									    <?php
											$query=$db->select("m_customer a join m_cabang b on a.id_cabang=b.id_cabang","*","a.id_cabang='$_SESSION[ID_CABANG]' and head=''");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_cus'].'_'.$sel['kode_cus']?>">
									      <?=$sel['kode_cabang'].'-'.$sel['kode_cus'].' - '.$sel['nama_usaha']?>
								        </option>
									    <?php } ?>
								    </select>
								
									  <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id']?>"  required>
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Tgl Deposit</label>
									<div class="col-lg-5">
										<input type="text" name="tgl" id="tgl" class="form-control datepicker" autocomplete="off" value="<?=$val['tgl']?>" required>
								      
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Nilai Deposit</label>
									<div class="col-lg-5">
										<input type="text" name="nominal" id="nominal" class="form-control harga" autocomplete="off" value="<?=$val['nominal']?>" required>
								      
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Keterangan</label>
									<div class="col-lg-8">
										<input type="text" name="ket" id="ket" class="form-control" autocomplete="off" value="<?=$val['ket']?>" >
								      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Kas/Bank</label>
								  <div class="col-lg-7">
								  <select name="pemb" id="pemb" class="select-search">
                                  <?php 
								 	$cc=$db->select("ak_kasbank","account,description","cabang='$_SESSION[ID_CABANG]'");  
								  foreach($cc as $dtt){
									?>
                                  <option value="<?=$dtt['account']?>"><?=$dtt['description']?></option>
                                  <?php 
									}
									?>
                                </select>
									</div>
								</div>
                              
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=deposit'">
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
		<form action="index.php?x=deposit" id="form_index" method="post">
   		  <div class="panel panel-flat scrolls">
					<div class="panel-heading">
						<h5 class="panel-title">Master deposit</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="10%">No Deposit Pelanggan</th>
                              	<th width="20%">Pelanggan</th>
                                <th width="10%">Nominal</th>
                                <th width="5%">Detil</th>
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
	$db->delete("m_cutomer_deposit",$where);
	echo "<script>window.location='index.php?x=deposit'</script>";
}
?>