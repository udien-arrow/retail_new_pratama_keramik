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
		<form action="index.php?x=app_pum" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View <?=$title?></h5>

					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                        <tr>
                        </tr>
                            <tr>
                                <td width="15%">Pegawai</td>
                                <td width="10%">Cabang</td>
                              	<td width="10%">No PUM</td>
                                <td width="10%">Tanggal</td>
                                <td width="10%">Total</td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>
                    </table>   
                                    
		   			
           			
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=app_pum" name="formku" id="formku" method="post">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil <?=$title?></h5>
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
                                        <input type="hidden" name="links" value="<?=$_GET['id']?>">
                                  
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
        <input type="hidden" name="id2" id="id2"  value=""  required>
        <input type="hidden" name="aksi" id="aksi"  value=""  required>
        <input type="hidden" name="jenisgg" id="jenisgg"  value="<?=$_GET['jenis']?>"  required>
     
</form>
<?php
if($_POST['jenisnya']=='setuju'){
	$data = array( 
						'STATUS' => 1,
						);	
	$db->update("ak_pum",$data,"NO_PUM='$_POST[links]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['links'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 17,
						'level' => 1,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	echo "<script>window.location='index.php?x=app_pum'</script>";
}
if($_POST['jenisnya']=='tolak'){
	$data = array( 
						'STATUS' => 4,
						);	
	$db->update("ak_pum",$data,"NO_PUM='$_POST[links]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['links'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 17,
						'level' => 1,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);
	echo "<script>window.location='index.php?x=app_pum'</script>";
}

if($_POST[aksi]=='hapus'){
	$where = array("id" => $_POST['id2']);
	$db->delete("tx_order_tagihan_kd_tmp",$where);
	echo "<script>window.location='index.php?x=app_pemba&id=$_POST[links]'</script>";
}

?>

