<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	
?>
<div class="table-responsive">
<div class="table-responsive pre-scrollable">
 <?php 
	$ce=$db->select("tx_billing","*","no_billing='$_GET[id]'");
	foreach($ce as $cek){};
	if($cek['jenis']==0){
	$noma=$db->select("tx_billing a join tx_brg_masuk b on a.no_ref=b.no_ref left join m_gudang c on b.id_gudang=c.id_gudang","b.*,c.nama_gudang","a.no_billing='$_GET[id]'");
	}if($cek['jenis']==1){
	$noma=$db->select("tx_billing a 
join tx_billing_dtl d on a.no_billing=d.no_billing
JOIN tx_brg_masuk b ON d.no_spj = b.surat_jalan
LEFT JOIN m_gudang c ON b.id_gudang = c.id_gudang","b.*,c.nama_gudang","a.no_billing='$_GET[id]'");
	}
	
	foreach($noma as $nomas){ ?>
  <table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
    <thead>
    <h5 style="background-color:black;color:white">Penerimaan</h5>
    No Masuk : <?=$nomas['no_masuk']?><br>
    No SPJ : <?=$nomas['surat_jalan']?><br>
	Tgl : <?=$nomas['tgl']?><br>
	Gudang : <?=$nomas['nama_gudang']?><br>
	<br>
	<th>Nama Barang</th>
    <th>QTY Terima</th>
    <th>QTY Kurang</th>
    <th>Claim Utuh</th>
    <th>Claim KTG</th>
    <th>Harga</th>
    <th>Total</th>
     </thead>
     <tbody>
     <?php 
	 $dt=$db->select("tx_brg_masuk a join tx_brg_masuk_dtl b on a.no_masuk=b.no_masuk join m_barang_gudang c on b.id_barang=c.id_barang and a.id_gudang=c.id_gudang","b.*,c.nama_barang,c.kode_barang","a.no_masuk='$nomas[no_masuk]'");
	$total=0;
	$totals=0;
	 foreach($dt as $dtl){
		 $harga=$dtl['harga_beli'];
		 $tota=$dtl['total'];
		 $total+=$tota;
	  ?>
     <tr>
    <td><?=$dtl['kode_barang'].' - '.$dtl['nama_barang']?></td>
    <td><?=$dtl['qty_terima']?></td>
    <td><?=$dtl['qty_kurang']?></td>
    <td><?=$dtl['claim_utuh']?></td>
    <td><?=$dtl['claim_ktg']?></td>
    <td><?=number_format($dtl['harga_beli'])?></td>
    <td><?=number_format($dtl['total'])?></td>
    </tr>
    <?php } ?>
        <tr>
        <td colspan="6" align="right">Total</td>
        <td><?=number_format($total)?></td>
        </tr>
  	</tbody>
</table>
<?php 
	}
	$ce=$db->select("tx_billing","*","a.no_billing='$_GET[id]'");
	foreach($ce as $cek){};
	$nomas=$db->select("tx_billing a join tx_brg_masuk b on a.no_ref=b.no_ref left join m_gudang c on b.id_gudang=c.id_gudang","b.*,c.nama_gudang","a.no_billing='$_GET[id]'");
	$totals=0;
	foreach($nomas as $nomas1){
	$noma=$db->select("tx_retur_pem a join tx_retur_pem_dtl b on a.no_retur=b.no_retur","*","a.no_ref='$nomas1[no_masuk]'");
	foreach($noma as $nomas){}
if(count($noma)>0){	 
?>
<table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
    <thead>
    <h5 style="background-color:black;color:white">Retur</h5>
    No Retur : <?=$nomas['no_retur']?><br>
    No Ref : <?=$nomas1['no_masuk']?><br>
	Tgl : <?=$nomas['tgl_retur']?><br>
	<br>
	<th>Nama Barang</th>
    <th>QTY Kembali</th>
    <th>Harga Beli</th>
    <th>Total</th>
    <th>Ket</th>
     </thead>
     <tbody>
     <?php 
	  $ss=$db->select("tx_brg_masuk a join tx_brg_masuk_dtl b on a.no_masuk=b.no_masuk join m_barang_gudang c on b.id_barang=c.id_barang and a.id_gudang=c.id_gudang","b.*,c.nama_barang,c.kode_barang","a.no_masuk='$nomas1[no_masuk]'");
	 foreach($ss as $st){
	 $dt=$db->select("tx_retur_pem a join tx_retur_pem_dtl b on a.no_retur=b.no_retur join m_barang_gudang c on b.id_barang=c.id_barang and a.id_gudang=c.id_gudang","b.*,c.nama_barang,c.kode_barang","a.no_retur='$nomas[no_retur]' and b.id_barang='$st[id_barang]'");
	 foreach($dt as $dtl){
		 $totals=$totals+($dtl['qty_kembali']*$st['harga_beli']);
	 
	  ?>
     <tr>
    <td><?=$dtl['kode_barang'].' - '.$dtl['nama_barang']?></td>
    <td><?=$dtl['qty_kembali']?></td>
    <td><?=$st['harga_beli']?></td>
    <td><?=$dtl['qty_kembali']*$st['harga_beli']?></td>
    <td><?=$dtl['ket']?></td>
    </tr>
    <?php } } ?>
    <td colspan="3" align="right">Total</td>
    <td><?=$totals?></td>
  	</tbody>
</table>
<?php  } } ?>
      <p>&nbsp;</p>
</div>
