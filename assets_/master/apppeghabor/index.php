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
	$tgl=date('Ym');
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
	<div class="col-lg-1">
    </div>
    <div class="col-lg-10">
		<form action="index.php?x=apppeghabor_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
			<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Master Pegawai" onClick="window.location='index.php?x=pegawai&cd=b2'"></button></li>
							</ul>
              </div>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="8">
                        <div class="form-group" >
                                  <div class="col-lg-4">
                                    
                                    <select name="cabang" id="cabang" class="select-search" onChange="pindahData(cabang.value)">
                                      <option value="">---Cabang---</option>
                                      <?php 
									  $gudang=$db->select("m_cabang","*");
									  foreach($gudang as $val){
										?>
                                      <option value="<?=$val['id_cabang']?>" <?php if($val['id_cabang']==$_GET['id']){echo "selected";}?>><?=$val['nama_cabang']?></option> 
                                     <?php }?>
                                    </select>
                                    </div>
                                   
                                    <div class="col-lg-3">
                                    <input class="btn btn-primary" type="submit" name="setuju" onclick="return confirm('Apakah Anda yakin menyimpan data??')" value="Setuju">
									<input class="btn btn-primary" name="tolak" type="submit" onclick="return confirm('Apakah Anda yakin menyimpan data??')" value="Tolak">
										  
                                    </div>
                      </div>
                      </td>
                      </tr>
                            <tr>
                              <th>Nama Cabang</th>
                              <th>Nama</th>
                              <th>Jabatan</th>
                              <th>Status</th>
                              <th>Tgl Masuk</th>
                              <th>Tgl Keluar</th>
                              <th>No KTP</th>
                              <th>Alamat</th>
                              <th>Jenis</th>
                            	<th width="2%"><input type="checkbox" name="cek_all" id="cek_all"/></th>
                            </tr>
                        </thead>

                    </table>
                    <?php
						$jum2=$db->select("v_barang","*");
						$jum=count($jum2);
					?>
            		<input type="hidden" name="id" id="id"  value=""  required>               
                    <input type="hidden" name="tambah_in" id="tambah_in"  value=""  required>
   		  </div>
			</form>
		</div>
         			
		</div>
</form>
<?php }?>
