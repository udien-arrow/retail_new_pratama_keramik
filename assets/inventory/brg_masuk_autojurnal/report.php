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
					$gud=$db->select("m_gudang","*","id_gudang='$_SESSION[ID_GUDANG]'");
					foreach($gud as $gud){}
					?>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
<td style="width:100%;font-size:15px;" align="center" class="td2"><b>PENERIMAAN BARANG MASUK <?=$gud['nama_gudang']?></b></td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
 <?php
					$supp=$db->select("v_brg_masuk","*","no_masuk='$_GET[id]'");
					foreach($supp as $valsupp){}
?>
<td class="td2" align="left" style="font-size:11px;">
No Masuk :<b> <?=$valsupp['no_masuk']?></b>
  <br>No Ref :<b> <?=$valsupp['no_ref']?></b>
  <br>Tanggal :<b> <?=$valsupp['tgl']?></b>
  <br>Surat Jalan :<b> <?=$valsupp['surat_jalan']?></b>
  <br>Dari :<b> <?=$valsupp['nama_supp']?></b>
</td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Satuan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty Pesan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty Terima</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Selisih</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Claim Utuh</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Claim Ktg</b></td>
  </tr>
  <?php 
$kon=$db->select("tx_brg_masuk zz join tx_brg_masuk_dtl a on zz.no_masuk=a.no_masuk left join m_barang_gudang b on a.id_barang=b.id_barang and zz.id_gudang=b.id_gudang 
		join m_satuan c on b.id_satuan=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_masuk='$_GET[id]'");
							  $no=1;
							  $tot=0;
							  $nilai=0;
							  $selisih=0;
							  $utuh=0;
							  $ktg=0;
							  foreach($kon as $valsupp){
								  $tot=$tot+$valsupp['qty'];
								  $nilai=$nilai+$valsupp['qty_terima'];
								  $selisih=$selisih+$valsupp['qty_kurang'];
								  $utuh=$selisih+$valsupp['claim_utuh'];
								  $ktg=$selisih+$valsupp['claim_ktg'];
?>
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:35%;font-size:11px;text-align:left"><?=$valsupp['kode_barang']."-".$valsupp['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$valsupp['nama_satuan']?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($valsupp['qty'])?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($valsupp['qty_terima'])?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($valsupp['qty_kurang'])?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($valsupp['claim_utuh'])?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($valsupp['claim_ktg'])?></td>
  </tr>
<?php } ?>
<tr>
  	<td colspan="3" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($tot)?></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($nilai)?></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($selisih)?></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($utuh)?></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($ktg)?></td>
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
                                        <td align="center" class="td2"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="21%" class="td2">&nbsp;</td>
                            <td width="18%" class="td2">&nbsp;</td>
                        </tr>
                      </table>