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
    <div class="col-lg-10">
		<form action="index.php?x=appkorpiutang" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Permintaan Koreksi Piutang</h5>
					</div>
					  <table  class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            
                           
                            <tr>
                                <th width="20%">No Koreksi</th>
                                <th width="10%">Tgl</th>
                              	<th width="10%">Jenis</th>
                                
                                <th width="20%">Pelanggan</th>
                                <th width="10%">No Faktur</th>
                                <th width="10%">Total Awal</th>
                                <th width="10%">Total Ganti</th>
                                <th width="15%">Account</th>
                                <th width="15%">#</th>
                            </tr>
                             
                        </thead>
                        <?php 
						$co=$db->select("v_koreksi_piutang2","*","status='0' and jenis='0'");
						$no=1;
						foreach($co as $stp){
						?>
							<tr>
                              <th align="left"><?php echo $stp['no_koreksi'];?></th>
                              <th align="left"><?php echo $stp['tgl_koreksi'];?></th>
                              <th align="left"><?php if($stp['jenis']==0){
								$d="Bulan Berjalan";
								}elseif($stp['jenis']==1){
								$d="Bulan Lalu";	
								}
								echo $d;
								?></th>
                              <th align="left"><?php echo $stp['nama_usaha'];?></th>
                              <th align="left"><?php echo $stp['no_fj'];?></th>
                              <th align="left"><?php echo number_format($stp['total_sebelumnya']);?></th>
                              <th align="left"><?php echo number_format($stp['total']);?></th>
                              <th align="left">
                              <select name="pemb[]" id="pemb<?=$no?>" class="select-search">
                                  <?php 
								  $cc=$db->select("ak_acc","account,description","type in ('6','5') and post_flag='1'");  
								  foreach($cc as $dtt){
									?>
                                  <option value="<?=$dtt['account']?>"><?=$dtt['account'].' - '.$dtt['description']?></option>
                                  <?php 
									}
									?>
                                </select>
                              <input type="hidden" name="nokor[]" id="nokor<?=$no?>"  value="<?php echo $stp['no_koreksi'];?>"  required></th>
                              <th align="left">
                              <ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick="appsetuju('<?=$no?>')" class='icon-folder-check' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick="apptolak('<?=$stp['no_koreksi']?>')" class=' icon-folder-remove' style='cursor:pointer'></a></li>
			</ul>
                              </th>
                            </tr>
                          <?php 
						  $no++;
						  }?>  
                    </table> 
                    <input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			 <input type="hidden" name="pemb" id="pemb"  value=""  required>
   		  </div>
			</form>
		</div>
        <!-- <form class="form-horizontal" action="index.php?x=appkorpiutang" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
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
											//include("keranjang_v.php");
											?> 
                                
                                </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
-->
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
	foreach($db->select("tx_koreksi","*","no_koreksi='$_POST[id]'")as $vals);
	$tgl=date('Y-m-d');
	//$nofp=$db->nourut('no_faktur_pajak', 'tx_piutang', 'FP', sprintf("%02s", $vals['id_cabang']), $tgl);
	foreach($db->select("m_fakturpajak","no_faktur","status=0 order by no_faktur asc limit 1")as $dtfp);
	$nofp=$dtfp['no_faktur'];
	
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
				//set fkturpjak
				$data5 = array( 
					'status' => 1, 
					'id_cabang' => $tang['id_cabang'], 
					'no_spj' => $vals['no_ref'], 
					);
				$exec= $db->update("m_fakturpajak", $data5,"no_faktur='$nofp'");
				
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
		include("jurnal.php");
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
			$idp=$db->idurut("tx_piutang","id_piutang");
			$dataj = array(
				'id_piutang' => $idp,
				'no_faktur_jual' => $fjn, 
				'no_faktur_pajak' => $fpn,
				'no_ref' => $vals['no_ref'],
				'status' => 1,
				'tgl' => $tgl,
				'total_piutang' => $vals['total']-$tang['total_piutang'],
				'id_cus' => $vals['id_cus'],
				'id_user' => $_SESSION['ID_LOGIN'],
				'tempo_normal' => $tang['tempo_normal'], 
				'tempo_tambahan' => $tang['tempo_tambahan'],		
				'jenis_jual' => $tang['jenis_jual'], 
				'jenis_kirim' => $tang['jenis_kirim'], 
				'status_bayar' => 0, 
				'id_cabang' => $tang['id_cabang'],
				'n_tempo_n' => $tang['n_tempo_n'], 
				'n_tempo_t' => $tang['n_tempo_t'],
				'stampdate' => date("Y-m-d H:i:s"),
				'jenis_piutang' => 1,
				'no_koreksi' => $_POST['id'],
				'type' => $vals['type'], 
				'jenis' => $vals['jenis'],	
				);
			$exc= $db->insert("tx_piutang",$dataj);	
		}
		$data = array(
			"status" => 1,
			"no_fj_baru" => $fjn,
		);
		$db->update("tx_koreksi",$data,"no_koreksi='$_POST[id]'");
		
	echo "<script>window.location='index.php?x=appkorpiutang'</script>";
}
if($_POST['jenis']=='tolak'){
	$data = array("status" => 2);
	$db->update("tx_koreksi",$data,"no_koreksi='$_POST[id]'");
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
	echo "<script>window.location='index.php?x=appkorpiutang'</script>";
}
?>

