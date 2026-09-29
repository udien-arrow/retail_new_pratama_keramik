<?php
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=laporan_kartu_stok.xls");//ganti nama sesuai keperluan
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
<table id="example5" class="tableku datatable-basic " >
                        <thead>
                            <tr>
                              <th colspan="9" style="text-align:center" ><h5>LAPORAN DETIL PEMBAYARAN PIUTANG CABANG 
                              <?php foreach($db->select("m_cabang","nama_cabang","id_cabang='$_GET[cab]'")as $cb); echo $cb['nama_cabang'];?><br>
                              PERIODE <?php echo "$_GET[a] s/d $_GET[b]"; ?></h5></th>
                            </tr>
                            <tr height="30px" bgcolor="#EFEFEF">
                                <th width="20%">Cabang</th>
                                <th width="20%">Kode Customer</th>
                                <th width="10%">Customer</th>
                                <th width="5%">No Faktur</th>
                              	<th width="20%">No Tagihan</th>
                                <th width="10%">No Buku</th>
                                <th width="10%">Jenis Bayar</th> 
                                <th width="10%">Tanggal Bayar</th>
                                <th width="10%">Jumlah Bayar</th>
                          </tr> 
                      </thead>
                      <?php
						  $tgl=date("Y-m-d",strtotime($_GET['a']));
						  $tglsd=date("Y-m-d",strtotime($_GET['b']));
				
						if($_GET['cab']=='0' || $_GET['cab']=='99' || $_GET['cab']=='all'){
$where2="date(tgl_bayar) BETWEEN '$gg' AND '$wp'";
}else{
$where2="id_cabang='$_GET[cab]' AND date(tgl_bayar) BETWEEN '$gg' AND '$wp'";
}
                          $dbt=$db->select("v_dtl_bayar","*",$where2);
						  foreach($dbt as $asd){
						  ?>
                         
                          <tr>
                           <th><?=$asd['nama_cabang']?></th>
                              <th><?=$asd['kode_cus']?></th>
                             
                              <th><?=$asd['nama_usaha']?></th>
                              <th><?=$asd['no_faktur']?></th>
                              <th><?=$asd['no_tk']?></th>
                              <th><?=$asd['no_ref']?></th>
                               <th><?=$asd['jenis_pembayaran']?></th>
                                <th><?=$asd['tgl_dibayar']?></th>
                               <th><?=number_format($asd['total_dibayar'],2)?></th>
                            <?php 
							
							}?>
                   
                       </table>    
                     
  
            
   		  </div>
          

			
		</div>
       <script>
	   window.close();
	   </script>   