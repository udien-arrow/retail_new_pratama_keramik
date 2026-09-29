<?php
	require( '../../../webclass.php' );
	$db=new kelas;
	$tgla= date("Y-m-d");
	$tglb=date('Y-m-d', strtotime('+2 days'));
	$sat=$db->select("tx_tkbm_pembelian_dtl a 
	join tx_tkbm_pembelian b on a.id_tkbm_b=b.id_tkbm_b
	join m_kendaraan c on a.id_jenis_kendaraan=c.id
	","b.no_masuk,a.id_jenis_kendaraan,c.nopol,a.id_tkbm_b","b.tgl between '$tgla' and '$tglb'");
?>
	<option value='' selected>-pilih-</option> 
	<?php foreach($sat as $val){
	?>
	<option value="<?php echo $val['no_masuk'].'_'.$val['id_tkbm_b'].'_'.$val['id_jenis_kendaraan']?>"><?php echo $val['no_masuk'].'-'.$val['nopol']?></option>
	<?php
	}
?>
