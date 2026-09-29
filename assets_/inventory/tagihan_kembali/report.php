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
<td style="width:100%;font-size:15px;" align="center" class="td2"><b>TAGIHAN KEMBALI</b></td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
 <?php
					$supp=$db->select("tx_tagihan_kembali","*","no_ta='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
<td class="td2" align="left" style="font-size:11px;">
No Koreksi :<b> <?=$valsupp['no_ta']?></b>
  <br>Tangal :<b> <?=$valsupp['tgl']?></b>
  <br>Keterangan :<b> <?=$valsupp['ket']?></b>
</td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:5%;font-size:9px;text-align:center"><b>No</b></td>
  	<td style="width:10%;font-size:9px;text-align:center"><b>Pelanggan</b></td>
    <td style="width:10%;font-size:9px;text-align:center"><b>NO FJ</b></td>
    <td style="width:10%;font-size:9px;text-align:center"><b>Total</b></td>
    <td style="width:10%;font-size:9px;text-align:center"><b>Dibayar</b></td>
    <td style="width:5%;font-size:9px;text-align:center"><b>Jenis</b></td>
    <td style="width:10%;font-size:9px;text-align:center"><b>Nama Bank</b></td>
    <td style="width:10%;font-size:9px;text-align:center"><b>Jatuh Tempo</b></td>
    <td style="width:10%;font-size:9px;text-align:center"><b>No Seri BG</b></td>
    <td style="width:12%;font-size:9px;text-align:center"><b>Nomor Rekening</b></td>
  </tr>
 <?php 
								$supp=$db->select("tx_tagihan_kembali_dtl a left join m_customer b on a.id_cus=b.id_cus","a.*,b.nama_usaha","a.no_ta='$_GET[id]'");
							  $no=1;
							  $total=0;
							  foreach($supp as $valsupp){
								?> 
  <tr>
  	<td style="width:5%;font-size:9px;text-align:center"><?=$no?></td>
    <td style="width:10%;font-size:9px;text-align:left"><?=$valsupp['nama_usaha']?></td>
    <td style="width:15%;font-size:9px;text-align:center"><?=$valsupp['no_fj']?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=number_format($valsupp['total_piutang'])?></td>
    <td style="width:10%;font-size:9px;text-align:center"><?=number_format($valsupp['dibayar'])?></td>
    <td style="width:5%;font-size:9px;text-align:right"><?php if($valsupp['jenis_pem']==1){
									echo "Tunai";}elseif($valsupp['jenis_pem']==2){
									echo "Transfer";}elseif($valsupp['jenis_pem']==3){
									echo "BG";}elseif($valsupp['jenis_pem']==4){
									echo "Kembali Utuh"; }
									?></td>
    <td style="width:5%;font-size:11px;text-align:center"><?=$valsupp['nama_bank']?></td>
    <td style="width:5%;font-size:11px;text-align:center"><?php if($valsupp['jatuh_tempo']=="0000-00-00"){
									echo "";
								}else{ echo $valsupp['jatuh_tempo'];}?></td>
    <td style="width:5%;font-size:11px;text-align:center"><?=$valsupp['no_seribg']?></td>
    <td style="width:5%;font-size:11px;text-align:center"><?=$valsupp['no_rekening']?></td>
  </tr>
<?php $no++;} ?>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
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
                                        <td width="200" align="center" class="td2"><br><br><?php
                                        echo $_SESSION['NAMA_PEG'];
										?></td>
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
                                        <td align="center" class="td2">BAO</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br><?php
                                        foreach($db->select("m_pegawai","nama_pegawai","id_jabatan='3' and id_cabang='$_SESSION[ID_CABANG]' and id_aktif='1'")as $dtbm);
										echo $dtbm['nama_pegawai'];
										?></td>
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

<p>
<font size="-1">
<i>Dicetak tanggal : <?php echo date("d-m-Y H:i:s")?></i> 
</font>
</p>