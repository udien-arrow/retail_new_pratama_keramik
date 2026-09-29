<?php 
session_start ();
error_reporting(0);
include( '../../../webclass.php' );
$db=new kelas;

//kita akan menambahkan script export di sini
header("content-type:application/vnd-ms-exel;base64,");
//membuat file excel
header("content-disposition:attachment;filename= Laporan-penjualan.xls");
//membuat nama file

?>
<table class="table" >
                            <tr>
                              <th colspan="11" style="text-align:center" ><h3>LAPORAN PENJUALAN <br>PERIODE <?php echo "$_GET[a] s/d $_GET[b]"; ?></h3></th>
                            </tr>
                            <tr bgcolor="#EFEFEF">
                                <th width="10%" >Tgl penjualan </th>
                                <th width="10%" >No Dokumen</th>
                                <th width="7%">Nama Toko</th>
                                <th width="9%">Alamat Toko</th>
                                <th width="9%">Nama Barang</th> 
                                <th width="6%">Qty</th>
                                <th width="7%">Harga</th>
                                <th width="10%">Total</th>
                                <th width="10%">Nama Sales</th>
                                <th width="13%">DPP</th> 
                                <th width="9%">PPN Keluaran</th> 
                          </tr> 
 <?php
if($_GET['a']!=''){
 if($_GET['jenis']=='1'){
 if($_GET['barang'] =='0'){	
 $where2="date(tgl_penjualan) BETWEEN '$_GET[a]' AND '$_GET[b]'"; 
}
else{
$where2="date(tgl_penjualan) BETWEEN '$_GET[a]' AND '$_GET[b]' and id_barang='$_GET[barang]'";	
	
	}
}
else if($_GET['jenis']=='2'){
if($_GET['toko'] =='0'){	
 $where2="date(tgl_penjualan) BETWEEN '$_GET[a]' AND '$_GET[b]'"; 
}
else{	
$where2="date(tgl_penjualan) BETWEEN '$_GET[a]' AND '$_GET[b]' and id_customer='$_GET[toko]'";
}
}



		$kon=$db->select("v_penjualan_dtl", "*", $where2);
        $no=1; 
        foreach($kon as $d){
		$total= $total + $d['dtl_total'];	
		$dpp= $d['dtl_total']*1.1;
		$ppn= $d['dtl_total']*10/100; 
		?>
         <tr>
         <td width="10%" align="left" ><?php echo ucfirst(strtolower($d['tgl_penjualan']));?></td>
         <td width="10%" align="left" ><?php echo ucfirst(strtolower($d['no_penjualan']));?></td>
         <td width="7%" align="center"><?=$d['nama_cus']?></td>
         <td width="9%"><?=$d['alamat_usaha']?></td> 
         <td width="9%" align="center"><?=$d['nama_barang']?></td>
         <td width="6%" align="center"><?=$d['qty_jual']?></td>
          <td width="7%" align="right"><?=number_format($d['harga_jual'])?></td>
         <td width="10%" align="right"><?=number_format($d['dtl_total'])?></td>
          <td width="10%" align="center" >&nbsp;</td>
          <td width="13%" align="right" ><?=number_format($dpp)?></td>
          <td width="9%" align="right" ><?=number_format($ppn)?></td> 
         </tr> 
<?php }} ?>     
                      <tfoot>
                      <tr >
                             <td bgcolor="#EFEFEF" colspan="9" align="center">Total Penjualan</td>
                             <td width="13%" align="right">
                              <?=number_format($total)?>
                              </td>
<td bgcolor="#EFEFEF" colspan="1" align="center"></td>
                           </tr>
                      </tfoot>
 
                       </table> 