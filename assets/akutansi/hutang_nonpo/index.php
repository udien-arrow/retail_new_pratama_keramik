<div class="col-lg-2"></div>
<div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Form Transaksi <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
					<div class="panel-body">
                   <?php
					if($_POST[id]!=''){
                    $sat=$db->select("ak_jurnal_dtl_tmp","*","IDX='$_POST[id]'");
					foreach($sat as $val){}
					}
					?>
					<form class="form-horizontal" action="index.php?x=htnonpo_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
							<!--<div class="form-group">
									<label class="control-label col-lg-4">Jenis Jurnal</label>
									<div class="col-lg-4">
										<select class="select-search" name="jenjur" id="jenjur">
                                        <option value="km">KAS MASUK</option>
                                        <option value="spum">Sisa PUM (TKBM & Retribusi)</option>
                                        <option value="pepel">Pembayaran Pelanggan</option>
                                        <option value="pumnon">Pum Non (TKBM & Retribusi)</option>
                                        </select>
								  	</div>
					  		</div>-->  
                      <div id="km">                            
                                <div class="form-group">
									<label class="control-label col-lg-4">Kode Rekening</label>
									<div class="col-lg-4">
                                    <input type="text" name="korek" id="korek" class="form-control" /> 
                                  </div>
                      </div>
                      </div>
                      <div id="spum">
                      <div class="form-group">
									<label class="control-label col-lg-4">No PUM</label>
						<div class="col-lg-5">
                         <?php if($_SESSION['ID_CABANG']=="0"){
						$c="";	
						}else{
						$c="a.CABANG='$_SESSION[ID_CABANG]' and";
						}?>
                                    <select name="pums" id="pums" class="select-search">
                                    <option value="">Pilih PUM</option>
                                      <?php 
                                      $ks=$db->select("ak_pum a join r_user_login b on a.USERID=b.ID join m_pegawai c on b.ID_PEGAWAI=c.id_pegawai","a.*,c.nama_pegawai","$c a.TIPE='39' and a.STATUS='9' and SISA<>TOTAL and a.NO_PUM not in(select NO_AMM from ak_jurnal_dtl_tmp)");
                    foreach($ks as $kw){ ?>
                                      <option value="<?=$kw['NO_PUM'].'_'.($kw['TOTAL']-$kw['SISA'])?>"><?=$kw['NO_PUM'].' - '.number_format($kw['TOTAL']-$kw['SISA']).' - '.$kw['nama_pegawai']?></option> 
                                      <?php } ?>
                                    </select>
                      	</div>
                      </div>
                      </div>
                      
                      <div id="npum">
                      <div class="form-group">
									<label class="control-label col-lg-4">No PUM</label>
						<div class="col-lg-5">
                                    <select name="pums1" id="pums1" class="select-search">
                                    <option value="">Pilih PUM</option>
                                      <?php 
                                      $ks=$db->select("ak_pum a join r_user_login b on a.USERID=b.ID join m_pegawai c on b.ID_PEGAWAI=c.id_pegawai","a.*,c.nama_pegawai","a.CABANG='$_SESSION[ID_CABANG]' and a.TIPE<>'39' and a.STATUS='9' and a.NO_PUM not in(select NO_AMM from ak_jurnal_dtl_tmp)");
                    foreach($ks as $kw){ ?>
                                      <option value="<?=$kw['NO_PUM'].'_'.($kw['TOTAL']-$kw['SISA'])?>"><?=$kw['NO_PUM'].' - '.number_format($kw['TOTAL']-$kw['SISA']).' - '.$kw['nama_pegawai']?></option> 
                                      <?php } ?>
                                    </select>
                      	</div>
                      </div>
                      </div>
                      
                      <div id="pepel">
                      <div class="form-group">
									<label class="control-label col-lg-4">Pelanggan</label>
						<div class="col-lg-5">
                                    <input type="text" name="pelangans" id="pelangans" class="form-control" /> 
                      	</div>
                      </div>
                      </div>
                      
                      
                      <!--<div class="form-group">
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
                      </div>-->
                      <div class="form-group">
									<label class="control-label col-lg-4">Keterangan</label>
									<div class="col-lg-4">
                                    	<input type="text" name="ket" id="ket" class="form-control" value="" autocomplete="off" required/>
								  	</div>
					</div>           
                    
                                  
                      <div class="form-group">
									<label class="control-label col-lg-4">Jumlah (Rp.)</label>
									<div class="col-lg-4">
                                    <input type="text" name="jml" id="jml" class="form-control harga"required/>
                                    <input type="hidden" name="curr" id="curr" class="form-control" value="kredit"/>
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
					<form class="form-horizontal" action="index.php?x=htnonpo_ss" name="form2" id="form2" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                     
                    
               <table id="example4" class="table datatable table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                     
                            <tr>
                               	<th width="20%">Kode Rekening</th>
                               	<th width="50%">Keterangan</th>
                              	<th width="15%">Jumlah</th>
                              	<th width="10%">Aksi</th>
                            </tr>
                               <?php
					//if($_POST[id]!=''){
                    $sat=$db->select("tx_bph_dtl_tmp","*","ID_USER='$_SESSION[ID_LOGIN]'");
					foreach($sat as $val){
						$kredit=$val['jumlah'];
						$tot_kredit=$tot_kredit+$kredit;
					//}
					?>
                            <tr>
                              <th><?php echo $val ['acc_code']; ?></th>
                              <th><?php  echo $val ['deskripsi']; ?></th>
                              <th style="text-align:right"><?php echo number_format($val ['jumlah']);?></th>
                              <th><ul class='icons-list'>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus(<?php echo $val['id_dtl']?>)' style='cursor:pointer' class='icon-trash'></a></li>
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
                     <input type="hidden" name="aksi" id="aksi"  value=""  required>
                     <input type="hidden" name="id" id="id"  value=""  required>
                     
                                                     <p>&nbsp;</p>
                                                     <p>&nbsp;</p>
                      	<!--<div class="form-group">
									<label class="control-label col-lg-4">Nama Supplier</label>
									<div class="col-lg-4">
                                      <input type="text" name="nama_supplier" id="korek1" value="" class="form-control" />
									   
                                      </div>
           			  	</div>-->
                        <div class="form-group">
									<label class="control-label col-lg-4">Supplier</label>
								  <div class="col-lg-5">
                                    <select name="psupp" id="psupp" class="select-search" onchange="pindahData2(psupp.value)">
                                        <option value="">---Pilih Supplier---</option>
                                        <?php
                                            $sup=$db->select("m_supplier","*","jenis_supplier=2");
                                                foreach($sup as $supp){
                                        ?>
                                        <option value="<?=$supp['id_supp']?>" <?php if($supp['id_supp']==$_GET['supp']){ echo "selected"; } ?>><?=$supp['nama_usaha']?> - <?=$supp['nama_usaha']?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="supplier" id="supplier" value="<?=$_GET['supp']?>" class=" form-control input datepicker validate[required]" size="8" readonly>
                                  </div>
                              
                        </div>
                      
                     	<div class="form-group">
                                         <label class="control-label col-lg-4">DPP</label>
                                <div class="col-lg-2">
                                		<?php
											$sup1=$db->select("m_supplier","*","id_supp=$_GET[supp]");
                                                foreach($sup1 as $supp1){}											
										?>
                                        <input type="text" name="dpp" id="dpp" value="<?php if($_GET['supp']==''){}else{ echo number_format($tot_kredit);} ?>" class=" form-control input datepicker validate[required]" size="8" readonly>
                            	</div>
                        </div>
                      
                      	<div class="form-group">
                                         <label class="control-label col-lg-4">PPn</label>
                                <div class="col-lg-2">
                                		<?php
											if($supp1['pkp']=="1"){
												$ppn = ($tot_kredit * 10)/100;
											} else {
												$ppn = 0;
											}
										?>
                                        <input type="text" name="ppn" id="ppn" value="<?php echo number_format($ppn);?>" class=" form-control input datepicker validate[required]" size="8" readonly>
                                        <input type="hidden" name="pkp" id="pkp" value="<?=$supp1['pkp']?>" class=" form-control input datepicker validate[required]" size="8" readonly>
                            	</div>
                        </div>
                      
                      	 <div class="form-group">
                                         <label class="control-label col-lg-4">PPh</label>
                                <div class="col-lg-2">
                                		<?php
											$pph = ($tot_kredit * $supp1['pph'])/100;
										?>
                                        <input type="text" name="pph" id="pph" value="<?php echo number_format($pph);?>" class=" form-control input datepicker validate[required]" size="8" readonly>
                                        <input type="hidden" name="pphpersen" id="pphpersen" value="<?=$supp1['pph']?>" class=" form-control input datepicker validate[required]" size="8" readonly>
                            	</div>
                        </div>
                      
                      	 <div class="form-group">
                                         <label class="control-label col-lg-4">Grand Total</label>
                                <div class="col-lg-2">
                                		<?php
											$total_seluruh = ($tot_kredit + $ppn) - $pph;
										?>
                                        <input type="text" name="total_seluruh" id="total_seluruh" value="<?php echo number_format($total_seluruh);?>" class=" form-control input datepicker validate[required]" size="8" readonly>
                            	</div>
                        </div>
                
                         <div class="form-group">
                                         <label class="control-label col-lg-4">No Invoice</label>
                                <div class="col-lg-2">
                                        <input type="text" name="no_invoice" id="no_invoice" value="" class="form-control input validate[required]" size="8" required="required">
                            	</div>
                        </div>
                      
                     	<?php if($_SESSION['ID_CABANG']==''){ ?>
                      	<div class="form-group">
									<label class="control-label col-lg-4">Cabang</label>
								  <div class="col-lg-5">
									  <select class="select-search" name="cabang" id="cabang" required>
									    <option value="">--Please Select--</option>
									    <?php
											$query=$db->select("m_cabang","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_cabang']?>"> <?=$sel['nama_cabang']?></option> <?php } ?>
								      </select> 
                                  </div>
                      	</div>
                       <?php }else{ ?>
                       		<input type="hidden" name="cabang" value="<?=$_SESSION['ID_CABANG']?>">
                       <?php } ?>
                         
                    
                      <div class="form-group">
									 <label class="control-label col-lg-4">Tanggal Transaksi</label>
                        	<div class="col-lg-2">
									<input type="text" name="tgl_transaksi" id="tgl_transaksi" value="<?php echo date("Y-m-d");?>" class=" form-control input datepicker validate[required]" size="8" readonly>
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
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                   <button class="btn btn-success" type="button" onClick="window.location='index.php?x=jurum'">
										 Batal 
                                    </button>
                                      
 
                                    <p>&nbsp;</p>
					   </div>
					  </div>
				  </form>
		</div>