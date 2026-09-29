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
				  border: 1px solid black;
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
<?php
					$supp=$db->select("v_order_tag","*","no_pt='$_GET[id]'");
					foreach($supp as $valsupp){}
					
					
					?>
<tr>
<td rowspan="2" style="width:80%;font-size:15px;text-align:center" class="td2"><b>PERMINTAAN PEMBAYARAN</b></td>

<td style="width:20%;font-size:11px;" align="left" class="td2"><b>Nomor : <?=$valsupp['no_pt']?></b></td>
</tr>
<tr>
<td style="width:20%;font-size:11px;" align="left" class="td2"><b>Tanggal : <?=date("d-m-Y",strtotime($valsupp['tgl_pt']))?></b></td>
</tr>
</table><br>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
 
<td style="width:50% ;font-size:11px;" align="right" class="td2" >
Dinas Operasional :<br>
Uang Muka :
  <br>Penanggung Jawab :
</td>
<td style="width:50% ;font-size:11px;" align="left" class="td2" >
</td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
    <td rowspan="2" style="width:20%;font-size:11px;text-align:left"><p><b>Jenis Pembayaran</b></p>
    <p>a</p>
    <p>&nbsp;</p></td>
    <td rowspan="2" style="width:20%;font-size:11px;text-align:left"><p><b>Jenis Pembayaran</b></p>
    <p><b>a</b>    </p>
    <p>&nbsp;</p></td>
    <td rowspan="2" style="width:35%;font-size:11px;text-align:left"><p><b>Dibayar Kepada</b></p>
    <p><b><?=$valsupp['kode_supp']?> </b> <b><?=$valsupp['nama_usaha']?></b><br/>
   <b><?=$valsupp['alamat_usaha']?></b></p>
    <p>&nbsp;</p></td>
    <td style="width:25%;font-size:10px;text-align:left"><p><b>Anggaran</b></p>
    <p>Rp.</p></td>
</tr>
<tr>
<td style="width:10%;font-size:10px;text-align:left"><p><b>Anggaran</b></p>
  <p>Rp.</p></td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>No Billing</b></td>
    <td style="width:5%;font-size:10px;text-align:center"><b>Qty</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Uraian</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Harga</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Jumlah</b></td>
  </tr>
 <?php
	$kon=$db->select("tx_order_tagihan_dtl a
JOIN tx_billing_dtl b ON a.no_billing=b.no_billing AND a.id_bill_dtl=b.id_dtl
JOIN m_barang c ON b.id_barang=c.id_barang","a.no_billing, b.qty, c.nama_barang, b.harga ,a.total_bil","a.no_pt='$_GET[id]'");
	$no=1;
	$tot=0;
	foreach($kon as $dtl){	
	$tot+=$dtl['total_bil'];		
	?>
  <tr>
  	<td style="width:5%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:20%;font-size:11px;text-align:left"><?=$dtl['no_billing']?></td>
    <td style="width:5%;font-size:11px;text-align:left"><?=$dtl['qty']?></td>
    <td style="width:30%;font-size:11px;text-align:left"><?=$dtl['nama_barang']?></td>
    <td style="width:15%;font-size:11px;text-align:right"><?=number_format($dtl['harga'])?></td>
    <td style="width:25%;font-size:11px;text-align:right"><?=number_format($dtl['total_bil'])?></td>
  </tr>
<?php $no++; } ?>
<tr>
  	<td colspan="4"  rowspan="3" style="width:3%;font-size:11px;text-align:left"></td>
    <td style="width:3%;font-size:11px;text-align:right">Jumlah</td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($tot)?></td>
  </tr>
    <tr>
    <td style="width:10%;font-size:11px;text-align:right">PPN 10%</td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($tot*10/100)?> </td>
    </tr>
    <tr>
    <td style="width:3%;font-size:11px;text-align:right">Dibayar</td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($tot+($tot*10/100))?></td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
    <td style="width:10%;font-size:10px;text-align:center"><b>Unit/Bagian Peminta</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Menyetujui,</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Adm. & Keuangan</b></td>
  </tr>
  <tr>
    <td style="width:35%;font-size:10px;text-align:center"><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p><b>Logistic Manager</b></p></td>
    <td style="width:30%;font-size:10px;text-align:center"><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p><b>Financial AVP</b></p></td>
    <td style="width:35%;font-size:10px;text-align:center"><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p><b>Accounting Manager</b></p></td>
  </tr>
  </table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td colspan="3" class="td2">&nbsp;</td>
                          
  </tr>
</table>
<table cellpadding="0" cellspacing="0" style="width:98%;" class="td2">
<tr>
<td style="width:25% ;font-size:11px;" align="left" class="td2" >
Jumlah yang harus dibayar<br>
Tanggal jatuh Tempo<br>
Nilai Retur Beli</td>
<td style="width:25% ;font-size:11px;" align="left" class="td2" >
: Rp................................................<br>
: .....................................................<br>
: Rp................................................</td>
<td style="width:25% ;font-size:11px;" align="left" class="td2" >
Nomor Koreksi Berita Acara<br>
- Koreksi Beli<br>
- Koreksi Retur Beli</td>
<td style="width:25% ;font-size:11px;" align="left" class="td2" >
: ......................................................<br>
: (Rp................................................<br>
: (Rp................................................ </td>

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