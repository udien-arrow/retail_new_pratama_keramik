<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
					$field="id_grup,
							jenis,id_sub,
							( SELECT CONCAT(b.account,' - ',b.description) FROM ak_acc b WHERE b.account = a.cogs) AS cogs,
							( SELECT CONCAT(b.account,' - ',b.description) FROM ak_acc b WHERE b.account = a.inventory) AS inventory,
							( SELECT CONCAT(b.account,' - ',b.description) FROM ak_acc b WHERE b.account = a.intransitcabang) AS intransitcabang,
							( SELECT CONCAT(b.account,' - ',b.description) FROM ak_acc b WHERE b.account = a.intransit) AS intransit,
							( SELECT CONCAT(b.account,' - ',b.description) FROM ak_acc b WHERE b.account = a.sales) AS sales,
							( SELECT CONCAT(b.account,' - ',b.description) FROM ak_acc b WHERE b.account = a.bongkar) AS bongkar,
							( SELECT CONCAT(b.account,' - ',b.description) FROM ak_acc b WHERE b.account = a.muat) AS muat,
							( SELECT CONCAT(b.account,' - ',b.description) FROM ak_acc b WHERE b.account = a.inventory_riject) AS riject,
							( SELECT CONCAT(b.account,' - ',b.description) FROM ak_acc b WHERE b.account = a.pok) AS pok
							";
                    $sat=$db->select("m_grup a",$field,"a.id_grup='$_POST[id]'");
					foreach($sat as $val){}
					//echo $val['id_sub'].'a';
					?>
					<form class="form-horizontal" action="index.php?x=pbar_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label  class="control-label col-lg-4">Jenis</label>
									<div class="col-lg-8">
									  <select  name="jen" id="jen" class="select-search" required>
                                      <option value="">---Pilih Jenis---</option>
									    <?php
											$query=$db->select("m_subdep a left join m_dep b on a.id_dep=b.id_dep","a.*,b.nama_dep");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_sub']?>" <?php if($sel['id_sub']==$val['id_sub']){echo "selected";}?>>
									      <?=$sel['nama_dep'].' - '.$sel['nama_sub']?>
								        </option>
									    <?php }?>
								      </select>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama</label>
									<div class="col-lg-7">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['jenis']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_grup']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Persediaan</label>
									<div class="col-lg-7">
										<input type="text" name="persediaan" id="persediaan" class="form-control" autocomplete="off" value="<?=$val['inventory']?>" required>
									</div>
								</div>
                                <!-- <div class="form-group">
									<label class="control-label col-lg-4">Riject</label>
									<div class="col-lg-7">
										<input type="text" name="riject" id="riject" class="form-control" autocomplete="off" value="<?=$val['riject']?>" required>
									</div>
								</div> -->
                                <div class="form-group">
									<label class="control-label col-lg-4">COGS</label>
									<div class="col-lg-7">
										<input type="text" name="cogs" id="cogs" class="form-control" autocomplete="off" value="<?=$val['cogs']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Lounge/Kitchen</label>
									<div class="col-lg-7">
										<input type="text" name="intransit" id="intransit" class="form-control" autocomplete="off" value="<?=$val['intransit']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Waste</label>
									<div class="col-lg-7">
										<input type="text" name="waste" id="bongkar" class="form-control" autocomplete="off" value="<?=$val['intransit']?>" required>
									</div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-lg-4">Intransit Antar Cabang / Gudang</label>
									<div class="col-lg-7">
										<input type="text" name="intransitcabang" id="intransitcabang" class="form-control" autocomplete="off" value="<?=$val['intransitcabang']?>" required>				      
									</div>
								</div> 
                                <!--<div class="form-group">
									<label class="control-label col-lg-4">Sales</label>
									<div class="col-lg-7">
										<input type="text" name="sales" id="sales" class="form-control" autocomplete="off" value="<?=$val['sales']?>" required>				      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Bongkar</label>
									<div class="col-lg-7">
										<input type="text" name="bongkar" id="bongkar" class="form-control" autocomplete="off" value="<?=$val['bongkar']?>" required>				      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Muat</label>
									<div class="col-lg-7">
										<input type="text" name="muat" id="muat" class="form-control" autocomplete="off" value="<?=$val['muat']?>" required>				      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">POK</label>
									<div class="col-lg-7">
										<input type="text" name="pok" id="pok" class="form-control" autocomplete="off" value="<?=$val['pok']?>" required>				      
									</div>
								</div>-->
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=grup_inven'">
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
  <form action="index.php?x=pbar" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Parameter Inventory</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                            <tr>
                                <th width="3%">Kode </th>
                              	<th width="10%">Nama</th>
                                <th width="10%">Persediaan</th>
                                <!-- <th width="10%">Riject</th> -->
                                <th width="10%">COGS</th>
                                <th width="10%">Lounge/Kitchen</th>
                                <th width="10%">Waste</th>
                                <!--<th width="10%">InTransit Cabang</th>
                                <th width="10%">Sales</th>
                                <th width="10%">Bongkar</th>
                                <th width="10%">Muat</th>
                                <th width="10%">Pok</th> -->
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
			</form>
		</div>

