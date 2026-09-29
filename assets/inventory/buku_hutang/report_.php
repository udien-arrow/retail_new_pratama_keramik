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
<td style="width:100%;font-size:15px;" align="center" class="td2"><b>BUKU TAGIHAN</b></td>
</tr>
</table>
<?php 
								$tglso=$db->select("tx_buku_tagihan a join m_cabang b on a.id_cabang=b.id_cabang","a.*,b.nama_cabang","a.no='$_GET[id]'");
							  foreach($tglso as $tglspj){}
								?>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
 <?php
					$supp=$db->select("tx_buku_tagihan","*","no='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
<td class="td2" align="left" style="font-size:11px;">
No Koreksi :<b> <?=$valsupp['no']?></b>
  <br>Tangal :<b> <?=$valsupp['tgl']?></b>
  <br>Keterangan :<b> <?=$valsupp['ket']?></b>
</td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:10%;font-size:10px;text-align:center" colspan="2" rowspan="2"><b>Pelanggan</b></td>
    <td style="width:10%;font-size:10px;text-align:center" colspan="4"><b>Faktur</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Parah Penyerahan</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Nama Pelanggan</b></td>
  </tr>
  <tr>
  	<td style="width:10%;font-size:10px;text-align:center"><b>No Faktur</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Tgl Tempo</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Umur</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Jumlah</b></td>
  </tr>
 <?php 
								$supp=$db->select("tx_buku_tagihan_dtl a join m_customer b on a.id_cus=b.id_cus","a.*,kode_cus,nama_usaha,nama_cus","a.no='$_GET[id]'");
							  $no=1;
							  $total=0;
							  foreach($supp as $valsupp){
								  $total=$total+$valsupp['total_piutang'];
								?> 
  <tr>
  	<td style="width:10%;font-size:11px;text-align:center"><?=$valsupp['kode_cus']?></td>
    <td style="width:25%;font-size:11px;text-align:left"><?=$valsupp['nama_usaha']?></td>
    <td style="width:15%;font-size:11px;text-align:center"><?=$valsupp['no_fj']?></td>
    <td style="width:10%;font-size:11px;text-align:center"><?=$valsupp['tempo_tambahan']?></td>
    <td style="width:10%;font-size:11px;text-align:center"><?php $selisih = ((abs(strtotime ($valsupp['tempo_tambahan']) - strtotime ($valsupp['tgl_spj'])))/(60*60*24));
			 echo $selisih.' H';?></td>
    <td style="width:12%;font-size:11px;text-align:right"><?=number_format($valsupp['total_piutang'])?></td>
    <td style="width:8%;font-size:11px;text-align:center"></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$valsupp['nama_cus']?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="5" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($total)?></td>
    <td style="width:3%;font-size:11px;text-align:center"></td>
    <td style="width:3%;font-size:11px;text-align:center"></td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="td2"><b>Tanggal : </b></td>
                          <td class="td2"><?=$tglspj['nama_cabang']?>, <?=date('d',strtotime($tglspj['tgl']))?>-<?=date('m',strtotime($tglspj['tgl']))?>-<?=date('Y',strtotime($tglspj['tgl']))?></td>
                        </tr>
                        <tr>
                          <td width="6%" class="td2">&nbsp;</td>
                          <td width="15%" class="td2"></td>
                          <td width="79%" align="right" class="td2">&nbsp;</td>
                        </tr>
		</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Sales</td>
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
                                        <td width="250" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Kepala Cabang</td>
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