<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Data  </h5>
                       
					</div>
                    
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                   			<div class="form-group">
                             
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="13%"align="center"><strong>No</strong></td>
          <td align="center" width="50%"><strong>Masa Kerja (tahun)</strong></td>
          <td width="37%"align="center"><strong>Emas 22 Karat (gram)</strong></td>
        </tr>
        <?php
		$kon=$db->select("hr_param_ikbat","*");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="left">&nbsp;<?php echo $no?></td>
          <td>&nbsp;<?php echo $d['masa_kerja'];?>&nbsp;</td>
          <td align="right"><?=$d['nominal']?>&nbsp;</td>
        </tr>
        <?php $no++;
		} 
		?>
      
</table>
               			</div>
                     	<br>
                         <!--<div class="form-group">
								  <label class="control-label col-lg-4">Nilai Emas</label>						 		<div class="col-lg-7">
									<input type="text" name="nilaiemas" id="nilaiemas" class="form-control" autocomplete="off"  required>
									</div>
						 </div>  <br>
						 <div class="form-group">
								   <label class="control-label col-lg-4">Index Faktor Kali</label>
								   <div class="col-lg-3">
										<input type="text" name="ifaktor_kali" id="ifaktor_kali" class="form-control" autocomplete="off"  required>
								   </div>
                                    
						 </div>  -->
                    
                    
                    
                    </div>
                     	
				</div>	
                




        
