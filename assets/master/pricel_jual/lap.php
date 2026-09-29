<?php
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=master_pricel_jual.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");


if($_GET['aksi']=="xls")
{
	header("Content-Type: application/vnd.ms-excel");
	
	}

?>


  	     <div class="col-lg-12">
		  <div class="panel panel-flat">
<div class="table-responsive pre-scrollable">
  <table id="example4" class="table  table-bordered table-striped table-hover dataTable no-footer " >
                  <thead>
                           
                            <tr>
                            		<th width="5%">No</th>
                                <th width="60%">Kode Barang</th>
                                <th width="60%">Nama Barang</th>
                                <th width="5%">Satuan</th>
                                <th width="5%">Hpp</th>
                                <th width="5%">Harga Retail</th>
                                <th width="5%">Cetak Retail</th>                                
                                <th width="5%">Harga Grosir</th>
                                <th width="5%">Cetak Grosir</th>
                            </tr>
    </thead>
                        <?php
						// $tgllan=date("y-m-d",strtotime($_GET['tg']));
						
						// if($_GET['gud']=='all'){
						// 	$guda=" and a.tipe=1";
						// }else{
						// 	$guda=" and a.id_gudang='$_GET[gud]' and a.tipe=1";
						// }
						
						//$table = 'v_barang';
						//$where2="kode_barang!=''";

            $row=$db->select("v_price_jual a join m_satuan b on a.id_satuan=b.id_satuan","a.*,b.nama_satuan","id_cabang='$_GET[cab]'","kode_barang");
            $no = 1;
						foreach($row as $arrdt){
						$exphpp = explode('-',$arrdt['hpp']);
            $hpp = number_format($exphpp[0]);
            $expharet = explode('-',$arrdt['harga_retail']);
            $harga_retail = number_format($expharet[0]);
            $cetak_retail = number_format($expharet[1]);
            $exphagros = explode('-',$arrdt['harga_retail']);
            $harga_grosir = number_format($exphagros[0]);
            $cetak_grosir = number_format($exphagros[1]);
						?>
                     
                      <tr>
                      				<th><?=$no;?></th>
                              <th align="left"><?php echo $arrdt['kode_barang']?></th>
                              <th align="left"><?php echo $arrdt['nama_barang']?></th>
                              <th align="left"><?php echo $arrdt['nama_satuan']?></th>
                              <th align="left"><?php echo $hpp?></th>
                              <th align="left"><?php echo $harga_retail?></th>
                              <th align="left"><?php echo $cetak_retail?></th>
                              <th align="left"><?php echo $harga_grosir?></th>
                              <th align="left"><?php echo $cetak_grosir?></th>
                      </tr>
            <?php 
								$no ++;
							}
							
						?>
                         <!--    <tr>
                          <th colspan="6" align="center">Total</th>
                          <th><?=$tawal?></th>
                          <th><?=$tmasuk?></th>
                          <th><?=$tkeluar?></th>
                          <th><?=$takhir?></th>
                          <th align="right"><?=number_format($nnhpp,2)?></th>
                          <th align="right"><?=number_format($nnawal,2)?></th>
                          <th align="right"><?=number_format($nnmasuk,2)?></th>
                          <th align="right"><?=number_format($nnkeluar,2)?></th>
                          <th align="right"><?=number_format($nnakhir,2)?></th>
                      </tr> -->
           	</table>
          </div>
       <script>
	   window.close();
	   </script>   