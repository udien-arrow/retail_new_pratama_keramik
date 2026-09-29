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
    <div class="col-lg-6">
		<form action="index.php?x=app_orderpemn" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Permintaan Barang</h5>

					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                        <tr>
                        <td>
                                  <div class="col-lg-12">
                                    
                                    <select name="jenis" id="jenis" class="select" onChange="pindahData(jenis.value)">
                                      <option value="0">---Jenis---</option>
                                      <option value="1" <?php if($_GET['jenis']==1){echo "selected";}?>>Non Semen</option> 
                                      <option value="3" <?php if($_GET['jenis']==3){echo "selected";}?>>Semen</option>
                                      <!--<option value="2" <?php //if($_GET['jenis']==2){echo "selected";}?>>Transit Gudang</option>-->    
                                    </select>
                        </div> 
                        </td>
                        </tr>
                            <tr>
                                <td width="15%">No PU</td>
                              	<td width="10%">Kepada</td>
                                <td width="10%">Tanggal</td>
                                <td width="20%">Distrik</td>
                                <td width="25%">Gudang Penerima</td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>
                    </table>   
                                    
		   			
           			
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=app_orderpemn" name="formku" id="formku" method="post">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Permintaan Barang</h5>
                        <?php if($_GET['id']==""){}else{ ?>
                        <a href='javascript:void(0)' onClick="apptolak('<?=$_GET[id]?>')">
                        <input style="float:right;width:70px;" value="Tolak" class="btn btn-danger" readonly></a>	
                        
                        <a href='javascript:void(0)' onClick="appsetuju('<?=$_GET[id]?>')">
                        <input style="float:right;width:70px;" value="Terima" class="btn btn-primary" readonly></a>
                        <?php } ?>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	
				  <div class="panel-body">
                   				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Permintaan</b>
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
        <input type="hidden" name="id" id="id"  value=""  required>
        <input type="hidden" name="jenisgg" id="jenisgg"  value="<?=$_GET['jenis']?>"  required>
     
</form>
<?php
if($_POST['jenisnya']=='setuju'){
	if($_POST['jenisgg']==1){
	foreach($_POST['idnya'] as $key => $val){
	$data = array("qty" => $_POST['editnya'][$key]);
	$db->update("tx_order_dtl",$data,"no_order='$_POST[id]' and id_barang='".$_POST['idnya'][$key]."'");
		}
	}
	if($_POST['jenisgg']==3){
	foreach($_POST['idnya'] as $key => $val){
	$data = array("qty" => $_POST['editnya'][$key]);
	$db->update("tx_order_dtl",$data,"no_order='$_POST[id]' and id_barang='".$_POST['idnya'][$key]."' and tgl_kirim='".$_POST['tglkim'][$key]."'");
		}	
	}
	$data = array("status" => 0);
	$db->update("tx_order",$data,"no_order='$_POST[id]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 1,
						'level' => 1,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	echo "<script>window.location='index.php?x=app_orderpemn'</script>";
}
if($_POST['jenisnya']=='tolak'){
	$data = array("status" => 4);
	$db->update("tx_order",$data,"no_order='$_POST[id]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 1,
						'level' => 1,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);
		
	echo "<script>window.location='index.php?x=app_orderpemn'</script>";
}
?>

