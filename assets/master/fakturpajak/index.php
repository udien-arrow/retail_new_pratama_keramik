
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
	 <form class="form-horizontal" action="index.php?x=fakturpajak_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())"  enctype="multipart/form-data">
		<div class="col-lg-12">
				<div class="panel panel-flat">
					<br>
                  <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;Data</label>
                             
                             <div class="col-lg-4">
                                 <input type="file" name="file" id="file" size="150"  class="file-input" data-show-preview="false">
                               </div>
                               
                               <div class="col-lg-3">
                                 Contoh Upload :<a href="assets/master/fakturpajak/Data.csv" ><img id="expxls" name="expxls" src="assets/inventory/fakturpajak/excel.png" alt="" width="22" height="22" border="0"  title="Type file Semen .csv"/></a> 
                              </div>  
                               
                    </div>
					
				</div>					
		</div>
</form>
	
    <div class="col-lg-5">
		<form action="index.php?x=order_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
		    <div class="panel-heading">
						<h5 class="panel-title">List Faktur</h5>
                     </div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <td width="10%">No Faktur</td>
                              	<td width="10%">Tgl</td>
                            </tr>
                        </thead>

                    </table>
                   
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=order" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-7">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">List Faktur Terpakai</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                  	
				  <div class="panel-body">
                   				<div class="form-group">
                                &nbsp;&nbsp;</div>
                                
                               
                                <div class="form-group">
                                  <table id="example" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                                    <thead>
                                      <tr>
                                        <td width="10%">No Faktur</td>
                                        <td width="10%">Tgl</td>
                                        <td width="10%">No SPJ</td>
                                        <td width="10%">Cabang</td>
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
<?php
if($_POST['delnot']){
	$where = array("status" => 1);
	$db->delete("tx_so_notif",$where);
}
?>
