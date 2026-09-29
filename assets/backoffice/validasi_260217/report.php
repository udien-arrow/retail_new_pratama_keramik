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
					$supp1=$db->select("v_brg_masuk","*","no_masuk='$_GET[id]'");
					foreach($supp1 as $valsupp1){}
?>
<?php
					$gud=$db->select("m_gudang","*","id_gudang='$_SESSION[ID_GUDANG]'");
					foreach($gud as $gud){}
					
					$kurs=$db->select("m_valuta a 
left join m_valuta_dtl b on a.id_valuta=b.id_valuta","a.id_valuta,b.kurs,a.nama_valuta","a.id_valuta='$valsupp1[id_valuta]' and b.tgl_berlaku <=CURDATE() ORDER BY b.tgl_berlaku desc limit 0,1");
		 			foreach($kurs as $kursval){}
					?>
<!--<table cellpadding="0" cellspacing="0" style="width:98%;">
    <tr>
        <td width="10%" align="center" class="td2" style="width:20%;font-size:15px;"><img src="assets/images/photo_c.jpg" style="height:50px; width:100px" ></td>
        <td width="90%" align="center" class="td2" style="width:80%;font-size:15px; ali"><span class="td2" style="width:100%;font-size:15px;"><b>BERITA ACARA SERAH TERIMA(BAST)</b><br/>
            <br/>
            <?=$valsupp1['no_masuk']?>
        </span></td>
    </tr>
</table><br>-->
<table cellpadding="0" cellspacing="0" style="width:98%;">
    <tr>
        <td width="22%" style="14%"><img src="assets/images/photo_c.jpg" style="height:height:50px; width:100px" ></td>
        <td style="width:40%;font-size:15px;" align="center" class="td2"><b>BERITA ACARA SERAH TERIMA(BAST)</b><br/>
            <?=$valsupp1['no_masuk']?></td>
        <td>&nbsp;</td>
        
       
    </tr>
    <tr>
    	<td style="width:25%;font-size:10px; padding-left:10px; padding-top:10px;" align="justify" class="td2">
                <b>PT. TAURUS GEMILANG</b>
                <br>
                <?php
                $cabang = $_SESSION['ID_CABANG'];
				$gudang = $_SESSION['ID_GUDANG'];
				//$cabang = $konval['id_cabang'];
				//$gudang = $konval['id_gudang'];
                $almt=$db->select("m_gudang a JOIN m_cabang b ON a.id_cabang = b.id_cabang","a.nama_gudang as nama_gudang, a.alamat as alamat1, b.nama_cabang as nama_cabang, b.alamat as alamat2","a.id_cabang='$cabang' and a.id_gudang='$gudang'");
                foreach($almt as $nama){
                ?>
                <?=$nama['nama_cabang']?><br>
                <?=$nama['nama_gudang']?><br>
                <?=$nama['alamat1']?><br>
                <?php } ?>
                <!--BANDARA SULTAN HASANUDDIN <br>
                JL. BANDARA BARU, BAJI MANGGAI, MANDAI<br>
                PH.<br>
                FAX<br>-->
                
            
         </td>
         <td width="32%" align="justify" class="td2" style="width:15%;font-size:25px; padding-left:10px;">&nbsp;</td>
         <td width="46%" align="justify" class="td2" style="width:15%;font-size:25px; padding-left:10px;">
         	<table width="60%" border="1">
                <tr>
                     <td width="44%" align="justify" style="width:25%;font-size:10px; padding-left:10px; padding-top:10px;"> DATE </td>
                     <td width="9%" align="justify" style="width:5%;font-size:5px; padding-left:10px; padding-top:10px;"> : </td>
                     <td width="47%" align="justify" style="width:30%;font-size:10px; padding-left:10px; padding-top:10px;"> <?=$valsupp1['tgl']?> </td>  
                </tr>
                <tr>
                    <td style="width:25%;font-size:10px; padding-left:10px;" align="justify" > PO NO. </td>
                    <td style="width:5%;font-size:5px; padding-left:10px;" align="justify" > : </td>
                    <td style="width:30%;font-size:10px; padding-left:10px;" align="justify" > <?=$valsupp1['no_ref']?> </td>
                </tr>
                <tr>
                    <td style="width:25%;font-size:10px; padding-left:10px;" align="justify" > DELIVERY DATE </td>
                    <td style="width:5%;font-size:5px; padding-left:10px;" align="justify" > : </td>
                    <td style="width:30%;font-size:10px; padding-left:10px;" align="justify" > <?=$valsupp1['tgl']?> </td>
                </tr>
                <tr>
                    <td style="width:25%;font-size:10px; padding-left:10px;" align="justify" > PO EXP DATE </td>
                    <td style="width:5%;font-size:5px; padding-left:10px;" align="justify" > : </td>
                    <td style="width:30%;font-size:10px; padding-left:10px;" align="justify" > <?=$valsupp1['tgl']?> </td>
                </tr>
                <tr>
                    <td style="width:25%;font-size:10px; padding-left:10px;" align="justify" > CURRENCY </td>
                    <td style="width:5%;font-size:5px; padding-left:10px;" align="justify" > : </td>
                    <td style="width:30%;font-size:10px; padding-left:10px;" align="justify" > <?=$kursval['nama_valuta']?> </td>
            	</tr>
    		</table>
          </td>
      </tr>
    	
    
</table><br>

<table cellpadding="0" cellspacing="0" style="width:98%;">
	<tr>
    	<td style="width:30%;font-size:12px; padding-left:5px; padding-top:5px; padding-bottom:5px; background-color:#039; color:white;" align="justify" class="td2">VENDOR/SUPPLIER</td>
    	<td style="width:25%;font-size:10px; padding-left:10px; padding-top:10px;" align="justify" class="td2">&nbsp;</td>
        <td style="width:30%;font-size:12px; padding-left:5px; padding-top:5px; padding-bottom:5px; background-color:#039; color:white;" align="justify" class="td2">SHIP TO</td>
    </tr>
    <tr>
    	<td style="width:25%;font-size:10px; padding-left:10px; padding-top:30px;" align="justify" class="td2">
        	<?=$valsupp1['nama_supp']?><br>
            <?=$valsupp1['nama_usaha']?><br>
            <?=$valsupp1['alamat_usaha']?><br>
            
        </td>
        <td style="width:25%;font-size:10px; padding-left:10px; padding-top:10px;" align="justify" class="td2">&nbsp;</td>
        <td style="width:25%;font-size:10px; padding-left:10px; padding-top:30px;" align="justify" class="td2">
        	PT. TAURUS GEMILANG<br>
			<?=$valsupp1['nama_gudang']?><br>
            <?=$valsupp1['alamat']?><br>
        </td>
    </tr>
</table><br />

<!--<table cellpadding="0" cellspacing="0" style="width:98%;">
<tr>

<td class="td2" align="left" style="font-size:11px;">
  <p>Kepada Yth. <br>
  <?=$valsupp1['nama_supp']?>
 <br> </p>
 

Dengan ini  kami  melakukan serah terima barang  dari 
  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Ref :<b> <?=$valsupp1['no_ref']?></b>
  <br> 
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal :<b> <?=$valsupp1['tgl']?></b>
  <br>
  Barang tersebut telah kami terima dengan baik, dengan rincian sebagai berikut :
</td>
</tr>
</table><br>-->

<table border="1" cellpadding="0" cellspacing="0" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Satuan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty Pesan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty Terima</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Selisih</b></td>
  </tr>
  <?php 
$kon=$db->select("tx_brg_masuk zz join tx_brg_masuk_dtl a on zz.no_masuk=a.no_masuk left join m_barang_gudang b on a.id_barang=b.id_barang and zz.id_gudang=b.id_gudang 
		join m_satuan c on a.sat=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan,zz.ket as ket","a.no_masuk='$_GET[id]'");
							  $no=1;
							  $tot=0;
							  $nilai=0;
							  $selisih=0;
							  $utuh=0;
							  $ktg=0;
							  foreach($kon as $valsupp){
								  $tot=$tot+$valsupp['qty'];
								  $nilai=$nilai+$valsupp['qty_terima'];
								  $selisih=$selisih+$valsupp['qty_kurang'];
								  $utuh=$selisih+$valsupp['claim_utuh'];
								  $ktg=$selisih+$valsupp['claim_ktg'];
?>
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:45%;font-size:11px;text-align:left"><?=$valsupp['kode_barang']."-".$valsupp['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$valsupp['nama_satuan']?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($valsupp['qty'])?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($valsupp['qty_terima'])?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($valsupp['qty_kurang'])?></td>
  </tr>
  <?php } ?>

<tr>
  	<td colspan="3" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($tot)?></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($nilai)?></td>
    <td style="width:3%;font-size:11px;text-align:right"><?=number_format($selisih)?></td>
  </tr>
</table><br />

<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          
                          <td colspan="3" class="td2">
                                <table width="60%" border="1">
                                    <tr>
                                        <td style="width:70%;font-size:12px; padding-left:5px; padding-top:5px; padding-bottom:5px; background-color:#666; color:white;" align="center">KETERANGAN</td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%; height:10%; font-size:12px; padding-left:5px; padding-top:5px; padding-bottom:5px;" align="justify"><?=$valsupp['ket']?></td>
                                    </tr>
                                </table> 
                          </td>
                        </tr>
                        <tr>
                          <td width="6%" class="td2">&nbsp;</td>
                          <td width="15%" class="td2">&nbsp;</td>
                          <td width="79%" align="right" class="td2">&nbsp;</td>
                        </tr>
</table>
<!--<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:11px;">
                        <tr>
                          <td style="width:86%" colspan="3" class="td2">&nbsp;</td>
                        </tr>
                        <tr>
          <td colspan="3">Catatan:</td>
        </tr>
        <tr>
          <td width="6%">&nbsp;</td>
          <td width="15%">Dikirim Ke</td>
          <td width="79%">:
           <?=$valsupp1['alamat']?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Contact Person </td>
          <td>:
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Alamat Tagihan</td>
          <td>:</td>
        </tr>
                        <tr>
                          <td class="td2">&nbsp;</td>
                          <td class="td2">&nbsp;</td>
                          <td align="right" class="td2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="3" class="td2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="3" class="td2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="3" class="td2">Atas Perhatian dan kerja sama yang baik, kami ucapkan terima kasih.</td>
                        </tr>
                        <tr>
                          <td colspan="3" class="td2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td style="width:30%; border: .01em solid #666;  " colspan="3"  height="60" valign="top" >Keterangan</td>
                        </tr>
		
        </table>-->
        <br><br>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="18%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                
                                    <tr>
                                        <td align="center" class="td2">Admin Gudang</td>
                                    </tr>
                                    <tr>
                                        <td width="242" align="center" class="td2"><br><br>
                                        <?php 
										/*$ak=$db->cetak('5',$_SESSION['ID_CABANG']);
										echo $ak;*/
										
										?> ------------------------                                         &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="18%" class="td2">&nbsp;</td>
                            
                            <td width="18%" class="td2">&nbsp;</td>
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
                            <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Pengirim</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>
                                        <?php 
										/*$ak=$db->cetak('1',$_SESSION['ID_CABANG']);
										echo $ak;*/
										?>          ------------------------                                 &nbsp;</td>
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
