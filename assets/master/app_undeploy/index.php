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
    <div class="col-lg-1">
    </div>
    <div class="col-lg-10">
		<form action="index.php?x=undeployed" id="form_index" method="post">
    <div class="panel panel-flat">
	  <div class="panel-heading">
						<h5 class="panel-title">View Pengembalian Aset</h5>
			  </div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <td width="15%">No </td>
                              	<td width="30%">Nama Lokasi</td>
                                <td width="10px">Nama Asset</td>
                                <td width="10px">Tanggal Request</td>
                                 <td width="10px">Keterangan Request</td>
                                <td width="30%">nama Pegawai </td>
                            </tr>
                          
                        </thead>
                    </table>   
                     <input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
    </div>
    <?php
if($_POST['jenis']=='setuju'){
	$data = array("status" => 1);
	$db->update("am_deployed",$data,"ID_DEPLOY='$_POST[id]'");
	//=====approve============
	$masuk=$db->select("am_deployed","*","ID_DEPLOY='$_POST[id]'");
	foreach($masuk as $masukin)
	$max=$db->select("am_deployed","max(ID_DEPLOY)as id");
	foreach($max as $val){}
		$id=$val['id']+1;
		$tgl=date("Y-m-d H:i:s");
	$data = array( 
						'ID_DEPLOY' => $id, 
						'ID_ALOKASI' => $masukin['ID_ALOKASI'],
						'ID_AMASSET' => $masukin['ID_AMASSET'],
						'DEPLOY_DATE' => $tgl,
						'STAMPDATE' => $masukin['STAMPDATE'],
						'DEPLOY_KETERANGAN' => $masukin['REQDEPLOY_KETERANGAN'],
						'DEPLOY_PEGAWAI' => $masukin['REQDEPLOY_PEGAWAI'],
						'STATUS' => '1',
						);
	$exec= $db->insert("am_deployed", $data);
	//=====po=================
					
	
	echo "<script>window.location='index.php?x=undeployed'</script>";
}
if($_POST['jenis']=='tolak'){
	$data = array("status" => 2);
	$db->update("am_reqdeploy",$data,"ID_REQDEPLOY='$_POST[id]'");
	//=====approve============
	$masukin=$db->select("am_reqdeploy","*","ID_REQDEPLOY='$_POST[id]'");
	foreach($masukin as $masukinyuk)
	$max=$db->select("am_undeployed","max(ID_UNDEPLOY)as id");
	foreach($max as $val){}
		$id=$val['id']+1;
			$tgl=date("Y-m-d H:i:s");
	$data = array( 
						'ID_UNDEPLOY' => $id, 
						'ID_ALOKASI' => $masukinyuk['ID_ALOKASI'],
						'ID_AMASSET' => $masukinyuk['ID_AMASSET'],
						'UNDEPLOY_DATE' => $tgl,
						'UNDEPLOY_KETERANGAN' => $masukinyuk['REQDEPLOY_KETERANGAN'],
						'UNDEPLOY_PEGAWAI' => $masukinyuk['REQDEPLOY_PEGAWAI'],
						);
	$exec= $db->insert("am_undeployed", $data);	
	echo "<script>window.location='index.php?x=undeployed'</script>";
}
?>
