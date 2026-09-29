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
    <?php
   // echo $_SESSION['ID_CABANG'];
	?>
    <div class="col-lg-10">
		<form action="index.php?x=app_spj" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Relokasi SPJ</h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                            <tr>
                                <td width="10%">No SO</td>
                              	<td width="10%">No SPJ</td>
                                <td width="15%">Gudang SPJ</td>
                                <td width="15%">Gudang Relokasi</td>
                                <td width="10%">Tgl Relokasi</td>
                                <td width="20%">Nama Barang</td>
                                <td width="10%">Qty DO</td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>

                    </table>   
                                    
		   			<input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
            		<input type="hidden" name="stain" id="stain"  value=""  required>
                    <input type="hidden" name="spjin" id="spjin"  value=""  required>
                    <input type="hidden" name="gudin" id="gudin"  value=""  required>
           			
   		  </div>
			</form>
		</div>
        <div class="col-lg-1">
    </div>  
<?php
if($_POST['jenis']=='setuju'){
	$sta=$_POST['stain']+1;
	$data = array("status" => $sta);
	$db->update("tx_spj_relokasi",$data,"id='$_POST[id]'");
	if($sta==2){
		$ship=$db->select("m_gudang_shipto","shipto_code","id_gudang='$_POST[gudin]' limit 0,1");
		foreach($ship as $vl){}
		
		$data = array(
			"kode_shipto" => $vl['shipto_code']
		);
		$db->update("tx_rilis_dtl",$data,"no_spj='$_POST[spjin]'");	
	}
	
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['spjin'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 2,
						'level' => $sta,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	
	
	echo "<script>window.location='index.php?x=app_spj'</script>";
}
if($_POST['jenis']=='tolak'){
	$sta=$_POST['stain']+1;
	$data = array("status" => 3);
	$db->update("tx_spj_relokasi",$data,"id='$_POST[id]'");
	
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['spjin'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 2,
						'level' => $sta,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);	
	
	echo "<script>window.location='index.php?x=app_spj'</script>";
}
?>

