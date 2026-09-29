<div class="col-lg-2"></div>
<div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Form Transaksi <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Transaksi" onClick="window.location='index.php?x=pjk_v'"></button></li>
							</ul>
                        </div>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
					<div class="panel-body">
                   <?php
					if($_POST[id]!=''){
                    $sat=$db->select("ak_jurnal_dtl_tmp","*","IDX='$_POST[id]'");
					foreach($sat as $val){}
					}
					?>
					<form class="form-horizontal" action="index.php?x=pjk_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                            <div class="form-group">
                            <label class="control-label col-lg-4">Jenis Uang Muka</label>
                            <div class="col-lg-7">
                              <select name="jum" class="select-search" id="jum"  onChange="pindah2(jum.value)"required>
	                              <option value="">Pilih Jenis Uang Muka</option>
                                  <?php
								  
									 $ak=$db->select("ak_jenisum","*","st='1' and id_jenisum<>'39'");
								  	foreach($ak as $jum){
										?>
									  <option value="<?=$jum[id_jenisum]?>" <?php if($jum[id_jenisum]==$_GET[jen]){ echo "selected"; }?>><?=$jum[account] .' - '. $jum[jenis_um]?></option>
									  
									  </optgroup>
									<?php
                                    }
									
								  ?>
                              </select>
                            </div>
           			  </div>
							<div class="form-group">
									<label class="control-label col-lg-4">PUM</label>
									<div class="col-lg-7">
                                    <?php 
									if($_SESSION['ID_CABANG']=='0'){
									$j="";	
									}else{
									$j="a.CABANG='$_SESSION[ID_CABANG]' and ";		
									}
									
									?>
										<select class="select-search" name="jenjur" id="jenjur" onChange="pindah(jenjur.value,jum.value)">
                                        <option value="0">--- PUM ---</option>
                                         <?php 
                                     //$ks=$db->select("ak_pum a join r_user_login b on a.USERID=b.ID join m_pegawai c on b.ID_PEGAWAI=c.id_pegawai","*","$j a.STATUS='9' and USERID='$_SESSION[ID_LOGIN]' and a.TIPE='$_GET[jen]' and SISA<>TOTAL and a.NO_PUM not in (select NO_PUM from ak_pjk_dtl)");
									 $ks=$db->select("ak_pum a join r_user_login b on a.USERID=b.ID join m_pegawai c on b.ID_PEGAWAI=c.id_pegawai","*","$j a.STATUS='9' and a.TIPE='$_GET[jen]' and SISA<>TOTAL");
                    foreach($ks as $kw){
						$ck=$db->select("ak_pjk_tmp","sum(JUMLAH)as jum,count(JUMLAH),NO_PUM","USER='$_SESSION[ID_LOGIN]' and NO_PUM='$kw[NO_PUM]'");
						foreach($ck as $kaj){}
						?>
                                      <option value="<?=$kw['NO_PUM']?>" <?php if($_GET['pum']==$kw['NO_PUM']){ echo "selected";} ?>><?=$kw['NO_PUM'].' - '.number_format(($kw['TOTAL']-$kw['SISA'])-$kaj['jum']).' - '.$kw['nama_pegawai']?></option> 
                                      <?php } ?>
                                        </select>
								  </div>
					  </div>    
                      <div id="km">                            
                                <div class="form-group">
									<label class="control-label col-lg-4">Nomer Rekening</label>
									<div class="col-lg-4">
                                    <input type="text" name="norek" id="korek" class="form-control" /> 
                                  </div>
                      </div>
                      </div>
                      
                      <div class="form-group">
									<label class="control-label col-lg-4">Keterangan</label>
									<div class="col-lg-4">
                                    	<input type="text" name="ket" id="ket" class="form-control" value="" autocomplete="off" required/>
								  	</div>
					</div>           
                    
                                  
                      <div class="form-group">
									<label class="control-label col-lg-4">Jumlah (Rp.)</label>
									<div class="col-lg-2">
                                    <input type="text" name="jml" id="jml" class="form-control harga"required/>
                                    <input type="hidden" name="curr" id="curr" class="form-control" value="debet"/>
                                    </div>
                                    <div class="col-lg-3">
                                    	<input type="checkbox" class="control-warning" id="checkbox"> Kurang Biaya (Kredit)
                                    </div>   
						
                       <!--             <label class="control-label col-lg-1">Posisi</label>
                        <div class="col-lg-2">
                                    <select class="select" name="curr" id="curr" onChange="">
                                    	
                                        <option value="kredit">Kredit</option>
                                        
                                    </select>
				     	</div>-->
                      </div>
                               
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
								  <div class="col-lg-5">
										<button class="btn btn-primary" type="submit" >
										 Tambah transaksi 
                                        </button>
                                   
                                      
 
                                    <p>&nbsp;</p>
								  </div>
								</div>     
					</form>
                    </div>
                    </div>
  </div>
</div>
                   <div class="col-lg-2"></div>
<div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">List Transaksi <?=$title?></h5>
					</div>
<div class="dataTables_wrapper"></div>
                    
					<div class="panel-body">
					<form class="form-horizontal" action="index.php?x=pjk_ss" name="form2" id="form2" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                     <input type="hidden" name="pums" value="<?=$_GET['pum']?>">
                      <input type="hidden" name="jums" value="<?=$_GET['jen']?>">
                    
               <table class="table datatable table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                     
                            <tr>
                               <th width="20%">Kode Rekening</th>
                               <th width="50%">Keterangan</th>
                              <th width="15%">Jumlah</th>
                              <th width="10%">Aksi</th>
                            </tr>
                               <?php
					//if($_POST[id]!=''){
                    $sat=$db->select("ak_pjk_tmp","*","USER='$_SESSION[ID_LOGIN]'");
					foreach($sat as $val){
						$kredit=$val['JUMLAH'];
						$tot_kredit=$tot_kredit+$kredit;
					//}
					?>
                            <tr>
                              <th><?php echo $val ['ACC_CODE']; ?></th>
                              <th><?php  echo $val ['KETERANGAN']; ?></th>
                              <th style="text-align:right"><?php echo number_format($val ['JUMLAH']);?></th>
                              <th><ul class='icons-list'>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus(<?php echo $val['ID']?>)' style='cursor:pointer' class='icon-trash'></a></li>
			</ul></th>
                            </tr>
                      <?php }?>      
                        </thead>
                        
						  <tr>
						    <td class="td" colspan="2" align="center"><b>TOTAL</b></td>
                            <th style="text-align:right"><?php echo number_format($tot_kredit); ?><input name="totk" type="hidden" id="totd" value="<?php echo $tot_kredit;?>">
                            </th>
                            <td class="td" align="center">&nbsp;</td>
						   
						   
					      </tr>
                    </table>
                    </fieldset>
                     <input type="hidden" name="aksi" id="aksi"  value=""  >
                     <input type="hidden" name="id" id="id"  value=""  required>
                     <div class="form-group">
									<label class="control-label col-lg-4">Jenis Arus Kas</label>
						<div class="col-lg-5">
                                    <select name="aruskas" class="select-search" required>
                                    <option value="">Pilih Jenis Arus Kas</option>
                                    <?php
										foreach($db->select("ak_paruskas","*") as $k){
											echo"<option value=\"$k[id_param]\">$k[nama]</option>";	
										}
									?>
                                    </select>
                      	</div>
                      </div>
                      
                      <?php
					  /**
					  $ce=$db->select("ak_pum","*","NO_PUM='$_GET[pum]'");
					  foreach($ce as $cak){}
					  if($tot_kredit>$cak['TOTAL']){
					   ?>
                      <div class="form-group">
									<label class="control-label col-lg-4">Rekening Kas</label>
									<div class="col-lg-4">
									  <input type="text" name="group" id="korek1" value="" class="form-control" />
                                      </div>
           			  </div>
                      <?php }  **/?>
                      <div class="form-group">
									 <label class="control-label col-lg-4">Tanggal Transaksi</label>
                        	<div class="col-lg-2">
									<input type="text" name="tgl_transaksi" id="tgl_transaksi" value="<?php echo date("Y-m-d");?>" class=" form-control input datepicker validate[required]" size="8" >
					  	</div>
					</div>     
                     
                    <div class="form-group">
									<label class="control-label col-lg-4">Catatan</label>
									<div class="col-lg-4">
                                    	<input type="text" name="cat" id="cat" class="form-control" value="" autocomplete="off" required/>
								  	</div>
					</div>           
                    
                     <div class="form-group">
									<label class="control-label col-lg-4"></label>
								  <div class="col-lg-5">
										<a onClick="sem()"><button class="btn btn-primary" type="button" onClick="return confirm('Apakah Anda yakin menyimpan data??')" >Simpan</button></a>
                                  <!-- <button class="btn btn-success" type="button" onClick="window.location='index.php?x=pjk'">
										 Batal 
                                    </button>-->
                                      
 
                                    <p>&nbsp;</p>
					   </div>
					  </div>
				  </form>
		</div>