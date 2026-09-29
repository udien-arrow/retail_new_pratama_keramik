    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #C4DAE7 ;
				padding:2px;
			}
			.scrolls {
				overflow-x: scroll;
				overflow-y: hidden;
				white-space:nowrap
			}
	</style>
    <div class="col-lg-1">
    </div>
    <div class="col-lg-10">
		<form action="index.php?x=pembgaji_s" id="form_index" method="post">
   		  <div class="panel panel-flat" >
		    <div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                     </div>
            		<div class="dataTables_wrapper">
                    </div>
                   <div class="panel-body scrolls">
                   <div class="form-group">
							<label class="control-label col-lg-3">Jenis</label>
								<div class="col-lg-4">
									<select class="select-search" name="jenis" id="jenis" onChange="pindahdata(jenis.value)" required>
                                 		<option value="">-- Jenis --</option>
									    <?php if($_SESSION['ID_CABANG']=='0'){?>
                                        <option value="1" <?php if($_GET['jenis']==1){ echo "selected";} ?>>Upah Organik</option>  
                                        <option value="2" <?php if($_GET['jenis']==2){ echo "selected";} ?>>Bonus</option>
                                        <?php }elseif($_SESSION['ID_CABANG']!='0'){?>
                                        <option value="3" <?php if($_GET['jenis']==3){ echo "selected";} ?>>Upah Harian</option>  
                                        <?php }?>
                                    </select>                                     
								</div>
						</div><br><br>
                        <?php if($_GET['jenis']==2){ ?>
                        <div class="form-group">
							<label class="control-label col-lg-3">Jenis Bonus</label>
								<div class="col-lg-4">
									<select class="select-search" name="jenisnya" id="jenisnya" onChange="pindahdata2(jenis.value,jenisnya.value)" required>
                                 		<option value="">-- Jenis --</option>
                                   <option value="1" <?php if($_GET['jenisnya']==1){echo "selected";}?>>THR</option>
                                        <option value="8" <?php if($_GET['jenisnya']==8){echo "selected";}?>>Bonus Tahunan</option>
                                        <option value="2" <?php if($_GET['jenisnya']==2){echo "selected";}?>>Kinerja Triwulan</option>
                                        <option value="3" <?php if($_GET['jenisnya']==3){echo "selected";}?>>Cuti Tahunan</option>
                                        <option value="7" <?php if($_GET['jenisnya']==7){echo "selected";}?>>Cuti Besar</option>
                                        <option value="4" <?php if($_GET['jenisnya']==4){echo "selected";}?>>Tunjangan Keluarga</option>
                                        <option value="5" <?php if($_GET['jenisnya']==5){echo "selected";}?>>Fasilitas Jabatan</option>
                                        <option value="6" <?php if($_GET['jenisnya']==6){echo "selected";}?>>Ikatan Batin</option>
                                    </select>                                     
								</div>
						</div><br><br>
                        <?php } ?>
                   <div class="form-group">
					<?php 
					if($_GET['jenis']==1){
                        include("v_jenis.php");	
					}elseif($_GET['jenis']==2){
                        include("v_bonus.php");	
					}elseif($_GET['jenis']==3){
                        include("v_harian.php");		
					}
                    ?>
				  </div><br>
				  <div class="form-group">
							<label class="control-label col-lg-3">Rekening kas/bank</label>
								<div class="col-lg-4">
									<select class="select-search" name="rekening" id="rekening" required>
                                 		<option value="">--Rekening kas/bank--</option>
                                         <?php
											$query=$db->select("ak_acc","*", "LR IN ('1','2')");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['account']?>"><?=$sel['account']?> - <?=$sel['description']?> </option> <?php } ?>  
                                    </select>                                     
								</div>
						</div> <br><br>
                 <div class="form-group">
									<label class="control-label col-lg-3">Jenis Transaksi</label>
						<div class="col-lg-5">
                                    <select name="aruskas" class="select" required>
                                    <option value="">Pilih Jenis transaksi</option>
                                    <?php
										foreach($db->select("ak_paruskas","*") as $k){
											echo"<option value=\"$k[id_param]\">$k[nama]</option>";	
										}
									?>
                                    </select>
                      	</div>
                      </div><br>
<br>
				<div class="form-group">
                        	<label class="control-label col-lg-3">Tanggal Transaksi</label>
                            	<div class="col-lg-2">
                                	<div class="input-group">
                                    	<span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                        <input type="text" class="form-control datepicker" name="tgl_trans" id="tgl_trans" value="<?php if($val['tanngal']==''){
											echo date("d-m-Y");
											}else{
											echo $val['tanngal'];
											}?>" />
                                            
                                    </div>                                    
                                </div>
                        </div><br>
<br>

				

				  <div class="form-group">
									<label class="control-label col-lg-3"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=pembsupp'">
										 Batal 
                                        </button>
									</div>
						</div>     
				  
                </div>
                </div>
                </form>
                </div>

