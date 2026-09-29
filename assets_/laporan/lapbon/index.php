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
    <?php if($_GET['id']==1 || $_GET['id']==2 || $_GET['id']==3 || $_GET['id']==7 || $_GET['id']=='' || $_GET['id']==8){?>
    <div class="col-lg-1">
    </div>	
    <?php }if($_GET['id']==4){?>
    <div class="col-lg-3">
    	<?php include("tunjel.php");?>
    </div>
    <?php }if($_GET['id']==5){?>
    <div class="col-lg-3">
    	<?php include("fasjab.php");?>
    </div>
    <?php }if($_GET['id']==6){?>
    <div class="col-lg-3">
    	<?php include("ikbat.php");?>
    </div>
    <?php }?>
    <?php if($_GET['id']==1 || $_GET['id']==2 || $_GET['id']==3 || $_GET['id']==7 || $_GET['id']=='' || $_GET['id']==8){?>
    <div class="col-lg-10">
    <?php }if($_GET['id']==4 || $_GET['id']==5 || $_GET['id']==6){?>
    <div class="col-lg-9">
    <?php }?>
		<form action="index.php?x=bonus_s" id="form_index" method="post">
   		  <div class="panel panel-flat" >
		    <div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Laporan Bonus Karyawan" onClick="window.location='index.php?x=bonus_v'"></button></li>
							</ul>
                            </div>
                     </div>
            <div class="dataTables_wrapper">
                    </div><br>
                    <div class="form-group">
					</div>
                   <div class="form-group">
									<label class="control-label col-lg-1">Jenis Bonus</label>
									<div class="col-lg-3">
										<select class="select-search" name="jenis" id="jenis" required onChange="pindah(jenis.value)">
									    <option value="">--Jenis--</option>
									    <option value="1" <?php if($_GET['id']==1){echo "selected";}?>>THR</option>
                                        <option value="8" <?php if($_GET['id']==8){echo "selected";}?>>Bonus Tahunan</option>
                                        <option value="2" <?php if($_GET['id']==2){echo "selected";}?>>Kinerja Triwulan</option>
                                        <option value="3" <?php if($_GET['id']==3){echo "selected";}?>>Cuti Tahunan</option>
                                         <option value="7" <?php if($_GET['id']==7){echo "selected";}?>>Cuti Besar</option>
                                        <option value="4" <?php if($_GET['id']==4){echo "selected";}?>>Tunjangan Keluarga</option>
                                        <option value="5" <?php if($_GET['id']==5){echo "selected";}?>>Fasilitas Jabatan</option>
                                        <option value="6" <?php if($_GET['id']==6){echo "selected";}?>>Ikatan Batin</option>
								    </select>
									</div>
                                    <?php if($_GET['id']==6){?>
                                    <div class="col-lg-1">
                                    	<input type="text" class="form-control" name="nilaiemas" id="nilaiemas" placeholder="Nilai Emas" value="<?=$_GET['ne']?>">
                                    </div>
                                    <?php }?>
                                     
                                    <div class="col-lg-2">
                                    	<input type="text" class="form-control datepicker" name="periode" id="periode" placeholder="Periode" value="<?=$_GET['per']?>">
                                    </div>
                                    <?php if($_GET['id']!=6){?>
                                    <div class="col-lg-2">
                                    	<input type="text" class="form-control datepicker" name="periodebay" id="periodebay" placeholder="Periode Bayar" value="<?=$_GET['pb']?>">
                                    </div>
                                    <?php }?>
                                    <div class="col-lg-1">
                                    	<input type="text" class="form-control" name="fk" id="fk" placeholder="Faktor Kali" value="<?=$_GET['fk']?>">
                                    </div>
								</div>
                   <?php
                   if($_GET['id']!=6){
				   ?>             
				   <input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahDataa(jenis.value,periode.value,fk.value,periodebay.value)">
                   <?php
				   }else{
				   ?>
                   <input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData(jenis.value,periode.value,fk.value,nilaiemas.value)">
                   <?php }?>
                   
                   <input type="submit" class="btn btn-info" name="simpan" id="simpan" value="Simpan" onClick="return confirm('Apakah anda yakin simpan data!');">
                   <br><br>
                   <div class="panel-body scrolls">
                   <div class="form-group">
					<?php 
					if($_GET['id']==1){
                        include("v_jenis.php");	
					}
					if($_GET['id']==2){
                        include("v_jenis2.php");	
					}
					if($_GET['id']==3){
                        include("v_jenis3.php");	
					}
					if($_GET['id']==4){
                        include("v_jenis4.php");	
					}
					if($_GET['id']==5){
                        include("v_jenis5.php");	
					}
					if($_GET['id']==6){
                        include("v_jenis6.php");	
					}
					if($_GET['id']==7){
                        include("v_jenis7.php");	
					}
					if($_GET['id']==8){
                        include("v_jenis8.php");	
					}
                    ?>
                    </div>
                    </div>
   		  </div>
			</form>
		</div>

