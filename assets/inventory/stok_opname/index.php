
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
	$idgen=$db->nourut('id_stok_opname', 'tx_stok_opname', 'SO', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$dttmp=$db->select("tx_stok_opname_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$jumlah=count($dttmp);
	if($jumlah>0){
		$id=$db->idurut("tx_stok_opname","id");
		$data = array( 
					'id' => $id, 
					'id_stok_opname' => $idgen, 
					'tgl' => $_POST['tgl'],
					'duedate' => $_POST['duedate'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'status' => 0,
					);
		
		$exec= $db->insert("tx_stok_opname", $data);
		
		
		
		foreach($dttmp as $valtmp){
			$supp=$valtmp['id'];
			$id=$db->idurut("tx_stok_opname_dtl","id");
			$data = array( 
					'id' => $id, 
					'id_stok_opname' => $idgen, 
					'kd_brg' => $valtmp['id_barang'],
					'stok_fisik' => $valtmp['stok_fisik'],
					'stok_sys' => $valtmp['stok_sys'],
					'selisih' => $valtmp['selisih'],
					'ket' => $valtmp['keterangan'],
					'status' => 0,
					'hpp_akhir' => $valtmp['hpp'],
					);
			
			$exec= $db->insert("tx_stok_opname_dtl", $data);
			$where = array("id_user" => $_SESSION['ID_LOGIN']);
			$db->delete("tx_stok_opname_tmp",$where);
		}
		$data = array( 
					'id_gudang' => $valtmp['id_gudang'], 
					);
		$exec= $db->update("tx_stok_opname", $data,"id_stok_opname='$idgen'");
			
			
	}//end if jumlah
	echo "<script>window.location='index.php?x=so'</script>";
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id" => $_POST['id2']);
	$db->delete("tx_stok_opname_tmp",$where);
	
	echo "<script>window.location='index.php?x=so&gudang=$_POST[gudan]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_stok_opname_tmp",$where);
	echo "<script>window.location='index.php?x=so&gudang=$_POST[gudan]'</script>";

}else{
?>	
    <div class="col-lg-6">
		<form action="index.php?x=so_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Stok Opname</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Stok Opname" onClick="window.location='index.php?x=so_v'"></button></li>
							</ul>
                            </div>
					</div>
                     
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="6">
                        <div class="form-group" >
                                  <div class="col-lg-5">
                                    
                                    <select name="gudangs" id="gudangs" class="select-search" onChange="pindahData(gudangs.value)">
                                      <option value="">---Gudang---</option>
                                      <?php 
									  $gudang=$db->select("r_user_login a join m_pegawai b on a.ID_PEGAWAI=b.id_pegawai join m_gudang d on b.id_cabang=d.id_cabang","d.id_gudang,nama_gudang","ID='$_SESSION[ID_LOGIN]' and d.id_gudang='$_SESSION[ID_GUDANG]'"); 
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['id_gudang']?>" <?php if($_GET['gudang']==$val['id_gudang']){echo "selected";}?>> <?=$val['nama_gudang']?></option> 
                                     <?php } ?>
                                    </select>
                                    </div>
                      </div>
                      </td>
                      </tr>
                            <tr>
                                <th width="5%">ID</th>
                              	<th width="40%">Nama Barang</th>
                                <th width="20%"> Stok Sistem</th>
                              	<th width="10%">Stok Fisik</th>
                                <th width="10%">Keterangan</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                        </thead>

                    </table>
                    <?php
						$jum2=$db->select("v_barang","*");
						$jum=count($jum2);
					?>
            		<input type="hidden" name="id" id="id"  value=""  required>               
                    <input type="hidden" name="tambah_in" id="tambah_in"  value=""  required>
                    <input type="hidden" name="stok_sys2" id="stok_sys"  value=""  required>
                    <input type="hidden" name="gudang2" id="gudang2"  value="<?=$_GET['gudang']?>"  required>
                    <input type="hidden" name="stok_fisik2" id="stok_fisik"  value=""  required>
                    <input type="hidden" name="keterangan2" id="keterangan"  value=""  required>
                    <input type="hidden" name="hpp2" id="hpp"  value=""  required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=so" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
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
                                  <input type="text" class="form-control daterange-single" name="tgl" id="tgl" value="<?php echo date("Y-m-d")?>" readonly>
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
									  <input type="hidden" name="gudan" id="gudan"  value="<?php echo $_GET[gudang]?>"  required>
								</div>
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;Due Date</label>
                              <div class="col-lg-4">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control daterange-single" name="duedate" id="duedate" value="<?php echo  date('Y-m-d', strtotime("+1 month"));?>">
                                  </div>
                               </div>
                    </div>
					<div class="panel-body">
                    			 <div class="form-group">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td width="4%"align="center"><strong>No</strong></td>
                                            <td align="center" width="30%"><strong>Nama Barang</strong></td>
                                            <td width="10%"align="center"><strong>Stok Sistem</strong></td>
                                            <td width="10%" align="center"><strong>Stok Fisik</strong> </td>
                                            <td width="10%" align="center"><strong>Selisih</strong></td>
                                            <td width="10%" align="center"><strong>Keterangan</strong></td>
                                            <td width="10%" align="center"><strong>Aksi</strong></td>
                                          </tr>
                                          <?php
										  $idgud=$_GET['gudang'];
                                          $kon=$db->select("tx_stok_opname_tmp a JOIN m_barang_gudang b on a.id_barang=b.id_barang","a.*,b.nama_barang,b.kode_barang","id_user='$_SESSION[ID_LOGIN]' and b.id_gudang= $idgud");
                                          $no=1;
                                          foreach($kon as $d){  ?>
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['kode_barang']." - ".$d['nama_barang'];?>&nbsp;</td>
                                            <td align="center"><?=$d['stok_sys']?>&nbsp;</td>
                                            <td align="center"><?=$d['stok_fisik']?>&nbsp;</td>
                                            <td align="center"><?=$d['selisih']?>&nbsp;</td>
                                            <td align="center"><?=$d['keterangan'];?>&nbsp;</td>
                                            <td align="center"><a href="javascript:void(0)" onclick="hapus(<?php echo $d['id'];?>)">hapus</a>&nbsp;</td>
                                          </tr>
                                          <?php $no++;} ?>
                                        </table>
                                     
                                 </div>
                                  
					
					</div>	
                    
				</div>					
		</div>
</form>
<?php }?>
