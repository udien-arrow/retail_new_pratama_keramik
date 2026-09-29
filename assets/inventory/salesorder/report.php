<?php 
require( 'webclass.php' );
$db=new kelas;
session_start();
?>
<style>
table {
		  border-collapse: collapse;
	  }
.table, {
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
					$supp=$db->select("v_sales_order","*","no_sales='$_GET[id]'");
					foreach($supp as $valsupp){}
?>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
<td style="14%" rowspan="4"><img src="assets/images/photo.jpg" height="65px" width="70px"></td>
<td style="width:90%;font-size:15px;" align="center" class="td2"><b>REQUEST ORDER</b><br/><br/><?=$valsupp['no_sales']?><br/></td>
</tr>
</table><br>

<table cellpadding="0"  cellspacing="0" style="width:98%;">
<tr>
<tr>
          <td colspan="3"style="width:80%;">Dari : <?=$valsupp['nama_usaha']?></td>
          <td>&nbsp;</td>
          <td>Tanggal :<?=$valsupp['tgl_sales']?></td>
          
  </tr>
  <tr>
          <td colspan="3">ke&nbsp;&nbsp;&nbsp; : <span style="width:80%;"><?=$valsupp['nama_gudang']?>
          </span></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
  <td class="td2" align="Center" style="font-size:11px;"></td>
</tr>
<tr>
 

  <td class="td2" align="left" style="font-size:11px;"></td>
</tr>
</table>
<br>

<table cellpadding="0" cellspacing="0" style="width:98%;" class="table" border="1">
  <tr>
  	<td style="width:10%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:20%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:20%;font-size:10px;text-align:center"><b>Satuan</b></td>
    <td style="width:20%;font-size:10px;text-align:center"><b>Qty</b></td>
  </tr>
  <?php
                   
				   
$kon=$db->select("tx_sales_order az
								JOIN tx_sales_order_dtl a ON az.no_sales = a.no_sales
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
    <td style="width:10%;font-size:11px;text-align:center"><?=number_format($d['qty'])?></td>
  </tr>
<?php } ?>
<tr>
  	<td colspan="4" style="width:3%;font-size:11px;text-align:right">&nbsp;</td>
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
                                        <td align="center" class="td2">Admin</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>
                                        
                                       </td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br> 
<?php
/*$cek=$db->select("tx_sales_order a 
left join r_user_login b on a.id_user=b.id  
left join m_pegawai c on b.id_pegawai=c.id_pegawai
","c.nama_pegawai","a.no_sales='$_GET[id]'");
		foreach($cek as $dtbm){}
		
		echo $dtbm['nama_pegawai'];*/
										
										?>------------------</td>
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
                            <td width="19%" class="td2">&nbsp;</td>
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
