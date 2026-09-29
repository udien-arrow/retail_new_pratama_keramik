<?php 
$dt=$db->select("m_level_app_sales","level","id_jabatan='$_SESSION[ID_JABATAN]'");
foreach($dt as $dtv){}
?>
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
		<form action="index.php?x=appjual" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Permintaan Penjualan</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                          <?php 
						  if($dtv['level']==3){?>
                            <tr>
                                <td width="35%">No Sales Biaya (SB)</td>
                              	<td width="10%">Tanggal</td>
                                <td width="10%">Jenis</td>
                                <td width="5%">#</td>
                            </tr>
                            <?php }else{?>
                            <tr>
                                <td width="15%">No SO</td>
                              	<td width="20%">Gudang Pengirim</td>
                                <td width="5%">Tanggal</td>
                                <td width="10%">Jenis</td>
                                <td width="20%">Kirim Ke</td>
                                <td width="5%">#</td>
                            </tr>
                            <?php }?>
                        </thead>
                    </table>  
                    
                     <input type="hidden" value="" name="tambah_in" id="tambah_in">
                     <input type="hidden" value="" name="no_so_in" id="no_so_in">
		   			
           			<!--<input type="hidden" name="jenis_p" id="jenis_p"  value="<?=$konval['jenis_p']?>"  required>-->
   		  </div>
			</form>
		</div>	  
         <form class="form-horizontal" action="index.php?x=appjual" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
        <?php 
		if($dtv['level']==1){
			$kon=$db->select("tx_sales_order a left join m_customer b on a.id_cus=b.id_cus","a.*,b.kode_cus","a.no_sales='$_GET[id]' and a.id_cabang='$_SESSION[ID_CABANG]'");	
			foreach($kon as $konval){}
			$par=$konval['id_cus'].'_'.$konval['kode_cus'];	
		?>
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Permintaan Penjualan</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<li>
                                
                                <?php 
								//if($konval['status_so']!='1'){
								$tglskr=date("Y-m-d");		
								if($_GET[id]!=''){
								foreach($ak=$db->select("tx_do","count(*)as jum","id_cus='$konval[id_cus]' and tempo_tambahan<'$tglskr'")as $con);
								$ak2=$db->select("tx_do","sum(jumlah_so) as jumlah,jenis_jual,
									case jenis_jual  
									when '1' then (select a.limit_plafon from m_customer_plafon a where a.id_cus='$konval[id_cus]' and a.jenis_plafon=jenis_jual) when '2' then (select a.limit_plafon from m_customer_plafon a where a.id_cus='$konval[id_cus]' and a.jenis_plafon=jenis_jual) end as jumlah_plafon","id_cabang='$_SESSION[ID_CABANG]' and id_cus='$konval[id_cus]' GROUP BY jenis_jual");
									
									foreach($ak2 as $con2){
										if($con2['jenis_jual']==1){
											$sem=$con2['jumlah'];
											$limsem=$con2['jumlah_plafon'];				
										}
										if($con2['jenis_jual']==2){
											$nonsem=$con2['jumlah'];
											$limnonsem=$con2['jumlah_plafon'];				
										}
									
									}
									
									//echo number_format($limsem).'-'.number_format($sem).'<br>';
									//echo number_format($limnonsem).'-'.number_format($nonsem);
								//|| $nonsem>$limnonsem
								if($con['jum']==0  && $limsem>=$sem && $limnonsem>=$nonsem){
									
								?>
                                <button type="button" style="height:25px; line-height: 0;" class="btn btn-info btn-sm" name="setuju" onClick="appsetuju()">Setuju</button>
                                <?php }?>
                                <button type="button" style="height:25px; line-height: 0;" class="btn btn-info btn-sm" name="tolak" onClick="apptolak()">Tolak</button>
                                <?php // }elseif($konval['status_so']=='1'){?>
                               <!-- <button type="button" style="height:25px; line-height: 0;" class="btn btn-info btn-sm" name="setuju" onClick="appsetuju()">Simpan</button>-->
                                
                                <button type="button" style="height:25px; line-height: 0;" class="btn btn-info btn-sm" data-toggle="modal" id="mod" onClick="pel('<?=$par?>')" data-target="#datapelanggan">Limit Plafon</button> 
                                <?php }?>
                                </li>
							</ul>
                            </div>
					</div>
                  <div class="dataTables_wrapper"></div>
                  <div class="panel-body">
                   				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Permintaan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$konval['no_sales']?></b>
                    <input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value="<?=$konval['id_sales']?>"  required>
            		<input type="hidden" name="stain" id="stain"  value="<?=$konval['status_so']?>"  required>
                    <input type="hidden" name="no_orderin" id="no_orderin"  value="<?=$konval['no_sales']?>"  required>
                    <input type="hidden" name="id_cus" id="id_cus"  value="<?=$konval['id_cus']?>"  required>
                    <input type="hidden" name="jenis_jual" id="jenis_jual"  value="<?=$konval['jenis_jual']?>"  required>
                    <input type="hidden" name="id_gudang" id="id_gudang"  value="<?=$konval['id_gudang']?>"  required>
                    <input type="hidden" name="id_cabang" id="id_cabang"  value="<?=$konval['id_cabang']?>"  required>
                   				</div>
                                <div class="form-group">
                               			 <?php
											include("keranjang_v.php");
										  ?> 
                                </div>
                                
                    </div>	
				</div>					
		</div>
		<?php 
		}
		if($dtv['level']==2){?>
        <div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Permintaan Penjualan</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<li>
                                <button type="button" style="height:25px; line-height: 0;" class="btn btn-info btn-sm" name="setuju" onClick="appsetuju()">Simpan</button>
                                <button type="button" style="height:25px; line-height: 0;" class="btn btn-info btn-sm" data-toggle="modal" id="mod2" onClick="muatan(jenisken.value)" data-target="#datamuatan">Cek Muatan</button> 
                                </li>
							</ul>
                            </div>
					</div>
                  <div class="dataTables_wrapper"></div>
                  		<?php 
								include("keranjang.php");
						?>
                        
                        		
				</div>					
		</div>
        <?php }
        if($dtv['level']==3){?>
        <div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Permintaan Penjualan</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<li>
                                <button type="button" style="height:25px; line-height: 0;" class="btn btn-info btn-sm" name="setuju" onClick="appsetuju2()">Simpan</button>
                               
                                </li>
							</ul>
                            </div>
					</div>
                  <div class="dataTables_wrapper"></div>
                  		<?php 
								include("keranjang_bao.php");
						?>		
				</div>					
		</div>
        <?php }?>
</form>
<?php
if($_POST['aksi']=='hapus'){
	$where = array(
		"id_tmp" => $_POST['id2'],
		);	
	$db->delete("tx_sales_biaya_tmp",$where);
	echo "<script>window.location='index.php?x=appjual'</script>";
}
if($_POST['tambah_in']=='ijen'){
	$expl=explode("_",$_POST['no_so_in']);
	$je=$expl[4];
	$aa=$db->select("tx_sales_biaya_tmp","jenis_kirim","id_cabang='$_SESSION[ID_CABANG]' limit 0,1");
	foreach($aa as $cek){}
	if($cek[jenis_kirim]=='' || $cek[jenis_kirim]==$je){
		$id=$db->idurut("tx_sales_biaya_tmp","id_tmp");
		$data = array(
			"id_tmp" => $id,
			"no_so" => $expl[0],
			"id_so" => $expl[1],
			"id_cus" => $expl[3],
			"jenis_kirim" => $expl[4],
			"id_gudang" => $expl[6],
			"jumlah" => $expl[5],
			"id_user" => $_SESSION['ID_LOGIN'],
			"id_cabang" => $_SESSION['ID_CABANG']
			);	
		$db->insert("tx_sales_biaya_tmp",$data);
	}else{
		echo "<script>alert('Jenis Kirim tidak sesuai!');</script>";	
	}
	echo "<script>window.location='index.php?x=appjual'</script>";
}
if($_POST['jenis']=='setuju'){
	//=====head============
	if($_POST['stain']==0){
		$sta=$_POST['stain']+1;
		$data = array(
			"status_so" => $sta
			);	
		$db->update("tx_sales_order",$data,"id_sales='$_POST[id]'");
		//=====approve============
		$id=$db->idurut("m_approving","id");
		$data = array( 
							'id' => $id, 
							'no' => $_POST['no_orderin'],
							'id_login' => $_SESSION['ID_LOGIN'],
							'tanggal' => date("Y-m-d H:i:s"),
							'jenis' => 7,
							'level' => $sta,
							'type' => 0,
							);
		$exec= $db->insert("m_approving", $data);
	}
	//===============
	if($_POST['stain']==1){
		$idh=$db->nourut('no_sb', 'tx_sales_biaya', 'SB', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		$data = array( 
							'no_sb' => $idh, 
							'id_user' => $_SESSION['ID_LOGIN'],
							'tgl' => date("Y-m-d"),
							'stampdate' => date("Y-m-d H:i:s"),
							'status' => 0,
							'jenis_jual' => $_POST['jenis_jual'],
							'id_cabang' => $_POST['id_cabang'],
							);
		$exec= $db->insert("tx_sales_biaya", $data);
		//===================================dtl=============================================
		$kon=$db->select("tx_sales_biaya_tmp","*","id_cabang='$_SESSION[ID_CABANG]' order by id_tmp asc");	
		foreach($kon as $key => $konval){
			$iddtl=$db->idurut("tx_sales_biaya_dtl","id_sb_dtl");
			if($_POST['cust']==$konval['id_cus']){
				$sw=$_POST['switch']; $rt=$_POST['jumlah_retri']; $uj=$_POST['ujs']; 
			}else{
				$sw=0; $rt=0;  $uj=0; 
			}
			$data = array( 
							'id_sb_dtl' => $iddtl, 
							'no_sb' => $idh, 
							'id_so' => $konval['id_so'],
							'no_so' => $konval['no_so'],
							'id_cus' => $konval['id_cus'],
							'id_gudang' => $konval['id_gudang'],
							'id_cabang' => $konval['id_cabang'],
							'biaya_so' => $konval['jumlah'],
							'biaya_retri' => $rt,
							'biaya_switch' => $sw,
							'ujs' => $uj,
							'biaya_lain' => $_POST['bl'][$key],
							'ket' => $_POST['keterangan'][$key],
							'id_jenis_kendaraan' => $_POST['jenisken'],
							'id_supir' => $_POST['supirr'],
							'nama_supir' => $_POST['nama_supir'],
							'nopol' => $_POST['nopol'],
							);
			$exec= $db->insert("tx_sales_biaya_dtl", $data);
			///uphead
			$sta2=$_POST['stain']+1;
			$data = array(
				"status_so" => $sta2
				);	
			$db->update("tx_sales_order",$data,"id_sales='$konval[id_so]'");
			//=====approve============
			$id=$db->idurut("m_approving","id");
			$data = array( 
								'id' => $id, 
								'no' => $konval['no_so'],
								'id_login' => $_SESSION['ID_LOGIN'],
								'tanggal' => date("Y-m-d H:i:s"),
								'jenis' => 7,
								'level' => $sta2,
								'type' => 0,
								);
			$exec= $db->insert("m_approving", $data);
			$where = array(
				"id_tmp" => $konval['id_tmp']
				);	
			$db->delete("tx_sales_biaya_tmp",$where);
			//end
		}
		//===========================================end dtl========================================
		if($_POST['jenis_jual']=='FRA'){
			foreach($_POST['nos'] as $key => $val){
				$idr=$db->idurut("tx_sales_biaya_supir","id");
				$data = array( 
									'id' => $idr, 
									'no_so' => $val,
									'id_cus' => $_POST['idc'][$key],
									'id_barang' => $_POST['bar'][$key],
									'qty' => $_POST['qty'][$key],
									'biaya_supir' => $_POST['bsin'][$key],
									'biaya_bongkar_toko' => $_POST['bmu'][$key],
									);
				$exec= $db->insert("tx_sales_biaya_supir", $data);		
			}
			//biaya bongkar toko
			foreach($_POST['nilai'] as $key => $val){
				$idr=$db->idurut("tx_sales_biaya_r_dtl","id_r_dtl");
				$data = array( 
									'id_r_dtl' => $idr, 
									'no_sb' => $idh,
									'id_cus' => $_POST['cust'],
									'id_retribusi' => $_POST['idret'][$key],
									'nilai' => str_replace(",","",$val),
									);
				$exec= $db->insert("tx_sales_biaya_r_dtl", $data);		
			}
			
		}
	}
	if($_POST['stain']==2){
		$idgen=$db->nourut('no_spb', 'tx_sales_spb', 'SPB', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		$id=$db->idurut("tx_sales_spb","id");
		$data = array( 
				  'id' => $id, 
				  'no_spb' => $idgen, 
				  'tgl' => date("Y-m-d"), 
				  'stampdate' => date("Y-m-d H:i:s"), 
				  'no_ref' => $_POST['no_sb'], 
				  'id_user' => $_SESSION['ID_LOGIN'], 
				  'id_cabang' => $_SESSION['ID_CABANG'], 
				);
		$exec= $db->insert("tx_sales_spb", $data);
		//dtl
		foreach($_POST['so'] as $key => $val){
			/*$id=$db->idurut("tx_sales_spb_tkbm","id_dtl");
			$data = array( 
				  'id_dtl' => $id, 
				  'no_spb' => $idgen, 
				  'no_so' => $_POST['so'][$key], 
				  'jenis' => $_POST['ambil'], 
				  'id_barang' => $_POST['no_sb'], 
				  'qty' => $_POST['qty'][$key], 
				  'nilai' => $_POST['biam'][$key], 
				  'berat' => $_POST['berat'][$key], 
				);
			$exec= $db->insert("tx_sales_spb_tkbm", $data);				*/
			///uphead
			$sta2=$_POST['stain']+1;
			$data = array(
				"status_so" => $sta2
				);	
			$db->update("tx_sales_order",$data,"no_sales='".$_POST['so'][$key]."'");
			//=====approve============
			$ida=$db->idurut("m_approving","id");
			$data = array( 
								'id' => $ida, 
								'no' => $_POST['so'][$key],
								'id_login' => $_SESSION['ID_LOGIN'],
								'tanggal' => date("Y-m-d H:i:s"),
								'jenis' => 7,
								'level' => $sta2,
								'type' => 0,
								);
			$exec= $db->insert("m_approving", $data);
			//end
		}
	}
	
	echo "<script>window.location='index.php?x=appjual'</script>";
}
if($_POST['jenis']=='tolak'){
	$sta=$_POST['stain']+1;
	$data = array("status_so" => 6);
	$db->update("tx_sales_order",$data,"id_sales='$_POST[id]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['no_orderin'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 7,
						'level' => $sta,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);	
	
	echo "<script>window.location='index.php?x=appjual'</script>";
}
?>
<div id="datapelanggan" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h6 class="modal-title">Plafon Kredit</h6>
							</div>
							<div class="modal-body" id="hahaha">
                            
															
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								
							</div>
						</div>
					</div>
</div>
<div id="datamuatan" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h6 class="modal-title">Tampungan Muatan</h6>
							</div>
							<div class="modal-body" id="hahaha2">
                            
															
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								
							</div>
						</div>
					</div>
</div>


