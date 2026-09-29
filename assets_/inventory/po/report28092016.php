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
<td style="width:100%;font-size:15px;" align="center" class="td2"><b>PEMBELIAN</b></td>
</tr>
</table><br>
 <?php
					$supp=$db->select("v_po","*","no_po='$_GET[id]'");
					foreach($supp as $valsupp){}
					$ggs=$db->select("tx_po a left join tx_prp b on a.no_prp=b.no_prp left join tx_order c on b.no_order=c.no_order left join m_plan d on c.id_plan=d.id_plan","d.*,b.no_order","a.no_po='$_GET[id]'");
					foreach($ggs as $valindo){}
					$kon=$db->select("tx_po a 
						left join m_supplier b on a.id_supp=b.id_supp
						left join m_gudang c on a.id_gudang=c.id_gudang","a.*,b.pkp,b.nama_supp,b.nama_usaha,c.nama_gudang,c.alamat,a.no_so","a.no_po='$_GET[id]'");	
						foreach($kon as $konval){}	
						$cek=explode('/',$valindo['no_order']); 			
if($konval['jenis_p']==1){
?>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
<td class="td2" align="left" style="font-size:11px;">
No PO :<b> <?=$konval['no_po']?></b>
  <br>Kepada :<b> <?=$konval['nama_usaha']?></b>
  <br>Tanggal :<b> <?=$konval['tgl_po']?></b>
  <br>Kirim Ke :<b> <?=$konval['nama_gudang']?></b>
  <?php if($cek[0]=="PU"){ ?>
  <br>Plant :<b> <?=$valindo['nama_plan'].' - '.$valindo['kode']?></b>
  <?php }else{} ?>
</td>
</tr>
</table><br>
<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Satuan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Tgl Kirim</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty Order</b></td>
  </tr>
  <?php  
$kon=$db->select("tx_prp_dtl a join m_barang b on a.id_barang=b.id_barang join m_satuan c on b.id_satuan=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_prp='$konval[no_prp]'");	
$no=1;
$tot=0;
foreach($kon as $d){  
$tot=$tot+$d['qty']?>			
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:50%;font-size:11px;text-align:left"><?=$d['kode_barang']."-".$d['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$d['nama_satuan']?></td>
    <td style="width:15%;font-size:11px;text-align:center"><?=$d['tgl_kirim']?></td>
    <td style="width:20%;font-size:11px;text-align:right"><?=number_format($d['qty'])?></td>
  </tr>
<?php $no++; }
 ?>
<tr>
  	<td colspan="4" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
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
                            <td width="18%" class="td2">
                                <table width="70%" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Direktur</td>
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
<?php }else if($konval['jenis_p']==1){ ?>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
<td class="td2" align="left" style="font-size:11px;">
No PO :<b> <?=$valsupp['no_po']?></b>
  <br>Kepada :<b> <?=$valsupp['nama_usaha']?></b>
  <br>Tanggal :<b> <?=$valsupp['tgl_po']?></b>
  <br>Kirim Ke :<b> <?=$valsupp['nama_gudang']?></b>
  <br>Plant :<b> <?=$valindo['nama_plan'].' - '.$valindo['kode']?></b>
</td>
</tr>
</table><br>
<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center" rowspan="2"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Satuan</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Qty Order</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Bonus</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Harga</b></td>
    <td style="width:8%;font-size:10px;text-align:center" colspan="2"><b>Disc</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Jumlah</b></td>
  </tr>
  <tr>
  <td style="width:5%;font-size:10px;text-align:center"><b>%</b></td>
  <td style="width:10%;font-size:10px;text-align:center"><b>$</b></td>
  </tr>
  <?php  
   $kurs=$db->select("m_valuta a 
left join m_valuta_dtl b on a.id_valuta=b.id_valuta","a.id_valuta,b.kurs,a.nama_valuta","a.id_valuta='$konval[id_valuta]' and b.tgl_berlaku <=CURDATE() ORDER BY b.tgl_berlaku desc limit 0,1");
		 foreach($kurs as $kursval){}
$kon=$db->select("tx_prp_dtl a join m_barang b on a.id_barang=b.id_barang join m_satuan c on b.id_satuan=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_prp='$konval[no_prp]'");	
$no=1;
$tot=0;
$habel=0;
$sub=0;
$grand=0;
foreach($kon as $d){  
$habel=$d['harga_beli']*$d['disc_persen']/100;
$habel=$d['harga_beli']-$habel;
$sub=$habel*$d['qty']*$kursval['kurs'];
$grand=$grand+$sub;
?>			
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:27%;font-size:11px;text-align:left"><?=$d['kode_barang']."-".$d['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$d['nama_satuan']?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($d['qty'])?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($d['bonus'])?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($d['harga_beli'])?></td>
    <td style="width:5%;font-size:11px;text-align:right"><?=number_format($d['disc_persen'])?></td>
    <td style="width:5%;font-size:11px;text-align:right"><?=number_format($d['disc_rupiah'],0)?></td>
    <td style="width:15%;font-size:11px;text-align:right"><?=number_format($sub,2)?></td>
  </tr>
<?php $no++; }
 ?>
<tr>
  	<td colspan="8" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($grand,2)?></td>
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
                            <td width="18%" class="td2">
                                <table width="70%" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Direktur</td>
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

<?php } ?>