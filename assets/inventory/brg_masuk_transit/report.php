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
					$supp=$db->select("tx_brg_masuk","*","jenis='4' and id_gudang='$_SESSION[ID_GUDANG]'");
					foreach($supp as $valsupp){}
?>
<?php
					$gud=$db->select("m_gudang","*","id_gudang='$_SESSION[ID_GUDANG]'");
					foreach($gud as $gud){}
					?>
<!--<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
<td style="14%" rowspan="4"><img src="assets/images/photo_c.jpg" style="height:80px; width:80px" ></td>
<td style="width:98%;font-size:15px;" align="center" class="td2"><b>PENERIMAAN TRANSIT BARANG</b><br/>
  <br/><?=$valsupp['no_masuk']?></td>
</tr>
</table><br>-->
<table cellpadding="0" cellspacing="0" style="width:98%;">
    <tr>
        <td style="14%" ><img src="assets/images/photo_c.jpg" style="height:50px; width:100px" ></td>
        <td style="width:100%;font-size:10px; padding-left:10px;" align="justify" class="td2">
                <b>PT. TAURUS GEMILANG</b>
                <br>
                <?php
                $gudang = $_SESSION['ID_GUDANG'];
                $almt=$db->select("m_gudang a JOIN m_cabang b ON a.id_cabang = b.id_cabang","a.nama_gudang as nama_gudang, a.alamat as alamat1, b.nama_cabang as nama_cabang, b.alamat as alamat2","a.id_gudang='$gudang'");
                foreach($almt as $nama){
                ?>
                <?=$nama['nama_cabang']?><br>
                <?=$nama['nama_gudang']?><br>
                <?=$nama['alamat1']?><br>
                <?php } ?>
                
            
         </td>
    </tr>
    <tr>
        <td colspan="2" style="width:98%;font-size:15px; padding-top:30px;" align="center" class="td2"><b>PENERIMAAN TRANSIT BARANG</b><br/><br/><?=$valsupp['no_masuk']?></td>
    </tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
 
<td class="td2" align="left" style="font-size:11px;">

  <br>No Ref :<b> <?=$valsupp['no_ref']?></b>
  <br>Tanggal :<b> <?=$valsupp['tgl']?></b>
  <br>Surat Jalan :<b> <?=$valsupp['surat_jalan']?></b>
  <?php
					$supps=$db->select("tx_brg_masuk a
JOIN tx_brg_keluar b ON a.no_ref = b.no_keluar
JOIN m_gudang c ON b.id_gudang = c.id_gudang","a.*,
c.nama_gudang as darigudang","a.id_masuk='$_GET[id]'");
					foreach($supps as $valsupp1){}
					?>
  <br>Dari Gudang :<b> <?=$valsupp1['darigudang']?></b>
</td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;" border="1">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Satuan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty Terima</b></td>
  </tr>
  <?php 
								$supp=$db->select("tx_brg_masuk a
JOIN tx_brg_masuk_dtl b ON a.no_masuk = b.no_masuk
LEFT JOIN m_barang_gudang c ON b.id_barang = c.id_barang
AND a.id_gudang = c.id_gudang left join m_satuan e on c.id_satuan=e.id_satuan","*","a.id_masuk='$_GET[id]'");
							  $no=1;
							  $tot=0;
							  $nilai=0;
							  foreach($supp as $valsupp){
								  $tot=$tot+$valsupp['qty'];
								  $nilai=$nilai+$valsupp['qty_terima'];
?>
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:50%;font-size:11px;text-align:left"><?=$valsupp['kode_barang']."-".$valsupp['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$valsupp['nama_satuan']?></td>
    <td style="width:10%;font-size:11px;text-align:center"><?=number_format($valsupp['qty'])?></td>
    <td style="width:10%;font-size:11px;text-align:center"><?=number_format($valsupp['qty_terima'])?></td>
  </tr>
<?php } ?>
<tr>
  	<td colspan="3" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:3%;font-size:11px;text-align:center"><?=number_format($tot)?></td>
    <td style="width:3%;font-size:11px;text-align:center"><?=number_format($nilai)?></td>
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
                                        <td width="500" align="center" class="td2"><br>
                                          <table width="150" border="0" cellpadding="3" cellspacing="0">
                                            <tr>
                                              <td align="center" class="td2">Admin</td>
                                            </tr>
                                            <tr>
                                              <td width="200" align="center" class="td2"><br>
                                                <br>
                                                &nbsp;</td>
                                            </tr>
                                            <tr>
                                              <td width="200" align="center" class="td2"><br>
                                                <br>
                                                ________________</td>
                                            </tr>
                                            <tr>
                                              <td align="center" class="td3"></td>
                                            </tr>
                                          </table>
                                      <br>&nbsp;</td>
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