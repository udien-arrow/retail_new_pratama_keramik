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
<td style="width:100%;font-size:15px;" align="center" class="td2"><b>BIAYA PENGIRIMAN LOCCO <?=$gud['nama_gudang']?></b></td>
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
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nilai</b></td>
  </tr>
  <?php 
$kon=$db->select("tx_brg_masuk a JOIN tx_brg_masuk_biaya_r b on a.no_masuk=b.no_sb join m_retribusi c on b.id_retribusi=c.id_retribusi","a.no_masuk,
c.nama_retribusi,
b.nilai","a.no_masuk='$_GET[id]'");
							  $no=1;
							  $tot=0;
							  foreach($kon as $valsupp){
							  $tot+=$valsupp['nilai'];
								 
?>
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:50%;font-size:11px;text-align:left"><?=$valsupp['nama_retribusi']?></td>
    <td style="width:40%;font-size:11px;text-align:right"><?=number_format($valsupp['nilai'])?></td>
  </tr>
<?php $no++;} ?>
<?php 
$k=$db->select("tx_brg_masuk_biaya","*","no_masuk='$_GET[id]'"); 
foreach($k as $ks){}
?>
<tr>
  	<td colspan="2" style="width:20%;font-size:11px;text-align:right"><b>Total Retribusi</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($ks['total_retribusi'])?></td>
</tr>
<tr>
  	<td colspan="2" style="width:10%;font-size:11px;text-align:right"><b>Total BBM</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($ks['total_bbm'])?></td>
</tr>
<tr>
  	<td colspan="2" style="width:10%;font-size:11px;text-align:right"><b>Total UJS</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($ks['total_ujs'])?></td>
</tr>
<tr>
  	<td colspan="2" style="width:20%;font-size:11px;text-align:right"><b>Biaya Lain-Lain</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($ks['biaya_lain'])?></td>
</tr>
<tr>
  	<td colspan="2" style="width:20%;font-size:11px;text-align:right"><b>Total Gaji Sopir</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($ks['total_gaji_supir'])?></td>
</tr>
<tr>
  	<td colspan="2" style="width:20%;font-size:11px;text-align:right"><b>Insentif Jarak</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($ks['insentif_jarak'])?></td>
</tr>
<tr>
  	<td colspan="2" style="width:20%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($ks['total'])?></td>
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
<!--<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="18%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Admin Gudang</td>
                                    </tr>
                                    <tr>
                                        <td width="242" align="center" class="td2"><br><br>
                                        <?php 
										$ak=$db->cetak('5',$_SESSION['ID_CABANG']);
										echo $ak;
										?>                                          &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="18%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                    <tr>
                                        <td width="20" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            
                            <td width="18%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0" >
                                    <tr>
                                        <td align="center" class="td2">BAO</td>
                                    </tr>
                                    <tr>
                                        <td width="242" align="center" class="td2"><br><br>
                                        <?php 
										$ak=$db->cetak('3',$_SESSION['ID_CABANG']);
										echo $ak;
										?>                                          &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="18%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                    <tr>
                                        <td width="20" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Branch Manager</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>
                                        <?php 
										$ak=$db->cetak('1',$_SESSION['ID_CABANG']);
										echo $ak;
										?>                                          &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="21%" class="td2">&nbsp;</td>
                            <td width="18%" class="td2">&nbsp;</td>
                        </tr>
                      </table>-->
                  <p>
<font size="-1">
<i>Dicetak tanggal : <?php echo date("d-m-Y H:i:s")?></i> 
</font>
</p>
