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
	$exp=explode("_",$_POST['supp']);
	if($exp[1]==1){$ppn='y';}else{$ppn='n';}
	$dttmp=$db->select("tx_bm_order_tmp","id_user,id_gudang","id_user='$_SESSION[ID_LOGIN]' group by id_gudang");
	foreach($dttmp as $valtmp){	
	  if($valtmp['id_user']<>''){
		$idgen=$db->nourut('no_order', 'tx_bm_order', 'PM', sprintf("%02s", $_SESSION['ID_CABANG']), $_POST[tgl]);
		$id=$db->idurut("tx_bm_order","id_order");
		$data = array( 
					'id_order' => $id, 
					'no_order' => $idgen, 
					'stampdate' => date('Y-m-d H:i:s'),
					'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
					'duedate' => date("Y-m-d",strtotime($_POST['due'])),
					'ket' => $_POST['ket'],
					'id_gudang' => $valtmp['id_gudang'],
					'id_user' => $valtmp['id_user'],
					'no_spj' => $_POST['no_spj'],
					'status' => 0,
					'id_cabang' => $_SESSION['ID_CABANG'],
					'id_supp' => $exp[0],
					'id_valuta' => $exp[1],
					);
		$exec= $db->insert("tx_bm_order", $data);
		$dttmp2=$db->select("tx_bm_order_tmp","*","id_user='$valtmp[id_user]' and id_gudang='$valtmp[id_gudang]'");
		foreach($dttmp2 as $valtmp2){
			$iddtl=$db->idurut("tx_bm_order_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $iddtl, 
					'id_barang' => $valtmp2['id_barang'],
					'harga' => $valtmp2['harga'],
					'sat' => $valtmp2['sat'],
					'id_order' => $id,
					'no_order' => $idgen,
					'qty' => $valtmp2['qty'],
					'ppn' => $ppn,
					'status' => 0,
					);
			$exec= $db->insert("tx_bm_order_dtl", $data);
			
			$where = array(	 "id_user" => $valtmp['id_user'],
							 "id_gudang" => $valtmp['id_gudang']);
			$db->delete("tx_bm_order_tmp",$where);
		}
	  }
	}//end if jumlah
			echo "<script>window.location='index.php?x=app_pm&id=$idgen'</script>";	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_bm_order_tmp",$where);
	
	echo "<script>window.location='index.php?x=order_bm&jenis=$_POST[jenis]&gud=$_POST[gud]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_bm_order_tmp",$where);
	echo "<script>window.location='index.php?x=order_bm'</script>";
}else{
	$jum=$db->jumlah_hari($_GET['bulan'],$_GET['tahun']);
	$explo=explode("_",$_GET['tahap']);
	//echo $jum.'_'.$explo[2];	
?>	
    <div class="col-lg-<?php if($_GET[jenis]=='3'){echo '7';}else{echo '6';}?>">
		<form action="index.php?x=order_bm_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Permintaan Penerimaan</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Permintaan" onClick="window.location='index.php?x=order_bm_v'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
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
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=order_bm" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-<?php if($_GET[jenis]=='3'){echo '5';}else{echo '6';}?>">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Permintaan Penerimaan</h5>
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
                                  <input type="text" class="form-control" name="due" id="due" value="<?php echo date('d-m-Y', strtotime('+30 days'));?>" readonly>
                                  </div>
                               </div>
                               
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Supplier</label>
                              <div class="col-lg-6">
                              	  <select name="supp" id="supp" class="select-search">
                              	    <option value="">---Supplier---</option>
                              	    	<?php
											$query=$db->select("m_supplier","id_supp,nama_supp,nama_usaha,id_valuta,pkp");
											foreach($query as $sel){	
			                            ?>
                              	    <option value="<?=$sel['id_supp'].'_'.$sel['id_valuta'].'_'.$sel['pkp']?>">
                              	    <?=$sel['nama_usaha']?>
                           	        </option>
                              	    <?php 
											
										}
									?>
                           	      </select>
                              	  
                      </div>          
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;No SPJ</label>
                              <div class="col-lg-3">
                              	  <div class="input-group">
                              	 
                                  <input type="text" class="form-control" name="no_spj" id="no_spj" value="">
                                  </div>
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
                                        <input type="hidden" name="aksi" id="aksi"    required>
								      <input type="hidden" name="id2" id="id2"  value=""  required>
									  <input type="hidden" name="jenis" id="jenis"  value="<?php echo $_GET[jenis]?>"  required>
                               		  <input type="hidden" name="gud" id="gud"  value="<?php echo $_GET[gud]?>"  required>
                                       
							</div>
                         </div>       
					<div class="panel-body">
                    			<div class="tabbable">
									<ul class="nav nav-tabs">
										<?php
                                        $tmp=$db->select("tx_bm_order_tmp a left join m_gudang b on a.ke_gudang=b.id_gudang","a.ke_gudang,b.nama_gudang","id_user='$_SESSION[ID_LOGIN]' group by id_gudang");										$no=1;
										foreach($tmp as $valtmp){
										?>
                                        <li class="<?php if($no==1){echo "active";}?>">
                                        <a href="#id_<?=$valtmp['ke_gudang']?>" data-toggle="tab"><?php if($valtmp['ke_gudang']=='0'){echo "Pembelian";}else{echo $valtmp['nama_gudang'];}?>
                                        </a></li>
                                        
                                        <?php $no++;}?>
									</ul>

									<div class="tab-content">
                                    <?php
                                        $tmp=$db->select("tx_bm_order_tmp a left join m_gudang b on a.id_gudang=b.id_gudang","a.id_gudang,b.nama_gudang","id_user='$_SESSION[ID_LOGIN]' group by id_gudang");										$no=1;
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