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
    <!--<div class="col-lg-1">
    </div>-->
    <div class="col-lg-6">
		<form action="index.php?x=app_swda" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Approve Switch DA</h5>

					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                        
                          <tr>
                                <td width="15%">No SPJ</td>
                              	<td width="10%"> Pelanggan</td>
                                <td width="10%">Shipto</td>
                                <td width="20%">Pelanggan Switch</td>
                                <td width="25%">Shipto Switch</td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>
                    </table>   
                   
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=app_swda" name="formku" id="formku" method="post">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Switch</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                   <?php
                   foreach($db->select("tx_switch_history","*","no_spj='$_GET[id]'")as $dt2);
				   foreach($db->select("m_customer","kode_cus","id_cus='$dt2[id_cus_to]'")as $konval);
				   $par=$dt2['id_cus_to'].'_'.$konval['kode_cus'];	
				   ?> 
                  <div class="panel-body">
                  <div align="right">
                  <button type="button" style="height:25px; line-height: 0;" class="btn btn-info btn-sm" name="setuju" onClick="appsetuju()">Setuju</button>
                   <button type="button" style="height:25px; line-height: 0;" class="btn btn-info btn-sm" name="tolak" onClick="apptolak()">Tolak</button>
                   <button type="button" style="height:25px; line-height: 0;" class="btn btn-info btn-sm" data-toggle="modal" id="mod" onClick="pel('<?=$par?>')" data-target="#datapelanggan">Limit Plafon</button> 
                   	</div>
                    			<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No SPJ</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b>
                                  
                                </div>
                                
                               
                                <div class="form-group">
                               			 <?php
											include("keranjang_v.php");
											?> 
                                
                                </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
        <input type="hidden" name="jenisnya" id="jenisnya"  value=""  required>
        <input type="hidden" name="id" id="id"  value="<?=$_GET['id']?>"  required>
       
</form>
<?php
if($_POST['jenisnya']=='setuju'){
	//============rilis=========
	foreach($db->select("tx_switch_history","*","no_spj='$_POST[id]' and status=0")as $dtku);
	foreach($db->select("v_spj_rilis","no_so","no_spj='$_POST[id]'")as $so);
	
	//======po===================
	/*$data = array(
		"id_daerah" => $dtku['id_cus_to'],
		"shipto_code" => $dtku['shipto_code_to']
		);
			
	$db->update("tx_po",$data,"no_so='$so[no_so]'");*/
	//=========================
	$data = array("kode_shipto" => $dtku['shipto_code_to']);
	$db->update("tx_rilis_dtl",$data,"no_spj='$_POST[id]'");
	//=======================
	$data = array("status" => 1);
	$db->update("tx_switch_history",$data,"no_spj='$_POST[id]'");
	
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 12,
						'level' => 1,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	echo "<script>window.location='index.php?x=app_swda'</script>";
}
if($_POST['jenisnya']=='tolak'){
	$data = array("status" => 2);
	$db->update("tx_switch_history",$data,"no_spj='$_POST[id]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 12,
						'level' => 1,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);
	echo "<script>window.location='index.php?x=app_swda'</script>";
}
?>

<div id="datapelanggan" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h6 class="modal-title">Plafon Kredit</h6>
							</div>
							<div class="modal-body" id="hahaha">
                            
															
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								
							</div>
						</div>
					</div>
</div>