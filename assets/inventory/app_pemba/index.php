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
		<form action="index.php?x=app_pemba" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View <?=$title?></h5>

					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                        <tr>
                        </tr>
                            <tr>
                                <td width="15%">Supplier</td>
                              	<td width="10%">No PT</td>
                                <td width="10%">Tanggal</td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>
                    </table>   
                                    
		   			
           			
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=app_pemba" name="formku" id="formku" method="post">
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
	//die();
	foreach($_POST['no_billing'] as $key => $val){
		$kmtg=$db->select("m_klaim_ktg ORDER BY tgl_berlaku desc LIMIT 1","*");
		foreach($kmtg as $kmt){}
		$se=$db->select("tx_order_tagihan_kd_tmp","*","digunakan_bill='$val'");
		foreach($se as $sel){
				$data = array( 
						'status' => 1,
						'digunakan_bill' => $sel['digunakan_bill'],
						'id_claim_ktg' => $kmt['id']
						);
						
				if($sel['urut']!="")
				{
				$where="no_spj='$sel[no_spj]' and no_billing='$sel[no_billing]' and urut='$sel[urut]'";
				}else{
				$where="no_spj='$sel[no_spj]' and no_billing='$sel[no_billing]'";
				}
				$db->update("tx_order_tagihan_kd",$data,$where);
			}
		}
	
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_order_tagihan_kd_tmp",$where);	
	
	$data = array( 
						'status' => 2,
						);	
	$db->update("tx_order_tagihan",$data,"no_pt='$_POST[links]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 17,
						'level' => 1,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	echo "<script>window.location='index.php?x=app_pemba'</script>";
}
if($_POST['jenisnya']=='tolak'){
	$data = array("status" => 4);
	$db->update("tx_order_tagihan",$data,"no_pt='$_POST[links]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 17,
						'level' => 1,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);
		
	echo "<script>window.location='index.php?x=app_pemba'</script>";
}

if($_POST[aksi]=='hapus'){
	$where = array("id" => $_POST['id2']);
	$db->delete("tx_order_tagihan_kd_tmp",$where);
	echo "<script>window.location='index.php?x=app_pemba&id=$_POST[links]'</script>";
}

?>

