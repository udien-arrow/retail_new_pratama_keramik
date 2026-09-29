    <!-- Theme JS files -->
	<?php
    $cbar=$db->select("m_barang","id_barang,id_satuan","status='0' and kode_barang=''");	
	$rbar=count($cbar);
	
	if($rbar>0 || $_GET[dep]!=""){
		$dbar=mysql_fetch_array($cbar);
		foreach($cbar as $dbar){}
		$id=$dbar[id_barang];
		
		$where = array("id_brg" => $dbar[ID_BRG]);
		$db->delete("m_konversi",$where);
	} else {	
				
		$max=$db->select("m_barang","max(id_barang)as id");
		foreach($max as $dbar2){}
		$id=$dbar2[id]+1;
		$data = array( 'id_barang' => $id, 
				);
		$exec= $db->insert("m_barang", $data);	
	}
	
	//=========generate kode barang=======
	$bar=$db->select("m_barang","max(substr(kode_barang,2,5))as bar");
	foreach($bar as $barval){}
	
	$datbar=$db->select("m_barang","*","id_barang='$_POST[id]'");
	foreach($datbar as $valbar){}
	   if($valbar['id_barang']=='')	{
		  $dt2="tambah";
		  $kdbar="B".sprintf("%05s", $barval['bar']+1);
		  $id=$id;
		  $_GET['dep']=$_GET['dep']; 
		  $_GET['sub']=$_GET['sub'];
		  $_GET['kat']=$_GET['kat'];
	   }else{
		  $dt2="edit";
		  $kdbar=$valbar['kode_barang'];
		  $id=$_POST['id'];
		  $_GET['dep']=$valbar['id_dep']; 
		  $_GET['sub']=$valbar['id_sub'];
		  $_GET['kat']=$valbar['id_kat'];
	   }
   
   
   
        ?>
    
		<div class="col-lg-12">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Barang</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
					<div class="table-responsive pre-scrollable">
                    <div class="panel-body" >
                    <?php
                    $sat=$db->select("m_satuan","*","id_satuan='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=barang_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label  class="control-label col-lg-4">Department</label>
									<div class="col-lg-6">
                                    <select name="dep" id="dep" class="select" onChange="tampildepp(this.value)">
										<option value="">---Pilih Department---</option>
										<?php
											$query=$db->select("m_dep","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_dep']?>" <?php if($sel['id_dep']==$_GET['dep']){echo "selected";}?>><?=$sel['nama_dep']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
								</div>
                                <div class="form-group">
									<label  class="control-label col-lg-4">Sub Department</label>
									<div class="col-lg-7">
                                    <select  name="subdep" id="subdep" class="select" onChange="tampilsubdep(dep.value,this.value)">
										<option value="">---Pilih Sub Department---</option>
										<?php
											$query=$db->select("m_subdep","*","id_dep='$_GET[dep]'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_sub']?>" <?php if($sel['id_sub']==$_GET['sub']){echo "selected";}?>><?=$sel['nama_sub']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
								</div>
                                <div class="form-group">
									<label  class="control-label col-lg-4">Kategori</label>
									<div class="col-lg-5">
                                    <select name="kat" id="kat" class="select" onChange="tampilkat(dep.value,subdep.value,this.value)">
										<option value="">---Pilih Kategori---</option>
										<?php
											$query=$db->select("m_kat","*","id_sub='$_GET[sub]'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_kat']?>"  <?php if($sel['id_kat']==$_GET['kat']){echo "selected";}?>><?=$sel['nama_kat']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Kode Barang</label>
									
                                  <div class="col-lg-5">
										<input type="text" name="kode_barang" id="kode_barang" class="form-control" autocomplete="off" value="<?=$kdbar?>" required readonly>
                                    <input type="hidden" name="kode" id="kode"  class="form-control" value="<?=$id?>"  required>
                                  </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Barang</label>
									
                                  <div class="col-lg-8">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$valbar['nama_barang']?>" required >
                                    </div>
								</div>
                                 <div class="form-group">
									<label  class="control-label col-lg-4">Satuan Terkecil</label>
									<div class="col-lg-7">
									  <select  name="sat" id="sat" onchange="konv()"  class="select-search">
                                      <option value="">---Pilih Satuan Terkecil---</option>
									    <?php
											$query=$db->select("m_satuan","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_satuan']?>" <?php if($sel['id_satuan']==$valbar['id_satuan']){echo "selected";}?>>
									      <?=$sel['nama_satuan']?>
								        </option>
									    <?php }?>
								      </select>
									</div>
								</div>
                                <div class="form-group">
                                		<label  class="control-label col-lg-4">Konversi</label>
										<div class="col-lg-3">
                                        <select  name="sat2" id="sat2" onchange="konv()"  class="select-search">
									    <option value="">-Pilih-</option>
                                        <?php
											$query=$db->select("m_satuan","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_satuan']?>">
									      <?=$sel['nama_satuan']?>
								        </option>
									    <?php }?>
								      </select>
                                      </div>
                                      <div class="col-lg-2">
                                	  <input type="text" name="konversi" id="konversi" class="form-control" />
                                      </div>
                                      <div class="col-lg-0">  
                                        <a href="javascript:void(0)" class="btn btn-warning" onclick="openIframeAll($('#kode').val(),$('#sat2').val(),$('#konversi').val())" >Add</a><br/>
                                         
                                </div><br>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
                                    	<div class="col-lg-4" id="keranjang"></div>
                                       </div>
                                </div>    
                                <div class="form-group">
									<label class="control-label col-lg-4">Berat / Tipe</label>
									
                                  <div class="col-lg-3">
										<input type="text" name="berat" id="berat" class="form-control" autocomplete="off" value="<?=$valbar['berat']?>" required>
                                    </div>
                                    <div class="col-lg-5">
                                      <select name="tipe" id="tipe" class="select">
                                        <option value="">---Pilih Tipe---</option>
                                        <option value="1" <?php if($valbar[tipe]==1){echo "selected";}?>>Pembelian</option>
                                        <option value="2" <?php if($valbar[tipe]==2){echo "selected";}?>>Penjualan</option>
                                        <option value="3" <?php if($valbar[tipe]==3){echo "selected";}?>>Assets</option>
                                      </select>
                                   </div>
								</div>
                                <div class="form-group">
									<label  class="control-label col-lg-4">Grup Inventory</label>
									<div class="col-lg-7">
									  <select name="grup" id="grup" class="select-search">
                                      <option value="">---Pilih Grup---</option>
									    <?php
											$query=$db->select("m_grup","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_grup']?>" <?php if($sel['id_grup']==$valbar['id_grup']){echo "selected";}?>>
									      <?=$sel['jenis']?>
								        </option>
									    <?php }?>
								      </select>
									</div>
								</div>
                                 <hr> 
                                 <?php  
								 
								 $kon=$db->select("m_gudang a left join m_cabang b on a.id_cabang=b.id_cabang","*","a.status='1'");
								 
								 
								 $jum=count($kon);
								 ?>
                                 <table width="100%" border="1" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td colspan="5" align="left"><b>&nbsp;Penggunaan Digudang</b></td>
                                      </tr>
                                      <tr>
                                        <td width="6%" align="left">&nbsp;<input type="checkbox"  value="<?=$d['nama_gudang']?>" onclick="checkedAll(<?=$jum?>)" id="call"></td>
                                        <td width="60%" align="center"><strong>Gudang</strong></td>
                                        <td width="10%" align="center"><strong>Min</strong></td>
                                        <td width="10%" align="center"><strong>Max</strong></td>
                                      </tr>
                                      <?php
                                      $no=1;
                                      foreach($kon as $d){  
									  $cek=$db->select("m_barang_gudang","id_barang,min,max","id_barang='$id' and id_gudang='$d[id_gudang]'");
									  foreach($cek as $valcek){}
									 
									  ?>
                                      <tr>
                                        <td>&nbsp;<input type="checkbox" <?php if($valcek[id_barang]!=''){echo "checked";}?> name="id_gudang[<?=$no?>]" id="split<?=$no?>" value="<?=$d['id_gudang']?>"></td>
                                        <td width="60%" align="left">&nbsp;<?=$d['nama_gudang']." ( ".$d['nama_cabang'].")"?></td>
                                         <td width="10%" align="center">&nbsp;<input type="text" name="min[<?=$no?>]" id="min" size="1" value="<?=$valcek['min']?>"></td>
                                        <td width="10%" align="center">&nbsp;<input type="text" name="max[<?=$no?>]" id="max" size="1" value="<?=$valcek['max']?>"></td>
                                      </tr>
                                      <?php
									  $no++;
									   } ?>
                                    </table>
                                <br>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
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
        <div class="col-lg-12">
		<form action="index.php?x=barang" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Barang Pusat</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="10%">Kode </th>
                              	<th width="40%">Nama Barang</th>
                                <th width="10%"> Satuan</th>
                                <th width="10%">Berat</th>
                                <th width="15%">Jenis</th>
                                <th width="15%">Aksi</th>
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
	$data = array("status" => 0);
	$db->update("m_barang",$data,"id_barang='$_POST[id]'");
	echo "<script>window.location='index.php?x=barang'</script>";
}
?>