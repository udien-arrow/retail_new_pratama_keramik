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
	
					$supp=$db->select("tx_usage_dtl a
										JOIN tx_usage b ON a.id_usage = b.id_usage
										JOIN m_barang c ON a.id_barang = c.id_barang
										JOIN m_satuan e ON c.id_satuan = e.id_satuan
										JOIN m_cabang d ON b.id_cabang = d.id_cabang
										JOIN m_gudang f ON b.id_gudang = f.id_gudang",
										"a.id_usage AS id_usage,
										a.no_usage AS no_usage,
										d.nama_cabang AS nama_cabang,
										f.nama_gudang AS nama_gudang,
										b.tgl_input AS tgl_input,
										c.nama_barang AS nama_barang,
										e.nama_satuan AS nama_satuan,
										a.qty_awal AS qty_awal,
										a.qty_masuk AS qty_masuk,
										a.qty_keluar AS qty_keluar,
										a.qty_waste AS qty_waste,
										a.qty_sisa AS qty_sisa","a.no_usage='$_GET[id]'");
					foreach($supp as $valsupp){}
					?>
<!--<table cellpadding="0" cellspacing="0" style="width:100%;">
    <tr>
        <td style="14%"><img src="assets/images/photo_c.jpg" style="height:80px; width:80px" ></td>
        <td style="width:86%;font-size:15px;" align="center" class="td2"><b>BUKTI PENGGUNAAN BARANG</b><br/><br/><?=$valsupp['no_usage']?></td>
    </tr>
</table><br>-->
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
        <td colspan="2" style="width:98%;font-size:15px; padding-top:30px;" align="center" class="td2"><b>BUKTI PENGGUNAAN BARANG</b><br/><br/><?=$valsupp['no_usage']?></td>
    </tr>
</table><br>

<table cellpadding="0" cellspacing="0" style="width:100%;">
    <tr>
     
        <td class="td2" align="left" style="font-size:11px;">
          <br>Nama Cabang :<b> <?=$valsupp['nama_cabang']?></b>
          <br>Nama Unit :<b> <?=$valsupp['nama_gudang']?></b>  
          <br>Tanggal :<b> <?=$valsupp['tgl_input']?></b>
        </td>
    </tr>
</table>

<table cellpadding="0" cellspacing="0" style="width:100%;" border="1">
      <tr>
        <td style="width:5%;font-size:10px;text-align:center"><b>No</b></td>
        <td style="width:30%;font-size:10px;text-align:center"><b>Nama Barang</b></td>
        <td style="width:15%;font-size:10px;text-align:center"><b>Satuan</b></td>
        <td style="width:10%;font-size:10px;text-align:center"><b>Total Penerimaan Barang</b></td>
        <td style="width:10%;font-size:10px;text-align:center"><b>Sisa</b></td>
        <td style="width:10%;font-size:10px;text-align:center"><b>Waste</b></td>
        <td style="width:10%;font-size:10px;text-align:center"><b>Terpakai</b></td>
      </tr>
 <?php 
								$supp=$db->select("tx_usage_dtl a
													JOIN tx_usage b ON a.id_usage = b.id_usage
													JOIN m_barang c ON a.id_barang = c.id_barang
													JOIN m_satuan e ON c.id_satuan = e.id_satuan
													JOIN m_cabang d ON b.id_cabang = d.id_cabang
													JOIN m_gudang f ON b.id_gudang = f.id_gudang",
													"a.id_usage AS id_usage,
													a.no_usage AS no_usage,
													d.nama_cabang AS nama_cabang,
													f.nama_gudang AS nama_gudang,
													b.tgl_input AS tgl_input,
													c.nama_barang AS nama_barang,
													e.nama_satuan AS nama_satuan,
													a.qty_awal AS qty_awal,
													a.qty_masuk AS qty_masuk,
													a.qty_keluar AS qty_keluar,
													a.qty_waste AS qty_waste,
													a.qty_sisa AS qty_sisa","a.no_usage='$_GET[id]'");
							  $no=1;
							  $tot=0;
							  $tot1=0;
							  $tot2=0;
							  $tot3=0;
							  foreach($supp as $valsupp){
							  $tot=$tot+$valsupp['qty_masuk'];
							  $tot1=$tot1+$valsupp['qty_sisa'];
							  $tot2=$tot2+$valsupp['qty_waste'];
							  $tot3=$tot3+$valsupp['qty_keluar'];
								?>
      <tr>
        <td style="font-size:11px;text-align:center"><?=$no?></td>
        <!--<td style="width:60%;font-size:11px;text-align:left"><?=$valsupp['kode_barang']."-".$valsupp['nama_barang']?></td>-->
        <td style="font-size:11px;text-align:left"><?=$valsupp['nama_barang']?></td>
        <td style="font-size:11px;text-align:center"><?=$valsupp['nama_satuan']?></td>
        <td style="font-size:11px;text-align:center"><?=number_format($valsupp['qty_masuk'])?></td>
        <td style="font-size:11px;text-align:center"><?=number_format($valsupp['qty_sisa'])?></td>
        <td style="font-size:11px;text-align:center"><?=number_format($valsupp['qty_waste'])?></td>
        <td style="font-size:11px;text-align:center"><?=number_format($valsupp['qty_keluar'])?></td>
      </tr>
<?php } ?>
    <tr>
        <td colspan="3" style="font-size:11px;text-align:right"><b>Total</b></td>
        <td style="font-size:11px;text-align:center"><?=number_format($tot)?></td>
        <td style="font-size:11px;text-align:center"><?=number_format($tot1)?></td>
        <td style="font-size:11px;text-align:center"><?=number_format($tot2)?></td>
        <td style="font-size:11px;text-align:center"><?=number_format($tot3)?></td>
    </tr>
</table>
<br />
<!--<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td colspan="3" class="td2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="6%" class="td2">&nbsp;</td>
                          <td width="15%" class="td2">&nbsp;</td>
                          <td width="79%" align="right" class="td2">&nbsp;</td>
                        </tr>
</table>-->

<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            
                            <td width="25%" class="td2">
                                <table width="70%" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2"></td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="25%" class="td2">
                                <table width="150" border="0" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td align="center" class="td2">Admin Gudang</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td2"><br><br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="td3"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="25%" class="td2">&nbsp;</td>
                            <td width="25%" class="td2">&nbsp;</td>
                        </tr>
</table>