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
<?php
					$supp=$db->select("v_brgkeluar_transit","*","no_keluar='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
<td style="14%" rowspan="4"><img src="assets/images/photo_c.jpg" style="height:80px; width:80px" ></td>
<td style="width:98%;font-size:15px;" align="center" class="td2"><b>BUKTI BARANG KELUAR</b><br/><br/><?=$valsupp['no_keluar']?></td>
</tr>
</table><br>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
 
<td class="td2" align="left" style="font-size:11px;">
  <br>Dari Gudang :<b> <?=$valsupp['darigudang']?></b>
  <br>Ke Gudang :<b> <?=$valsupp['kegudang']?></b>
  <br>Tanggal :<b> <?=$valsupp['tgl']?></b>
</td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Satuan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty</b></td>
  </tr>
 <?php 
								$supp=$db->select("tx_brg_keluar a
								JOIN tx_brg_keluar_dtl b ON a.no_keluar = b.no_keluar
								JOIN m_barang_gudang c ON b.id_barang = c.id_barang
								AND a.id_gudang = c.id_gudang 
								JOIN m_satuan d on b.sat=d.id_satuan
								","a.id_gudang,
								a.kpd_id_gudang,
								a.no_ref,
								a.ket,
								b.id_dtl,
								b.id_keluar,
								b.no_keluar,
								b.id_barang,
								b.qty,
								b.hpp,
								b.total,
								b.`status`,
								b.sat,
								c.kode_barang,
								c.nama_barang,
								d.nama_satuan,
								a.tgl","a.no_keluar='$_GET[id]'");
							  $no=1;
							  $tot=0;
							  foreach($supp as $valsupp){
							  $tot=$tot+$valsupp['qty'];
								?>
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:60%;font-size:11px;text-align:left"><?=$valsupp['kode_barang']."-".$valsupp['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$valsupp['nama_satuan']?></td>
    <td style="width:15%;font-size:11px;text-align:center"><?=number_format($valsupp['qty'])?></td>
  </tr>
<?php } ?>
<tr>
  	<td colspan="3" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:3%;font-size:11px;text-align:center"><?=number_format($tot)?></td>
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
                                        <td align="center" class="td2">Admin Gudang</td>
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