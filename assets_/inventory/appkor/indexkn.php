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
		<form action="index.php?x=appkor" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Permintaan Koreksi Harga</h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                            <tr>
                                <td width="15%">No Koreksi</td>
                              	<td width="30%">Tanggal</td>
                                <td width="10px">Jenis</td>
                                <td width="30%">Nama Pelanggan</td>
                                <td width="15%">#</td>
                            </tr>
                        </thead>
                    </table>   
                    <?php
                    $exp=explode("/",$_GET['id']);
					$periode="_".intval(substr($exp[2],4,2)).substr($exp[2],0,4);
						$kon=$db->select("tx_prp a left join m_supplier b on a.id_supp=b.id_supp","a.*,b.pkp","a.no_prp='$_GET[id]'");	
						foreach($kon as $konval){}			
					?>                 
		   			<input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=appkor" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Koreksi</h5>
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
</form>
<?php
if($_POST['jenis']=='setuju'){
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 9,
						'level' => 1,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	//=====piu=================
	foreach($db->select("tx_koreksi_piutang","*","no_koreksi='$_POST[id]'")as $vals);
	$tgl=date('Y-m-d');
	$nofp=$db->nourut('no_faktur_pajak', 'tx_piutang', 'FP', sprintf("%02s", $vals['id_cabang']), $tgl);
	$nofj=$db->nourut('no_faktur_jual', 'tx_piutang', 'FJ', sprintf("%02s", $vals['id_cabang']), $tgl);
	$piut=$db->select("tx_piutang","*","no_ref='$vals[no_ref]' ORDER BY id_piutang DESC limit 0,1");
	foreach($piut as $tang){}
		if($vals['jenis']==0){
			$fjn=$tang['no_faktur_jual'];
			$fpn=$tang['no_faktur_pajak'];	
		}else{
		  if($vals['jenis']==1 && $vals['type']==0){	
				$fjn=$nofj;
				$fpn=$nofp;
			}elseif($vals['jenis']==1 && $vals['type']==1){
				$fjn=$tang['no_faktur_jual'];
				$fpn=$tang['no_faktur_pajak'];	
		  }
		}
		if($vals['type']==0){
			$stb=0;
		}if($vals['type']==1){
			$stb=$tang['status_bayar'];
		}
	    //=============================piutang=========================================
		if(($vals['type']==0 && $tang['status_bayar']==0) || ($vals['type']==1 && $tang['status_bayar']==0) || ($vals['type']==1 && $tang['status_bayar']==0) || ($vals['type']==0 && $tang['status_bayar']==1)){
			$ret = array( 
					'status' => 0,
					);
			$exc= $db->update("tx_piutang",$ret,"no_ref='$vals[no_ref]'");
			
			$idp=$db->idurut("tx_piutang","id_piutang");
			$dataj = array(
				'id_piutang' => $idp,
				'no_faktur_jual' => $fjn, 
				'no_faktur_pajak' => $fpn,
				'no_ref' => $vals['no_ref'],
				'status' => 1,
				'tgl' => $tgl,
				'total_piutang' => $vals['total'],
				'id_cus' => $vals['id_cus'],
				'id_user' => $_SESSION['ID_LOGIN'],
				'tempo_normal' => $tang['tempo_normal'], 
				'tempo_tambahan' => $tang['tempo_tambahan'],		
				'jenis_jual' => $tang['jenis_jual'], 
				'jenis_kirim' => $tang['jenis_kirim'], 
				'status_bayar' => $stb, 
				'id_cabang' => $tang['id_cabang'],
				'n_tempo_n' => $tang['n_tempo_n'], 
				'n_tempo_t' => $tang['n_tempo_t'],
				'stampdate' => date("Y-m-d H:i:s"),
				);
			$exc= $db->insert("tx_piutang",$dataj);
		//===============update===================//
		//end piu
		}else{
			$idp=$db->idurut("tx_piutang_kndn","id_kndn");
			$dataj = array(
				'id_kndn' => $idp,
				'no_faktur_jual' => $fjn, 
				'no_faktur_pajak' => $fpn,
				'no_ref' => $vals['no_ref'],
				'status' => 0,
				'tgl' => $tgl,
				'total_piutang' => $tang['total_piutang'],
				'total_kndn' => $vals['total']-$tang['total_piutang'],
				'id_cus' => $vals['id_cus'],
				'id_user' => $_SESSION['ID_LOGIN'],
				'jenis_trans' => $vals['type'], 
				'jenis_koreksi' => $vals['jenis'],		
				'jenis_jual' => $tang['jenis_jual'], 
				'status_bayar' => 0, 
				'id_cabang' => $tang['id_cabang'],
				'stampdate' => date("Y-m-d H:i:s"),
				'n_tempo_n' => $tang['n_tempo_n'], 
				'n_tempo_t' => $tang['n_tempo_t'],
				'tempo_normal' => $tang['tempo_normal'], 
				'tempo_tambahan' => $tang['tempo_tambahan'],		
				'jenis_kirim' => $tang['jenis_kirim'],
				'no_koreksi' => $_POST['id'], 
				);
			$exc= $db->insert("tx_piutang_kndn",$dataj);		
		}
		$data = array(
			"status" => 1,
			"no_fj_baru" => $fjn,
		);
		$db->update("tx_koreksi_piutang",$data,"no_koreksi='$_POST[id]'");
		
	echo "<script>window.location='index.php?x=appkor'</script>";
}
if($_POST['jenis']=='tolak'){
	$data = array("status" => 2);
	$db->update("tx_koreksi_piutang",$data,"no_koreksi='$_POST[id]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 9,
						'level' => 1,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);	
	echo "<script>window.location='index.php?x=appkor'</script>";
}
?>

