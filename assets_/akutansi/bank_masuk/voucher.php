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

$hd1=$db->select("ak_jurnal_dtl a

JOIN ak_jurnal b ON b.NO_JURNAL = a.NO_JURNAL

LEFT JOIN ak_acc c ON a.ACC_CODE = c.account","a.ACC_CODE as ACC_CODE,

	a.KET_DTL as KET_DTL,

	a.KREDIT as KREDIT,

	c.description as deskrip, a.TGL_JURNAL as TGL_JURNAL","(a.NO_JURNAL='$_GET[id]' OR NO_INVOICE='$_GET[id]') ORDER BY IDX DESC limit 0,1"); //updateima

foreach($hd1 as $hds1){}

$tg=date("d-m-Y",strtotime($hds['TGL']));

?>



<table cellpadding="0" cellspacing="0" style="width:100%;">

  <tr>

  	  <td style="width:45%">

      <img src="assets/images/photo_c.png" width="100" height="50"/>

      </td>

      <td style="width:55%">&nbsp;</td>

  </tr>

  <tr>

      <td colspan="2" class="th2">

      <p align="center"><b>BUKTI BANK MASUK<br>

        PT. TAURUS GEMILANG</b><br></p>&nbsp;

      </td>

  </tr>

</table>



<!--<table cellpadding="0" cellspacing="0" style="width:100%;">

  <tr>

      <td class="td2">

        <p style="font-size:10px;">&nbsp;<b>Kas/Bank : <?=$hds1['ACC_CODE']?></b><br>

        &nbsp;<b>Tanggal : <?=$tg?></b><br>

        &nbsp;<b>No Transaksi : <?=$_GET['id']?></b></p></td>

      </td>

  </tr>-->

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



<table cellpadding="0" cellspacing="0" style="width:100%; border:1px" border="1">

  <tr>

  	<!--<td style="width:1%;font-size:10px;text-align:center""><b>No</b></td>

    <td style="width:18%;font-size:10px;text-align:center"><b>No Rekening</b></td>

    <td style="width:9%;font-size:10px;text-align:center"><b>Keterangan</b></td>

    <td style="width:10%;font-size:10px;text-align:center"><b>Jumlah</b></td>-->

    

    <td style="width:5%;font-size:10px;text-align:center""><b>No</b></td>

    <td style="width:20%;font-size:10px;text-align:center"><b>No Rekening</b></td>

    <td style="width:25%;font-size:10px;text-align:center"><b>Deskripsi</b></td>

    <td style="width:20%;font-size:10px;text-align:center"><b>Keterangan</b></td>

    <td style="width:20%;font-size:10px;text-align:center"><b>Jumlah</b></td>

    

  </tr>

  <?php



$dt1=$db->select("ak_jurnal_dtl a

JOIN ak_jurnal b ON b.NO_JURNAL = a.NO_JURNAL

LEFT JOIN ak_acc c ON a.ACC_CODE = c.account","a.ACC_CODE as ACC_CODE,

  a.KET_DTL as KET_DTL,

  a.KREDIT as KREDIT,

  c.description as deskrip, a.TGL_JURNAL as TGL_JURNAL","(a.NO_JURNAL='$_GET[id]' OR NO_INVOICE='$_GET[id]') and a.KREDIT<>''");

	// print_r($dt1);

$no=1;

$tot=0;

foreach($dt1 as $detail){



?>

  <tr>

  	<td style="font-size:9px;text-align:center"><?=$no;?></td>

    <td style="font-size:9px;text-align:left"><?=$detail['ACC_CODE'];?></td>

    <td style="font-size:9px;text-align:left"><?=$detail['deskrip'];?></td>

    <td style="font-size:9px;text-align:left"><?=$detail['KET_DTL'];?></td>

    <td style="font-size:9px;text-align:right"><?=number_format($detail['KREDIT']);?></td>

  </tr>

  

<?php

$tot=$tot+$detail['KREDIT']; 

$no++;

} ?>

    <tr>

        <td colspan="4" style="width:3%;font-size:9px;text-align:right">Total</td>

        <td style="width:3%;font-size:9px;text-align:right"><?=number_format($tot)?></td>

    </tr>

    <tr>

        <td class="td2" colspan="5">

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

                                    <tr>

                                        <td align="center" class="td2">Di Buat Oleh,</td>

                                    </tr>

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