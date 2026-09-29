<?php
session_start();
error_reporting(0);

require( 'webclass.php' );
include  'assets/akutansi/kasmasuk/terbilang.php' ;
$db=new kelas;
?>
<style>
table {
		  border-collapse: collapse;
	  }
.table, .td, .th {
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
$hd=$db->select("ak_kas_masuk","*","IDKM='$_GET[id]'");
foreach($hd as $hds){}
//$hd1=$db->select("ak_jurnal_dtl","*","NO_JURNAL='$_GET[id]' ORDER BY IDX DESC limit 0,1");
$hd1=$db->select("ak_jurnal_dtl a JOIN ak_acc b ON b.account = a.ACC_CODE","a.*, b.description AS deskrip","(NO_JURNAL='$_GET[id]' OR NO_INVOICE='$_GET[id]') ORDER BY IDX ASC limit 0,1");
//echo"select * from ak_jurnal_dtl a JOIN ak_acc b ON b.account = a.ACC_CODE where (NO_JURNAL='$_GET[id]' OR IDKM='$_GET[id]') ORDER BY IDX ASC limit 0,1";
foreach($hd1 as $hds1){}
$tg=date("d-m-Y",strtotime($hds1['TANGGAL']));
?>

<table cellpadding="0" cellspacing="0" style="width:100%;">
  <tr>
  	  <td style="width:45%">
      <img src="logo/<?php echo"$_SESSION[LOGO]";?>" width='50' height='50'/>
      </td>
      <td style="width:55%">&nbsp;</td>
  </tr>
  <tr>
      <td colspan="2" class="th2">
      <p align="center"><b>BUKTI KAS MASUK<br>
        <?php echo"$_SESSION[NAMA_PERUSAHAAN]";?></b><br></p>&nbsp;
      </td>
  </tr>
</table>
<table cellpadding="0" cellspacing="0" style="width:100%;">
  <tr>
      <td style="width:15%">Kas/Bank</td>
      <td style="width:5%">:</td> 
	  <td style="width:20%"><?php echo $hds1['ACC_CODE']."-".$hds1['deskrip'];?></td>
      <td style="width:20%">&nbsp;</td>
      <td style="width:15%">Nomor Transaksi</td>
      <td style="width:5%">:</td> 
	  <td style="width:20%"><?=$_GET['id']?></td>
            
  </tr>
  <tr>
        <td>Tanggal Jurnal</td>
        <td>:</td>
        <td><?php echo date("d-m-Y",strtotime($hds1['TGL_JURNAL']));?></td>
        <td>&nbsp;</td>
        <td>Tanggal Input</td> 
        <td>:</td> 
		<td><?=$tg?></td>  
  </tr>
</table>
<br />

<table cellpadding="0" cellspacing="0" style="width:100%;" border="1">
  <tr>
  	<td style="width:5%;font-size:10px;text-align:center""><b>No</b></td>
    <td style="width:20%;font-size:10px;text-align:center"><b>No Rekening</b></td>
    <td style="width:25%;font-size:10px;text-align:center"><b>Deskripsi</b></td>
    <td style="width:20%;font-size:10px;text-align:center"><b>Keterangan</b></td>
    <td style="width:20%;font-size:10px;text-align:center"><b>Jumlah</b></td>
    
  </tr>
  <?php
$dt=$db->select("ak_jurnal_dtl a JOIN ak_acc b ON b.account = a.ACC_CODE","a.*, b.description AS deskrip","NO_JURNAL='$hds1[NO_JURNAL]' and KREDIT<>''");
$no=1;
$tot=0;

foreach($dt as $dtl){
$tot=$tot+$dtl['KREDIT'];
?>
  <tr>
  	<td style="font-size:9px;text-align:center"><?=$no;?></td>
    <td style="font-size:9px;text-align:left"><?php echo $dtl['ACC_CODE'];?></td>
    <td style="font-size:9px;text-align:left"><?php echo $dtl['deskrip'];?></td>
    <td style="font-size:9px;text-align:left"><?=$dtl['KET_DTL'];?></td>
    <td style="font-size:9px;text-align:right"><?=number_format($dtl['KREDIT']);?></td>
  </tr>
<?php 
$no++;} ?>
<tr>
  	<td colspan="4" style="width:3%;font-size:9px;text-align:right">Total</td>
    <td style="width:3%;font-size:9px;text-align:right"><?=number_format($tot)?></td>
</tr>
<tr>
<td class="td2" colspan="2">
<?php $terbilang = new Terbilang($tot);
?>
<p><b>Terbilang : <?=strtoupper($terbilang)?></b> <br>
<b>Keterangan : <?=$hds['URAIAN']?></b></p>
</td>
</tr>
</table>
<br />

<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                             <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <?php
										$ini = explode("/",$_GET['id']);
										if($ini[0]=='VL'){
									?>
                                    <tr>
                                        <td align="center" class="td2">Di Validasi Oleh,</td>
                                    </tr>
                                    <?php
										} else {
									?>
                                    <tr>
                                        <td align="center" class="td2">Di Buat Oleh,</td>
                                    </tr>
                                    <?php
										}
									?>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    
                                    <?php 
									
										foreach($db->select("r_user_login a JOIN m_pegawai b ON b.id_pegawai= a.ID_PEGAWAI","b.nama_pegawai AS pegawai","ID = '$_GET[user]'") as $user){};
										
									?>
                                    <tr>
                                        <td align="center" class="td3"><?=$user['pegawai']?></td>
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
                                        <td align="center" class="td3">----------------------</td>
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
                                        <td align="center" class="td3">----------------------</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="21%" class="td2">&nbsp;</td>
                            <td width="18%" class="td2">&nbsp;</td>
                        </tr>
                      </table>
<br />
<br />
<p style="font-size:9px">
<b>
<i>Dicetak tanggal : <?php echo date("d-m-Y H:i:s")?> oleh <?=$user['pegawai']?></i> 
</b>
</p>