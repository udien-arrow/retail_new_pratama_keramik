
    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
	</style>
	 <form class="form-horizontal" action="index.php?x=upabsen" name="formku" id="formku" method="post" onSubmit="return(validate_frm())"  enctype="multipart/form-data">
		<div class="col-lg-2">
        </div>
        <div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">List Gagal Upload</h5>
					</div>
                    <div class="dataTables_wrapper"><br>
                    &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" type="submit"name="delnot" value="delnot">
										 Back 
                                        </button>
                    </div>
                   
                  
					<div class="panel-body">
                    			
                    
                                <div class="form-group">
                                <div class="table-responsive">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table">
                                          <thead>
                                          <tr>
                                            <th width="7%"align="left"><strong>No</strong></th>
                                            <th width="21%"align="left"><strong>ACNO</strong></th>
                                            <th width="72%" align="left"><strong>Keterangan</strong></th>
                                            </tr>
                                          </thead>
                                          <?php
                                          $kon=$db->select("hr_absensi_notif group by sales_order,ket","*");
                                          $no=1;
                                          foreach($kon as $d){ 
										  ?>
                                          <tr>
                                            <td align="left"><?php echo $no?>&nbsp;</td>
                                            <td align="left"><?=$d['sales_order']?></td>
                                            <td align="left"><?=$d['ket']?></td>
                                          </tr>
                                          <?php $no++;}?>
                                        </table>
                                        </div>
                                 </div>
					</div>	
                    
				</div>					
		</div>
</form>
<div class="col-lg-2">
        
        </div>