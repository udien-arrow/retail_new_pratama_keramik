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
	$exp=explode("_",$_POST['shipto']);
	$cuss=explode("_",$_POST['cusa']);
	
	$dttmp=$db->select("tx_sales_order_tmp","id_user,id_gudang,id_cus,jenis_jual,ship_to","id_user='$_SESSION[ID_LOGIN]' group by id_gudang,id_cus");
	foreach($dttmp as $valtmp){	
	$tgl=date("Y-m-d");
	  if($valtmp['id_user']<>''){
		$idgen=$db->nourut('no_sales', 'tx_sales_order', $cuss[4], sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
		$id=$db->idurut("tx_sales_order","id_sales");
		if($_POST['jenispen']=='SWC'){
			$hah=explode("_",$_POST['spjrilis']);
			$haha=$hah[1];	
		}else{
			$haha='';	
		}
		$data = array( 
					'id_sales' => $id, 
					'no_sales' => $idgen, 
					'stampdate' => date('Y-m-d H:i:s'),
					'tgl_sales' => date("Y-m-d",strtotime($_POST['tgl'])),
					'duedate' => date("Y-m-d",strtotime($_POST['due'])),
					'id_gudang' => $valtmp['id_gudang'],
					'id_user' => $valtmp['id_user'],
					'status_so' => 3,
					'id_cabang' => $_SESSION['ID_CABANG'],
					'id_cus' => $valtmp['id_cus'],
					'jenis' => $_POST['jenispen'],
					'no_spj_rilis' => $haha,
					'jenis_jual' => $valtmp['jenis_jual'],
					'ship_to' => $exp[0],
					'id_cus_shipto' => $exp[1],
					);
		$exec= $db->insert("tx_sales_order", $data);  
		$dttmp2=$db->select("tx_sales_order_tmp","*","id_user='$valtmp[id_user]' and id_gudang='$valtmp[id_gudang]'");
		foreach($dttmp2 as $valtmp2){
			$iddtl=$db->idurut("tx_sales_order_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $iddtl, 
					'id_barang' => $valtmp2['id_barang'],
					'harga' => $valtmp2['harga'],
					'id_satuan' => $valtmp2['id_satuan'],
					'tgl_kirim' => $valtmp2['tgl_kirim'],
					'id_sales' => $id,
					'no_sales' => $idgen,
					'qty' => $valtmp2['qty'],
					'status' => 0,
					
					);
			$exec= $db->insert("tx_sales_order_dtl", $data);
			$jumlah_so=$jumlah_so+($valtmp2['qty']*$valtmp2['harga']);
			//var_dump($data);
			$where = array(	 "id_user" => $valtmp['id_user'],
							 "id_gudang" => $valtmp['id_gudang']);
			$db->delete("tx_sales_order_tmp",$where);
		}	
			$data3 = array( 
					'jumlah_so' => $jumlah_so,
					);
			$exec= $db->update("tx_sales_order", $data3,"no_sales='$idgen'");
	  }
	}//end if jumlah
			echo "<script>
			alert('Sukses Simpan Dengan No SO $idgen');
			window.open('cetak.php?page=salesorder&id=$idgen','_blank');
			
			window.location='index.php?x=salesorder'</script>";	
}

if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_sales_order_tmp",$where);
	echo "<script>window.location='index.php?x=salesorder&jen=$_POST[jena]&gud=$_POST[guda]&cus=$_POST[cusa]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_sales_order_tmp",$where);
	echo "<script>window.location='index.php?x=salesorder&jen=$_POST[jena]&gud=$_POST[guda]&cus=$_POST[cusa]'</script>";
}else{
	$jum=$db->jumlah_hari($_GET['bulan'],$_GET['tahun']);
	$explo=explode("_",$_GET['tahap']);
	//echo $jum.'_'.$explo[2];	
?>	
    <div class="col-lg-<?php if($_GET[jenis]=='3'){echo '7';}else{echo '6';}?>">
		<form action="index.php?x=salesorder_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Permintaan Barang</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li>
                                 
                              <input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Permintaan" onClick="window.location='index.php?x=salesorder_v'"></button></li>
							</ul>
                            </div>
					</div>
                    
                    <?php
                   $exp=explode("_",$_GET['cus']);
				   
				   if($_SESSION['JEN']=='kitchen'){
					   $rq="RK";
				   }
				   if($_SESSION['JEN']=='lounge'){
					   $rq="RL"; 
				   }
					?>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                             <tr>
                               <th colspan="7">
                               <div class="form-group" >
                                 <div class="col-lg-5">
                              	  	<select name="cus" id="cus" class="select" onChange="pindahdata()">
                                   <option value="">---Unit---</option>
                                   	<?php 
								$query=$db->select("m_customer","id_cus,kode_cus,nama_usaha,ship_to,jenis","id_cabang='$_SESSION[ID_CABANG]' and head='' and jenis='$rq'");
								foreach($query as $sel){	
								?>
								<option value="<?=$sel['id_cus'].'_'.$sel['kode_cus'].'_'.$sel['nama_usaha'].'_'.$sel['ship_to'].'_'.$sel['jenis']?>" <?php if($exp[0]==$sel['id_cus']){echo "selected";}?>>
								<?=$sel['nama_usaha']?>
								</option>
                                    <?php }?>
                               	   </select>
                                   </div>
                                    <input type="hidden" name="jen" id="jen" value="2">
                                 <div class="col-lg-4">
                                    
                                    <select name="gud" id="gud" class="select-search" onChange="pindahdata2()">
                                      <?php 
									  $gudang=$db->select("m_gudang","*","id_cabang='$_SESSION[ID_CABANG]'");
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['id_gudang']?>" <?php if($_GET['gud']==$val['id_gudang']){echo "selected";}?>> <?=$val['nama_gudang']?></option> 
                                     <?php } ?>
                                    </select>
                                    </div>
                                    
                                    
                      </div>
                               </th>
                          </tr>
                             <tr>
                                <th width="70%">Nama Barang</th>
                                <th width="5%">Satuan</th>
                                <th width="5%">Stok</th>
                                <th width="5%">Qty </th>
                                <th width="5%">
                                <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a>
                              </th>
                            </tr>
                       </thead>
                    </table>
                    <input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
                    <input type="hidden" name="qty_in" id="qty_in"  value="" required>
                    <input type="hidden" name="harga_in" id="harga_in"  value="" required>
                    <input type="hidden" name="tglkir_in" id="tglkir_in"  value="" required>
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" required>
            <input type="hidden" name="cus2" id="cus2"  value="<?=$_GET[cus]?>" required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=salesorder" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-<?php if($_GET[jenis]=='3'){echo '5';}else{echo '6';}?>">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Permintaan Barang</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                   <br>
                  <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Tanggal </label>
                              <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date("d-m-Y")?>">
                                  </div>
                               </div>
                               <label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Duedate </label>
                               <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control" name="due" id="due" value="<?php echo date('d-m-Y', strtotime('+7 days'));?>" readonly>
                                  </div>
                               </div>
                               
                    </div>
                    <input type="hidden" name="jenispen" id="jenispen" value="FRC">
                    
                    <div class="form-group" style="display:none" id="spjr">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Spj Rilis</label>
                              <div class="col-lg-7">
                              	     <?php
                                     if($_GET['jen']==1){
                                     ?>
                                     <select name="spjrilis" id="spjrilis" class="select-search">
										<option value="">------------------Pilih SPJ Rilis------------------</option>
										<?php
											$query=$db->select("v_spj_rilis","no_spj,no_so,line_item,so_date,no_polisi,tgl_spj","id_cabang='$_SESSION[ID_CABANG]' and status_tx=1 and st_upload_dtl=1");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['no_so'].'_'.$sel['no_spj'].'_'.$sel['line_item']?>"><?=$sel['no_spj'].' - '.$sel['tgl_spj'].' - '.$sel['no_polisi']?></option>
                                        <?php }?>
									</select>
                              	  	<?php }elseif($_GET['jen']==2){?>
                                    <select name="spjrilis" id="spjrilis" class="select-search">
										<option value="">------------------Pilih SPJ Rilis------------------</option>
										<?php
											$query=$db->select("tx_po","no_po,no_jwa,tgl_po","id_cabang='$_SESSION[ID_CABANG]' and status=1 and no_jwa is not null");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['no_po'].'_'.$sel['no_jwa']?>"><?=$sel['no_po'].' - '.$sel['tgl_po'].' - '.$sel['no_jwa']?></option>
                                        <?php }?>
									</select>
                                    <?php }?>
                               </div>          
                    </div>
                    <?php
                 /*   foreach($db->select("m_customer","id_cus","head='$expl[1]'")as $ak);
											$query=$db->select("m_customer_shipto a join m_customer b on a.id_cus=b.id_cus","a.shipto_code,a.shipto_name,b.nama_usaha,a.id_cus","a.id_cus='$ak[id_cus]'");*/
					?>
                    
                     <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Shipto</label>
                              <div class="col-lg-9">
                              	    <select name="shipto" id="shipto" class="select-search" required>
                              	      	<?php
										if($_GET['cus']==''){
										}else{
											$query=$db->select("m_customer_shipto a join m_customer b on a.id_cus=b.id_cus","a.shipto_code,a.shipto_name,b.nama_usaha,a.id_cus","a.id_cus='$expl[0]' and jenis='$rq'");
										
											foreach($query as $sel){	
			                            ?>
                              	      <option value="<?=$sel['shipto_code'].'_'.$sel['id_cus']?>">
                              	        <?=$sel['nama_usaha'].' - '.$sel['shipto_code'].' - '.$sel['shipto_name']?>
                           	          </option>
                              	      <?php 	
										}
									?>
                                    <?php
											
											$he=$db->select("m_customer","id_cus","head='$expl[1]'");
											foreach($he as $ak){
											$query=$db->select("m_customer_shipto a left join m_customer b on a.id_cus=b.id_cus","a.shipto_code,a.shipto_name,b.nama_usaha,a.id_cus","a.id_cus='$ak[id_cus]'  and jenis='$rq'");
											foreach($query as $sel){	
			                            ?>
                              	      <option value="<?=$sel['shipto_code'].'_'.$sel['id_cus']?>">
                              	        <?=$sel['nama_usaha'].' - '.$sel['shipto_code'].' - '.$sel['shipto_name']?>
                           	          </option>
                              	      <?php 	
											}
										}
										}
									?>
                           	      </select>
                              	  
                                  
                               </div>          
                    </div>
                    
                    <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;</label>									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="batal()">
										 Batal 
                                        </button>
                                        
								      
                                       
							</div>
                         </div>       
					<div class="panel-body">
                    			<div class="tabbable">
									<ul class="nav nav-tabs">
										<?php
                                        $tmp=$db->select("tx_sales_order_tmp a left join m_gudang b on a.ke_gudang=b.id_gudang","a.ke_gudang,b.nama_gudang","id_user='$_SESSION[ID_LOGIN]' group by id_gudang");										$no=1;
										foreach($tmp as $valtmp){
										?>
                                        <li class="<?php if($no==1){echo "active";}?>">
                                        <a href="#id_<?=$valtmp['ke_gudang']?>" data-toggle="tab"><?php if($valtmp['ke_gudang']=='0'){echo "Pembelian";}else{echo $valtmp['nama_gudang'];}?>
                                        </a></li>
                                        
                                        <?php $no++;}?>
									</ul>

									<div class="tab-content">
                                    <?php
                                        $tmp=$db->select("tx_sales_order_tmp a left join m_gudang b on a.id_gudang=b.id_gudang","a.id_gudang,b.nama_gudang","id_user='$_SESSION[ID_LOGIN]' group by id_gudang");										$no=1;
										foreach($tmp as $valtmp){	
									?>
										<div class="tab-pane <?php if($no==1){echo "active";}?>" id="id_<?=$valtmp['ke_gudang']?>">
                                        	<?php
                                            include("keranjang.php");
											?>
										</div>
                                    <?php $no++;}?>
                                    <span class="col-lg-5">
                                    <input type="hidden" name="guda" id="guda"  value="<?php echo $_GET[gud]?>"  required>
                                    <input type="hidden" name="jena" id="jena"  value="<?php echo $_GET[jen]?>"  required>
                                    <input type="hidden" name="cusa" id="cusa"  value="<?php echo $_GET[cus]?>"  required>
                                    <input type="hidden" name="aksi" id="aksi"    required>
								      <input type="hidden" name="id2" id="id2"  value=""  required>
                                  </span></div>
								</div>
							
                    
                                <div class="form-group">
                                    	
                                     
                                </div>
                                  
					
					</div>	
                    
				</div>					
		</div>
</form>
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
<?php }?>