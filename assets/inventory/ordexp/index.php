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
	$dttmp=$db->select("ex_order_tagihan_tmp","id_supp","id_supp='$_POST[supp]' group by id_supp");
	foreach($dttmp as $valtmp){	
	  if($valtmp['id_supp']<>''){
		$idgen=$db->nourut('no_pt', 'ex_order_tagihan', 'ET', sprintf("%02s", $_SESSION['ID_CABANG']), date('Y-m-d'));
		$id=$db->idurut("ex_order_tagihan","id_pt");
		$data = array( 
					'stampdate' => date('Y-m-d H:i:s'),
					'id_pt' => $id, 
					'no_pt' => $idgen,
					'tgl_pt' => date("Y-m-d",strtotime($_POST['tgl'])),
					'status' => '0',
					'id_supp' => $_POST['supp'],
					'total_tag' => round($_POST['total_tag']),
					'id_user' => $_SESSION['ID_LOGIN'],
					);
		$exec= $db->insert("ex_order_tagihan", $data);
		$dttmp2=$db->select("ex_order_tagihan_tmp","*","id_supp='$valtmp[id_supp]'");
		$totals=0;
		foreach($dttmp2 as $valtmp2){
			$iddtl=$db->idurut("ex_order_tagihan_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $iddtl, 
					'id_pt' => $id,
					'no_pt' => $idgen,
					'id_expediture' => $valtmp2['id_expediture'],
					'no_expediture' => $valtmp2['no_expediture'],
					'total_ao' => $valtmp2['total_ao'],
					);
			$exec= $db->insert("ex_order_tagihan_dtl", $data);
			
			$totaall=0;
			foreach($_POST['ids'] as $key => $val){
				
			$totals=$_POST['totao'][$key]-$_POST['returs'][$key];
			
			$data = array(
			"retur" => $_POST['returs'][$key],
			"total" => $totals);
			$totaall=$totaall+$totals;
			$db->update("ex_order_tagihan_dtl",$data,"no_pt='$idgen' and id_expediture='".$_POST['ids'][$key]."'");
			}
			$where = array(	 
							 "id_tmp" => $valtmp2['id_tmp']);
			$db->delete("ex_order_tagihan_tmp",$where);
		}
		
		$data = array("total_tag" => $totaall);
		$db->update("ex_order_tagihan",$data,"no_pt='$idgen'");
	  }
	}//end if jumlah
		echo "<script>window.location='index.php?x=ordexp&supp=$_POST[supp]'</script>";	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("ex_order_tagihan_tmp",$where);
	
	echo "<script>window.location='index.php?x=ordexp&supp=$_POST[supp]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_supp" => $_POST['supp']);
	$db->delete("ex_order_tagihan_tmp",$where);
	echo "<script>window.location='index.php?x=ordexp&supp=$_POST[supp]'</script>";
}else{
	$jum=$db->jumlah_hari($_GET['bulan'],$_GET['tahun']);
	$explo=explode("_",$_GET['tahap']);
	//echo $jum.'_'.$explo[2];	
?>	

    <div class="col-lg-<?php if($_GET[jenis]=='3'){echo '7';}else{echo '6';}?>">
    
		<form action="index.php?x=ordexp_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Permintaan" onClick="window.location='index.php?x=ordexp_v'"></button></li>
							</ul>
                        </div>
					</div>
                    
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                             <tr>
                               <th colspan="6">
                               <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Supplier</label>
                              <div class="col-lg-5">
                                <select name="supp" id="supp" class="select-search" onChange="pindahData2()">
                                  <option value="">---Supplier---</option>
                                  <?php 
								  $date=date("Y-m-d");
									   $gudang=$db->select("(select * from ex_tarif_oa order by tgl_berlaku desc) as aku join m_supplier c on aku.id_supp=c.id_supp group by aku.id_supp","aku.*,nama_usaha");
									  foreach($gudang as $val){
									  ?>
                                  <option value="<?=$val['id_supp']?>" <?php if($_GET[supp]==$val['id_supp']){echo "selected";}?>>
                                    <?=$val['nama_usaha']?>
                                  </option>
                                  <?php } ?>
                                </select>
                              </div>          
                    </div>
                               </th>
                               <th>&nbsp;</th>
                             </tr>
                             <tr>
                                <th width="30%">No Exp</th>
                                <th width="10%">Tgl</th>
                                <th width="30%">No SO</th>
                                <th width="30%">No SPJ</th>
                                <th width="20%">Lokasi Kirim</th>
                                <th width="20%">Total</th>
                                <th width="2%">
                                <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a>
                              </th>
                            </tr>
                        </thead>
                    </table>
                    <input type="hidden" name="id" id="id"  value=""  required>
           			
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=ordexp" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-<?php if($_GET[jenis]=='3'){echo '5';}else{echo '6';}?>">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang <?=$title?></h5>
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
                              <div class="col-lg-10">
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