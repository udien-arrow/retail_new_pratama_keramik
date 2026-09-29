<?php
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=master_barang.xls");//ganti nama sesuai keperluan
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
                            		<th width="3%">No </th>
                              	<th width="10%">Kode </th>
                              	<th width="20%">Nama Barang</th>
                                <th width="10%">Satuan</th>
                                <th width="5%">Gol</th>
                                <th width="5%">Sub Gol</th>
                                <th width="5%">Kategori</th>
                                <th width="10%">Tipe</th>
                                <th width="10%">Kode Barang Supplier</th>
                                <th width="5%">Status</th>
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

            $row=$db->select("v_barang","*","kode_barang != ''","kode_barang");
            $no = 1;
						foreach($row as $arrdt){
						
						?>
                     
                      <tr>
                      				<th><?=$no;?></th>
                              <th align="left"><?php echo $arrdt['kode_barang']?></th>
                              <th align="left"><?php echo $arrdt['nama_barang']?></th>
                              <th align="left"><?php echo $arrdt['nama_satuan']?></th>
                              <th align="left"><?php echo $arrdt['nama_dep']?></th>
                              <th align="left"><?php echo $arrdt['nama_sub']?></th>
                              <th align="left"><?php echo $arrdt['nama_kat']?></th>
                              <th><?php if($arrdt['nama_kat'] == 1){echo 'Barang Dagang';}else{echo 'Non Dagang';} ?></th>
				<th align="left"><?php echo $arrdt['kode_barang_semen']?></th>
                              <th><?php if($arrdt['status'] == 0){echo 'Tidak Aktif';}else{echo 'Aktif';} ?></th>
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