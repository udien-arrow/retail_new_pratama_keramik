<?php
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=laporan_mutasi_barang.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");


if($_GET['aks']=="xls")
{
	header("Content-Type: application/vnd.ms-excel");
	
	}

?>


  	     <table id="example" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th colspan="9">
                              
                             </th>
                            </tr>
                           
                            <tr>
                                <th width="20%">Jenis Mutasi </th>
                              	<th width="20%">No Ref 1</th>
                              	<th width="20%">No Ref 2</th>
                              	<th width="20%">Referensi</th>
                                <th width="20%">Tanggal Mutasi</th>
                                <th width="10%">Awal</th>
                                <th width="10%">Masuk</th>  
                                <th width="10%">Keluar</th>
                                <th width="10%">Akhir</th>
                                <th width="10%">Hpp</th>
                                                              
                                
                            </tr>
                        </thead>
                        <?php
	$tg=date("Y-m-d H:i:s",strtotime($_GET['tg']." 00:00:00"));
	$tgsd=date("Y-m-d H:i:s",strtotime($_GET['tgsd']." 23:59:00"));
	$table = "tx_mutasi a";
	$isi = "a.*,
	case 
		when (a.jenis_mutasi=0 and substr(no_ref,1,2)='IK') then (select concat(c.id_gudang,' : ',c.nama_gudang,' : ',b.no_masuk) from tx_brg_masuk b join m_gudang c on b.id_gudang=c.id_gudang where b.no_ref=a.no_ref)
		when (a.jenis_mutasi=0 and substr(no_ref,1,2)<>'IK') then (select concat(c.kode_supp,' : ',c.nama_usaha,' : ',b.no_masuk) from tx_brg_masuk b join m_supplier c on b.id_supp=c.id_supp where b.no_ref=a.no_ref)
		when a.jenis_mutasi=1 then (select concat(c.id_gudang,' : ',c.nama_gudang,' : ',b.no_keluar) from tx_brg_keluar b join m_gudang c on b.id_gudang=c.id_gudang where b.no_ref=a.no_ref)
		when a.jenis_mutasi=10 then (select concat(c.nama_usaha,' : ',date(b.tgl_retur),' : ',b.no_ref) from tx_retur_pem b join m_supplier c on b.kpd_id_supp=c.id_supp where b.no_retur=a.no_ref)
		when a.jenis_mutasi=11 then (select concat(c.kode_cus,' : ',c.nama_usaha,' : ',b.no_ref) from tx_do b join m_customer c on b.id_cus=c.id_cus where b.no_spj=a.no_ref)
		when a.jenis_mutasi=12 then (select concat(c.kode_cus,' : ',c.nama_usaha,' : ',b.no_ref) from tx_retur_pen b join m_customer c on b.id_cus=c.id_cus where b.no_retur=a.no_ref)
	end as referensi
	
	";
	$where2="a.id_gudang='$_GET[gud]' and a.id_barang='$_GET[id]' and a.tgl_mutasi between '$tg' and '$tgsd' order by a.tgl_mutasi asc";
	$haha=$db->select($table,$isi,$where2);
	foreach($haha as $arhaha){
						  
						  if($arhaha['referensi']=='' && $arhaha['jenis_mutasi']==0){
							 	foreach($db->select("tx_rilis_dtl a 
								JOIN tx_so b ON a.no_so = b.sales_order
								LEFT JOIN tx_brg_masuk d ON a.no_spj= d.surat_jalan
JOIN m_supplier c ON b.id_supp = c.id_supp","a.tgl_spj, c.nama_usaha,c.kode_supp,d.no_masuk","a.no_spj='$arhaha[no_ref]'")as $spj);
								
								$ref=$spj['kode_supp'].' : '.$spj['nama_usaha'].' : '.$spj['no_masuk']; 
								$xp=explode(" : ",$ref);
						   }else{
								$xp=explode(" : ",$arhaha['referensi']);
						   }
						   
		
								$ref=$xp[0].' : '.$xp[1];
						   		
						?>
                         <tr>
                           <th><?php
                                if($arhaha['jenis_mutasi']==0){
									$mutasi="Barang Masuk";
								}elseif($arhaha['jenis_mutasi']==1){
									$mutasi="Barang Keluar";
								}elseif($arhaha['jenis_mutasi']==10){
									$mutasi="Retur Pembelian";
								}elseif($arhaha['jenis_mutasi']==11){
									$mutasi="Delivery Order";			
								}elseif($arhaha['jenis_mutasi']==12){
									$mutasi="Retur Jual";			
								}
								echo $mutasi;
							  ?></th>
                           <th><?=$arhaha['no_ref']?></th>
                           <th align="left"><?=$xp[2]?></th>
                           <th align="left"><?php
                           		echo $ref;
						   ?></th>
                              <th><?=$arhaha['tgl_mutasi']?></th>
                              <th><?=$arhaha['awal']?></th>
                              <th><?=$arhaha['masuk']?></th>
                              <th><?=$arhaha['keluar']?></th>
                              <th><?=$arhaha['akhir']?></th>
                              <th><?=$arhaha['hpp']?></th>
                      </tr>
                            <?php }?>
                    </table>
          </div>
       <script>
	  window.close();
	   </script>   