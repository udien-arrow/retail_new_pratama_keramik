<?php 
require( 'webclass.php' );
$db=new kelas;
session_start();
foreach($jum=$db->select("tx_sales_biaya","*","no_sb='$_GET[id]'")as $vsb);
								foreach($db->select("tx_sales_biaya_dtl a 
								join tx_sales_order b on a.id_cus=b.id_cus_shipto
								join m_customer c on a.id_cus=c.id_cus
								","c.nama_usaha,b.ship_to,a.no_so","a.no_sb='$_GET[id]' order by biaya_retri desc limit 0,1")as $c);
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
<td style="width:100%;font-size:15px;" align="center" class="td2"><b>Biaya Pengiriman</b></td>
</tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>
 
<td class="td2" align="left" style="font-size:11px;">
Pelanggan :<b> <?=$c['nama_usaha']?></b>
  <br>Ship to :<b> <?=$c['ship_to']?></b>
  <br>No SB :<b> <?=$_GET['id'] .' - '. $c['no_so'];?></b>
</td>
</tr>
</table><br>

<table style="width:98%;" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="3" align="left"><b>&nbsp;Detil Biaya</b></td>
                  </tr>
                  <tr>
                        <td width="5%"  align="center" style="width:3%;font-size:10px;text-align:center"><strong>No</strong></td>
                        <td width="73%" align="center" style="width:70%;font-size:10px;text-align:center"><strong>Nama Biaya</strong></td>
                        <td width="22%" align="center"  style="width:20%;font-size:10px;text-align:center"><strong>Jumlah</strong></td>
                  </tr>
                 <?php if($vsb['jenis_jual']=='FRC'){
                 
					$ak=$db->select("tx_sales_biaya_r_dtl a join m_retribusi b on a.id_retribusi=b.id_retribusi","a.*,b.nama_retribusi","a.no_sb='$_GET[id]'");
					$no=1;
					foreach($ak as $dta){  
					
				  ?>
                  <tr>
                    <td align="center"><?=$no?></td>
                    <td>&nbsp;<?=$dta['nama_retribusi'];?></td>
                    <td align="right"><?=number_format($dta['nilai']);?>&nbsp;</td>
                  </tr>
                  <?php 
				  $no++;
				  }?>
                  <tr>
                    <td align="center"><?=$no+1?></td>
                    <td >&nbsp;Biaya Retribusi</td>
                    <td align="right"><?=number_format($vsb['biaya_retri'])?>&nbsp;</td>
                  </tr>
                  <tr>
                      <td align="center"><?=$no+1?></td>
                      <td >&nbsp;Total BBM</td>
                      <td align="right"><?=number_format($vsb['biaya_ujs'])?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center"><?=$no+1?></td>
                      <td >&nbsp;Biaya Lain2</td>
                      <td align="right"><?=number_format($vsb['biaya_lain'])?>&nbsp;</td>
                    </tr>
                     <tr>
                        <td colspan="2" align="right"><b> Total UJS</b>&nbsp;</td>
                       
                        <td align="right"><b><?php echo number_format($vsb['biaya_retri']+$vsb['biaya_ujs']+$vsb['biaya_lain'])?>&nbsp;</b></td>
                </tr>
                     <tr>
                        <td colspan="2" align="right">&nbsp;<b>Total Gaji Supir</b></td>
                        <td align="right"><?php
						if($vsb['jenis_jual']=='FRC'){
						foreach($db->select("tx_sales_biaya_supir a join tx_sales_biaya_dtl b on a.no_so=b.no_so","sum(a.biaya_supir)as bs","b.no_sb='$_GET[id]' group by b.no_sb")as $bsv);
						echo number_format($ak=$bsv['bs']);
						}else{
							$ak=0;
							echo $ak;	
						}
						?>&nbsp;</td>
                </tr>
                <?php }if($vsb['jenis_jual']=='SWC'){?>
                     <tr>
                    <td align="center">1</td>
                    <td >&nbsp;Biaya Switch</td>
                    <td align="right"><?=number_format($vsb['biaya_switch'])?>&nbsp;</td>
                  	</tr>
                    <?php }if($vsb['jenis_jual']=='LCO'){?>
                     <tr>
                      <td align="center">1</td>
                      <td>&nbsp;Biaya Sewa Locco</td>
                      <td align="right"><?=number_format($vsb['biaya_sewa_lco'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                   
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
                                        <td width="70" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
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
										?>                        </td>
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
                                        <td align="center" class="td2">POA</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br><?php 
										$ak=$db->cetak('4',$_SESSION['ID_CABANG']);
										echo $ak;
										?>                        </td>
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
