<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Data Nominal Wilayah</h5>
                       
					</div>
                    
                    <div class="dataTables_wrapper"></div>
					<div class="panel-body">
                   			<div class="form-group">
                             
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="13%"align="center"><strong>No</strong></td>
          <td align="center" width="50%"><strong>Wilayah</strong></td>
          <td width="37%"align="center"><strong>Nominal</strong></td>
        </tr>
        <?php
										  
	$kon=$db->select("hr_param_tunjkel a left join m_wilayah b on a.id_wilayah=b.id_wilayah","a.*,b.nama_wilayah");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="left">&nbsp;<?php echo $no?></td>
          <td>&nbsp;<?php echo $d['nama_wilayah'];?>&nbsp;</td>
          <td align="right"><?=number_format($d['nominal'])?>&nbsp;</td>
        </tr>
        <?php $no++;
		} 
		?>
      
</table>


                            
                      </div>
                     <br>
                         <!--<div class="form-group">
								  <label class="control-label col-lg-4">Index Faktor Kali</label>
								   <div class="col-lg-3">
										<input type="text" name="ifaktor_kali" id="ifaktor_kali" class="form-control" autocomplete="off"  required>
									</div>
								</div>  -->
					</div>
                    	
				</div>	
                




        
