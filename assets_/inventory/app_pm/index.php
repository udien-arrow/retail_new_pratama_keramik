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
    <div class="col-lg-7">
		<form action="index.php?x=app_pm" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Data Permintaan Penerimaan(-SO)</h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                            <tr>
                                <td width="10%">No Order</td>
                              	<td width="10%">Tgl</td>
                                <td width="10%">No SPJ</td>
                                <td width="20%">Gudang</td>
                                <td width="20%">Supplier</td>
                                <td width="10%">#</td>
                            </tr>
                        </thead>
                    </table>           
		   			<!--
                    <input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
            		<input type="hidden" name="stain" id="stain"  value=""  required>
                    <input type="hidden" name="no_orderin" id="no_orderin"  value=""  required>-->
                   
   		  </div>
			</form>
		</div>
        <form class="form-horizontal" action="index.php?x=app_pm" name="form_index2" id="form_index2" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Permintaan (-SO)</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	
				  <div class="panel-body">
                   				
                                <div class="form-group">
                                	<div class="col-lg-8">
                                        &nbsp;&nbsp;&nbsp;<b>No Permintaan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b>
                     <?php
                     $da=$db->select("tx_bm_order","*","no_order='$_GET[id]'");
					 foreach($da as $vda){}
					 ?>                   
                    <input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value="<?=$vda['id_order']?>"  required>
            		<input type="hidden" name="stain" id="stain"  value="<?=$vda['status']?>"  required>
                    <input type="hidden" name="no_orderin" id="no_orderin"  value="<?=$vda['no_order']?>"  required>
                                  </div>
                                  <div class="col-lg-4">
                                       
                                       <input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Setuju & Simpan" onClick="appsetuju()"></button>
                                  </div>
                                </div>
                                
                               
                                <div class="form-group">
                               			 <?php
											include("keranjang_v.php");
											?> 
                                
                                </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form> 
<?php
if($_POST['jenis']=='setuju'){
	//=====head============
	$sta=$_POST['stain']+1;
	$data = array(
		"status" => $sta
		);	
	$db->update("tx_bm_order",$data,"id_order='$_POST[id]'");
	//=====head dtl============
	$sta=$_POST['stain']+1;
	//=====head dtl============
	foreach($_POST['id_bar2'] as $key => $val){
		$data = array(
			"harga" => $_POST['harga2'][$key]
			);	
		$db->update("tx_bm_order_dtl",$data,"id_barang='$val' and no_order='$_POST[no_orderin]'");
	}
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['no_orderin'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 3,
						'level' => $sta,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	//===============
	
	echo "<script>window.location='index.php?x=app_pm'</script>";
}
if($_POST['jenis']=='tolak'){
	$sta=$_POST['stain']+1;
	$data = array("status" => 3);
	$db->update("tx_bm_order",$data,"id_order='$_POST[id]'");
	
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['no_orderin'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 3,
						'level' => $sta,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);	
	
	echo "<script>window.location='index.php?x=app_pm'</script>";
}
?>

