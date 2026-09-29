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
<td style="width:100%;font-size:15px;" align="center" class="td2"><b>RETUR PEMBELIAN</b></td>
</tr>
</table><br>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
 <?php
					$supp=$db->select("tx_retur_pem","*","no_retur='$_GET[id]'");
					foreach($supp as $valsupp){}
					
					$supp2=$db->select("tx_brg_masuk","no_ref","no_masuk='$valsupp[no_ref]'");
					foreach($supp2 as $valsupp2){}
					?>
<td class="td2" align="left" style="font-size:11px;">
No Retur :<b> <?=$valsupp['no_retur']?></b>
  <br>No Ref :<b> <?=$valsupp2['no_ref']?></b>
  <br>SPJ :<b> <?=$valsupp['no_spj']?></b>
  <br>Tanggal :<b> <?=$valsupp['tgl_retur']?></b>
</td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Satuan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Keterangan</b></td>
  </tr>
 <?php 
								$supp=$db->select("tx_retur_pem a
JOIN tx_retur_pem_dtl b ON a.no_retur = b.no_retur
JOIN m_barang_gudang c ON b.id_barang = c.id_barang
AND a.id_gudang = c.id_gudang
JOIN m_satuan d ON c.id_satuan = d.id_satuan","a.no_retur,
a.id_gudang,
b.qty_kembali,
b.ket,
c.kode_barang,
c.nama_barang,
d.nama_satuan","a.no_retur='$_GET[id]'");
							  $no=1;
							  $tot=0;
							  foreach($supp as $valsupp){
								  $tot=$tot+$valsupp['qty_kembali'];
								?>
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:50%;font-size:11px;text-align:left"><?=$valsupp['kode_barang']."-".$valsupp['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$valsupp['nama_satuan']?></td>
    <td style="width:15%;font-size:11px;text-align:center"><?=number_format($valsupp['qty_kembali'])?></td>
    <td style="width:25%;font-size:11px;text-align:center"><?=$valsupp['ket']?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="3" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:3%;font-size:11px;text-align:center"><?=$tot?></td>
    <td style="width:3%;font-size:11px;text-align:center"></td>
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