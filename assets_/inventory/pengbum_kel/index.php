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
	if($_SESSION['ID_JABATAN']==1){
	$sa=1;	
	}else{
	$sa=0;	
	}
	$dttmp=$db->select("tx_pengbum_tmp","id_user,id_gudang","id_user='$_SESSION[ID_LOGIN]' group by id_gudang");
	foreach($dttmp as $valtmp){	
	  if($valtmp['id_user']<>''){
		$idgen=$db->nourut('no_pengbum', 'tx_pengbum', 'BU', sprintf("%02s", $_SESSION['ID_GUDANG']), date('Y-m-d'));
		$id=$db->idurut("tx_pengbum","id_pengbum");
		$data = array( 
					'id_pengbum' => $id, 
					'no_pengbum' => $idgen, 
					'stampdate' => date('Y-m-d H:i:s'),
					'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
					'duedate' => date("Y-m-d",strtotime($_POST['due'])),
					'ket' => $_POST['ket'],
					'id_gudang' => $_POST['gudang_z'],
					'jenis' => $_POST['jenis_z'],
					'id_cabang' => $_SESSION['ID_CABANG'],
					'id_user' => $valtmp['id_user'],
					'status' => $sa,
					);
		$exec= $db->insert("tx_pengbum", $data);
		$dttmp2=$db->select("tx_pengbum_tmp","*","id_user='$valtmp[id_user]' and id_gudang='$valtmp[id_gudang]'");
		foreach($dttmp2 as $valtmp2){
			$iddtl=$db->idurut("tx_pengbum_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $iddtl, 
					'id_barang' => $valtmp2['id_barang'],
					'sat' => $valtmp2['sat'],
					'id_pengbum' => $id,
					'no_pengbum' => $idgen,
					'qty' => $valtmp2['qty'],
					'hpp' => $valtmp2['hpp'],
					'status' => 0,
					);
			$exec= $db->insert("tx_pengbum_dtl", $data);
			
			$where = array(	 "id_user" => $valtmp['id_user'],
							 "id_gudang" => $valtmp['id_gudang']);
			$db->delete("tx_pengbum_tmp",$where);
		}
		
	//keluar
	$tgl=date('Y-m-d');
	$idcab=$db->select("r_user_login a
	JOIN m_pegawai b ON a.ID_PEGAWAI = b.id_pegawai
	JOIN m_gudang d ON b.id_cabang = d.id_cabang
	JOIN m_cabang c ON b.id_cabang = c.id_cabang","d.id_gudang,
	nama_gudang,
	b.id_cabang,
	c.kode_cabang","ID='$_SESSION[ID_LOGIN]'");
	foreach($idcab as $valcab){}
	$idgen2=$db->nourut('no_keluar', 'tx_brg_keluar', 'IK', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$dttmp=$db->select("tx_pengbum a join tx_pengbum_dtl b on a.no_pengbum=b.no_pengbum","*","a.no_pengbum='$idgen'");
	$sa=$db->select("tx_pengbum","*","no_pengbum='$idgen'");
	foreach($sa as $as){}
	$jumlah=count($dttmp);
	if($jumlah>0){
		$id=$db->idurut("tx_brg_keluar","id_keluar");
		$data = array( 
					'id_keluar' => $id, 
					'no_keluar' => $idgen2, 
					'id_gudang' => $as['id_gudang'],
					'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
					'stampdate' => $as['stampdate'],
					'no_ref' => $as['no_pengbum'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'ket' => $_POST['ket'],
					'status' => 1,
					);
		$exec= $db->insert("tx_brg_keluar", $data);
		foreach($dttmp as $valtmp){
			$supp=$valtmp['id'];
			$ids=$db->idurut("tx_brg_keluar_dtl","id_dtl");
			$total=$valtmp['qty']*$valtmp['hpp'];
			$data = array( 
					'id_dtl' => $ids, 
					'id_keluar' =>$id, 
					'no_keluar' => $idgen2,
					'id_barang' => $valtmp['id_barang'],
					'qty' => $valtmp['qty'],
					'hpp' => $valtmp['hpp'],
					'total' => $total,
					'status' => 0,
					'sat' => $valtmp['sat'],
					);
			$exec= $db->insert("tx_brg_keluar_dtl", $data);

			$data = array( 
					'status' => 1, 
					);
			$exec= $db->update("tx_pengbum_dtl", $data,"no_pengbum='$idgen' and id_barang='$valtmp[id_barang]'");
		}
		$data2 = array( 
					'status' => 3, 
					);
		$exec= $db->update("tx_pengbum", $data2,"no_pengbum='$idgen'");
		//mutasi
		$dttmp=$db->select("tx_brg_keluar a
JOIN tx_brg_keluar_dtl b ON a.no_keluar = b.no_keluar
JOIN m_barang_gudang c ON b.id_barang = c.id_barang AND a.id_gudang = c.id_gudang","a.id_keluar,
b.no_keluar,
a.id_gudang,
a.kpd_id_gudang,
a.id_user,
a.`status`,
a.ket,
a.tgl,
a.stampdate,
a.no_ref,
b.qty,
c.kode_barang,
c.nama_barang,
b.id_barang,
b.hpp","b.no_keluar='$idgen2'");
	$jumlah=count($dttmp);
	
	if($jumlah>0){
		foreach($dttmp as $valtmp){
	$cek=$db->select("tx_mutasi","*","id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]' ORDER BY id_mutasi DESC LIMIT 0,1");
			foreach($cek as $mutan){}
			$ak=$db->select("tx_mutasi","max(id_mutasi)as id");
		    foreach($ak as $ka){}
		    $idn=$ka['id']+1;
			$akhir=$mutan['akhir']-$valtmp['qty'];
			$tglmutasi=date("Y-m-d H:i:s");
			$datai = array( 
		 		'id_mutasi' => $idn,
				'no_ref' => $idgen,
				'awal' => $mutan['akhir'],
				'masuk' => 0,
				'keluar' =>  $valtmp['qty'],
				'akhir' => $akhir,
				'hpp' => $valtmp['hpp'],
				'tgl_mutasi' => $tglmutasi,
				'jenis_mutasi' => 1,
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_gudang' => $valtmp['id_gudang'],
				'id_barang' => $valtmp['id_barang']
				);
				
			$exec= $db->insert("tx_mutasi", $datai);
			$vv=$db->select("m_barang_gudang","*","id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]'");
		    foreach($vv as $vw){}
			$total=$akhir*$vw['hpp'];
			$data33 = array( 
					'stok' => $akhir, 
					'total' => $total, 
					);
			$exec= $db->update("m_barang_gudang", $data33,"id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]'");
			}
			
	}
			
			
	}
		
	  }
	}//end if jumlah
			echo "<script>alert('Sukses Simpan Data Dengan Nomer BU $idgen');window.location='index.php?x=pengbum_kel'</script>";
	
}
if($_POST[aksi]=='hapus'){
	//echo $_POST['id2'];
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_pengbum_tmp",$where);
	echo "<script>	window.location='index.php?x=pengbum_kel&gudang=$_POST[gudang_z]&jenis=$_POST[jenis_z]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_pengbum_tmp",$where);
	echo "<script>	window.location='index.php?x=pengbum_kel&gudang=$_POST[gudang_z]&jenis=$_POST[jenis_z]'</script>";
}else{
?>	
    <div class="col-lg-6">
		<form action="index.php?x=pengbum_kel_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input <?=$title?> </h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Permintaan" onClick="window.location='index.php?x=pengbum_kel_v'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th colspan="5">
                                <div class="form-group" > 
                                
                                <?php if($_SESSION['ID_GUDANG']=="" or $_SESSION['ID_GUDANG']=="0"){ ?>
                                <div class="col-lg-5">
                                    <select name="gudang" id="gudang" class="select-search" onChange="pindahData(gudang.value)">
										<option value="">--Gudang--</option>
                                        <?php $gud=$db->select("m_gudang","*");
										foreach($gud as $gud){ ?>
                                        	<option value="<?=$gud['id_gudang']?>" <?php if($_GET['gudang']==$gud['id_gudang']){echo "selected";}?>><?=$gud['nama_gudang']?></option>
									<?php } ?>
                                    </select>
                                    </div> 
                                    <?php }else{ ?>
                                    <input type="hidden" name="gudang" id="gudang" value="<?=$_SESSION['ID_GUDANG']?>">
                                    <?php } ?>                               
                                    <div class="col-lg-5">
                                    <select name="jenis" id="jenis" class="select-search" onChange="pindahData2(gudang.value,jenis.value)">
										<option value="">--Jenis--</option>
                                        	<option value="4" <?php if($_GET['jenis']==4){echo "selected";}?>>Alat</option>
                                            <option value="5" <?php if($_GET['jenis']==5){echo "selected";}?>>Sparepart</option>
									</select>
                                    </div>
                                 </div>
                                
                                </th>
                              <th>&nbsp;</th>
                            </tr>
                            <tr>
                               
                                <th width="5%">Kode</th>
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
                    <?php
						$jum2=$db->select("v_barang","*");
						$jum=count($jum2);
					?>
		   			<input type="hidden" name="qty_in" id="qty_in"  value=""  placeholder="qty" required>
            		<input type="hidden" name="id" id="id"  value="" placeholder="barang"  required>
           			<input type="hidden" name="sat_in" id="sat_in"   placeholder="sat"  required>
                    <input type="hidden" name="gud_in" id="gud_in"  placeholder="gud"  required>
                    <input type="hidden" name="hpp2" id="hpp2"  placeholder="gud"  required>
                    <input type="hidden" name="jenis_s" id="jenis_s"  value="<?=$_GET['jenis']?>"  required>
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=pengbum_kel" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Permintaan Penggunaan Barang Umum</h5>
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
                                  <input type="text" class="form-control datepicker" name="due" id="due" value="<?php echo date('d-m-Y', strtotime('+7 days'));?>">
                                  </div>
                               </div>
                               
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Keterangan </label>						
                              	<div class="col-lg-8">
                                  <div class="form-group">
                              	 
                                  <input type="text" class="form-control" name="ket" id="ket" >
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
									  <input type="hidden" name="jenis_z" id="jenis_z"  value="<?php echo $_GET[jenis]?>"  required>
                                      <input type="hidden" name="gudang_z" id="gudang_z"  value="<?php echo $_GET[gudang]?>"  required>
							</div>
                            
                            
                     </div>       
					<div class="panel-body">
                    		
								<div class="tabbable">
									<ul class="nav nav-tabs">
										<?php
                                        $tmp=$db->select("tx_pengbum_tmp a left join m_gudang b on a.id_gudang=b.id_gudang","a.id_gudang,b.nama_gudang","id_user='$_SESSION[ID_LOGIN]' group by id_gudang");
										$no=1;
										foreach($tmp as $valtmp){
										?>
                                        <li class="<?php if($no==1){echo "active";}?>">
                                        <a href="#id_<?=$valtmp['id_gudang']?>" data-toggle="tab"><?php if($valtmp['id_gudang']=='0'){echo "Pembelian";}else{echo $valtmp['nama_gudang'];}?>
                                        </a></li>
                                        
                                        <?php $no++;}?>
									</ul>

									<div class="tab-content">
                                    <?php
                                        $tmp=$db->select("tx_pengbum_tmp a left join m_gudang b on a.id_gudang=b.id_gudang","a.id_gudang,b.nama_gudang","id_user='$_SESSION[ID_LOGIN]' group by id_gudang");										$no=1;
										foreach($tmp as $valtmp){
												
									?>
										<div class="tab-pane <?php if($no==1){echo "active";}?>" id="id_<?=$valtmp['id_gudang']?>">
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