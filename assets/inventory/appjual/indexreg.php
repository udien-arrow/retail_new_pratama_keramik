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
		<form action="index.php?x=appjualreg" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Permintaan Penjualan</h5>
                       <?php
                        if($dtv['level']==2){?>
					   
                        <div class="heading-elements">
                        <ul class="icons-list">
		                	    <li>
                              <input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Cetak Biaya" onClick="window.location='index.php?x=appjual_c'"></button></li>
						</ul>
                        </div>
                        <?php }?>
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
         <form class="form-horizontal" action="index.php?x=appjualreg" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
        <?php
			$kon=$db->select("tx_sales_order a left join m_customer b on a.id_cus=b.id_cus","a.*,b.kode_cus","a.no_sales='$_GET[id]'");	
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
</form>
<?php
if($_POST['aksi']=='hapus'){
	$where = array(
		"id_tmp" => $_POST['id2'],
		);	
	$db->delete("tx_sales_biaya_tmp",$where);
	echo "<script>window.location='index.php?x=appjualreg'</script>";
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
	echo "<script>window.location='index.php?x=appjualreg'</script>";
}
if($_POST['jenis']=='setuju'){
	$idcust=explode("_",$_POST['cust']);
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
		echo "<script>window.location='index.php?x=appjualreg'</script>";
	}
	//===============
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
	
	echo "<script>window.location='index.php?x=appjualreg'</script>";
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


