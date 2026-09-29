<?php 
require( 'webclass.php' );
error_reporting(0);
include  'assets/akutansi/kasmasuk/terbilang.php' ;
$db=new kelas;
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
			   
               border: 0px solid #666; font-size:10px; 
               vertical-align:middle; padding:0px;line-height:15px;
           }
</style>
<?php
$expl=explode("-",$_GET['id']);
 //echo $expl[0];
$hd1=$db->select("v_pem_supp","*","no_pt='$expl[0]'");
foreach($hd1 as $hds1){}

$hd2=$db->select("tx_order_tagihan_bayar","tgl_bayar","no_ps='$expl[1]'");
foreach($hd2 as $hds2){}


$tg=date("d-m-Y",strtotime($hds2['tgl_bayar']));
$ec=$db->select("ak_jurnal_dtl","*","NO_INVOICE='$expl[0]'");
foreach($ec as $ca){}
?>

<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  <td colspan="6" class="th2">
  <p align="center"><b>BUKTI PEMBAYARAN SUPPLIER<br>
	PT. WARUABADI</b><br></p>&nbsp;
  	<table>
  <tr>
  <td class="td2">
    <p style="font-size:10px;">&nbsp;<b>Supplier : <?=$hds1['nama_usaha']?></b><br>
    &nbsp;<b>Tanggal : <?=$tg?></b><br>
    &nbsp;<b>No Transaksi : <?=$expl[0]?></b><br>
	&nbsp;<b>No Jurnal : <?=$ca['NO_JURNAL']?></b></p></td>
    </tr></table></td>
  </tr>
  <tr>
  	<td style="width:1%;font-size:10px;text-align:center""><b>No</b></td>
    <td style="width:24%;font-size:10px;text-align:center"><b>Billing</b></td>
    <td style="width:25%;font-size:10px;text-align:center"><b>Spj</b></td>
    <td style="width:15%;font-size:10px;text-align:center"><b>Total</b></td>
    <td style="width:15%;font-size:10px;text-align:center"><b>Dibayar</b></td>
    
  </tr>
  <?php
  
  
/*$dt=$db->select("tx_order_tagihan a
JOIN tx_order_tagihan_dtl b ON a.no_pt = b.no_pt
LEFT JOIN tx_order_tagihan_bayar c ON b.no_billing = c.no_billing and c.id_bill_dtl=b.id_bill_dtl and c.no_spj=b.no_spj","b.*,c.dibayar","a.no_pt='$expl[0]' and c.no_ps='$expl[1]'");*/
$dt=$db->select("tx_order_tagihan_bayar a","	a.no_ps,
	a.no_billing,
	a.no_spj,
	a.dibayar,a.id_bill_dtl","a.no_ps='$expl[1]'");
$no=1;
$tot=0;
$bay=0;
foreach($dt as $dtl){

//echo $dtl[id_bill_dtl];
foreach($db->select("tx_order_tagihan_dtl","total_bil","no_pt='$expl[0]' and id_bill_dtl='$dtl[id_bill_dtl]'")as $tb);

foreach($db->select("tx_order_tagihan_bayar","sum(dibayar)as dibayseb","no_ps<>'$expl[1]'  and id_bill_dtl='$dtl[id_bill_dtl]'")as $aky);
//echo $tb['total_bil'].'<br>';
?>
  <tr>
  	<td style="width:5%;font-size:9px;text-align:center"><?=$no;?></td>
    <td style="width:25%;font-size:9px;text-align:left"><?=$dtl['no_billing'];?></td>
    <td style="width:25%;font-size:9px;text-align:left"><?=$dtl['no_spj'];?></td>
    <td style="width:20%;font-size:9px;text-align:right"><?=number_format($jumo=$tb[total_bil],2);?></td>
    <td style="width:20%;font-size:9px;text-align:right"><?=number_format($dtl['dibayar'],2);?></td>
  </tr>
<?php 
$tot=$tot+$jumo;
$bay=$bay+$dtl['dibayar'];
$no++;} ?>
<tr>
  	<td colspan="3" style="width:3%;font-size:9px;text-align:right">Total</td>
    <td style="width:3%;font-size:9px;text-align:right"><?=number_format($tot,2)?></td>
    <td style="width:3%;font-size:9px;text-align:right"><?=number_format($bay,2)?></td>
</tr>
<tr>
<td class="td2" colspan="5">
<?php $terbilang = terbilang($bay);
?>
<p><b>Terbilang : <?=strtoupper($terbilang)?></b> <br></p>
</td>
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
                                        <td align="center" class="td2">Di Buat Oleh,</td>
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
                            <td width="18%" class="td2">
                                <table width="70%" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                    <tr>
                                        <td width="50" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Penerima</td>
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
                            <td width="18%" class="td2">
                                <table width="70%" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                    <tr>
                                        <td width="50" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Diketahui</td>
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
