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
		<form action="index.php?x=app_pemba2" id="form_index" method="post">
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
         <form class="form-horizontal" action="index.php?x=app_pemba2" name="formku" id="formku" method="post">
		<div class="col-lg-6">
				<div class="panel panel-flat">
                	
					<div class="panel-heading">
						<h5 class="panel-title">View Detil <?=$title?></h5>
                        <?php 
						
						$aa = explode("_",$_GET['id']);						
						if($aa[0]!="" && $aa[1]!="3" && $aa[1]!="1"){?>
                        <!--<a href='javascript:void(0)' onClick="apptolak('<?=$_GET[id]?>')">-->
                        <a href='javascript:void(0)' onClick="apptolak('<?=$aa[0]?>')">
                        <input style="float:right;width:70px;" value="Tolak" class="btn btn-danger" readonly></a>	
                        
                        <!--<a href='javascript:void(0)' onClick="appsetuju('<?=$_GET[id]?>')">-->
                        <a href='javascript:void(0)' onClick="appsetuju('<?=$aa[0]?>')">
                        <input style="float:right;width:70px;" value="Terima" class="btn btn-primary" readonly></a> 
						<?php 
						}else{ 						
						?>
                        
                        <?php } ?>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	
				  <div class="panel-body">
                   				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Permintaan</b>
                                        <!--&nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b>-->
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$aa['0']?>
                                  
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
	foreach($_POST['app'] as $key => $val){
	if($val!=""){
	$id=$db->idurut("tx_order_tagihan_bayar","id");
	if($_POST['total'][$key]!='0'){
	$data = array( 
						'id' => $id,
						'no_pt' => $_POST['no_pt'],
						'id_user' => $_SESSION['ID_LOGIN'],
						'no_billing' => $_POST['no_billing'][$key],
						'total' => str_replace(",","",$_POST['total'][$key]),
						'dibayar' => str_replace(",","",$_POST['dibayar'][$key]),
						'no_spj' => $_POST['no_spj'][$key],
						'id_bill_dtl' => $val
						);
	$db->insert("tx_order_tagihan_bayar",$data);
		}
	}
	//die();
	$data = array("status" => 3);
	$db->update("tx_order_tagihan",$data,"no_pt='$_POST[id]'");
	
	$data = array("status" => 1);
	$db->update("tx_order_tagihan_dk",$data,"no_spj='$val' and no_billing='".$_POST['no_billing'][$key]."'");
	
	
	
	
	}
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
	echo "<script>window.location='index.php?x=app_pemba2'</script>";
}

if($_POST['jenisnya']=='tolak'){

	foreach($_POST['app'] as $key => $val){
	$data = array("status" => 4);
	$db->update("tx_order_tagihan_dtl",$data,"id_bill_dtl='$val'");
	}
	
	
	$cek=$db->select("tx_order_tagihan_dtl","count(id_dtl)","no_pt='$_POST[id]' and status='4'");
	foreach($cek as $ca){}
	
	$cek1=$db->select("tx_order_tagihan_dtl","count(id_dtl)","no_pt='$_POST[id]'");
	foreach($cek1 as $ca1){}
	if($ca==$ca1){
		$data = array("status" => 4);
		$db->update("tx_order_tagihan",$data,"no_pt='$_POST[id]'");	
	}
	
	
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
	echo "<script>window.location='index.php?x=app_pemba2'</script>";
}
?>

