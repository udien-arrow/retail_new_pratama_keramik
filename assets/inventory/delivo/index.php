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
	$tgl=date('Y-m-d');
	$idcab=$db->select("r_user_login a
	JOIN m_pegawai b ON a.ID_PEGAWAI = b.id_pegawai
	JOIN m_gudang d ON b.id_cabang = d.id_cabang
	JOIN m_cabang c ON b.id_cabang = c.id_cabang","d.id_gudang,
	nama_gudang,
	b.id_cabang,
	c.kode_cabang","ID='$_SESSION[ID_LOGIN]'");
	foreach($idcab as $valcab){}
	$idgen=$db->nourut('no_do', 'tx_do', 'DO', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$dttmp=$db->select("tx_do_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$sa=$db->select("tx_sales_order","*","no_sales='$_POST[no_ref]'");
	foreach($sa as $asv){}
	$jumlah=count($dttmp);
	if($jumlah>0){
		$id=$db->idurut("tx_do","id_do");
		$data = array( 
					'id_do' => $id, 
					'no_do' => $idgen, 
					'id_gudang' => $_SESSION['ID_GUDANG'],
					'tgl_do' => $_POST['tgl'],
					'stampdate' => $asv['stampdate'],
					'no_reff' => $_POST['no_ref'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'ket_do' => $_POST['keterangan'],
					'status_do' => 0,
					);
		$exec= $db->insert("tx_do", $data);
		foreach($dttmp as $valtmp){
			$supp=$valtmp['id'];
			$ids=$db->idurut("tx_do_dtl","id_dtl");			
			$data = array( 
					'id_dtl' => $ids, 
					'id_do' =>$id, 
					'no_do' => $idgen,
					'id_barang' => $valtmp['id_barang'],
					'qty' => $valtmp['qty'],
					'harga' => $valtmp['harga'],
					'status' => 0,
					'id_satuan' => $valtmp['id_satuan'],
					);
			
			$exec= $db->insert("tx_do_dtl", $data);
			$where = array("id_user" => $_SESSION['ID_LOGIN']);
			$db->delete("tx_do_tmp",$where);
			$data = array( 
					'status' => 1, 
					);
			$exec= $db->update("tx_do_dtl", $data,"no_do='$_POST[no_ref]' and id_barang='$valtmp[id_barang]'");
			$data = array( 
					'status_so' => 4, 
					);
			$exec= $db->update("tx_sales_order", $data,"no_sales='$_POST[no_ref]'");
		}	
	}//end if jumlah
	echo "<script>window.location='index.php?x=delivo'</script>";
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_do_tmp",$where);
	
	echo "<script>window.location='index.php?x=delivo&id=$_POST[links]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_do_tmp",$where);
	echo "<script>window.location='index.php?x=delivo&id=$_POST[links]'</script>";

}else{
?>	
	
    <div class="col-lg-7">
		<form action="index.php?x=delivo_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Delivery Order" onClick="window.location='index.php?x=delivo_v'"></button></li>
							</ul>
                            </div>
					</div>
                     
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="6">
                        <div class="form-group" >
                                  <div class="col-lg-7">
                                    
                                    <select name="id_stok" id="id_stok" class="select-search" onChange="pindahData(id_stok.value)">
                                      <option value="">---No SPJ - Customer - No SO---</option>
                                      <?php 
									  $gudang=$db->select("tx_sales_order a join m_customer b on a.id_cus=b.id_cus join tx_sales_biaya c on a.no_sales=c.no_so","*","status_so='3' and a.id_gudang='$_SESSION[ID_GUDANG]'");
									 $exp=explode("_",$_GET['id']);
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['no_sales']."_".$val['id_gudang']?>" <?php if($exp[0]==$val['no_sales']){echo "selected";}?>> <?=$val['no_spj']." - ".$val['nama_usaha']." - ".$val['no_sales']?></option> 
                                     <?php } ?>
                                    </select>
                                    </div>
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-lg-1">
                                    </select>
                                    </div>
                      </div>
                      </td>
                      </tr>
                            <tr>
                              	<th width="5%">Kode</th>
                                <th width="20%">Nama Barang</th>
                                <th width="10%">Satuan</th>
                              	<th width="10%">QTY</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                        </thead>

                    </table>
                    <input type="hidden" name="id" id="id"  value="" placeholder='id' required>               
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="qty2" id="qty2"  value=""  placeholder='minta' required>
                    <input type="hidden" name="satuan2" id="satuan2"  value=""  placeholder='sat' required>
                    <input type="hidden" name="harga2" id="harga2"  value=""  placeholder='harga' required>
                    <input type="hidden" name="idlink" id="idlink"  value="<?=$_GET['id']?>" required>

                    
   		  </div>
			</form>
		</div>
         			
	 <form class="form-horizontal" action="index.php?x=delivo" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                   <br>
                  <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;Tanggal</label>
                              <div class="col-lg-4">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control daterange-single" name="tgl" id="tgl" value="<?php echo date("Y-m-d")?>">
                                   <input type="hidden" name="no_ref" id="no_ref"  value="<?php $gg=explode('_',$_GET['id']);echo $gg[0]?>"   required>
                                   <input type="hidden" name="id_gudangnya" id="id_gudangnya"  value="<?php $gg=explode('_',$_GET['id']);echo $gg[1]?>"   required>
                                  </div>
                               </div>
                               <div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="batal()">
										 Batal 
                                        </button>
                                        <input type="hidden" name="aksi" id="aksi"    required>
								      <input type="hidden" name="id2" id="id2"  value=""  required>
                                      <input type="hidden" name="links" id="links"  value="<?=$_GET['id']?>"  required>
								</div>
                                
                    </div>
                   <?php 
				   $da=explode("_",$_GET['id']);
				  $dk=$db->select("tx_sales_order a left join tx_sales_biaya b on a.no_sales=b.no_so left join m_jenis_kendaraan d on b.id_jenis_kendaraan=d.id_jenis","d.nama,a.no_sales,
				  b.no_spj","a.no_sales='$da[0]'");
                                          $no=1;
                                          foreach($dk as $dnj){}  ?>
                                          
                     <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;No SO</label>
                              <div class="col-lg-4">
                              	  <div class="input-group">
                                  <input type="text" name="no_so" id="no_so" class="form-control" value="<?=$dnj['no_sales']?>" readonly>
                                  </div>
                               </div>
                    </div>             
                     <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;SPJ</label>
                              <div class="col-lg-4">
                              	  <div class="input-group">
                                  <input type="text" name="spj" id="spj" class="form-control" value="<?=$dnj['no_spj']?>" readonly>
                                  </div>
                               </div>
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;Jenis Kendaraan</label>
                              <div class="col-lg-4">
                              	  <div class="input-group">
                                  <input type="text" name="jenis_ken" id="jenis_ken" class="form-control" value="<?=$dnj['nama']?>" readonly>
                                  </div>
                               </div>
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;Keterangan</label>
                              <div class="col-lg-4">
                              	  <div class="input-group">
                                  <textarea rows="2" cols="30" class="form-control" name="keterangan"></textarea> 
                                  </div>
                               </div>
                    </div>
					<div class="panel-body">
                    			 <div class="form-group">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td width="4%"align="center"><strong>No</strong></td>
                                            <td align="center" width="30%"><strong>Nama Barang</strong></td>
                                            <td width="10%"align="center"><strong>Satuan</strong></td>
                                            <td width="10%"align="center"><strong>Qty</strong></td>
                                            <td width="10%" align="center"><strong>Aksi</strong></td>
                                          </tr>
                                          <?php
										  $idgud=explode("_",$_GET['id']);
                                          $kon=$db->select("tx_do_tmp a
										  JOIN m_barang_gudang b ON a.id_barang = b.id_barang
										  JOIN m_satuan c ON a.id_satuan = c.id_satuan
										  AND a.id_gudang = b.id_gudang","a.id_tmp,
										  a.id_barang,
										  a.id_satuan,
										  a.qty,
										  a.id_user,
										  a.id_gudang,
										  c.nama_satuan,
										  b.kode_barang,
										  b.nama_barang","id_user='$_SESSION[ID_LOGIN]'");
                                          $no=1;
                                          foreach($kon as $d){  ?>
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['kode_barang']." - ".$d['nama_barang'];?>&nbsp;</td>
                                            <td align="center"><?=$d['nama_satuan']?>&nbsp;</td>
                                            <td align="center"><?=number_format($d['qty'])?>&nbsp;</td>
                                            <td align="center"><a href="javascript:void(0)" onclick="hapus(<?php echo $d['id_tmp'];?>)">hapus</a>&nbsp;</td>
                                          </tr>
                                          <?php $no++;} ?>
                                        </table>
                                     
                                 </div>
                                  
					
					</div>	
                  
				</div>	
               
		</div>
</form>
<?php }?>
