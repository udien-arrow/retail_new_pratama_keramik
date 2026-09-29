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
<?php
if($_POST[simpan]){
	$exp=explode("_",$_POST['distrik']);
	$idgudang=$exp[1];
	$iddaerah=$exp[0];
	if($_SESSION['ID_JABATAN']==1){
	$sa=0;	
	}else{
	$sa=3;	
	}
	
	$dttmp=$db->select("tx_order_tmp","id_user,jenis,ke_gudang","id_user='$_SESSION[ID_LOGIN]' group by ke_gudang");
	foreach($dttmp as $valtmp){	
	  if($valtmp['id_user']<>''){
		$idgen=$db->nourut('no_order', 'tx_order', 'RO', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		$id=$db->idurut("tx_order","id_order");
		$data = array( 
					'id_order' => $id, 
					'no_order' => $idgen, 
					'stampdate' => date('Y-m-d H:i:s'),
					'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
					'duedate' => date("Y-m-d",strtotime($_POST['due'])),
					'ket' => $_POST['ket'],
					'id_gudang' => $_SESSION['ID_GUDANG'],
					'id_gudang_tujuan' => 0,
					'id_user' => $valtmp['id_user'],
					'jenis' => $valtmp['jenis'],
					'status' => 0,
					'jenis_kirim' => $_POST['jenkir'],
					'id_cabang' => $_SESSION['ID_CABANG'],
					'shipto_code' => $_POST['shipto'],
					'id_daerah' => $iddaerah,
					'id_plan' => $_POST['plan'],
					);
		$exec= $db->insert("tx_order", $data);
		
		$dttmp2=$db->select("tx_order_tmp","*","id_user='$valtmp[id_user]' and ke_gudang='$valtmp[ke_gudang]'");
		foreach($dttmp2 as $valtmp2){
			$iddtl=$db->idurut("tx_order_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $iddtl, 
					'id_barang' => $valtmp2['id_barang'],
					'tgl_kirim' => $valtmp2['tgl_kirim'],
					'id_order' => $id,
					'no_order' => $idgen,
					'qty' => $valtmp2['qty'],
					'sat' => $valtmp2['sat'],
					'status' => 0,
					);
			$exec= $db->insert("tx_order_dtl", $data);
			
			$where = array(	 "id_user" => $valtmp['id_user'],
							 "ke_gudang" => $valtmp['ke_gudang']);
			$db->delete("tx_order_tmp",$where);
		}
	  }
	}//end if jumlah
			echo "<script>alert('Sukses Simpan Data Dengan Nomer : $idgen'); window.location='index.php?x=order'</script>";
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_order_tmp",$where);
	
	echo "<script>window.location='index.php?x=order&jenis=$_POST[jenis]&gud=$_POST[gud]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_order_tmp",$where);
	echo "<script>window.location='index.php?x=order'</script>";
}else{
	$jum=$db->jumlah_hari($_GET['bulan'],$_GET['tahun']);
	$explo=explode("_",$_GET['tahap']);
	//echo $jum.'_'.$explo[2];
	
?>	
    <div class="col-lg-<?php if($_GET[jenis]=='3'){echo '7';}else{echo '6';}?>">
		<form action="index.php?x=order_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Permintaan Barang</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Permintaan" onClick="window.location='index.php?x=order_v'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th colspan="<?php 
							  if($_GET['jenis']!=3){
								  echo '5';
							  }elseif($_GET['jenis']==3 && $_GET['tahap']<5){
								  echo '10';
							  }elseif($_GET['jenis']==3 && $_GET['tahap']==5){
								   if($jum==31){
										echo '11';
									}
									if($jum==29){
										echo '9';
									}
									if($jum==30){
										echo '10';
									}
									if($jum==28){
										echo '8';
									}
							  }
							  ?>">
                              
                            
                              <div class="form-group" >
                                  <div class="col-lg-6">
                                    
                                    <select name="jenis" id="jenis" class="select" onChange="pindahData(jenis.value,unit.value)">
                                      <option value="0">---Jenis---</option>
                                      <option value="1" <?php if($_GET['jenis']==1){echo "selected";}?>>Permintaan ke Purchasing</option> 
                              
                                      <!--<option value="2" <?php //if($_GET['jenis']==2){echo "selected";}?>>Transit Gudang</option>-->    
                                    </select>
                                  </div>
                                  <div class="col-lg-6">
                                    <?php
										
										$peru=$db->select("tx_transit a
															JOIN tx_transit_dtl b ON a.id_transit = b.id_transit
															JOIN m_barang_gudang c ON b.id_barang = c.id_barang
															AND c.id_gudang = a.id_gudang
															JOIN m_gudang d ON d.id_gudang=a.id_gudang",
															"
															a.id_transit,
															a.no_transit,
															c.stok,
															b.qty,
															nama_gudang",
															"b.`status` = '0'
															GROUP BY
																a.no_transit
															");
																
									?>
                                    <select name="unit" id="unit" class="select" onChange="pindahData(jenis.value,unit.value)">
                                    
                                      <option value="0">Permintaan Unit</option>
                                       <?php
									   foreach($peru as $vperu){
										   if($_GET[unt]==$vperu[no_transit]){$d="selected";}else{$d="";}
										   echo"<option value=\"$vperu[no_transit]\" $d>$vperu[no_transit] - $vperu[nama_gudang]</option>";
										   }
									   ?>
                              
                                      <!--<option value="2" <?php //if($_GET['jenis']==2){echo "selected";}?>>Transit Gudang</option>-->    
                                    </select>
                                  </div>
                                    <input type="hidden" id="gudori" value="<?=$_SESSION['ID_GUDANG']?>">
                                    <?php /*if($_SESSION['ID_GUDANG']==0){?>
                                    <div class="col-lg-3">
                                    <select name="gud" id="gudangs" class="select-search" onChange="pindahData2(jenis.value,gudangs.value)">
									<option value="">-Gudang-</option>	
										<?php
											$query=$db->select("m_gudang","id_gudang,nama_gudang","id_cabang='$_SESSION[ID_CABANG]'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_gudang']?>" <?php if($sel['id_gudang']==$_GET['gud']){echo "selected";}?>><?=$sel['nama_gudang']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div> 
                                     <?php }*/?>
                                    <?php if($_GET['jenis']==3){?>
                                    <div class="col-lg-2">
                                    <?php include('bulan.php');?>
                                    </div>
                                    <div class="col-lg-2">
                                    <?php include('tahun.php');?>
                                    </div>
                                    <div class="col-lg-2">
                                      <select name="tahap" id="tahap" class="select" >
                                        <?php
											$query=$db->select("m_tahap","id_tahap,nama_tahap,tgl_awal,tgl_akhir");
											foreach($query as $sel){	
			                            ?>
                                        <option value="<?=$sel['id_tahap'].'_'.$sel['tgl_awal'].'_'.$sel['tgl_akhir']?>" <?php if($sel['id_tahap'].'_'.$sel['tgl_awal'].'_'.$sel['tgl_akhir']==$_GET['tahap']){echo "selected";}?>>
                                          <?=$sel['nama_tahap']?>
                                        </option>
                                        <?php }?>
                                      </select>
                                    </div>
                                    <div class="col-lg-1">
                                    <input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData3('<?=$_GET['jenis']?>',gud.value,bulan.value,tahun.value,tahap.value)">
                                    </div>
                                    <?php }?>
                                   
                                </div>
                              </th>
                            </tr>
                            <?php
                            if($_GET['jenis']==3){
							?>
                            <tr>
                                <th width="70%">Nama Barang</th>
                                <th width="5%">Satuan</th>
                                <th width="5%">Stok</th>
                              	<?php 
								//echo $jum .'-'. $explo[2];
								if($jum >= $explo[2]){
									$samp=$explo[2];	
								}else{
									$samp=$jum;
								}
								$jumlah=0;
								for($i=$explo[1];$i<=$samp;$i++){
									
									?>
                                <th width="5%"><?php echo $i.'-'.$_GET[bulan].'-'.substr($_GET[tahun],2,2)?></th>
                                <?php 
								$jumlah++;
								}
								//echo $jumlah;
								?>
                                <th width="5%">
                                <!--<a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a>-->
                              </th>
                            </tr>
                            <?php }else{?>
                             <tr>
                                <th width="70%">Nama Barang</th>
                                <th width="5%">Satuan</th>
                                <th width="5%">Stok</th>
                                <?php
								if(!empty($_GET[unt])){
								?>
                                <th width="5%">Permintaan</th>
                                <?php } ?>
                                <th width="5%">Qty </th>
                                <th width="5%">
                                <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a>
                              </th>
                            </tr>
                            <?php }?>
                        </thead>

                    </table>
                    <?php
						$jum2=$db->select("v_barang","*");
						$jum=count($jum2);
					?>
		   			<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
                    <input type="hidden" name="gud_in" id="gud_in"  value="0" required>
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" required>
                  <input type="hidden" name="tgl1" id="tgl1_i"  value=""  required>
                  <input type="hidden" name="tgl2" id="tgl2_i"  value=""  required>
                   <input type="hidden" name="tgl3" id="tgl3_i"  value=""  required>
                    <input type="hidden" name="tgl4" id="tgl4_i"  value=""  required>
                     <input type="hidden" name="tgl5" id="tgl5_i"  value=""  required>
                      <input type="hidden" name="tgl6" id="tgl6_i"  value=""  required>
                       <input type="hidden" name="tgl7" id="tgl7_i"  value=""  required>
                       <input type="hidden" name="tglkirin" id="tglkirin"  value=""  required>
                  <input type="hidden" name="qty_in1" id="qty_in1"  value=""  required>
                  <input type="hidden" name="qty_in2" id="qty_in2"  value=""  required>
                   <input type="hidden" name="qty_in3" id="qty_in3"  value=""  required>
                    <input type="hidden" name="qty_in4" id="qty_in4"  value=""  required>
                     <input type="hidden" name="qty_in5" id="qty_in5"  value=""  required>
                     <input type="hidden" name="gud" id="gud1"  value="<?php echo $_GET['gud']?>"  required>
                      <input type="hidden" name="qty_in6" id="qty_in6"  value=""  required>
                       <input type="hidden" name="qty_in7" id="qty_in7"  value=""  required> <input type="hidden" name="jumlah" id="jumlah"  value="<?=$jumlah?>"  required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=order" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-<?php if($_GET[jenis]=='3'){echo '5';}else{echo '6';}?>">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Permintaan Barang</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                     
                   <br>
                  <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Tanggal </label>
                              <div class="col-lg-4">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker1" name="tgl" id="tgl" value="<?php echo date("d-m-Y")?>">
                                  </div>
                               </div>
                               <label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Duedate </label>
                               <div class="col-lg-4">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control" name="due" id="due" value="<?php echo date('d-m-Y', strtotime('+30 days'));?>" readonly>
                                  </div>
                               </div>
                               
                    </div>
                   
                     <input type="hidden" name="jenkir" value="FRC">
                     <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Ship To </label>						
                              	<div class="col-lg-8">
                                  <div class="form-group">                                 	<select name="shipto" id="shipto" class="select" ><?php
	//$sat=$db->select("m_gudang_shipto","shipto_code,shipto_name","id_gudang='$_SESSION[ID_GUDANG]'");
	$sat=$db->select("m_gudang_shipto","shipto_code,shipto_name");
	foreach($sat as $val){
	?>
	<option value="<?php echo $val['shipto_code']?>"><?php echo $val['shipto_code'].' - '.$val['shipto_name']?></option>
	<?php
	}
	?>
                                    
                                      
                                    </select>
                                  </div>
                               </div>			 
                     </div> 
                      <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Ket </label>						
                              	<div class="col-lg-8">
                                  <div class="form-group">
                              	 
                                  <input type="text" class="form-control" name="ket" id="ket" >
                                  </div>
                               </div>			
                            
                            
                     </div>  
                          
					<div class="panel-body">
                    			<div class="tabbable">
									<ul class="nav nav-tabs">
										<?php
                                        $tmp=$db->select("tx_order_tmp a left join m_gudang b on a.ke_gudang=b.id_gudang","a.ke_gudang,b.nama_gudang","id_user='$_SESSION[ID_LOGIN]' group by id_gudang");										$no=1;
										foreach($tmp as $valtmp){
										?>
                                        <li class="<?php if($no==1){echo "active";}?>">
                                        <a href="#id_<?=$valtmp['ke_gudang']?>" data-toggle="tab"><?php if($valtmp['ke_gudang']=='0'){echo "Pembelian";}else{echo $valtmp['nama_gudang'];}?>
                                        </a></li>
                                        
                                        <?php $no++;}?>
									</ul>

									<div class="tab-content">
                                    <?php
                                        $tmp=$db->select("tx_order_tmp a left join m_gudang b on a.ke_gudang=b.id_gudang","a.ke_gudang,b.nama_gudang","id_user='$_SESSION[ID_LOGIN]' group by id_gudang");										$no=1;
										foreach($tmp as $valtmp){	
									?>
										<div class="tab-pane <?php if($no==1){echo "active";}?>" id="id_<?=$valtmp['ke_gudang']?>">
                                        	<?php
                                            include("keranjang.php");
											?>
										</div>
                                    <?php $no++;}?>
                                 </div>
								</div>
							
                    
                                <div class="form-group">
                                    	
                                     
                                </div>
                                  
					
					</div>	
                    
				</div>					
		</div>
</form>
<?php }?>
