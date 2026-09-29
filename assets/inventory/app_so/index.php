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
	//echo"disini";
	/*
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
	echo "<script>window.location='index.php?x=so'</script>"; */
	
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
		<form action="index.php?x=appso_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Stok Opname" onClick="window.location='index.php?x=appso_v'"></button></li>
							</ul>
                            </div>
					</div>
                     
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="6">
                        <div class="form-group" >
                                  <div class="col-lg-9">
                                    <select name="id_stok" id="id_stok" class="select-search" onchange="pindahData(id_stok.value)">
                                      <option value="">---No Stok Opname---</option>
                                      <?php 
									  $gudang=$db->select("tx_stok_opname a join m_gudang b on a.id_gudang=b.id_gudang","*","a.status='0'");
									  $asf=explode("_",$_GET['id']);
									  foreach($gudang as $val){
										if($val['duedate']>=date("Y-m-d")){
										
									  ?>
                                      <option value="<?=$val['id_stok_opname']."_".$val['id_gudang']?>" <?php if($asf[0]==$val['id_stok_opname']){echo "selected";}?>>
                                        <?=$val['id_stok_opname']." - ".$val['nama_gudang']." - ".$val['tgl']?>
                                      </option>
                                      <?php }} ?>
                                    </select>
                                  </div>
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-lg-1">
                                    <button class="btn btn-primary" type="submit" onclick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Approve 
                                    </button>
                                    </select>
                                    </div>
                      </div>
                      </td>
                      </tr>
                            <tr>
                            	<th width="10%">Kode</th>
                                <th width="20%">Nama Barang</th>
                                <th width="10%">Satuan</th>
                                <th width="5%">Stok Fisik</th>
                                <th width="5%">Stok Sistem</th>
                                <th width="5%">Selisih</th>
                                <th width="20%">Keterangan</th>
                                <th width="5%">Hpp Akhir</th>
                                <th width="2%"><input type="checkbox" name="cek_all" id="cek_all" /></th>
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
         			
		</div>
</form>
<?php }?>
