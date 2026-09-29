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
<td style="width:100%;font-size:15px;" align="center" class="td2"><b>TKBM PEMBELIAN</b></td>
</tr>
</table><br>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
 <?php
					$supp=$db->select("v_tkbm_pembelian","*","no_masuk='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
<td class="td2" align="left" style="font-size:11px;">
No Masuk :<b> <?=$valsupp['no_masuk']?></b>
  <br>No SPJ :<b> <?=$valsupp['no_spj']?></b>
  <br>Cabang :<b> <?=$valsupp['nama_cabang']?></b>
  <br>Tanggal :<b> <?=$valsupp['tgl']?></b>
</td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Jenis</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Kendaraan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Berat</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nilai/Kg</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Total</b></td>
  </tr>
 <?php 
								$supp=$db->select("tx_tkbm_pembelian_dtl a 
								join m_barang b on a.id_barang=b.id_barang
								join m_satuan c on b.id_satuan=c.id_satuan
								left join m_kendaraan d on a.id_jenis_kendaraan=d.id
								","a.*,b.nama_barang,b.kode_barang,d.nopol","a.id_tkbm_b='$valsupp[id_tkbm_b]'");
							  $no=1;
							  $tot=0;
							  foreach($supp as $valsupp){
							  $tot=$tot+$valsupp['total'];
								?>
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:10%;font-size:11px;text-align:center"><?php
                                if($valsupp['jenis_tkbm']==1){
									echo 'Forklif';
								}if($valsupp['jenis_tkbm']==2){
									echo 'Bongkar';
								}if($valsupp['jenis_tkbm']==3){
									echo 'POK';
								}
								?></td>
    <td style="width:30%;font-size:11px;text-align:left"><?=$valsupp['kode_barang']."-".$valsupp['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$valsupp['nopol']?></td>
    <td style="width:5%;font-size:11px;text-align:right"><?=$valsupp['berat']?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=$valsupp['nilai']?></td>
    <td style="width:15%;font-size:11px;text-align:right"><?=number_format($valsupp['qty'])?></td>
    <td style="width:15%;font-size:11px;text-align:right"><?=number_format($valsupp['total'])?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="7" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
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