<html>
<head>
<title></title>
</head>
<body bgcolor="#FFF380">
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
		border-bottom: 	1px solid #ddd;
		border-left: 1px solid #ddd;
		border-right: 1px solid #ddd;
	}
.td2 {
			   
               border: 0px solid #666; font-size:12px; 
               vertical-align:middle; padding:0px;line-height:15px;
           }
</style>

 <?php
					
					$supp=$db->select("v_po","*","no_po='$_GET[id]'");
					foreach($supp as $valsupp){}
					$ggs=$db->select("tx_po a left join tx_prp b on a.no_prp=b.no_prp left join tx_order c on b.no_order=c.no_order left join m_plan d on c.id_plan=d.id_plan","d.*,b.no_order, b.ket","a.no_po='$_GET[id]'");
					foreach($ggs as $valindo){}
					
					$kon=$db->select("tx_po a 
						left join m_supplier b on a.id_supp=b.id_supp
						left join m_gudang c on a.id_gudang=c.id_gudang","a.*,b.pkp,b.nama_supp,b.nama_usaha,c.nama_gudang,c.alamat,a.no_so,b.alamat_usaha,a.tgl_po","a.no_po='$_GET[id]'");	
					foreach($kon as $konval){}

											

					$cek=explode('/',$valindo['no_order']);
					
					$kurs=$db->select("m_valuta a 
left join m_valuta_dtl b on a.id_valuta=b.id_valuta","a.id_valuta,b.kurs,a.nama_valuta","a.id_valuta='$konval[id_valuta]' and b.tgl_berlaku <=CURDATE() ORDER BY b.tgl_berlaku desc limit 0,1");
		 			foreach($kurs as $kursval){}			
?>

<table cellpadding="0" cellspacing="0" style="width:98%;">
    <tr>
        <td width="22%" style="14%">
        <img src="assets/images/photo_c.jpg" style="height:height:50px; width:100px" ></td>
        <td style="width:40%;font-size:20px;" align="center" class="td2"><b>PURCHASE ORDER</b></td>
        <td>&nbsp;</td>
        
       
    </tr>
    <tr>
    	<td style="width:25%;font-size:10px; padding-left:10px; padding-top:10px;" align="justify" class="td2">
                <b>PT. TAURUS GEMILANG</b>
                <br>
                <?php
                //$cabang = $_SESSION['ID_CABANG'];
				//$gudang = $_SESSION['ID_GUDANG'];
				$cabang = $konval['id_cabang'];
				$gudang = $konval['id_gudang'];
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
                     <td width="47%" align="justify" style="width:30%;font-size:10px; padding-left:10px; padding-top:10px;"> <?=date("Y-m-d",strtotime($konval['tgl_po']))?> </td>  
                </tr>
                <tr>
                    <td style="width:25%;font-size:10px; padding-left:10px;" align="justify" > PO NO. </td>
                    <td style="width:5%;font-size:5px; padding-left:10px;" align="justify" > : </td>
                    <td style="width:30%;font-size:10px; padding-left:10px;" align="justify" > <?=$konval['no_po']?> </td>
                </tr>
                <tr>
                    <td style="width:25%;font-size:10px; padding-left:10px;" align="justify" > DELIVERY DATE </td>
                    <td style="width:5%;font-size:5px; padding-left:10px;" align="justify" > : </td>
                    <td style="width:30%;font-size:10px; padding-left:10px;" align="justify" > <?=date("Y-m-d",strtotime($konval['deliverydate']))?> </td>
                </tr>
                <tr>
                    <td style="width:25%;font-size:10px; padding-left:10px;" align="justify" > PO EXP DATE </td>
                    <td style="width:5%;font-size:5px; padding-left:10px;" align="justify" > : </td>
                    <td style="width:30%;font-size:10px; padding-left:10px;" align="justify" > <?=$konval['duedate']?> </td>
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
        	<?=$konval['nama_supp']?><br>
            <?=$konval['nama_usaha']?><br>
            <?=$konval['alamat_usaha']?><br>
            
        </td>
        <td style="width:25%;font-size:10px; padding-left:10px; padding-top:10px;" align="justify" class="td2">&nbsp;</td>
        <td style="width:25%;font-size:10px; padding-left:10px; padding-top:30px;" align="justify" class="td2">
        	PT. TAURUS GEMILANG<br>
			<?=$konval['nama_gudang']?><br>
            <?=$konval['alamat']?><br>
        </td>
    </tr>
</table>

<!--<table cellpadding="0" cellspacing="0" style="width:98%;">
    <tr>
        <td class="td2" align="left" style="font-size:11px;">
          <p>Kepada Yth. <br>
          <?=$konval['nama_usaha']?>
         <br> <?=$konval['alamat_usaha']?></p>
         <p>Dengan Hormat,
         <br> Bersama ini kami sampaikan order untuk produk <?=$konval['nama_usaha']?> dengan spesifikasi sbb :</p>
          <p>
            Tanggal :<b> <?=$konval['tgl_po']?>
              </b>
            <br>
            Tujuan :<b> <?=$konval['nama_gudang']?>
              </b>
            <br>Kode Shipto :<b> <?=$konval['shipto_code']?>
              </b>
           
            <br>
          </p>
          
        </td>
    </tr>
</table>--><br>
<table cellpadding="0" cellspacing="0" border="1" style="width:98%;">
<?php 
$kj=$db->select("tx_prp_dtl","*","no_prp='$konval[no_prp]'");
foreach($kj as $kajo){}
$k=explode("-",$kajo['tgl_kirim']);

$epx=explode("-",$konval['tgl_po']);

$jum=$db->jumlah_hari($epx[1],$epx[0]);


$query=$db->select("m_tahap","id_tahap,nama_tahap,tgl_awal,tgl_akhir","");
											foreach($query as $sel){}

?>
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center" rowspan="2"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Satuan</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Tanggal</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Qty Order</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Bonus</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Harga</b></td>
    <td style="width:8%;font-size:10px;text-align:center" colspan="2"><b>Disc</b></td>
    <td style="width:10%;font-size:10px;text-align:center" rowspan="2"><b>Jumlah</b></td>
  </tr>
  <tr>
  <td style="width:5%;font-size:10px;text-align:center"><b>%</b></td>
  <td style="width:10%;font-size:10px;text-align:center"><b>$</b></td>
  </tr>
  <?php  
   
$kon=$db->select("tx_prp_dtl a join m_barang b on a.id_barang=b.id_barang join m_satuan c on a.sat=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_prp='$konval[no_prp]'");	
$no=1;
$tot=0;
$habel=0;
$sub=0;
$grand=0;
foreach($kon as $d){  
$habel=$d['harga_beli']*$d['disc_persen']/100;
$habel=$d['harga_beli']-$habel;
$sub=$habel*$d['qty']*$kursval['kurs'];
$grand=$grand+$sub;
?>			
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:20%;font-size:11px;text-align:left"><?=$d['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$d['nama_satuan']?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=$d['tgl_kirim']?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=$d['qty']?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($d['bonus'])?></td>
    <td style="width:10%;font-size:11px;text-align:right"><?=number_format($d['harga_beli'],2)?></td>
    <td style="width:5%;font-size:11px;text-align:right"><?=number_format($d['disc_persen'])?></td>
    <td style="width:5%;font-size:11px;text-align:right"><?=number_format($d['disc_rupiah'],0)?></td>
    <td style="width:15%;font-size:11px;text-align:right"><?=number_format($sub,2)?></td>
  </tr>
<?php $no++; 
$tot=$tot+$sub;
}
 ?>
<tr>
  <td colspan="9" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
  <td style="width:3%;font-size:11px;text-align:right"><b><?php echo number_format($tot,2)?></b></td>
</tr>
<tr>
  <td colspan="9" style="width:3%;font-size:11px;text-align:right"><b>Disc
      <?=$konval['disc_persen']?>
    %</b></td>
  <td style="width:3%;font-size:11px;text-align:right"><b><?php echo number_format($disc=$konval['disc_jumlah'],2);?></b></td>
</tr>
<tr>
  	<td colspan="9" style="width:3%;font-size:11px;text-align:right"><b>Grant</b></td>
    <td style="width:3%;font-size:11px;text-align:right"><b><?php echo number_format($grant=$tot-$disc,2);?></b></td>
</tr>
</table><br>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <!--<td colspan="3" class="td2">
                          <p>Cat :<br>
                            Dikirim Ke &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<b><?=$konval['nama_usaha']?></b><br>
                            Contact Person &nbsp;&nbsp;:<br>
                          	 Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<b> <?=$konval['tgl_po']?>
      </b><br>
                             Alamat Tagihan &nbsp;&nbsp;:<br>
                            </p>
                          <p>Demikian order ini kami ajukan, atas kerjasamanya kami sampaikan terima kasih.</p></td>-->
                          <td colspan="3" class="td2">
                                <table width="60%" border="1">
                                    <tr>
                                        <td style="width:70%;font-size:12px; padding-left:5px; padding-top:5px; padding-bottom:5px; background-color:#666; color:white;" align="center">KETERANGAN</td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%; height:10%; font-size:12px; padding-left:5px; padding-top:5px; padding-bottom:5px;" align="justify"><?=$valindo['ket']?></td>
                                    </tr>
                                </table> 
                          </td>
                        </tr>
                        <tr>
                          <td width="6%" class="td2">&nbsp;</td>
                          <td width="15%" class="td2">&nbsp;</td>
                          <td width="79%" align="right" class="td2">&nbsp;</td>
                        </tr>
</table><br>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                             <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Mengetahui,</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br> ------------------------</td>
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
                            <?php error_reporting(0)?>
                            <td width="19%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Hormat Kami,</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="200" align="center" class="td2"><br><br><?php 
										/*$ak=$db->cetak('10',$_SESSION['ID_CABANG']);
										echo $ak;*/
										?> ------------------------</td>
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
</body>
</html>