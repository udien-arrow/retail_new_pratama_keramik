<?php 
require( 'webclass.php' );
$db=new kelas;
session_start();
?>
<style>
table {
		  border-collapse: collapse;
	  }
table, td, th {
				  border: 1px solid #DDD ;
				  padding:1px;
			  }
.th2{	
		border-top: 1px solid #ddd;	
	}
.td2 {
			   
               border: 0px solid #666; font-size:12px; 
               vertical-align:middle; padding:0px;line-height:15px;
           }
</style>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
<td style="width:100%;font-size:15px;" align="center" class="td2"><b>PERMINTAAN PEMBAYARAN EXPEDITURE</b></td>
</tr>
</table><br>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
 <?php
					$supp=$db->select("v_ex_order_tag","*","no_pt='$_GET[id]'");
					foreach($supp as $valsupp){}
					
					
					?>
<td class="td2" align="left" style="font-size:11px;">
No  :<b> <?=$valsupp['no_pt']?></b><br>
Supplier  :<b> <?=$valsupp['nama_usaha']?></b>
  <br>Tanggal :<b> <?=$valsupp['tgl_pt']?></b>
</td>
</tr>
</table>

<?php
$kon=$db->select("ex_order_tagihan_dtl","*","no_pt='$_GET[id]'");
foreach($kon as $d){			
$ce=$db->select("ex_expediture","*","no_expediture='$d[no_expediture]'");
foreach($ce as $cek){

if(substr($cek['no_so'],0,3)=='JWA'){
	$jw=$db->select("ex_expediture a
	JOIN tx_po b ON a.no_so = b.no_jwa or a.no_so = b.no_so
	LEFT JOIN tx_brg_masuk c on c.no_ref=b.no_po
	left join m_gudang e on c.id_gudang=e.id_gudang","b.no_jwa as no_so,c.*,e.nama_gudang","no_expediture='$d[no_expediture]'");
	
	
}else{

$jw=$db->select("ex_expediture a join tx_rilis_dtl b on a.no_so=b.no_so LEFT JOIN tx_brg_masuk c on b.no_so=c.no_ref
	left join m_gudang d on d.id_gudang=c.id_gudang","*","no_expediture='$d[no_expediture]'");
}}
?>

<h5>Penerimaan</h5>
<table cellpadding="0" cellspacing="0" style="width:98%;">
 <tr>
 <td style="width:3%;font-size:10px;text-align:left" colspan="8"><?php echo $d['no_expediture'];?><br></td>
 </tr> 
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>QTY Terima</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>QTY Kurang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Claim Utuh</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Claim Ktg</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Harga</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Total</b></td>
  </tr>
 <?php 
foreach($jw as $jwa){}
	$dt=$db->select("tx_brg_masuk a join tx_brg_masuk_dtl b on a.no_masuk=b.no_masuk join m_barang_gudang c on b.id_barang=c.id_barang and a.id_gudang=c.id_gudang","b.*,c.nama_barang,c.kode_barang","a.no_masuk='$jwa[no_masuk]'");
	 $no=1;
	 $tot=0;
	 foreach($dt as $dtl){
		 $tot=$tot+$dtl['total'];
	  ?>
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:40%;font-size:11px;text-align:left"><?=$dtl['kode_barang'].' - '.$dtl['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:right"><?=$dtl['qty_terima']?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=$dtl['qty_kurang']?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=$dtl['claim_utuh']?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=$dtl['claim_ktg']?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($dtl['harga_beli'])?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($dtl['total'])?></td>
  </tr>
  
<?php $no++; }  ?>

<tr>
  	<td colspan="7" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($tot)?></td>
</tr>
</table>
<?php 
	$noma=$db->select("tx_retur_pem a join tx_retur_pem_dtl b on a.no_retur=b.no_retur","*","a.no_ref='$jwa[no_masuk]'");
	foreach($noma as $nomas){}
	
	 
if(count($noma)>0){	

?>
<h5>Retur</h5>
<table cellpadding="0" cellspacing="0" style="width:98%;">
 <tr>
 <td style="width:100%;font-size:10px;text-align:left;" colspan="6">No Retur : <?=$nomas['no_retur']?><br>
	Tgl : <?=$nomas['tgl_retur']?><br></td>
 </tr> 
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>QTY Kembali</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Harga Beli</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Total</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Keterangan</b></td>
  </tr>
<?php 
$total=0;
$no=1;
	  $ss=$db->select("tx_brg_masuk a join tx_brg_masuk_dtl b on a.no_masuk=b.no_masuk join m_barang_gudang c on b.id_barang=c.id_barang and a.id_gudang=c.id_gudang","b.*,b.harga_beli as dkd,c.nama_barang,c.kode_barang","a.no_masuk='$jwa[no_masuk]'");
	 foreach($ss as $st){
	
	 $dt=$db->select("tx_retur_pem a join tx_retur_pem_dtl b on a.no_retur=b.no_retur join m_barang_gudang c on b.id_barang=c.id_barang and a.id_gudang=c.id_gudang","b.*,c.nama_barang,c.kode_barang","a.no_retur='$nomas[no_retur]' and b.id_barang='$st[id_barang]'");
	 foreach($dt as $dtl){ 
		 $total=$total+($dtl['qty_kembali']*$st['harga_beli']);
	 
	  ?>
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:40%;font-size:11px;text-align:left"><?=$dtl['kode_barang'].' - '.$dtl['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:right"><?=$dtl['qty_kembali']?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($st['harga_beli'])?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($dtl['qty_kembali']*$st['harga_beli'])?></td>
    <td style="width:15%;font-size:11px;text-align:right"><?=$dtl['ket']?></td>
  </tr>
  
<?php $no++; }  } ?>

<tr>
  	<td colspan="4" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($total)?></td>
    <td style="width:3%;font-size:11px;text-align:right"><b></b></td>
</tr>
</table><br>

<?php }
?>

<?php } ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td colspan="3" class="td2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="6%" class="td2">&nbsp;</td>
                          <td width="15%" class="td2">&nbsp;</td>
                          <td width="79%" align="right" class="td2">&nbsp;</td>
                        </tr>
		</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            
                            <td width="18%" class="td2">
                                <table width="70%" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                    <tr>
                                        <td width="500" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                     <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="21%" class="td2">&nbsp;</td>
                            <td width="18%" class="td2">&nbsp;</td>
                        </tr>
                      </table>