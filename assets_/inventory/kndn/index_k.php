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
   	<form action="index.php?x=kndn_s" id="form_index" method="post">
   		  <div class="panel panel-flat" >
		    <div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Back" onClick="window.location='index.php?x=kndn'"></button></li>
							</ul>
                            </div>
                     </div>
            <div class="dataTables_wrapper">
                    </div><br>
                    <div class="form-group">
					</div>
                    <div class="form-group">
									<label class="control-label col-lg-1">Pelanggan</label>
									<div class="col-lg-3">
										<select name="cus" id="cus" class="select-minimum" onChange="pindahdata3()">
                                   	    <?php if($_GET[cus]!=''){
										$expl=explode("_",$_GET[cus]);
										?>
                                    <option value="<?=$_GET[cus]?>" selected><?=$expl[2]?></option>
                                    <?php }?>
                               	   </select>
                                   <input type="hidden" name="cusa" value="<?=$expl[0]?>">
									</div>
								</div> 
                   <input type="submit" class="btn btn-info" name="simpan" id="simpan" value="Simpan" onClick="return confirm('Apakah anda yakin simpan data!');">
                   <br><br>
                   <div class="panel-body scrolls">
                   <div class="form-group">
					<?php 
					    include("v_jenis.php");	
					?>
                    </div>
                   </div>
   		  </div>
			</form>
		</div>

