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
               vertical-align:middle; padding:0px;
           }
.td3 {
			   
               border-bottom: 1px solid #666; font-size:12px;
               vertical-align:middle; padding:0px;
           }
</style>
<?php 
	$tglso=$db->select("tx_do a 
	join m_customer b on a.id_cus_shipto=b.id_cus","a.*,b.nama_usaha,b.alamat_usaha","no_spj='$_GET[id]'");
	foreach($tglso as $tglspj){}
	
	
	?>
<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
<td style="14%" rowspan="4"><img src="assets/images/photo_c.jpg" style="height:80px; width:80px" ></td>
<td style="width:98%;font-size:14px;" align="center" class="td2"><b>PENGELUARAN BARANG</b><br/><br/><?=$tglspj['no_spj']?></td>
</tr>
</table><br>
<table cellpadding="0"  cellspacing="0" style="width:98%;">
<tr>
<tr>
  <td colspan="3"style="width:50%;">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
          <td colspan="3" style="width:50%; font-size:12px;" >Unit&nbsp;&nbsp; : <?=$tglspj['nama_usaha']?></td>
    <td>&nbsp;</td>
          <td style="width:50%; font-size:12px;" >No Ref  : <?=$tglspj['no_ref']?></td>
          
  </tr>
  <tr>
    <td colspan="3" style="width:50%; font-size:12px;" >Tgl&nbsp;&nbsp;&nbsp; :
      <?=$tglspj['tgl_spj']?>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
          <td colspan="3">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
  </tr>
  <td class="td2" align="Center" style="font-size:11px;"></td>
</tr>
<tr>
 

  <td class="td2" align="left" style="font-size:11px;"></td>
</tr>
</table>

              <table style="width:98%;" border="1" cellpadding="3" cellspacing="3" >
                  <tr>
                        <td style="width:10%;font-size:10px;text-align:center"><strong>No</strong></td>
                        <td style="width:10%;font-size:10px;text-align:center"><strong>Nama Barang</strong></td>
                        <td style="width:10%;font-size:10px;text-align:center"><strong>Satuan</strong></td>
                        <td style="width:10%;font-size:10px;text-align:center"><strong>Qty</strong></td>
                </tr>
                  <?php 
							$supp=$db->select("tx_do_dtl a
							JOIN m_barang c ON a.id_barang = c.id_barang
							JOIN m_satuan e on c.id_satuan=e.id_satuan","a.*,
							c.kode_barang,
							c.nama_barang,
							e.nama_satuan","a.no_spj='$_GET[id]'");
							  $no=1;
							  $tot=0;
							  $total=0;
							  foreach($supp as $valsupp){
								
								?>
                  <tr>
                        <td style="width:5%;font-size:10px;text-align:center;"><?=$no?></td>
                        <td style="width:60%;font-size:10px;text-align:left;"><?=$valsupp['nama_barang']?></td>
                        <td style="width:10%;font-size:10px;text-align:center;"><?=$valsupp['nama_satuan']?></td>
                        <td style="width:10%;font-size:10px;text-align:center;"><?=$valsupp['qty']?></td>
                 </tr>
                      <?php 
					  
					  $no++; } ?>
                    
                <tr>
                        <td colspan="4" style="font-size:10px;text-align:right;">&nbsp;<b></b></td>
                </tr>
                      
</table>	
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td colspan="3" class="td2" style="font-size:10px;text-align:right;">&nbsp;</td>
                 </tr>
                        <tr>
                        <?php 
								$tgln=$db->select("tx_do a
								JOIN m_customer b ON a.id_cus = b.id_cus
								JOIN m_cabang c ON c.id_cabang = b.id_cabang","c.nama_cabang","a.no_spj='$_GET[id]'");
							  foreach($tgln as $ks){}
								?>
                          <td align="right" style="font-size:10px;text-align:right;" class="td2"><strong></strong></td>
                          <td style="font-size:10px;text-align:right;" class="td2">&nbsp;</td>
                          <td class="td2" style="font-size:10px;text-align:right;"><strong>Tgl : <?=$ks['nama_cabang']?>, <?=date('d',strtotime($tglspj['tgl_spj']))?>-<?=date('m',strtotime($tglspj['tgl_spj']))?>-<?=date('Y',strtotime($tglspj['tgl_spj']))?></strong></td>
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
                            <td width="18%" class="td2">&nbsp;</td>
                            <td width="58%" class="td2">&nbsp;</td>
                            <td width="21%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td class="td2" align="center">Admin</td>
                                    </tr>
                                    <tr>
                                        <td width="120" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width:70%" width="38%" class="td2">
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
                                        <td class="td2" align="center">--------------</td>
                                    </tr>
                                    <tr>
                                        <td width="120" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                            
                            <td width="18%" class="td2">&nbsp;</td>
                        </tr>
</table>
                  