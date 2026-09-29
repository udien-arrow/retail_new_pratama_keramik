<?php
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=laporan_detil_penjualan.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");


if($_GET['aks']=="xls")
{
	header("Content-Type: application/vnd.ms-excel");
	
	}
?>
<?php 
						  $a=explode('/',$_GET['a']);
						  $gg=$a[2]."-".$a[0]."-".$a[1];
						  $b=explode("/",$_GET['b']);
						  $wp=$b[2]."-".$b[0]."-".$b[1];
							?>

<table id="example5" class="tableku  " >
                        <thead>
                            <tr>
                              <th colspan="16" style="text-align:center" ><h5>LAPORAN DETIL PENJUALAN CABANG 
                              <?php foreach($db->select("m_cabang","nama_cabang","id_cabang='$_GET[cab]'")as $cb); echo $cb['nama_cabang'];?><br>PERIODE <?php echo "$_GET[a] s/d $_GET[b]"; ?></h5></th>
                            </tr>
                            
                            <tr height="30px" bgcolor="#EFEFEF">
                                <th width="10%">Customer</th>
                                <th width="10%">Cabang</th>
                                <th width="5%">Sales</th>
                                <th width="5%">#</th>
                              	<th width="10%">No SPJ</th>
                                <th width="10%">Nopol</th>
                                <th width="10%">Tanggal SPJ</th>
                                <th width="10%">No Ref</th>
                                <th width="15%">Nama Barang</th>
                                <th width="5%">Jenis</th>
                                <th width="5%">Qty</th>
                                <th width="5%">Harga</th>
                                <th width="5%">Jumlah</th>
                                <th width="5%">DPP</th>  
                                <th width="5%">HPP</th>  
                                <th width="5%">NIHPP</th>  
                          </tr> 
                      </thead>
                      <?php
                      $table="tx_do_dtl a
JOIN tx_do b ON a.no_spj = b.no_spj
JOIN m_customer c on b.id_cus=c.id_cus 
JOIN m_barang d on a.id_barang=d.id_barang 
LEFT JOIN (select id_cus,max(tgl_berlaku)as tgl_berlaku,id_cro from m_customer_cro GROUP BY id_cus) e on b.id_cus=e.id_cus and b.tgl_spj>=e.tgl_berlaku
LEFT JOIN m_pegawai f on e.id_cro=f.id_pegawai
LEFT JOIN tx_sales_biaya_dtl g on b.no_ref=g.no_so 
LEFT JOIN m_cabang h on b.id_cabang=h.id_cabang ";
					  $isi="b.id_spj,b.id_cabang,b.id_gudang,b.no_ref,a.id_barang,
	c.nama_usaha,
	b.id_cus,
	b.no_spj,
	b.jenis_kirim,
	b.tgl_spj,
	d.nama_barang,
	a.qty,
	a.harga,
	a.hpp_akhir,
	a.qty * a.harga AS total,b.jenis_jual,
	concat(a.id_spj,'_',a.qty * a.harga)as gab,
	IFNULL(e.id_cro,'')as id_cro,IFNULL(f.nama_pegawai,'')as nama_pegawai,
	ifnull(g.nopol,'') as nopol,
	nama_cabang";
				if($_GET['cab']=='A'){
					$cab="";
				}else{
					$cab="b.id_cabang='$_GET[cab]' AND";
				}
				if($_GET['jenju']=='A'){
					$jenju="";
				}else{
					$jenju="and jenis_jual='$_GET[jenju]'";
				}
				$tgl=date("Y-m-d",strtotime($_GET['a']));
				$tglsd=date("Y-m-d",strtotime($_GET['b']));
				
				$where="$cab date(b.tgl_spj) BETWEEN '$tgl' AND '$tglsd' $jenju";
				$haha=$db->select($table,$isi,$where);
				foreach($haha as $dta){
					  ?>
                      <tr>
                              <th><?php echo $dta['nama_usaha']?></th>
                              <th><?php echo $dta['nama_cabang']?></th>
                              <th><?php echo $dta['nama_pegawai']?></th>
                              <th><?php echo $dta['jenis_kirim']?></th>
                              <th><?php echo $dta['no_spj']?></th>
                              <th><?php echo $dta['nopol']?></th>
                              <th><?php echo $dta['tgl_spj']?></th>
                              <th><?php echo $dta['no_ref']?></th>
                              <th><?php echo $dta['nama_barang']?></th>
                              <th><?php 
							  if($dta['jenis_jual']=="1"){
								$a="Semen";	
								}else{
								$a="Non Semen";	
								}
							  	echo $a?></th>
                              <th><?php echo $dta['qty']?></th>
                              <th><?php echo $dta['harga']?></th>
                              <th><?php 
							 	 $a=explode('_',$dta['gab']);
								 $s=number_format($a[1],2);
							 		 echo $s?></th>
                              <th><?php echo number_format($jdp=($dta['qty']*$dta['harga'])/1.1,2);?></th>
                              <th><?php echo number_format($dta['hpp_akhir'],2);?></th>
                              <th><?php echo number_format($dta['qty']*$dta['hpp_akhir'],2)?></th>
                            </tr>
                       <?php 
					   $jumi=$jumi+$a[1];
					   $jumd=$jumd+$jdp;
					   }?> 
                      <tfoot>
                       <tr>
                              <th colspan="12">Total</th>
                              <th><?php echo number_format($jumi,2)?></th>
                              <th><?php echo number_format($jumd,2)?></th>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                            </tr>
                      </tfoot>
                       </table>
	   <script>
	   window.close();
	   </script>   