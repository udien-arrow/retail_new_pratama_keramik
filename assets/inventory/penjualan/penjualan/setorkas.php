<style>
        table {
            border-collapse: collapse;
        }
        table, td, th {
            border: 1px solid #DDD ;
            padding:1px;
        }
</style>
<div class="col-lg-1"></div>
<div class="col-lg-10" >
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->				</ul>
                        </div>
					</div>
                    
<div class="panel-body">

<div class="col-lg-12">
<form class="form-horizontal" action="index.php?x=setorkas_s" name="formku" id="formku" method="post">
<div class="col-lg-5 form-horizontal">
<div class="form-group" >
<br>
<?php
foreach($db->select("tm_kas","AWAL_KAS,ID_KAS","TANGGAL_KAS = (SELECT MAX( TANGGAL_KAS ) FROM tm_kas WHERE ID_PEG = '$_SESSION[ID_LOGIN]') AND SETOR_KAS='0'") as $vkas){}

/*echo "select AWAL_KAS,ID_KAS from tm_kas where TANGGAL_KAS = (SELECT MAX( TANGGAL_KAS ) FROM tm_kas WHERE ID_PEG = '$_SESSION[ID_LOGIN]') AND SETOR_KAS='0' <br><br>";
*/$tglawalakhir=$db->select("pj_penjualan t,tm_kas k","MAX(k.TANGGAL_KAS) as max1, MAX(t.stamp_date) as max2","t.id_user = k.ID_PEG
                            AND t.id_user = '$_SESSION[ID_LOGIN]'
                            AND ifnull(t.void_jual,'') =''
                            AND t.jenis_jual = '1'
                            AND k.SETOR_KAS='0'");

/*echo "select MAX(k.TANGGAL_KAS) as max1, MAX(t.stamp_date) as max2 from pj_penjualan t,tm_kas k where t.id_user = k.ID_PEG
                            AND t.id_user = '$_SESSION[ID_LOGIN]'
                            AND ifnull(t.void_jual,'') =''
                            AND t.jenis_jual = '1' 
                            AND k.SETOR_KAS='0'<br><br>";
*/
foreach($tglawalakhir as $vtgl){}
$trxt=$db->select(" pj_penjualan t,tm_kas k","SUM(t.bayar_tunai) as sum, sum(case when t.kembali_tunai>'0' then t.kembali_tunai else 0 end) as kembali", "t.id_user = k.ID_PEG 
AND ifnull(t.void_jual,'') = ''
AND t.jenis_jual = '1'
AND t.stamp_date BETWEEN '$vtgl[max1]' AND '$vtgl[max2]'
AND k.TANGGAL_KAS = '$vtgl[max1]'");
/*echo "select SUM(t.bayar_tunai) as sum, um(case when t.kembali_tunai>'0' then t.kembali_tunai else 0 end) as kembali from pj_penjualan t,tm_kas k where t.id_user = k.ID_PEG 
AND ifnull(t.void_jual,'') = ''
AND t.jenis_jual = '1'
AND t.stamp_date BETWEEN '$vtgl[max1]' AND '$vtgl[max2]' 
AND k.TANGGAL_KAS = '$vtgl[max1]'";*/
foreach($trxt as $vtrxt){}
?>
  <label class="control-label col-lg-6">Modal Awal</label>
  <div class="col-lg-6">
      <input type="text"  name="modal" id="modal" readonly="" class="form-control" autocomplete="off" value="<?=number_format($vkas['AWAL_KAS'])?>">
      <input type="hidden"  name="id_kas" id="id_kas" readonly="" class="form-control" autocomplete="off" value="<?=$vkas[ID_KAS]?>">
      <input type="hidden"  name="tgl1" id="tgl1" readonly="" class="form-control" autocomplete="off" value="<?=$vtgl[max1]?>">
      <input type="hidden"  name="tgl2" id="tgl2" readonly="" class="form-control" autocomplete="off" value="<?=$vtgl[max2]?>">
      <input type="hidden"  name="id_peg" id="id_peg" readonly="" class="form-control" autocomplete="off" value="<?=$_SESSION[ID_LOGIN]?>">
  </div>     
</div>

<div class="form-group">
      <label class="control-label col-lg-6">Total Penerimaan Tunai</label>
      <div class="col-lg-6">
      <input type="text" name="totpj" id="totpj" class="form-control numbformat" readonly="" autocomplete="off" value="<?=number_format($vtrxt[sum]-$vtrxt[kembali])?>">
      
      </div>     
</div>

<div class="form-group" >
      <label class="control-label col-lg-6">Jumlah (Modal + Total Pj)</label>
      <div class="col-lg-6">
      <input type="text" name="jumlah" id="jumlah" class="form-control numbformat" readonly="" autocomplete="off" value="<?=number_format(($vtrxt[sum]-$vtrxt[kembali])+$vkas[AWAL_KAS])?>" >
      </div>     
</div>



<div class="form-group">
      <label class="control-label col-lg-6">Setor</label>
      <div class="col-lg-6">
      <input type="text" name="setor" id="setor" class="form-control numbformat" autocomplete="off" value="" >
      </div>     
</div>
<div class="form-group">
      <label class="control-label col-lg-6">Sisa Uang</label>
      <div class="col-lg-6">
      <input type="text" name="sisa" id="sisa" readonly="" class="form-control numbformat" autocomplete="off" value="" >
      </div>     
</div>

<div class="form-group" >
      <label class="control-label col-lg-4"></label>
      <div class="col-lg-6">
      <button class= "btn btn-primary" id="simpan"type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
      Simpan 
      </button>
      <input type="hidden" id="aksi" name="aksi" />
      <button class="btn btn-success" type="reset">
      Batal 
      </button>
    
</div>
</form>



<?php 
if($_POST['aksi']=='hapus'){
	$where = array("id_tmp" => $_POST['id']);
	$db->delete("pj_penjualan_dtl_tmp",$where);
	echo "<script>window.location='index.php?x=penjualan'</script>";
}

if($_GET['st']=='h'){
	$dttmp=$db->select("pj_penjualan_dtl_tmp","*","user_tmp='$_SESSION[ID_LOGIN]' and jenis=1");
	$jum=count($dttmp);
	if($jum>0){
		$idj=$db->nourut('no_hold', 'pj_penjualan_dtl_tmp_hold', 'HL', sprintf("%02s", $_SESSION['ID_GUDANG']), date("Y-m-d"));
		foreach($dttmp as $dta){
			$data = array(
				"id_barang" => $dta['id_barang'],
				"harga_jual_tmp" => $dta['harga_jual_tmp'],
				"qty_tmp" => $dta['qty_tmp'],
				"discprs_tmp" => $dta['discprs_tmp'],
				"total_tmp" => $dta['total_tmp'],
				"session_jual" => $dta['session_jual'],
				"status" => $dta['status'],
				"user_tmp" => $dta['user_tmp'],
				"no_hold" => $idj,
				"tgl" => date("Y-m-d"),
				"jenis" => 1
			);
			$db->insert("pj_penjualan_dtl_tmp_hold",$data);
			
			$data = array(
				"id_tmp" => $dta['id_tmp'],
			);
			$db->delete("pj_penjualan_dtl_tmp",$data);
		}
	}
	
	echo "<script>
	alert('No Hold : $idj');
	window.location='index.php?x=penjualan'</script>";
}
if($_GET['st']=='b'){
	
	$dttmp=$db->select("pj_penjualan_dtl_tmp_hold","*","user_tmp='$_SESSION[ID_LOGIN]' and no_hold='$_GET[no]'");
		foreach($dttmp as $dta){
			$data = array(
				"id_barang" => $dta['id_barang'],
				"harga_jual_tmp" => $dta['harga_jual_tmp'],
				"qty_tmp" => $dta['qty_tmp'],
				"discprs_tmp" => $dta['discprs_tmp'],
				"total_tmp" => $dta['total_tmp'],
				"session_jual" => $dta['session_jual'],
				"status" => $dta['status'],
				"user_tmp" => $dta['user_tmp'],
				"jenis" => 1,
			);
			$db->insert("pj_penjualan_dtl_tmp",$data);
			
			$data = array(
				"id_tmp" => $dta['id_tmp'],
			);
			$db->delete("pj_penjualan_dtl_tmp_hold",$data);
		}
	
	echo "<script>
	window.location='index.php?x=penjualan'</script>";
}

?>
<div id="datapelanggan" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h6 class="modal-title">Hold Transaksi</h6>
							</div>
							<div class="modal-body" id="hahaha2">
                            
															
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								
							</div>
						</div>
					</div>
				</div>
<