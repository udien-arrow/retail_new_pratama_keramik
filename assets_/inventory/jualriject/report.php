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
<td style="width:100%;font-size:15px;" align="center" class="td2"><b>PERMINTAAN PENJUALAN BARANG RIJECT</b></td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
 <?php
					$supp=$db->select("v_jual_riject","*","no_sales='$_GET[id]'");
					foreach($supp as $valsupp){}
?>
<td class="td2" align="left" style="font-size:11px;">
Pelanggan :<b> <?=$valsupp['nama_usaha']?></b>
  <br>Customer :<b> <?=$valsupp['no_sales']?></b>
  <br>Tanggal :<b> <?=$valsupp['tgl_sales']?></b>
  <br>Jenis :<b> <?=$valsupp['jenis']?></b>
</td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Satuan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Harga</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Total</b></td>
  </tr>
  <?php
                   
				   
$kon=$db->select("tx_jual_riject az
								JOIN tx_jual_riject_dtl a ON az.no_sales = a.no_sales
								JOIN m_barang_gudang b ON a.id_barang = b.id_barang
								AND az.id_gudang = b.id_gudang
								JOIN m_satuan c ON a.id_satuan = c.id_satuan
								join m_customer d on az.id_cus=d.id_cus
								","a.qty,
								b.kode_barang,
								b.nama_barang,
								a.harga,
								c.nama_satuan,
								d.nama_usaha,
								a.no_sales","az.no_sales='$_GET[id]'");	
$no=1;
$tot=0;
$grand=0;
foreach($kon as $d){  
$tot=$d['qty']*$d['harga'];
$grand=$grand+$tot;
?>			
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:50%;font-size:11px;text-align:left"><?=$d['kode_barang']."-".$d['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$d['nama_satuan']?></td>
    <td style="width:15%;font-size:11px;text-align:right"><?=number_format($d['harga'])?></td>
    <td style="width:10%;font-size:11px;text-align:center"><?=number_format($d['qty'])?></td>
    <td style="width:15%;font-size:11px;text-align:right"><?=number_format($tot)?></td>
  </tr>
<?php } ?>
<tr>
  	<td colspan="5" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($grand)?></td>
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
                                        <td align="center" class="td2">BAO</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br><?php 
										$ak=$db->cetak('3',$_SESSION['ID_CABANG']);
										echo $ak;
										?>;</td>
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
                                        <td width="70" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
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
                                        <td width="70" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Directur</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br><?php 
										$ak=$db->cetak('7',$_SESSION['ID_CABANG']);
										echo $ak;
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
