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
		<form action="index.php?x=app_pengbum" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>

					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                        <tr>
                        <td>
                                  <div class="col-lg-12">
                                    
                                    <select name="jenis" id="jenis" class="select" onChange="pindahData(jenis.value)">
                                      <option value="0">---Jenis---</option>
                                      <option value="4" <?php if($_GET['jenis']==4){echo "selected";}?>>Alat</option> 
                                      <option value="5" <?php if($_GET['jenis']==5){echo "selected";}?>>Sparepart</option>
                                      <!--<option value="2" <?php //if($_GET['jenis']==2){echo "selected";}?>>Transit Gudang</option>-->    
                                    </select>
                        </div> 
                        </td>
                        </tr>
                            <tr>
                                <td width="15%">No</td>
                              	<td width="10%">Kepada</td>
                                <td width="10%">Tanggal</td>
                                <td width="20%">User</td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>
                    </table>   
                                    
		   			
           			
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=app_pengbum" name="formku" id="formku" method="post">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Permintaan Penggunaan Barang Umum</h5>
                        <?php if($_GET['id']==""){}else{ ?>
                        <a href='javascript:void(0)' onClick="apptolak('<?=$_GET[id]?>')">
                        <input style="float:right;width:70px;" value="Tolak" class="btn btn-danger" readonly></a>	
                        
                        <a href='javascript:void(0)' onClick="appsetuju('<?=$_GET[id]?>')">
                        <input style="float:right;width:70px;" value="Terima" class="btn btn-primary" readonly></a>
                        <?php } ?>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	
				  <div class="panel-body">
                  <?php 
				  $s=$db->select("tx_pengbum","*","no_pengbum='$_GET[id]'");
				  foreach($s as $s){}
				  ?>
                   				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Permintaan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b><br>
										&nbsp;&nbsp;&nbsp;<b>Keterangan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$s['ket']?></b>
                                  
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
	foreach($_POST['idnya'] as $key => $val){
	$data = array("qty" => $_POST['editnya'][$key]);
	$db->update("tx_pengbum_dtl",$data,"no_pengbum='$_POST[id]' and id_barang='".$_POST['idnya'][$key]."'");
		}
	$data = array("status" => 1);
	$db->update("tx_pengbum",$data,"no_pengbum='$_POST[id]'");
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 14,
						'level' => 1,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	echo "<script>window.location='index.php?x=app_pengbum&jenis=$_POST[jenisgg]'</script>";
}
if($_POST['jenisnya']=='tolak'){
	$data = array("status" => 2);
	$db->update("tx_pengbum",$data,"no_pengbum='$_POST[id]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 		'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 14,
						'level' => 1,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);
	echo "<script>window.location='index.php?x=app_pengbum&jenis=$_POST[jenisgg]'</script>";
}
?>

