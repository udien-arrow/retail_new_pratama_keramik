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
  $x = 1;
$hd=$db->select("ak_kas_keluar","*","IDKK='$_GET[id]'");
foreach($hd as $hds){}
$hd1=$db->select("ak_jurnal_dtl","*","NO_JURNAL='$_GET[id]' ORDER BY IDX DESC limit 0,1");
foreach($hd1 as $hds1){}
$tg=date("d-m-Y",strtotime($hds['TGL']));
?>

<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  <td colspan="6" class="th2">
  <p align="center"><b>BUKTI BANK KELUAR<br>
	PT. WARUABADI</b><br></p>&nbsp;
  	<table>
  <tr>
  <td class="td2">
    <p style="font-size:10px;">&nbsp;<b>Kas/Bank : <?=$hds1['ACC_CODE']?></b><br>
    &nbsp;<b>Tanggal : <?=$tg?></b><br>
    &nbsp;<b>No Transaksi : <?=$_GET['id']?></b></p></td>
    </tr></table></td>
  </tr>
  <tr>
  	<td style="width:1%;font-size:10px;text-align:center""><b>No</b></td>
    <td style="width:18%;font-size:10px;text-align:center"><b>No Rekening</b></td>
    <td style="width:9%;font-size:10px;text-align:center"><b>Keterangan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Jumlah</b></td>
    
  </tr>
  <?php
$dt=$db->select("ak_jurnal_dtl","*","NO_JURNAL='$_GET[id]' and DEBET<>''");
$no=1;
$tot=0;
foreach($dt as $dtl){
$tot=$tot+$dtl['DEBET'];
?>
  <tr>
  	<td style="width:1%;font-size:9px;text-align:center"><?=$no;?></td>
    <td style="width:20%;font-size:9px;text-align:left"><?=$dtl['ACC_CODE'];?></td>
    <td style="width:20%;font-size:9px;text-align:left"><?=$dtl['KET_DTL'];?></td>
    <td style="width:20%;font-size:9px;text-align:right"><?=number_format($dtl['DEBET']);?></td>
  </tr>
<?php 
$no++;} ?>
<tr>
  	<td colspan="3" style="width:3%;font-size:9px;text-align:right">Total</td>
    <td style="width:3%;font-size:9px;text-align:right"><?=number_format($tot)?></td>
</tr>
<tr>
<td class="td2">
<?php $terbilang = new Terbilang($tot);
?>
<p><b>Terbilang : <?=strtoupper($terbilang)?></b> <br>
<b>Keterangan : <?=$hds['URAIAN']?></b></p>
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

