		<div class="col-lg-4">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                     <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
					if($_POST[id]!=''){
                    $sat=$db->select("m_gudang","*","id_gudang='$_POST[id]'");
					foreach($sat as $val){}
					
					}
					?>
					<form class="form-horizontal" action="index.php?x=gudang_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Wilayah</label>
								   <div class="col-lg-6">
									 <select class="select" name="wilayah" id="cabang">
                                      		 <option value="">--Wilayah--</option>
											<?php
											$query=$db->select("m_wilayah","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_wilayah']?>"  <?php if($sel['id_wilayah']==$val['id_wilayah']){echo "selected";}?>><?=$sel['nama_wilayah']?></option> <?php } ?>
									</select>
									
								  </div>
								</div>
                                 <div class="form-group">
                                   <label class="control-label col-lg-4">Cabang</label>
								   <div class="col-lg-6">
										<select class="select" name="cabang" id="cabang">
                                      		 <option value="">--Cabang--</option>
											<?php
											$query=$db->select("m_cabang","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_cabang']?>"  <?php if($sel['id_cabang']==$val['id_cabang']){echo "selected";}?>><?=$sel['nama_cabang']?></option> <?php } ?>
									</select>
								     <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_gudang']?>" readonly >
									 <input type="hidden" name="jenis" id="jenis" class="form-control" value="tambah" readonly >
								   </div>
								</div>
                               
                                <div class="form-group">
                                <label class="control-label col-lg-4">Nama Gudang</label>
									<div class="col-lg-7">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_gudang']?>" >
									</div>
								</div>
                                <div class="form-group">
                                <label class="control-label col-lg-4">Alamat</label>
									<div class="col-lg-7">
										<input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" value="<?=$val['alamat']?>">
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Telp</label>
									<div class="col-lg-5">
										<input type="text" name="telp" id="telp" class="form-control" autocomplete="off" value="<?=$val['telp']?>" >
									</div>
                      </div>
                                    <div class="form-group">
									<label class="control-label col-lg-4">Email</label>
									<div class="col-lg-6">
										<input type="text" name="email" id="email" class="form-control" autocomplete="off" value="<?=$val['email']?>" >
									</div>
                                    </div>
                               
                               
                      <div class="form-group">
									<label class="control-label col-lg-4">Fax</label>
									<div class="col-lg-4">
                                    <input type="text" name="fax" id="fax" class="form-control" autocomplete="off" value="<?=$val['fax']?>" >
									</div>
                                </div>
                                <table bordercolor="#E9E9E9" width="100%" border="1" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td colspan="3" align="left"><b>&nbsp;Ship to</b></td>
                                      </tr>
                                      <tr>
                                        <td width="10%" align="center"><strong>Shipto Code</strong></td>
                                        <td width="10%" align="center"><strong>Shipto Name</strong></td>
                                      </tr>
                                      <?php
                                      $i=1;
                                      for($i=1;$i<=5;$i++){
										  $dt=$db->select("m_gudang_shipto","*","id_gudang='$_POST[id]' and urut='$i'");
									  	  foreach($dt as $valdt){}
									  ?>
                                      <tr>
                                        <td width="10%" align="center">
                                        <input type="hidden" id="id_dtl" name="id_dtl[<?=$i?>]" value="<?=$valdt['id']?>">
                                         &nbsp;<input type="text" name="code[<?=$i?>]" id="code" size="20" value="<?=$valdt['shipto_code']?>"></td>
                                        <td width="10%" align="center">&nbsp;<input type="text" name="name[<?=$i?>]" id="name" size="20" value="<?=$valdt['shipto_name']?>"></td>
                                      </tr>
                                      <?php
									  $no++;
									  $valdt['shipto_code']="";
 	 								  $valdt['shipto_name']="";
									  $valdt['id']="";  
									  } 
									 ?>
                                    </table><br> 
                               
                                 
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-6">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=gudang'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
                    </div>
				</div>					
		</div>
        
<?php if($_GET[id]==''){?>        
<div class="col-lg-8">
		<form action="index.php?x=gudang" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Data Gudang</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                           	   <th width="5%">Id </th>
                               <th width="40%">Nama Gudang</th>
                               <th width="20%">Nama Cabang</th>
                               <th width="10%">Telp</th>
                                <th width="10%">Detil</th>
                               <th width="10%">Status</th>
                               <th width="10%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="jenis" id="jenis4"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
         		</div>
			</form>
		</div>
<?php }?>
<?php if($_GET[id]!='' && $_GET[in]==''){?>        
<div class="col-lg-8">
		<form action="index.php?x=gudang_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Detil Gudang <?php foreach($db->select("m_gudang","*","id_gudang='$_GET[id]'") as $val){echo $val['nama_gudang'];}?></h5>
                         <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Master Gudang" onClick="window.location='index.php?x=gudang'"></button></li>
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Master Barang" onClick="window.location='index.php?x=gudang&id=<?=$_GET['id']?>&in=tambah'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example5" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                           	   <th width="5%">Id </th>
                               <th width="40%">Nama Barang</th>
                               <th width="20%">Satuan</th>
                               <th width="10%">Min</th>
                               <th width="10%">Max</th>
                               <th width="10%">Status</th>
                               <th width="5%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="jenis" id="jenis3"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
                    <input type="hidden" name="id_gudang" id="id_gudang"  value="<?=$_GET[id]?>"  required>
   		  </div>
			</form>
		</div>
<?php }?>
<?php if($_GET[id]!='' && $_GET[in]!=''){?>        
<div class="col-lg-8">
		<form action="index.php?x=gudang_s" id="form_index" name="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Barang <?php foreach($db->select("m_gudang","*","id_gudang='$_GET[id]'") as $val){echo $val['nama_gudang'];}?></h5>
                         <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Master Gudang" onClick="window.location='index.php?x=gudang'"></button></li>
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Back" onClick="window.location='index.php?x=gudang&id=<?=$_GET['id']?>'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example6" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                           	   <th width="5%">Id </th>
                               <th width="40%">Nama Barang</th>
                               <th width="20%">Satuan</th>
                               <th width="10%">Min</th>
                               <th width="10%">Max</th>
                               <th width="10%">Tipe</th>
                               <th width="10%"><a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                        </thead>

                    </table>
		   			
                    <input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id_gudang" id="id_gudang"  value="<?=$_GET[id]?>"  required>
               
                    <input type="hidden" name="id_barang" id="id_barang"  value=""  required>
           
   		            <input type="hidden" name="jenis" id="jenis2" class="form-control" value="tambah_bar" readonly >
                    <input type="hidden" name="min_in" id="min_in" class="form-control" value="" readonly >
                    <input type="hidden" name="max_in" id="max_in" class="form-control" value="" readonly >
            <input type="hidden" name="cabang" id="cabang" class="form-control" value="<?php echo  $val['id_cabang']?>" readonly >
   		  </div>
			</form>
		</div>
<?php }?>
<?php
if($_POST[jenis]=='hapus'){
	$data = array("status" => 0);
	$db->update("m_gudang",$data,"id_gudang='$_POST[id]'");
	echo "<script>window.location='index.php?x=gudang'</script>";
}
?>