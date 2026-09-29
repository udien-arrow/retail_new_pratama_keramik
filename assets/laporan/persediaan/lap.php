<?php
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=laporan_persediaan_barang.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");


if($_GET['aks']=="xls")
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
                              <th width="10%">Cabang</th>
                                <th width="10%">Kode </th>
                              	<th width="50%">Nama Barang</th>
                                <th width="15%">Satuan</th>
                                <th width="10%">Min</th>
                                <th width="10%">Max</th>
                                <th width="15%">Awal</th>
                                <th width="15%">Masuk</th>
                                <th width="15%">Keluar</th>  
                                <th width="15%">Akhir</th>
                                <th width="5%">Hpp</th>
                                <th width="5%">Rupiah Awal</th>
                                <th width="5%">Rupiah Masuk</th>
                                <th width="5%">Rupiah Keluar</th>
                                <th width="5%">Rupiah Akhir</th>
                              <!-- <th width="5%">ITO</th>
                                <th width="5%">AIP</th>-->
                            </tr>
    </thead>
                        <?php
						$tgllan=date("y-m-d",strtotime($_GET['tg']));
						
						if($_GET['gud']=='all'){
							$guda=" and a.tipe=1";
						}else{
							$guda=" and a.id_gudang='$_GET[gud]' and a.tipe=1";
						}
						
                        $row=$db->select("m_barang_gudang a 
left join m_satuan d on a.id_satuan=d.id_satuan
left join m_cabang h on a.id_cabang=h.id_cabang
LEFT JOIN m_gudang zz on a.id_gudang=zz.id_gudang
left join tx_mutasi b on a.id_gudang=b.id_gudang and a.id_barang=b.id_barang and b.id_mutasi=
( SELECT c.id_mutasi 
         FROM tx_mutasi c 
         WHERE c.id_barang = a.id_barang and c.id_gudang = a.id_gudang
         and date(c.tgl_mutasi)<='$tgllan'
		 ORDER BY c.id_mutasi DESC
         LIMIT 0,1
       )","a.*,
concat(IFnull(b.awal,0),'_',ifnull(b.masuk,0),'_',ifnull(b.keluar,0),'_',ifnull(b.akhir,0),'_',ifnull(b.hpp,0)) as persediaan,ifnull(b.hpp,0) as hpp_mutasi,d.nama_satuan,h.nama_cabang,zz.nama_gudang","a.status=1 $guda GROUP BY a.id_gudang,a.id_barang");
						foreach($row as $arrdt){
						foreach($db->select("tx_mutasi","ifnull(awal,0)as awal,ifnull(sum(masuk),0)as masuk,ifnull(sum(keluar),0)as keluar","id_gudang='$arrdt[id_gudang]' and id_barang='$arrdt[id_barang]' and date(tgl_mutasi)<='$tgllan'")as $dts);
						
						$per=explode("_",$arrdt['persediaan']);
						
						$awal=$dts['awal'];
						$masuk=$dts['masuk'];
						$keluar=$dts['keluar'];
						$akhir=$dts['awal']+$dts['masuk']-$dts['keluar'];
						
						if($akhir==0){
							$awal=$per[0];
							$masuk=$per[1];
							$keluar=$per[2];
							$akhir=$per[3];	
						}else{
							$awal=$dts['awal'];
							$masuk=$dts['masuk'];
							$keluar=$dts['keluar'];
							$akhir=$dts['awal']+$dts['masuk']-$dts['keluar'];	
						}
						
						$hpp=$per[4];
						$nawal=$awal*$per[4];
						$nasuk=$masuk*$per[4];
						$nakel=$keluar*$per[4];
						$pers=($awal+$masuk-$keluar)*$per[4];
						
						?>
                        
                      
                      <tr>
                              <th align="left"><?php echo $arrdt['nama_gudang']?></th>
                              <th align="left"><?php echo $arrdt['kode_barang']?></th>
                              <th align="left"><?php echo $arrdt['nama_barang']?></th>
                              <th align="left"><?php echo $arrdt['nama_satuan']?></th>
                              <th align="left"><?php echo $arrdt['min']?></th>
                              <th align="left"><?php echo $arrdt['max']?></th>
                              <th><?php echo $awal?></th>
                              <th><?php echo $masuk?></th>
                              <th><?php echo $keluar?></th>
                              <th><?php echo number_format($akhir,2)?></th>
                              <th align="right"><?php echo $hpp?></th>
                              <th align="right"><?php echo number_format($nawal,2)?></th>
                              <th align="right"><?php echo number_format($nasuk,2)?></th>
                              <th align="right"><?php echo number_format($nakel,2)?></th>
                        <th align="right"><?php echo number_format($pers,2)?></th>
                        <!--<th align="right">&nbsp;</th>
                        <th align="right">&nbsp;</th>-->
                      </tr>
                            <?php 
								$tawal+=$awal;
								$tmasuk+=$masuk;
								$tkeluar+=$keluar;
								$takhir+=$akhir;
								
								$nnhpp+=$nhpp;
								$nnawal+=$nawal;
								$nnmasuk+=$nasuk;
								$nnkeluar+=$nakel;
								$nnakhir+=$pers;
							}
							
							?>
                            <tr>
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
                      </tr>
           	</table>
          </div>
       <script>
	   window.close();
	   </script>   