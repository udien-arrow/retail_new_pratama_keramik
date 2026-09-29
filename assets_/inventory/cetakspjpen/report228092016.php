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
               vertical-align:middle; padding:0px;
           }
.td3 {
			   
               border-bottom: 1px solid #666; font-size:12px;
               vertical-align:middle; padding:0px;
           }
</style>
<?php 
							 // $se=$db->select("v_sales_order","*","no_sales='$_GET[id]'");
							  //$no=1;
							  //foreach($se as $val){}
								?>
<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  <td align="right" style="width:40%" class="td2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
  <td align="right" style="width:50%;font-size:10px;text-align:center" class="td2"><b>PT.Taurus Gemilang</b></td>
   <td style="width:40%;font-size:15px;text-align:left;" class="td2"><b>SURAT PERINTAH JALAN</b></td>
  </tr>
   <?php 
	$tglso=$db->select("tx_do a left join m_customer b on a.id_cus_shipto=b.id_cus","a.*,b.nama_usaha,b.alamat_usaha","no_ref='$_GET[id]'");
	foreach($tglso as $tglspj){}
	?>
 <tr>
  <td style="width:30%" colspan="2" class="td2"><b></b></td>
  <td style="width:10%;font-size:10px;text-align:center;" class="td2"><?=$tglspj['no_spj']?></td>
 </tr>
 <tr>
  <td style="width:30%" colspan="2" class="td2"><b></b></td>
  <td style="width:20%;font-size:10px;text-align:center" class="td2">&nbsp;</td>
 </tr>
 <tr>
 <td style="width1:10%;align:center;font-size:10px;"  class="td2"><b>Kepada Yth.</b></td>
 <td style="font-size:10px;"  class="td2"><b><?=$tglspj['nama_usaha']?></b></td>
 <td style="width:20%;font-size:10px;" class="td2"><b>Tanggal Pengiriman : <?=$tglspj['tgl_spj']?></b></td>
 </tr>
 <tr>
 <td style="width1:10%;align:center;font-size:10px;"  class="td2"><b></b></td>
 <td style="font-size:10px;"  class="td2"><b><?=$tglspj['ship_to']?></b></td>
 <td style="width:20%;font-size:10px;" class="td2"><b>Jatuh Tempo Pembayaran Normal : <?=$tglspj['tempo_normal']?></b></td>
 </tr>
 <tr>
 <td style="width1:10%;align:center;font-size:10px;"  class="td2"><b></b></td>
 <td style="font-size:10px;"  class="td2"><b><?=$tglspj['alamat_usaha']?></b></td>
 <td style="width:20%;font-size:10px;" class="td2"><b>Nopol : </b></td>
 </tr>
 <tr>

 <td style="width1:10%;align:center;font-size:10px;"  class="td2"><b></b></td>
 <td style="font-size:10px;"  class="td2"><b></b></td>
 <td style="width:20%;font-size:10px;" class="td2">&nbsp;</td>
 </tr>
 <tr>
  <td style="width:30%" colspan="2" class="td2"><b></b>&nbsp;</td>
  <td style="width:20%;font-size:10px;text-align:center" class="td2">&nbsp;</td>
 </tr>
 <tr>
  <td style="width:30%" colspan="2" class="td2"><b></b>&nbsp;</td>
  <td style="width:20%;font-size:10px;text-align:center" class="td2">&nbsp;</td>
 </tr>
 <tr>
  <td colspan="2" style="width:50%;font-size:10px;text-align:left;"" class="td2"><b>Bersama ini kami kirimkan surat pengiriman barang berupa :	</b></td>
  <td style="width:20%;font-size:10px;text-align:center" class="td2"></td>
 </tr>
</table>

              <table style="width:98%;" border="1" cellpadding="0" cellspacing="0" class="table4">
                  <tr>
                        <td style="width:10%;font-size:10px;text-align:center"><strong>No</strong></td>
                        <td style="width:10%;font-size:10px;text-align:center"><strong>Nama Barang</strong></td>
                        <td style="width:10%;font-size:10px;text-align:center"><strong>Qty</strong></td>
                        <td style="width:10%;font-size:10px;text-align:center"><strong>Keterangan</strong></td>
                  </tr>
                  <?php 
									$supp=$db->select("tx_sales_order a
									JOIN tx_sales_order_dtl b ON a.no_sales = b.no_sales
									JOIN m_barang_gudang c ON b.id_barang = c.id_barang
									AND a.id_gudang = c.id_gudang
									JOIN m_satuan e on b.id_satuan=e.id_satuan","b.*,
									c.kode_barang,
									c.nama_barang,
									e.nama_satuan","b.no_sales='$_GET[id]'");
							  $no=1;
							  $tot=0;
							  foreach($supp as $valsupp){
								  $tot=$tot+$valsupp['qty'];
								?>
                  <tr>
                        <td style="width:5%;font-size:10px;text-align:center;"><?=$valsupp['kode_barang']?></td>
                        <td style="width:60%;font-size:10px;text-align:left;"><?=$valsupp['nama_barang']?></td>
                        <td style="width:10%;font-size:10px;text-align:center;"><?=$valsupp['qty']?></td>
                        <td style="width:20%;font-size:10px;text-align:center;"></td>
                 </tr>
                      <?php $no++; } ?>
                    
                <tr>
                        <td colspan="2" style="font-size:10px;text-align:right;"><b>Total</b>&nbsp;</td>
                        <td style="font-size:10px;text-align:center;"><b></b><?=$tot?></td>
                        <td style="font-size:10px;text-align:center;"><b></b>&nbsp;</td>
                </tr>
                      
              </table>	
               <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td colspan="3" class="td2" style="font-size:10px;text-align:right;">&nbsp;</td>
                        </tr>
                        <tr>
                        <?php 
						$tgln=$db->select("tx_sales_order","id_cabang,ifnull(id_cabang_direct,'')as id_cabang_direct","no_sales='$_GET[id]'");
						foreach($tgln as $ks){}
						if($ks['id_cabang_direct']==''){
							foreach($db->select("m_cabang","nama_cabang","id_cabang='$ks[id_cabang]'")as $ks2);	
						}else{
							foreach($db->select("m_cabang","nama_cabang","id_cabang='$ks[id_cabang_direct]'")as $ks2);	
						}	  
							  
						
								?>
                          <td style="font-size:10px;text-align:right;" class="td2"><strong></strong></td>
                          <td style="font-size:10px;text-align:right;" class="td2">&nbsp;</td>
                          <td class="td2" style="font-size:10px;text-align:right;"><strong>Tgl : <?=$ks2['nama_cabang']?>,<?=date('d',strtotime($tglspj['tgl_spj']))?>-<?=date('m',strtotime($tglspj['tgl_spj']))?>-<?=date('Y',strtotime($tglspj['tgl_spj']))?></strong></td>
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
        <table width="90%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="18%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Penerima</td>
                                    </tr>
                                    <tr>
                                        <td width="100" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                             <td width="20%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                    <tr>
                                        <td width="50" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="18%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td class="td2" align="center">Driver</td>
                                    </tr>
                                    <tr>
                                        <td class="td2" width="100"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="td2" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="18%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                    <tr>
                                        <td width="30" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td class="td2" align="center">Cheker</td>
                                    </tr>
                                    <tr>
                                        <td class="td2" width="100"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="18%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                    <tr>
                                        <td width="30" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="21%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Satpam</td>
                                    </tr>
                                    <tr>
                                        <td class="td2" width="100"><br><br>&nbsp;</td>
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
                                        <td width="30" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="18%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td class="td2" align="center">Branch Manager</td>
                                    </tr>
                                    <tr>
                                        <td width="120" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                      </table>
                  