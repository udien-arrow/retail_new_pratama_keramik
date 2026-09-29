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
<td style="width:100%;font-size:15px;" align="center" class="td2"><b>KOREKSI NOTA RETUR</b></td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
  <?php 
							  $se=$db->select("tx_koreksi_piutang a 
							  join m_customer b on a.id_cus=b.id_cus
							  left join m_cabang c on a.id_cabang=c.id_cabang
							  ","a.*,b.nama_usaha,b.alamat_usaha,c.nama_cabang","a.no_koreksi='$_GET[id]'");
							  $no=1;
							  foreach($se as $val){}
								?>
<td class="td2" align="left" style="font-size:11px;">
No Koreksi :<b> <?=$val['no_koreksi']?></b>
  <br>Pelanggan :<b> <?=$val['nama_usaha']?></b>
  <br>Tanggal :<b> <?=date("d-m-Y",strtotime($val['tgl_koreksi']))?></b>
  <br>No FJ :<b> <?=$val['no_fj_baru']?></b>
  <br>NO FJ Lama :<b> <?=$val['no_fj']?></b>
  <br>NO SPJ :<b> <?=$val['no_ref']?></b>
</td>
</tr>
</table><br>
<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Satuan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Harga Awal</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Diganti Harga</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Jumlah</b></td>
  </tr>
  <?php
                   
				   
$kon=$db->select("tx_koreksi_piutang a
JOIN tx_koreksi_piutang_dtl b ON a.no_koreksi = b.no_piutang
JOIN m_barang_gudang c ON b.id_barang = c.id_barang
AND a.id_gudang = c.id_gudang
JOIN m_satuan d ON c.id_satuan = d.id_satuan","a.no_koreksi,
a.id_gudang,
b.qty,
b.harga_awal,
b.harga_ganti,
b.ket,
c.kode_barang,
c.nama_barang,
d.nama_satuan","a.no_koreksi='$_GET[id]'");	
$no=1;
$tot=0;
$sub=0;
foreach($kon as $d){  
?>			
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:40%;font-size:11px;text-align:left"><?=$d['kode_barang']."-".$d['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$d['nama_satuan']?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($d['qty'])?></td>
    <td style="width:15%;font-size:11px;text-align:right"><?=number_format($d['harga_awal'])?></td>
    <td style="width:15%;font-size:11px;text-align:right"><?=number_format($d['harga_ganti'])?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($sub=$d['harga_ganti']*$d['qty'])?></td>
  </tr>
<?php 
$tot=$tot+$sub;} ?>
<tr>
  	<td colspan="6" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($tot)?></td>
</tr>
</table>
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
                                        <td align="center" class="td2">Branch Manager</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="21%" class="td2">&nbsp;</td>
                            <td width="18%" class="td2">&nbsp;</td>
                        </tr>
                      </table>