<?php 
session_start ();
require( 'webclass.php' );
$db=new kelas;
error_reporting(0);
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
		border-top: 0px;
		border-left: 0px;
		border-right: 0px;	
	}
.kop{
	border: 0px;
}
</style>
<table cellpadding="0" cellspacing="0" style="width:120%;">
                        <thead>
                            <tr>
                            	<?php
								$bln = '';
								switch ($_GET['bul']){
								case 1 :$bln = 'Januari'; break;
								case 2 :$bln = 'Februari';break;
								case 3 :$bln = 'Maret'; break;
								case 4 :$bln = 'April';break;
								case 5 :$bln = 'Mei';break;
								case 6 : $bln = 'Juni';break;
								case 7 : $bln = 'Juli';break;
								case 8 : $bln = 'Agustus';break;
								case 9 : $bln = 'September';break;
								case 10 : $bln = 'Oktober';break;
								case 11 : $bln = 'November';break;
								case 12 : $bln = 'Desember';	break;
								}
								?>
                              <th colspan="11" style="text-align:center" ><h5>LAPORAN POIN PELANGGAN <br>Periode <?php echo "$bln  $_GET[tah]"; ?></h5></th>
                            </tr>
                            <tr bgcolor="#EFEFEF">
                                <th width="5%" >No </th>
                                <th width="10" >Kode Ship To</th>
                              	<th width="25%">Nama Pelanggan</th>
                                <th width="30%">Alamat</th>
                                <th width="10%">Telp</th>
                                <th width="20%">Total</th> 
                          </tr> 
                      </thead>
 <?php
		$kon=$db->select("pj_penjualan_dtl a inner join 
		pj_penjualan b inner join  
		m_customer c inner JOIN
		m_customer_shipto d
		on 
		a.id_pj = b.id_pj AND
		b.id_customer = c.id_cus AND
		b.id_customer = d.id_cus", "d.shipto_code,c.nama_usaha,c.alamat_usaha,c.no_telp_usaha,sum(a.qty_jual) as total_jual", 
		"a.id_barang = '$_GET[bar]' and YEAR(b.tgl_penjualan) = '$_GET[tah]' and month(b.tgl_penjualan) = '$_GET[bul]'
		and b.id_customer like '$_GET[cus]'
		GROUP BY c.nama_usaha order by total_jual desc");
        $no=1; 
        foreach($kon as $d){
		$total=$total+$d['total_jual']; 
		?>
         <tr>
         <td  align = "right" ><?php echo $no;?></td>
         <td ><?=$d['shipto_code']?></td>
 	      <td><?=$d['nama_usaha']?></td> 
 	      <td><?=$d['alamat_usaha']?></td> 
 	      <td><?=$d['no_telp_usaha']?></td>           
          <td align="right"><?=number_format($d['total_jual'])?></td>
         </tr> 
		<?php $no++ ;} ?>     
                      <tfoot>
                      <tr >
                             <td bgcolor="#EFEFEF" colspan="5" align="center">Total Penjualan</td>
                             <td align="right">
                              <?=number_format($total)?>
                              </td>
                           </tr>
                      </tfoot>
 
</table>