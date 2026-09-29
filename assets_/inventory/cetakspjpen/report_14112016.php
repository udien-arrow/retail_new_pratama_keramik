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
			   
               border: 0px solid #666; font-size:12px; line-height: 20px; 
               vertical-align:middle; padding:0px;
           }
.td3 {
			   
               border-bottom: 1px solid #666; font-size:12px; line-height: 20px; 
               vertical-align:middle; padding:0px;
           } 
</style>
<table cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  <td align="right" style="width:40%" class="td2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
  <td align="right" style="width:50%;font-size:10px;text-align:center" class="td2"><b>PT.Taurus Gemilang</b></td>
   <td align="center" style="width:40%;font-size:15px;text-align:center" class="td2"><b>SURAT IJIN PENGAMBILAN BARANG</b></td>
  </tr>
   <?php 
				$supp=$db->select("tx_sales_spb","*","no_spb='$_GET[id]'");
                foreach($supp as $valsupp){}
				$no=1;
?>
 <tr>
  <td align="center" style="width:30%" colspan="2" class="td2"><b></b></td>
  <td align="center" style="width:20%;font-size:10px;text-align:right;" class="td2"><?=$valsupp['no_spb']?></td>
 </tr>
 <tr>
  <td align="center" style="width:30%" colspan="2" class="td2"><b></b></td>
  <td align="center" style="width:20%;font-size:10px;text-align:center" class="td2">&nbsp;</td>
 </tr>
 <tr>
  <td align="center" style="width:30%" colspan="2" class="td2"><b></b></td>
  <td align="center" style="width:20%;font-size:10px;text-align:center" class="td2">Tanggal SPB : <?php echo date("d-m-Y",strtotime($valsupp['tgl']));?></td>
 </tr>
 <tr>
  <td align="center" style="width:30%" colspan="2" class="td2"><b></b>&nbsp;</td>
  <td align="center" style="width:20%;font-size:10px;text-align:center" class="td2">&nbsp;</td>
 </tr>
 <tr>
  <td align="center" style="width:30%" colspan="2" class="td2"><b></b>&nbsp;</td>
  <td align="center" style="width:20%;font-size:10px;text-align:center" class="td2">&nbsp;</td>
 </tr>
 <tr>
  <td align="center" style="width:30%" colspan="2" class="td2"><b></b>&nbsp;</td>
  <td align="center" style="width:20%;font-size:10px;text-align:center" class="td2">&nbsp;</td>
 </tr>
 <tr>
  <td align="center" style="width:30%" colspan="2" class="td2"><b></b>&nbsp;</td>
  <td align="center" style="width:20%;font-size:10px;text-align:center" class="td2">&nbsp;</td>
 </tr>
 <tr>
  <td align="center" colspan="2" style="width:50%;font-size:10px;text-align:center"" class="td2"><b>	</b></td>
  <td align="center" style="width:20%;font-size:10px;text-align:center" class="td2"></td>
 </tr>
</table>
 <?php
 				
					
              $kon=$db->select("tx_sales_biaya_dtl b left join m_customer c on b.id_cus=c.id_cus","b.*,c.nama_usaha,c.kode_cus","b.no_sb='$valsupp[no_ref]' order by b.biaya_retri asc");	
			  $nom=1;
              foreach($kon as $konval){
              $tot=0;
              ?>
<?php error_reporting(0)?>
<p>Kepada Yth, <br>
<?=$konval['kode_cus'] ?> /
<?=$konval['nama_usaha']?> <br>
<?=$konval['alamat_usaha']?></p>

<p>Dengan Hormat, <br>
Bersama ini kami mohon untuk diberikan barang kepada sopir kami dengan identifikasi sebagai berikut : <br>
Nama : <?=$konval['nama_supir']?> <br>
Nopol : <?=$konval['nopol']?> <br>
Telepon : <br> 
Nomor SO : <?=$konval['no_so']?> <br>
Tujuan : 
</p>
<p>
  
</p>
<table style="width:98%;" border="1" cellpadding="0" cellspacing="0" class="table4">
  <tr>
                    <td colspan="4"align="left" style="width:20%;font-size:10px;text-align:center">&nbsp;<?php echo ucfirst(strtoupper($konval['no_so'].' - '.$konval['kode_cus'].' - '.$konval['nama_usaha']));?></td>
  </tr>
                  <tr>
                        <td style="width:10%;font-size:10px;text-align:center"><strong>No</strong></td>
                        <td style="width:10%;font-size:10px;text-align:center"><strong>Nama Barang</strong></td>
                        <td style="width:10%;font-size:10px;text-align:center"><strong>Satuan</strong></td>
                        <td style="width:10%;font-size:10px;text-align:center"><strong>Qty</strong></td>
                  </tr>
                  <?php
                      $kon=$db->select("tx_sales_order_dtl a 
					  join m_barang b on a.id_barang=b.id_barang
					  join m_satuan c on c.id_satuan=a.id_satuan
					  ","c.nama_satuan,a.id_barang,b.kode_barang,b.nama_barang,a.qty,a.harga","a.no_sales='$konval[no_so]'");
                      $no=1;
					  $tot=0;
                      foreach($kon as $d){  
				  	  $br=$db->select("m_barang","*","kode_barang='$d[kode_barang]'");
					  foreach($br as $bar){}
					  if($bar['nama_barang_nick']=='')
					  {  $sa=$d['nama_barang']; }
					  else{ $sa=$bar['nama_barang_nick']; }
                      ?>
                  <tr>
                        <td style="width:5%;font-size:10px;text-align:center;"><?php echo $no?>&nbsp;</td>
                        <td style="width:60%;font-size:10px;text-align:left;">&nbsp;<?php echo ucfirst(strtolower($sa));?>&nbsp;</td>
                        <td style="width:10%;font-size:10px;text-align:center;">&nbsp;<?=$d['nama_satuan']?></td>
                        <td style="width:20%;font-size:10px;text-align:center;"><?=$d['qty']?>&nbsp;</td>
                 </tr>
                      <?php $no++;
					  $tot=$tot+$d['qty'];
                      } ?>
                    
                    <tr>
                        <td colspan="3" style="font-size:10px;text-align:right;"><b>Total</b>&nbsp;</td>
                        <td style="font-size:10px;text-align:center;"><b><?=$tot?></b>&nbsp;</td>
                </tr>
                      
              </table>	
<p>
  <?php
               $nom++;
               }
               ?>
              </p>
              <p> Atas perhatian dan kerjasamanya kami ucapkan banyak terimakasih.</p>
              <p><font size="-1"> 
<i>Dicetak tanggal : <?php echo date("d-m-Y H:i:s")?></i> 
</font></p>
             <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td colspan="3" class="td2">&nbsp;</td>
               </tr>
                        <tr>
                          <td width="6%" class="td2">&nbsp;</td>
                          <td width="15%" class="td2">&nbsp;</td>
                          <td width="79%" align="right" class="td2">    <p>

</p></td>
                        </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="18%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Driver</td>
                                    </tr>
                                    <tr>
                                        <td width="242" align="center" class="td2"><br><br>
                                        <?=$konval['nama_supir']
										?>                                          &nbsp;</td>
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
                                        <td width="20" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            
                            
                          <td width="18%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                    <tr>
                                        <td width="20" align="center" class="td2"><br><br></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="19%" class="td2">
                                
                          </td>
                            <td width="21%" class="td2">&nbsp;</td>
                            <td width="18%" class="td2">&nbsp;</td>
  </tr>
</table>
    
                  