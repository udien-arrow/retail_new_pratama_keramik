    	<div class="col-lg-12">
		<form action="index.php?x=asset" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Data Removed Asset
                         <input style="height:25px; line-height: 0; float:right" type="button" class="btn btn-info" value="Remove Asset" onClick="window.location='index.php?x=remaset_v'"></h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                             	<th width="10%">Nama Asset</th>
                                <th width="10%">Tanggal</th>
                                <th width="10%">Keterangan</th>
                                <th width="10%">Jenis</th>
                                <th width="10%">Lokasi</th>
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
	$where = array("ID_AMASSET" => $_POST['id']);
	$db->delete("am_asset",$where);
	echo "<script>window.location='index.php?x=asset'</script>";
}
?>