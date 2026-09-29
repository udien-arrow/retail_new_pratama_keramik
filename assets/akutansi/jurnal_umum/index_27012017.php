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
					  <form class="form-horizontal" action="index.php?x=jurum_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
							<div class="form-group">
									<label class="control-label col-lg-4">Jenis Jurnal</label>
									<div class="col-lg-3">
										<select class="select" name="jenjur" id="jenjur">
                                        <option value="JU">Jurnal Umum</option>
                                        </select>
								  </div>
					  </div>                                
                                <div class="form-group">
									<label class="control-label col-lg-4">Nomor Rekening</label>
								  <div class="col-lg-5">
									  <select class="select-search" name="norek" id="norek" required>
									    <option value="">--Please Select--</option>
									    <?php
											$query=$db->select("ak_acc","*","post_flag='1'");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['account']?>"> <?=$sel['account']?> - <?=$sel['description']?> </option> <?php } ?>
								      </select> 
                                  </div>
                      			</div>
                      <div class="form-group">
									<label class="control-label col-lg-4">Keterangan</label>
						<div class="col-lg-5">
                                    	<input type="text" name="ket" id="ket" class="form-control" value="" autocomplete="off" required/>
					  	</div>
					</div>                  
                      <div class="form-group">
									<label class="control-label col-lg-4">Jumlah (Rp.)</label>
									<div class="col-lg-2"><input type="text" name="jml" id="jml" class="form-control harga"required/></div>
                                    <label class="control-label col-lg-1">Posisi</label>
                                    <div class="col-lg-2">
                                    <select class="select-search" name="status" id="status">
									    <option value="debet" >Debet</option>    
<option value="kredit">Kredit</option> 
								      </select>
                                    </div>
                      </div>
                                <div class="form-group"></div>
                                <div class="form-group">
                                  <div class="col-lg-5"></div>
					  </div>
                                
                        <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit"  name="tambah" id="tambah">
										 Tambah transaksi 
                                        </button>  
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
						<h5 class="panel-title">List Transaksi 
					    <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
 
					<div class="panel-body">
                    
					<form class="form-horizontal" action="index.php?x=jurum_ss" name="form1" id="form1" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                <div class="form-group">
                                  <table id="example4" class="table datatable table-bordered table-striped table-hover dataTable no-footer" >
                    <thead>
                            <tr>
                               <th width="20%">Kode Rekening</th>
                               <th width="20%">Keterangan</th>
                              <th width="15%">Debet</th>
                              <th width="15%">Kredit</th>
                              <th width="10%">Aksi</th>
                            </tr>
                            <?php
				
                    $sat=$db->select("ak_jurnal_dtl_tmp","*","TIPE='JU'");
					
					foreach($sat as $val){
					$debet=$val['DEBET'];
					$kredit=$val['KREDIT'];
					$tot_debet=$tot_debet+$debet;
					$tot_kredit=$tot_kredit+$kredit;
					
					?>
                            <tr>
                              <th><?php echo $val ['ACC_CODE']; ?></th>
                              <th><?php  echo $val ['KET_DTL']; ?></th>
                              <th style="text-align:right"><?php  echo number_format($val ['DEBET']); ?></th>
                              <th style="text-align:right"><?php  echo number_format($val ['KREDIT']); ?></th>
                              <th style="text-align:center"><ul class='icons-list'>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus(<?php echo $val['IDX']?>)' style='cursor:pointer' class='icon-trash'></a></li>
			</ul></th>
                            </tr>
                      <?php }?> 
                  </thead>
						  <tr>
						    <td class="td" colspan="2" align="center"><b>TOTAL</b></td>
						    <td class="td" align="right"><b><?php echo number_format($tot_debet); ?>
						      <input name="totd" type="hidden" id="totd" value="<?php echo"$tot_debet";?>">
						    </b></td>
						    <td class="td" align="right"><b><?php echo number_format($tot_kredit); ?>
                            <input name="totk" type="hidden" id="totk" value="<?php echo"$tot_kredit";?>"></b></td>
						    <td class="td" align="center"><?php
							if(!empty($tot_debet) || !empty($tot_kredit)){
								if($tot_debet==$tot_kredit){
									echo "<font color='#0033FF'>Balance</font>";
								}else{
									echo "<font color=red>Not Balance : ".abs($tot_debet-$tot_kredit)."</font>";
								}
							}
							?></td>
					      </tr>
                    </table>
                    <input type="hidden" name="aksi" id="aksi"  value=""  required>
                    <input type="hidden" name="id" id="id"  value=""  required>
               <br>
                    <div class="form-group">
		    <label class="control-label col-lg-4">TGL Transaksi</label>
                           	<div class="col-lg-7"><span class="field-block button-height">
                           	  <input class="input datepicker validate[required]" type="text" name="tanggal_transaksi" size="10" value="<?php echo date("Y-m-d");?>" readonly />
                           	</span></div>
                                  </div>
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
                                  <div class="form-group">
					    <label class="control-label col-lg-4">Catatan </label>
                           	<div class="col-lg-5">
										<input type="text" name="cat" id="cat" class="form-control" autocomplete="off" value="<?=$val['cat']?>" required>
								  </div>
								</div>
                                
                                 <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')"name="simpan" id="simpan">
										Simpan Jurnal
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=jurum'">
										 Batal 
                                        </button>
									</div></div>
								</div> </div>
					</form>
					</div>	
  </div>
				</div>

