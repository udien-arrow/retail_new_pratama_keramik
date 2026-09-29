<?php
session_start();
error_reporting(0);
include"../../../webclass.php";
$db=new kelas();
foreach($db->select("preferences","*") as $pref){}
foreach($db->select("tm_kas","*","id_kas='$_GET[id]'") as $kas){}
?>
<style>
    .table1 {
        border-collapse: collapse;
    }    
    .table1, .td, .th {
        border: 1px solid black;
        padding:3px;
    }
    </style>
    <style type="text/css">
    <!--
    body,td,th {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size: 12px;
    }
    
    -->
    </style>
<?php
echo $pref[nama_perusahaan]."<br>";
echo $pref[alamat]."<br><br>";
?>


<center>LAPORAN SETOR KAS</center>
<table width="100%" border="1" class="table1">
  <tr>
    <td width="18%" class="td">Kas Awal</td>
    <td width="31%" class="td">Total Penerimaan Kas</td>
    <td width="22%" class="td">Jumlah</td>
    <td width="20%" class="td">Setor Kas</td>
    <td width="9%" class="td">Sisa</td>
  </tr>
  <tr>
    <td align="right" class="td"><?=number_format($kas[AWAL_KAS])?>&nbsp;</td>
    <td align="right" class="td"><?=number_format($kas[TOTAL_TRANSAKSI])?>&nbsp;</td>
    <td align="right" class="td"><?=number_format($kas[TOTAL_TRANSAKSI]+$kas[AWAL_KAS])?>&nbsp;</td>
    <td align="right" class="td"><?=number_format($kas[SETOR_KAS])?>&nbsp;</td>
    <td align="right" class="td"><?=number_format($kas[SISA])?>&nbsp;</td>
  </tr>
</table>
<br />
<br />
<?php
foreach($db->select("tm_kas a JOIN r_user_login b ON a.ID_PEG=b.ID","*","id_kas='$_GET[id]'") as $vk){}

?>
<center>RINCIAN TRANSAKSI &amp; TOTAL UANG</center><br /><br />
KASIR : <?=$vk[USERNAME]?><br />
NOMOR : <?=$vk[NO_KAS]?><br />
WAKTU : <?=$vk[TANGGAL_KAS]?><br />
<table width="100%" border="1" class="table1">
  <tr>
    <td width="15%" class="td"><strong>Tanggal</strong></td>
    <td width="31%" class="td"><strong>No Bill</strong></td>
    <td width="22%" class="td"><strong>Uang Terima</strong></td>
    <td width="20%" class="td"><strong>Piutang</strong></td>
    <td width="20%" class="td"><strong>Kembalian</strong></td>
    <td width="30%" class="td"><strong>Total Penjualan</strong></td>
  </tr>
<?php
$trx=$db->select("pj_penjualan t,tm_kas k","*",
							"t.id_user=k.ID_PEG	
							AND t.jenis_jual='1'
							AND t.stamp_date BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'
							AND k.TANGGAL_KAS='$_GET[tgl1]'
							AND t.ID_USER='$_SESSION[ID_LOGIN]'
						  ");
				  
foreach($trx as $vtrx){
$pt=0;
$km=0;
if($vtrx[kembali_tunai]<0){
	$pt=abs($vtrx[kembali_tunai]);
	} else {$km=$vtrx[kembali_tunai];}
?> 
  <tr>
    <td align="left" class="td"><?=$vtrx[tgl_penjualan]?>&nbsp;</td>
    <td align="left" class="td"><?=$vtrx[no_penjualan]?>
      &nbsp;</td>
    <td align="right" class="td"><?=number_format($vtrx[bayar_tunai]-$km)?>
      &nbsp;</td>
    <td align="right" class="td"><?=number_format(abs($pt))?>
      &nbsp;</td>
    <td align="right" class="td"><?=number_format(($km))?>
      &nbsp;</td>
    <td align="right" class="td"><?=number_format($vtrx[bayar_tunai]+$pt-$km)?></td>
  </tr>
 
<?php
	$tt+= $vtrx[bayar_tunai]-$km;
	$ttp+=$pt;
  $ttp1+=$km;
  $ttp2+=$vtrx[bayar_tunai]-$km+$pt;
}
?>
 <tr>
    <td colspan="2" align="right" class="td"><strong>TOTAL</strong></td>
    <td align="right" class="td"><strong>
      <?=number_format($tt)?>
    </strong></td>
    <td align="right" class="td"><strong>
      <?=number_format($ttp)?>
    </strong></td>
    <td align="right" class="td"><strong>
      <?=number_format($ttp1)?>
    </strong></td>
    <td align="right" class="td"><strong>
      <?=number_format($ttp2)?>
    </strong></td>
  </tr>
</table>
<br /><br />
<?php
foreach($db->select("tm_kas a JOIN r_user_login b ON a.ID_PEG=b.ID","*","id_kas='$_GET[id]'") as $vk){}

?>
<center>RINCIAN PENJUALAN BARANG</center><br /><br />
KASIR : <?=$vk[USERNAME]?><br />
NOMOR : <?=$vk[NO_KAS]?><br />
WAKTU : <?=$vk[TANGGAL_KAS]?><br />
<table width="100%" border="1" class="table1">
  <tr>
    <td width="13%" class="td"><strong>Tanggal</strong></td>
    <td width="23%" class="td"><strong>Kode Barang</strong></td>
    <td width="16%" class="td"><strong>Nama Barang</strong></td>
    <td width="5%" class="td"><strong>Satuan</strong></td>
    <td width="5%" class="td"><strong>Qty</strong></td>
    <td width="17%" class="td"><strong>Harga</strong></td>
    <td width="26%" class="td"><strong>Total</strong></td>
  </tr>
<?php
$trx=$db->select("pj_penjualan t,pj_penjualan_dtl l,tm_kas k, m_barang b, m_satuan s","t.no_penjualan,b.kode_barang,
	t.tgl_penjualan,
	sum(l.qty_jual) as qty_jual,
	sum(l.dtl_total) as dtl_total,
	b.nama_barang,
	s.nama_satuan",
							"t.id_user=k.ID_PEG	
							AND t.id_pj=l.id_pj
							AND b.id_barang=l.id_barang 
							AND s.id_satuan=b.id_satuan
							AND t.jenis_jual='1'
							AND t.stamp_date BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'
							AND k.TANGGAL_KAS='$_GET[tgl1]'
							AND t.ID_USER='$_SESSION[ID_LOGIN]'
							group by b.id_barang, harga_jual
						  ");
						  
  echo"select t.no_penjualan,
  t.tgl_penjualan,
  sum(l.qty_jual) as qty_jual,
  sum(l.dtl_total) as dtl_total,
  b.nama_barang,
  s.nama_satuan from pj_penjualan t,pj_penjualan_dtl l,tm_kas k, m_barang b, m_satuan s where t.id_user=k.ID_PEG  
              AND t.id_pj=l.id_pj
              AND b.id_barang=l.id_barang 
              AND s.id_satuan=b.id_satuan
              AND t.jenis_jual='1'
              AND t.stamp_date BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'
              AND k.TANGGAL_KAS='$_GET[tgl1]'
              AND t.ID_USER='$_SESSION[ID_LOGIN]'
              group by b.id_barang, harga_jual";
			  
foreach($trx as $vtrx){

?>
  <tr>
    <td class="td"><?=$vtrx[tgl_penjualan]?>&nbsp;</td>
    <td class="td"><?=$vtrx[kode_barang]?>&nbsp;</td>
    <td class="td"><?=$vtrx[nama_barang]?>&nbsp;</td>
    <td class="td"><?=$vtrx[nama_satuan]?>&nbsp;</td>
    <td class="td" align="right"><?=$vtrx[qty_jual]?>&nbsp;</td>
    <td align="right" class="td"><?=number_format($vtrx[dtl_total]/$vtrx[qty_jual])?>&nbsp;</td>
    <td align="right" class="td"><?=number_format($vtrx[dtl_total])?></td> 
  </tr>
  
<?php 
$td+=$vtrx[dtl_total];
}
?>
  <tr>
    <td colspan="5" align="right" class="td"><strong>TOTAL</strong></td>
    <td align="right" class="td"><strong>
      <?=number_format($td)?>
    </strong></td>
  </tr>
</table>
    