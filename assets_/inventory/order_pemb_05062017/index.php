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
	$dttmp=$db->select("tx_order_tagihan_tmp","id_supp","id_supp='$_POST[supp]'");
	foreach($dttmp as $valtmp){	}
	  if($valtmp['id_supp']<>''){
		$idgen=$db->nourut('no_pt', 'tx_order_tagihan', 'PT', sprintf("%02s", $_SESSION['ID_CABANG']), date('Y-m-d'));
		$id=$db->idurut("tx_order_tagihan","id_pt");
		$data = array( 
					'stampdate' => date('Y-m-d H:i:s'),
					'id_pt' => $id, 
					'no_pt' => $idgen,
					'tgl_pt' => date("Y-m-d",strtotime($_POST['tgl'])),
					'status' => '0',
					'id_supp' => $_POST['supp'],
					'total_tag' => $_POST['total_tag'],
					'id_user' => $_SESSION['ID_LOGIN'],
					);
		$exec= $db->insert("tx_order_tagihan", $data);
		$dttmp2=$db->select("tx_order_tagihan_tmp","*","id_supp='$valtmp[id_supp]'");
		$kurang=0;
		$ret['qty_kembali']=0;
		foreach($dttmp2 as $valtmp2){
			 $ce=$db->select("tx_billing_dtl","*","no_billing='$valtmp2[no_billing]'");
			 $kurang=0;
			 $ret['qty_kembali']=0;
			 			//var_dump($ce);
   	 		foreach($ce as $caki){
			$re=$db->select("tx_billing a
			JOIN tx_brg_masuk b ON a.no_ref = b.no_ref
			JOIN tx_brg_masuk_dtl d on b.no_masuk=d.no_masuk
			LEFT JOIN tx_retur_pem c ON d.no_masuk = c.no_ref
			LEFT JOIN tx_retur_pem_dtl e on c.no_retur=e.no_retur and d.id_barang=e.id_barang","d.harga_beli,e.qty_kembali","no_billing = '$valtmp2[no_billing]' and e.id_barang='$caki[id_barang]'");
			foreach($re as $ret){}
			$korbel=$db->select("tx_billing a
			JOIN tx_brg_masuk b ON a.no_ref = b.no_ref
			JOIN tx_brg_masuk_dtl d on b.no_masuk=d.no_masuk
			left JOIN tx_koreksi_habel c on b.no_masuk=c.no_ref
			left join tx_koreksi_habel_dtl e on c.no_koreksi=e.no_koreksi","e.total,e.qty","a.no_billing = '$valtmp2[no_billing]' and e.id_barang='$caki[id_barang]'");
			foreach($korbel as $kor){}
			
			$kores=$kor['total'];
			$kurang=$ret['qty_kembali']*$ret['harga_beli'];
			
			$iddtl=$db->idurut("tx_order_tagihan_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $iddtl, 
					'id_pt' => $id,
					'no_pt' => $idgen,
					'id_billing' => $valtmp2['id_billing'],
					'no_billing' => $valtmp2['no_billing'],
					'total_bil' => ($caki['total']-$kurang)+$kores,
					'retur' => $kurang,
					'no_spj' => $caki['no_spj'],
					'id_bill_dtl' => $caki['id_dtl'],
					'total' => $caki['total'],
					'id_cabang' => $caki['id_cabang'],
					'koreksi_habel' => $kores,
					);
			$exec= $db->insert("tx_order_tagihan_dtl", $data);
			
			
			$data = array("status" => 1);
			$db->update("tx_billing_dtl",$data,"no_spj='$caki[no_spj]'");
			} ///end kene
			
			foreach($_POST['idbill'] as $key => $val){
			$data = array(
				"retur" => $_POST['returs'][$key],
				"total" => $_POST['totalper'][$key]
			);
			$db->update("tx_order_tagihan_dtl",$data,"no_pt='$idgen' and id_billing='".$_POST['idbill'][$key]."'");
			
			}
		}
			
			//kredit
			foreach($dttmp2 as $valtmp2){
			$ce=$db->select("tx_billing_dtl a LEFT JOIN tx_brg_masuk b on a.no_spj=b.surat_jalan LEFT JOIN tx_brg_masuk_dtl c on b.no_masuk=c.no_masuk","a.*,b.no_masuk,c.claim_ktg,c.claim_utuh,b.jenis","a.no_billing='$valtmp2[no_billing]'");
   foreach($ce as $cak){
	   if($cak['no_masuk']==''){
		$data = array( 
					'no_billing' => $valtmp2['no_billing'], 
					'no_spj' => $cak['no_spj'],
					'qty' => $cak['qty'],
					'harga' => $cak['harga'],
					'total' => $cak['total'],
					'jenis' => 1,
					'id_user' => $_SESSION['ID_LOGIN'],
					'status' => 0,
					'claim_utuh' => $cak['claim_utuh'],
					'claim_ktg' => $cak['claim_ktg'],
					'id_supp' => $_POST['supp']
					);
			$exec= $db->insert("tx_order_tagihan_kd", $data);
		}
		
		 if($cak['jenis']=='3'){
		$data = array( 
					'no_billing' => $valtmp2['no_billing'], 
					'no_spj' => $cak['no_spj'],
					'qty' => $cak['qty'],
					'harga' => $cak['harga'],
					'total' => $cak['total'],
					'jenis' => 2,
					'id_user' => $_SESSION['ID_LOGIN'],
					'status' => 0,
					'claim_utuh' => $cak['claim_utuh'],
					'claim_ktg' => $cak['claim_ktg'],
					'id_supp' => $_POST['supp']
					);
			$exec= $db->insert("tx_order_tagihan_kd", $data);
		}
   			
		 if($cak['claim_utuh']>'0'){
		$data = array( 
					'no_billing' => $valtmp2['no_billing'], 
					'no_spj' => $cak['no_spj'],
					'qty' => $cak['qty'],
					'harga' => $cak['harga'],
					'total' => $cak['total'],
					'jenis' => 0,
					'id_user' => $_SESSION['ID_LOGIN'],
					'status' => 0,
					'claim_utuh' => $cak['claim_utuh'],
					'id_supp' => $_POST['supp'],
					'urut' => 1,
					);
			$exec= $db->insert("tx_order_tagihan_kd", $data);
														}	
			if($cak['claim_utuh']>'0'){
		$data = array( 
					'no_billing' => $valtmp2['no_billing'], 
					'no_spj' => $cak['no_spj'],
					'qty' => $cak['qty'],
					'harga' => $cak['harga'],
					'total' => $cak['total'],
					'jenis' => 0,
					'id_user' => $_SESSION['ID_LOGIN'],
					'status' => 0,
					'claim_ktg' => $cak['claim_ktg'],
					'urut' => 2,
					'id_supp' => $_POST['supp']
					);
			$exec= $db->insert("tx_order_tagihan_kd", $data);
														
   }
   
	}
			//end kredit
			
			
			$where = array(	 
						"id_user" => $_SESSION['ID_LOGIN']);
			$db->delete("tx_order_tagihan_tmp",$where);
		}
	  }
	//end if jumlah
			echo "<script>window.location='index.php?x=order-pemb&supp=$_POST[supp]'</script>";	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_order_tagihan_tmp",$where);
	
	echo "<script>window.location='index.php?x=order-pemb&supp=$_POST[supp]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_supp" => $_POST['supp']);
	$db->delete("tx_order_tagihan_tmp",$where);
	echo "<script>window.location='index.php?x=order-pemb&supp=$_POST[supp]'</script>";
}else{
	$jum=$db->jumlah_hari($_GET['bulan'],$_GET['tahun']);
	$explo=explode("_",$_GET['tahap']);
	//echo $jum.'_'.$explo[2];	
?>	
    <div class="col-lg-<?php if($_GET[jenis]=='3'){echo '7';}else{echo '6';}?>">
		<form action="index.php?x=order-pemb_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Permintaan Pembayaran</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Permintaan" onClick="window.location='index.php?x=order-pemb_v'"></button></li>
							</ul>
                        </div>
					</div>
                    
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                             <tr>
                               <th colspan="4">
                               <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Supplier</label>
                              <div class="col-lg-5">
                              	  <select name="supp" id="supp" class="select-search" onChange="pindahData2()">
                              	    <option value="">---Supplier---</option>
                              	    	<?php
											$query=$db->select("m_supplier","id_supp,nama_supp,nama_usaha,id_valuta,pkp");
											foreach($query as $sel){	
												if($_GET['supp']==$sel['id_supp']){
												$st="selected";
												}else{
												$st="";
												}
			                            ?>
                              	    <option value="<?=$sel['id_supp']?>" <?=$st?>>
                              	    <?=$sel['nama_usaha']?>
                           	        </option>
                              	    <?php 
										}
									?>
                           	      </select>  
                      </div>          
                    </div>
                               </th>
                               <th>&nbsp;</th>
                             </tr>
                             <tr>
                                <th width="30%">No Billing</th>
                                <th width="10%">Tgl</th>
                                <th width="30%">No Ref</th>
                                <th width="20%">Total</th>
                                <th width="2%">
                                <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a>
                              </th>
                            </tr>
                        </thead>
                    </table>
                    <input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="idbil_in" id="idbil_in"    required>
                    <input type="hidden" name="nobil_in" id="nobil_in"  value="" required>
                    <input type="hidden" name="totalbil_in" id="totalbil_in"  value="" required>
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=order-pemb" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-<?php if($_GET[jenis]=='3'){echo '5';}else{echo '6';}?>">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Permintaan Pembayaran</h5>
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
                    </div>
                    <div class="form-group">
                    <label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Detil </label>
                              <div class="col-lg-9">
                    				 <?php
                                    	include("keranjang.php");
									 ?>
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

										<input type="hidden" name="supp" id="supp"  value="<?=$_GET['supp']?>"  required>									   
				              <input type="hidden" name="total_tag" id="total_tag"  value="<?=$totjum?>"  required>
							</div>
                         </div>       
						
                    
				</div>					
		</div>
</form>
<?php }?>
<div id="datapelanggan" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h6 class="modal-title">Detil</h6>
							</div>
							<div class="modal-body" id="hahaha">
                            
															
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								
							</div>
						</div>
					</div>
				</div>