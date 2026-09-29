<?php 
require( 'webclass.php' );
$db=new kelas;
session_start();
?>
<style>
table {
		  border-collapse: collapse;
	  }
.table, .td,.th {
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
					$supp=$db->select("v_order","*","no_order='$_GET[id]'");
					foreach($supp as $valsupp){}
?>
<?php
					$gud=$db->select("m_gudang","*","id_gudang='$_SESSION[ID_GUDANG]'");
					foreach($gud as $gu){}
					?>
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
        <td colspan="2" style="width:98%;font-size:15px; padding-top:30px;" align="center" class="td2"><b>REQUEST ORDER</b><br/><br/><?=$valsupp['no_order']?></td>
    </tr>
</table><br>

<table cellpadding="0"  cellspacing="0" style="width:98%;">
<tr>
<tr>
          <td colspan="3"style="width:80%;">Dari : <?=$valsupp['nama_gudang']?></td>
    <td>&nbsp;</td>
          <td>Tanggal :<?=$valsupp['tgl']?></td>
          
  </tr>
  <tr>
          <td colspan="3">ke&nbsp;&nbsp;&nbsp; : <span style="width:80%;">Purchasing
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

<table cellpadding="0" cellspacing="0" border="1" style="width:98%;">
  <tr>
  	<td style="width:3%;font-size:10px;text-align:center"><b>No</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Satuan</b></td>
    <td style="width:10%;font-size:10px;text-align:center"><b>Qty</b></td>
  </tr>
  <?php
                   
				   
$kon=$db->select("tx_order_dtl a 
			  join m_barang b on a.id_barang=b.id_barang
			  join m_satuan c on a.sat=c.id_satuan
			   ","*","a.no_order='$_GET[id]'");	
$no=1;
$tot=0;
foreach($kon as $d){  
$tot=$tot+$d['qty']?>			
  <tr>
  	<td style="width:3%;font-size:11px;text-align:center"><?=$no?></td>
    <td style="width:60%;font-size:11px;text-align:left"><?=$d['kode_barang']."-".$d['nama_barang']?></td>
    <td style="width:8%;font-size:11px;text-align:center"><?=$d['nama_satuan']?></td>
    <td style="width:20%;font-size:11px;text-align:center"><?=number_format($d['qty'])?></td>
  </tr>
<?php $no++;} ?>
<tr>
  	<td colspan="3" style="width:3%;font-size:11px;text-align:right"><b>Total</b></td>
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
                                        <td align="center" class="td2">Admin</td>
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