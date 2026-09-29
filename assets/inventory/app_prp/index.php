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
		<form action="index.php?x=app_prp" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Permintaan Pembelian</h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <td width="15%">No PP</td>
                              	<td width="30%">Kepada</td>
                                <td width="10px">Tanggal</td>
                                <td width="30%">Kirim Ke</td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>
                    </table>   
                    <?php
                    $exp=explode("/",$_GET['id']);
					$periode="_".intval(substr($exp[2],4,2)).substr($exp[2],0,4);
						$kon=$db->select("tx_prp a left join m_supplier b on a.id_supp=b.id_supp","a.*,b.pkp","a.no_prp='$_GET[id]'");	
						foreach($kon as $konval){}			
					?>                 
		   			
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=app_prp" name="formku" id="formku" method="post">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Permintaan Pembelian</h5>
                        <?php if($_GET['id']==""){}else{ ?>
                        <a href='javascript:void(0)' onClick="apptolak('<?=$_GET[id]?>')">
                        <input style="float:right;width:70px;" value="Tolak" class="btn btn-danger" readonly></a>
                        
                        <a href='javascript:void(0)' onClick="apptolakrev('<?=$_GET[id]?>')">
                        <input style="float:right;width:95px;" value="Tolak Revisi" class="btn btn-success" readonly></a>	
                        
                        <a href='javascript:void(0)' onClick="appsetuju('<?=$_GET[id]?>','<?=$_GET[no]?>')">
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
                    <input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="jenis_p" id="jenis_p"  value="<?=$konval['jenis_p']?>"  required>
				</div>					
		</div>
</form>
<?php
if($_POST['jenis']=='setuju'){
	$st=1;
	$data = array("status" => 1);
	$db->update("tx_prp",$data,"no_prp='$_POST[id]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 0,
						'level' => 1,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	//=====po=================
	$prp=$db->select("tx_prp","*","no_prp='$_POST[id]'");
	foreach($prp as $prpval){
		$idgen=$db->nourut('no_po', 'tx_po', 'PO', sprintf("%02s",$_SESSION['ID_CABANG']), date("Y-m-d"));
		$id=$db->idurut("tx_po","id_po");
		$data = array( 
					'id_po' => $id, 
					'no_po' => $idgen, 
					'id_prp' => $prpval['id_prp'],
					'no_prp' => $prpval['no_prp'],
					'tgl_po' => date("Y-m-d H:i:s"),
					'duedate' => $prpval['duedate'],
					'deliverydate' => $prpval['deliverydate'],
					'jumlah' => $prpval['total'],
					'status' => $st,
					'id_supp' => $prpval['id_supp'],
					'id_gudang' => $prpval['id_gudang'],
					'id_cabang' => $prpval['id_cabang'],
					'id_user' => $prpval['id_user'],
					'disc_persen' => $prpval['disc_persen'],
					'disc_jumlah' => $prpval['disc_jumlah'],
					'id_valuta' => $prpval['id_valuta'],
					'jenis_p' => $prpval['jenis_p'],
					'kurs' => $prpval['kurs'],
					'acc_code' => $prpval['acc_code'],	
					'shipto_code' => $prpval['shipto_code'],	
					'st_upload' => $prpval['st_upload'],	
					'jenis_kirim' => $prpval['jenis_kirim'],	
					'id_daerah' => $prpval['id_daerah'],	
					);
		$exec= $db->insert("tx_po", $data);
					
	}
	echo "<script>window.location='index.php?x=app_prp'</script>";
}
if($_POST['jenis']=='tolak'){
	$data = array("status" => 2);
	$db->update("tx_prp",$data,"no_prp='$_POST[id]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 0,
						'level' => 1,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);	
	echo "<script>window.location='index.php?x=app_prp'</script>";
}
if($_POST['jenis']=='tolakrev'){
	$data = array("status" => 8);
	$db->update("tx_prp",$data,"no_prp='$_POST[id]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 0,
						'level' => 1,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);	
	echo "<script>window.location='index.php?x=app_prp'</script>";
}
?>

