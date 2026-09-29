<?php if($_GET[slug]==''){?>   
    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Biaya Retribusi</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_biaya_retribusi","*","id_biaya='$_POST[id]'");
					foreach($sat as $val){}
					
					?>
					<form class="form-horizontal" action="index.php?x=biayaretribusi_s" id="formku" name="formku" method="post">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Gudang</label>
									<div class="col-lg-6">
									  <select class="select-search" name="gudang" id="gudang">
									    <option value="">--Gudang--</option>
									    <?php
										if($_SESSION['ID_CABANG']=='99'){
											$cab="id_cabang like '%%'";	
										}else{
											$cab="id_cabang='$_SESSION[ID_CABANG]'";	
										}
										
											$query=$db->select("m_gudang","*","$cab");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_gudang']?>"  <?php if($sel['id_gudang']==$val['id_gudang']){echo "selected";}?>>
									      <?=$sel['nama_gudang']?>
								        </option>
									    <?php } ?>
								    </select>
									  <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_biaya']?>">
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Pelanggan</label>
									<div class="col-lg-6">
									  <select class="select-search" name="cus" id="cus" onChange="datashipto(cus.value)" >
									    <option value="">--Pelanggan--</option>
									    <?php
											$query=$db->select("m_customer","*","id_cabang='$_SESSION[ID_CABANG]'");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_cus']?>"  <?php if($sel['id_cus']==$val['id_cus']){echo "selected";}?>>
									      <?=sprintf("%02s", $sel['id_cabang']).' - '.$sel['nama_usaha']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Ship to</label>
									<div class="col-lg-6">
									  <select class="select-search" name="shipto" id="shipto" >
									    <option value="">--Ship to--</option>
                                        <?php
                                        if($val['id_biaya']!=''){
											echo "<option value='$val[shipto_code]' selected>$val[shipto_code].'-'.$val[shipto_name]</option>";	
										}
										?>
									   
								    </select>
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Nama Kendaraan</label>
									<div class="col-lg-6">
									  <select class="select-search" name="jenis" id="jenis" >
									    <option value="">--Kendaraan--</option>
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
									<label class="control-label col-lg-4">Tgl berlaku</label>
									<div class="col-lg-5">
										<div class="input-group">
                                        
											<span class="input-group-addon"><i class="icon-calendar22"></i></span>
											<input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php if($_POST[tglber]==''){echo date("Y-m-d");}else{echo "$_POST[tglber]";}?>">
                                            </div>
										
								  </div>
								</div>
                                
                                <?php  
								 
								 $kon=$db->select("m_retribusi","*");
								 
								 
								 $jum=count($kon);
								 ?>
                                 <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#E1E1E1">
                                      <tr>
                                        <td colspan="4" align="left"><b>&nbsp;Retribusi</b></td>
                                      </tr>
                                      <tr>
                                       <td width="60%" align="center"><strong>Nama Retribusi</strong></td>
                                        <td width="10%" align="center"><strong>Nilai</strong></td>
                                      </tr>
                                      <?php
                                      $no=1;
                                      foreach($kon as $d){  
									  foreach($db->select("m_biaya_retribusi_dtl","*","id_biaya='$_POST[id]' and tgl_berlaku='$_POST[tglber]' and id_retribusi='$d[id_retribusi]'") as $kol);
									    if($_POST[id]==''){
											$kolni=0;	  
										}else{
											$kolni=$kol[nilai];	  
										}
									  ?>
                                      <tr>
                                      <td width="60%" align="left">&nbsp;<?=$d['nama_retribusi']?></td>
                                         <td width="10%" align="center">&nbsp;<input type="text" name="nilai[<?=$no?>]" id="nilai" size="10" value="<?=$kolni?>">
                                         <input type="hidden" name="id_ret[<?=$no?>]" id="id_ret" size="10" value="<?=$d['id_retribusi']?>" >
                                         <input type="hidden" name="id_dtl[<?=$no?>]" id="id_dtl" size="10" value="<?=$kol['id_dtl']?>" ></td>
                                      </tr>
                                      <?php
									  $no++;
									 
									   } ?>
                                    </table>
                                <div class="form-group">
								  <label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=biayaretribusi'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>					
		</div>
        <div class="col-lg-7">
   		<form action="index.php?x=biayaretribusi" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Biaya Retribusi</h5>
					</div>                  
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                               <th width="30%">Lokasi</th>
                              <th width="30%">Pelanggan</th>
                              <th width="10%">Ship to</th>
                              <th width="25%">Jenis Kendaraan</th>
                              <th width="25%">Detil Retribusi</th>
                            </tr>
                        </thead>
                    </table><input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
				</div>
                </form>
		</div>
 <?php 
 		if($_POST['aksi']!=''){
		$where = array("id_biaya" => $_POST['id']);
		$db->delete("m_biaya_retribusi",$where);
		echo "<script>window.location='index.php?x=biayaretribusi'</script>";
		}
  }
  if($_GET[slug]==1){
	  foreach($dat=$db->select("v_biaya_retribusi","*","id_biaya='$_GET[id]'") as $dtbi);
	  
 ?>   
   		<div class="col-lg-2">
		</div>
         <div class="col-lg-8">
   			 <form action="index.php?x=biayaretribusi" id="form_index" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Biaya Retribusi</h5>
							<div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li>
                                
                                <input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Back" onClick="window.location='index.php?x=biayaretribusi'"></button></li>
							</ul>
                            </div>
					</div>
                    <div class="dataTables_wrapper"></div>
                   
                    <br>
					 <table id="example5" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr >
                              <th colspan="3"><div class="form-group">
                            <div class="col-lg-3">
                                    <input type="text" class="form-control" name="tgl" id="tgl" value="<?php echo $dtbi['nama_gudang']?>">			
                            </div>
                            
                            <div class="col-lg-3">
                                    <input type="text" class="form-control" name="tgl" id="tgl" value="<?php echo $dtbi['nama_usaha']?>">			
                            </div>
                            <div class="col-lg-3">
                                    <input type="text" class="form-control" name="tgl" id="tgl" value="<?php echo $dtbi['shipto_code']?>">			
                            </div>
                            <div class="col-lg-3">
                                    <input type="text" class="form-control" name="tgl" id="tgl" value="<?php echo $dtbi['nama']?>">			
                            </div>
                        </div></th>
                            </tr>
                            <tr >
                              <th colspan="3">
                       
                        <div class="form-group">
                            <label class="control-label col-lg-2">Tgl Berlaku</label>
                            <div class="col-lg-3">
                                	<select class="select-search" name="tglber" id="tglber"  onChange="pindah('<?=$_GET[id]?>','<?=$_GET[slug]?>',tglber.value)">
									    <option value="">--Tgl--</option>
									    <?php
											$query=$db->select("m_biaya_retribusi_dtl ","tgl_berlaku","id_biaya='$_GET[id]' group by tgl_berlaku");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['tgl_berlaku']?>"  <?php if($sel['tgl_berlaku']==$_GET['tgl']){echo "selected";}?>>
									      <?=$sel['tgl_berlaku']?>
								        </option>
									    <?php } ?>
								    </select>   			
                            </div>
                             <div class="col-lg-3">
                                	<input style="height:25px; line-height: 0;" type="submit" class="btn btn-info" value="Edit"></button>  			
                            </div>
                        </div>
                              
                              </th>
                            </tr>
                            <tr >
                              <th width="43%">Kode </th>
                              <th width="20%">Harga</th>
                              <th width="20%">Tgl Berlaku</th>
                            </tr>
                        </thead>
                        
                    </table>
					 <input type="hidden" name="aksi" id="aksi"  value=""  required>
                     <input type="hidden" name="id" id="id"  value="<?=$_GET[id]?>"  required>
				</div>
               </form> 
		</div>
 <?php 
 if($_POST['aksi']!=''){
 $where = array("id_dtl" => $_POST['id']);
		$db->delete("m_biaya_retribusi_dtl",$where);
		 echo "<script>	window.location='index.php?x=biayaretribusi&slug=$_GET[slug]&id=$_GET[id]'</script>";
 	}
  }
 ?> 
 

    
