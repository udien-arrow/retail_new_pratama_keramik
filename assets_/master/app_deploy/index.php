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
    <div class="col-lg-5">
   		<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("am_deployed","*","ID_DEPLOY='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=deployin_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group"><label class="control-label col-lg-4">Lokasi</label>
                                  <div class="col-lg-6">
										<select class="select" name="mod" id="mod" readonly="readonly">
											<?php
											$query=$db->select("am_lokasi","*","ID_ALOKASI='$val[ID_ALOKASI]'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['ID_ALOKASI']?>"  <?php if($sel['ID_ALOKASI']==$val['ID_ALOKASI']){echo "selected";}?>><?=$sel['NAMA_ALOKASI']?></option> <?php } ?>
									</select>
                                    
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['ID_DEPLOY']?>"  required>
								   </div>
								</div>
                             
                              
                      <div class="form-group"><label class="control-label col-lg-4">Nama Asset</label>
                                  <div class="col-lg-6">
										<select class="select" name="na" id="na" readonly="readonly">
                                      		 
											<?php
											$query=$db->select("am_asset","*","ID_AMASSET='$val[ID_AMASSET]'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['ID_AMASSET']?>"  <?php if($sel['ID_AMASSET']==$val['ID_AMASSET']){echo "selected";}?>><?=$sel['ASSET_NAME']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Tanggal Request</label>
									<div class="col-lg-5">
									  <input type="text" name="date" id="date" class="form-control datepicker" autocomplete="off" value="<?=$val['DEPLOY_DATE']?>" required readonly>
								      
									</div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Keterangan Permintaan</label>
									<div class="col-lg-5">
									  <input type="text" name="ket" id="ket" class="form-control" autocomplete="off" value="<?=$val['DEPLOY_KETERANGAN']?>" required readonly>
								      
									</div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Tgl Checkin</label>
									<div class="col-lg-5">
									  <input type="text" name="tgldep" id="tgldep" class="form-control datepicker" autocomplete="off" value="" required>
								      
									</div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Catatan</label>
									<div class="col-lg-5">
									  <input type="text" name="catdep" id="catdep" class="form-control" autocomplete="off" value="" required>
								      
									</div>
								</div>
                               
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" <?php if(empty($_POST[id])){echo"disabled";}?>>
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=asset'">
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
	<form action="index.php?x=deployin" id="form_index" method="post">
    <div class="panel panel-flat">
	  <div class="panel-heading">
						<h5 class="panel-title">View Penggunaan Aset</h5>
			  </div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                              	<td width="15%">Nama Lokasi</td>
                                <td width="20%">Nama Asset</td>
                                <td width="10%">Tanggal Request</td>
                                <td width="10%">Keterangan Request</td>
                                <td width="10%">Nama Pegawai </td>
                                <td width="5%">#</td>
                            </tr>
                          
                        </thead>
                    </table>   
                     <input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
        </div></form>            
    </div>
    <?php
if($_POST['jenis']=='setuju'){
	
					
	
	/* echo "<script>window.location='index.php?x=deployed'</script>"; */
}
if($_POST['jenis']=='tolak'){
	$data = array("status" => 2);
	$db->update("am_reqdeploy",$data,"ID_REQDEPLOY='$_POST[id]'");
	//=====approve============
	$masukin=$db->select("am_reqdeploy","*","ID_REQDEPLOY='$_POST[id]'");
	foreach($masukin as $masukinyuk)
	$max=$db->select("am_undeployed","max(ID_UNDEPLOY)as id");
	foreach($max as $val){}
		$id=$val['id']+1;
			$tgl=date("Y-m-d H:i:s");
	$data = array( 
						'ID_UNDEPLOY' => $id, 
						'ID_ALOKASI' => $masukinyuk['ID_ALOKASI'],
						'ID_AMASSET' => $masukinyuk['ID_AMASSET'],
						'UNDEPLOY_DATE' => $tgl,
						'UNDEPLOY_KETERANGAN' => $masukinyuk['REQDEPLOY_KETERANGAN'],
						'UNDEPLOY_PEGAWAI' => $masukinyuk['REQDEPLOY_PEGAWAI'],
						);
	$exec= $db->insert("am_undeployed", $data);	
	echo "<script>window.location='index.php?x=deployin'</script>";
}
?>
