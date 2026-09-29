  <style>
  .scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap
}
  </style> 
		<div class="col-lg-1">
        </div>
        <div class="col-lg-10">
		<form action="index.php?x=deposit" id="form_index" method="post">
   		  <div class="panel panel-flat scrolls">
					<div class="panel-heading">
						<h5 class="panel-title">History deposit</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Back" onClick="window.location='index.php?x=deposit'"></button></li>
							</ul>
                         </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="10%">No Deposit Pelanggan</th>
                              	<th width="20%">Pelanggan</th>
                              	<th width="10%">Tanggal</th>
                                <th width="10%">Nominal</th>
                                <th width="30%">Keterangan</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
			</form>
		</div>

<?php
if($_POST[aksi]=='hapus'){
	$where = array("id" => $_POST['id']);
	$db->delete("m_cutomer_deposit",$where);
	echo "<script>window.location='index.php?x=deposit'</script>";
}
?>