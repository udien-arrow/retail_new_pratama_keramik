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
		<form action="index.php?x=app_orderpemn" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>

					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                        <tr>
                        <th colspan="8">
                        <?php 
						$ce=$db->select("m_pegawai","*","id_pegawai='$_SESSION[ID_PEG]'");
						foreach($ce as $cek){}
						$wp=$db->select("m_level_app_nondagang","*","id_stjabatan='$cek[id_st_jabatan]'");
						foreach($wp as $ggwp){}
						?>
                        <?php 
						if($cek['id_st_jabatan']==2){
						?>
                        <div class="col-md-3">
						<select name="cabang" id="cabang" class="select" onChange="pindahData2(cabang.value)">
                                      <option value="0">---Cabang---</option>
                                      <?php 
									  $cab=$db->select("m_regional a join m_cabang b on a.id_wilayah=b.id_wilayah_pem","*","a.id_pegawai='$_SESSION[ID_PEG]'");
									  foreach($cab as $cabe){ ?>
                                      <option value="<?=$cabe['id_cabang']?>" <?php if($_GET['cab']==$cabe['id_cabang']){echo "selected";}?>><?=$cabe['nama_cabang']?></option> 
                                      <?php } ?>
                                    </select>
                        </div>
                        <?php }
                        else
                      if($cek['id_jabatan']==29 or $cek['id_jabatan']==55){?>
							 <div class="col-md-3">
						<select name="cabang" id="cabang" class="select" onChange="pindahData2(cabang.value)">
                                      <option value="0">---Cabang---</option>
                                      <?php 
									  $cab=$db->select("m_cabang","*");
									  foreach($cab as $cabe){ ?>
                                      <option value="<?=$cabe['id_cabang']?>" <?php if($_GET['cab']==$cabe['id_cabang']){echo "selected";}?>><?=$cabe['nama_cabang']?></option> 
                                      <?php } ?>
                                    </select>
                        </div>
						<?php }
                        else{ ?>
                        <input type="hidden" name="cabang" id="cabang" value="<?=$_SESSION['ID_CABANG']?>">
                        <?php } 
						
						if($cek['id_jabatan']==29){
						$sta=9;	
						}elseif($cek['id_jabatan']==55){
							$sta=10;
						}else{
							$sta=$ggwp['status'];
						}
						
						if($cek['id_jabatan']==29 or $cek['id_jabatan']==55){
						$lev=0;	
						}else{
							$lev=$ggwp['level'];
						}
						
						if($cek['id_jabatan']==29 or $cek['id_jabatan']==55){
						$kode=1;	
						}else{
							$kode=2;
						}
						?>
                        
                        
                        <div class="col-md-3">
                        <input type="hidden" name="st" id="st"  value="<?=$cek['id_st_jabatan']?>"  required>
						<select name="jenis" id="jenis" class="select" onChange="pindahData(jenis.value,st.value,<?=$lev?>,<?=$sta?>,cabang.value,<?=$kode?>)">
                                      <option value="0">---Jenis---</option>
                                      <option value="4" <?php if($_GET['jenis']==4){echo "selected";}?>>Alat</option> 
                                      <option value="5" <?php if($_GET['jenis']==5){echo "selected";}?>>Sparepart</option>
                                    </select>
                        </div>
                        </th>
                        </tr>
                            <tr>
                                <td width="15%">Nomer Order</td>
                              	<td width="10%">Gudang</td>
                                <td width="10%">Tanggal</td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>
                    </table>   
                                    
		   			
           			
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=app_orderpemn" name="formku" id="formku" method="post">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Permintaan Penggunaan Barang Umum</h5>
                        <?php if($_GET['id']==""){}else{ ?>
                        <a href='javascript:void(0)' onClick="apptolak('<?=$_GET[id]?>')">
                        <input style="float:right;width:70px;" value="Tolak" class="btn btn-danger" readonly></a>	
                        
                        <a href='javascript:void(0)' onClick="appsetuju('<?=$_GET[id]?>')">
                        <input style="float:right;width:70px;" value="Terima" class="btn btn-primary" readonly></a>
                        <?php } ?>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	
				  <div class="panel-body">
                  <?php 
				  $s=$db->select("tx_order","*","no_order='$_GET[id]'");
				  foreach($s as $s){}
				  ?>
                   				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Permintaan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b><br>
										&nbsp;&nbsp;&nbsp;<b>Keterangan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$s['ket']?></b>
                                  
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
        <input type="hidden" name="st2" id="st2"  value="<?=$_GET['st']?>"  required>
        <input type="hidden" name="level2" id="level2"  value="<?=$_GET['level']?>"  required>
        <input type="hidden" name="sta2" id="sta2"  value="<?=$_GET['sta']?>"  required>
        <input type="hidden" name="cab2" id="cab2"  value="<?=$_GET['cab']?>"  required>
     
</form>
<?php
if($_POST['jenisnya']=='setuju'){
	$ce=$db->select("m_pegawai","*","id_pegawai='$_SESSION[ID_PEG]'");
	foreach($ce as $cek){}
	$wp=$db->select("m_level_app_nondagang","*","id_stjabatan='$cek[id_st_jabatan]'");
	foreach($wp as $ggwp){}
	$dat=$db->select("tx_order","*","no_order='$_POST[id]'");
	foreach($dat as $ww){}
	
	$us=$db->select("r_user_login a join m_pegawai b on a.id_pegawai=b.id_pegawai","*","a.ID='$ww[id_user]'");
	foreach($us as $use){}
	
	if($ggwp['level']<$ww['level']){
	$l=$ggwp['level']+1;
	}elseif($ggwp['level']==$ww['level'])
	{ $l=$ggwp['level']; 
	}
	
	$jad=$db->select("m_level_app_nondagang","*","level='$l'");
	foreach($jad as $jadi){}
	
	if($ww['status']==$jadi['status']){
		$stu=0;
		}else{
		$stu=$jadi['status'];}
		
		
	if($ww['status']==7 and $use['id_jabatan']==3){
		$stu=9;
		}else
	if($ww['status']==7 and $use['id_jabatan']==4){
		$stu=10;
		}
		
	if($ww['status']==9 and $use['id_jabatan']==3){
		$stu=8;
		}else
	if($ww['status']==10 and $use['id_jabatan']==4){
		$stu=8;
		}
		
		
	
	foreach($_POST['idnya'] as $key => $val){
	$data = array("qty" => $_POST['editnya'][$key]);
	$db->update("tx_order_dtl",$data,"no_order='$_POST[id]' and id_barang='".$_POST['idnya'][$key]."'");
		}
	$data = array("status" => $stu);
	$db->update("tx_order",$data,"no_order='$_POST[id]'");
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 13,
						'level' => 1,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	echo "<script>window.location='index.php?x=app_orderpemn&jenis=$_POST[jenisgg]&st=$_POST[st2]&level=$_POST[level2]&sta=$_POST[sta2]&cab=$_POST[cab2]'</script>";
}
if($_POST['jenisnya']=='tolak'){
	$data = array("status" => 2);
	$db->update("tx_order",$data,"no_order='$_POST[id]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 		'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 13,
						'level' => 1,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);
	echo "<script>window.location='index.php?x=app_orderpemn&jenis=$_POST[jenisgg]&st=$_POST[st2]&level=$_POST[level2]&sta=$_POST[sta2]&cab=$_POST[cab2]'</script>";
}
?>

