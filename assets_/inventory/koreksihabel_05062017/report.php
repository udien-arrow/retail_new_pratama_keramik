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
<td style="width:100%;font-size:15px;" align="center" class="td2"><b>KOREKSI HARGA BELI
  <?=$gud['nama_gudang']?></b></td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
 <?php
					$supp=$db->select("v_korhabel","*","no_koreksi='$_GET[id]'");
					foreach($supp as $val){}
?>
<td class="td2" align="left" style="font-size:11px;">
  <p>&nbsp;</p>
  <p>Kepada Yth : <br>
    Sales Pembelian PT. Taurus Gemilang</p>
  <p>Dengan Hormat,<br>
    Bersama ini kami sampaikan barang-barang dengan spesifikasi sebagai berikut :</p>
  <p>No Masuk :<b> <?=$val['no_masuk']?>
    </b>
  
    <br>Tanggal :<b> <?=$val['tgl_koreksi']?>
      </b>

 </p>
</td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Satuan</b></td>
   
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Harga Awal</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Di Ganti Harga</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>keterangan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Jumlah</b></td>
  </tr>
  <?php
                   
				   
$kon=$db->select("tx_koreksi_habel a 
			
			  join m_barang b on a.id_barang=b.id_barang
			  join m_satuan c on b.id_satuan=c.id_satuan
			   ","*","a.no_masuk='$_GET[id]'");	
$no=1;
$tot=0;
foreach($kon as $d){  
$tot=$tot+$d['qty']?>			
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:20%;font-size:11px;text-align:left"><?=$d['kode_barang']."-".$d['nama_barang']?></td>
    <td style="width:5%;font-size:11px;text-align:center"><?=$d['nama_satuan']?></td>
   
    <td style="width:8%;font-size:11px;text-align:center"><?=number_format($d['qty'])?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=number_format($d['harga_awal'])?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=number_format($d['harga_ganti'])?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=number_format($d['ket'])?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=number_format($sub=$d['harga_ganti']*$d['qty'])?></td>
  </tr>
 <?php $no++; 
	   $tot=$tot+$sub;
								} ?>
<tr>
  	<td colspan="7" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:3%;font-size:11px;text-align:center"><?=number_format($tot)?></td>
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
                                        <td align="center" class="td2">Branch Manager</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br><?php 
										$ak=$db->cetak('1',$_SESSION['ID_CABANG']);
										echo $ak;
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
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                          <td width="19%" class="td2">&nbsp;</td>
                            <td width="21%" class="td2">&nbsp;</td>
                            <td width="18%" class="td2">&nbsp;</td>
                        </tr>
                      </table>
<p>
<font size="-1">
<i>Dicetak tanggal : <?php echo date("d-m-Y H:i:s")?></i> 
</font>
</p>