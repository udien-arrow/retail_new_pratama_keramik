<?php 
require( 'webclass.php' );
$db=new kelas;
session_start();
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
			   
               border: 0px solid #666; font-size:12px; 
               vertical-align:middle; padding:0px;line-height:15px;
           }

</style>
<?php
foreach($db->select("m_pegawai","nama_pegawai","id_pegawai='$_SESSION[ID_PEG]'") as $vus){}
$supp=$db->select("v_prp","*","no_prp='$_GET[id]'");
foreach($supp as $valsupp){}
?>
<?php 
$kon=$db->select("tx_prp a left join m_supplier b on a.id_supp=b.id_supp","a.*,b.pkp","a.no_prp='$_GET[id]'");	
						foreach($kon as $konval){}	
		 $kurs=$db->select("m_valuta a 
left join m_valuta_dtl b on a.id_valuta=b.id_valuta","a.id_valuta,b.kurs,a.nama_valuta","a.id_valuta='$konval[id_valuta]' and b.tgl_berlaku <=CURDATE() ORDER BY b.tgl_berlaku desc limit 0,1");
		 foreach($kurs as $kursval){}
		  ?> 
<table cellpadding="0" cellspacing="0" style="width:98%;">
    <tr>
        <td style="14%"><img src="assets/images/photo_c.jpg" style="height:50px; width:100px" ></td>
        <td style="width:100%;font-size:10px; padding-left:10px;" align="justify" class="td2">
                <b>PT. TAURUS GEMILANG</b>
                <br>
                <?php
                $gudang = $konval['id_gudang'];
                $almt=$db->select("m_gudang a JOIN m_cabang b ON a.id_cabang = b.id_cabang","a.nama_gudang as nama_gudang, a.alamat as alamat1, b.nama_cabang as nama_cabang, b.alamat as alamat2","a.id_gudang='$gudang'");
                foreach($almt as $nama){
                ?>
               <!-- <?=$nama['nama_cabang']?><br>-->
                <?=$nama['nama_gudang']?><br>
                <?=$nama['alamat1']?><br>
                <?php } ?>
                
            
         </td>
    </tr>
    <tr>
        <td colspan="2" style="width:90%;font-size:15px;" align="center" class="td2"><b>REQUEST ORDER</b><br/><br/><?=$valsupp['no_prp']?></td>
    </tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;" class="table" border="0">
<tr></tr>
  <tr>
  <td colspan="3" style="width:80%;">Dari : <?=$nama['nama_gudang']?></td>
  <td>&nbsp;</td>
  <td>Tanggal :<?=date("d-m-Y",strtotime($valsupp['tgl']))?></td>
          
  </tr>
    <tr>
     
    <td class="td2" align="left" style="font-size:12px;">
    
      <br> Ke :<b> <?=$valsupp['nama_usaha']?></b></td>
    </tr>
</table>
<br>

<table cellpadding="0" cellspacing="0" border="1" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center" rowspan="2"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Satuan</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Tgl Kirim</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Qty</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Bonus</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Harga</b></td>
    <td style="width:10%;font-size:10px;text-align:center" colspan="2"><b>Disc</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Total</b></td>
  </tr>
  <tr>
  <td style="width:3%;font-size:10px;text-align:center"><b>%</b></td>
  <td style="width:3%;font-size:10px;text-align:center"><b>$</b></td>
  </tr>
  <?php 
$kon=$db->select("tx_prp_dtl a join m_barang b on a.id_barang=b.id_barang join m_satuan c on a.sat=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_prp='$_GET[id]'");
							  $no=1;
							  $habel=0;
							  $tot=0;
							  foreach($kon as $valsupp){
?>
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:25%;font-size:11px;text-align:left"><?=$valsupp['kode_barang']."-".$valsupp['nama_barang']?></td>
    <td style="width:10%;font-size:11px;text-align:center"><?=$valsupp['nama_satuan']?></td>
    <td style="width:10%;font-size:11px;text-align:center"><?=$valsupp['tgl_kirim']?></td>
    <td style="width:10%;font-size:11px;text-align:center"><?=$valsupp['qty']?></td>
    <td style="width:10%;font-size:11px;text-align:center"><?=$valsupp['bonus']?></td>
    <td style="width:10%;font-size:11px;text-align:center"><?=number_format($valsupp['harga_beli'],2)?></td>
    <td style="width:5%;font-size:11px;text-align:center"><?=$valsupp['disc_persen']?></td>
    <td style="width:5%;font-size:11px;text-align:center"><?=$valsupp['disc_rupiah']?></td>
    <?php 
	$habel=$valsupp['harga_beli']*$valsupp['disc_persen']/100;
	$habel=$valsupp['harga_beli']-$habel;
	?>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($sub=$habel*$valsupp['qty']*$kursval['kurs'],2)?></td>
  </tr>
<?php $no++;
$tot=$tot+$sub; } ?>
<tr>
  	<td colspan="9" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:15%;font-size:11px;text-align:right"><?=number_format($tot,2)?></td>
</tr>
<tr>
  	<td colspan="9" style="width:3%;font-size:11px;text-align:right"><b>Disc %</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($disc=$konval['disc_jumlah'],2)?></td>
</tr>
<tr>
	<?php
    $cc1=$db->select("tx_prp","id_supp","no_prp='$_GET[id]'");
    foreach($cc1 as $dd1){}
    $aa1=$db->select("m_supplier","pkp","id_supp='$dd1[id_supp]'");
    foreach($aa1 as $bb1){
      if($bb1['pkp']=='1'){
        $pp=10;
      } else {
        $pp=0;
      }
    }
    $totppn=($tot*$pp)/100;
    
    ?>
      <td colspan="8" align="right"><b>Ppn (%)</b>&nbsp;</td>
      <td align="right"><b><?php echo number_format($pp)."%";?></b>&nbsp;</td>
      <td align="right"><b><?php echo number_format($totppn);?></b>&nbsp;</td>
</tr>
<tr>
  	<td colspan="9" style="width:3%;font-size:11px;text-align:right"><b>Grand Total</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($grant=$tot-$disc+$totppn,2)?></td>
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
                                        <td align="center" class="td2">Admin</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>
                                        <?=$vus['nama_pegawai']?></td>
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
