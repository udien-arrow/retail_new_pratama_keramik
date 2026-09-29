    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
	</style>
    <div class="col-lg-6">
		<form action="index.php?x=appbrgkel" id="form_index1" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Posting Barang Keluar</h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                            <tr>
                                <td width="15%">No</td>
                              	<td width="20%">Dari</td>
                                <td width="20%">Kepada</td>
                                <td width="10%">Tanggal</td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>

                    </table>   
                                    
		   			
           			
   		  </div>
			</form>
		</div>
        <form class="form-horizontal" action="index.php?x=appbrgkel" name="form_index" id="form_index" method="post">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
                    <input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
						<h5 class="panel-title">View Detil Posting  Barang</h5>
                         <?php if($_GET['id']==""){}else{ ?>
                        <!--<a href='javascript:void(0)' onClick="apptolak('<?=$_GET[id]?>')">
                        <input style="float:right;width:70px;" value="Tolak" class="btn btn-danger" readonly></a>	-->
                        
                        <a href='javascript:void(0)' onClick="appsetuju('<?=$_GET[id]?>')">
                        <input style="float:right;width:70px;" value="Posting" class="btn btn-primary" readonly></a>
                        <?php } ?>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
                  	<?php 
					$hore=$db->select("v_brgkeluar_transit","*","no_keluar='$_GET[id]'");
					foreach($hore as $hos){}
					$hores=$db->select("m_gudang","*","id_gudang='$hos[kpd_id_gudang]'");
					foreach($hores as $host){}
					 ?>
                     <input type="hidden" name="cabs" value="<?=$host['id_cabang']?>">
				  <div class="panel-body">
                   				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Keluar</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b><br>
                                        &nbsp;&nbsp;&nbsp;<b>Keterangan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$hos['ket']?></b>
                                </div>
                                <div class="form-group">
                                <div class="col-lg-5">
                                <input type="hidden" id="link" name="link" value="<?=$_GET['id']?>">
               
              </div>
             </div>
                               
                                <div class="form-group">
                               			 <?php
											include("keranjang_v.php");
											?> 
                                
                                </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
<?php
if($_POST['jenis']=='setuju'){
	$data = array("status" => 1);
	$db->update("tx_brg_keluar",$data,"no_keluar='$_POST[id]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 5,
						'level' => 1,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	$dttmp=$db->select("tx_brg_keluar a
JOIN tx_brg_keluar_dtl b ON a.no_keluar = b.no_keluar
JOIN m_barang_gudang c ON b.id_barang = c.id_barang AND a.id_gudang = c.id_gudang","a.id_keluar,
b.no_keluar,
a.id_gudang,
a.kpd_id_gudang,
a.id_user,
a.`status`,
a.ket,
a.tgl,
a.stampdate,
a.no_ref,
b.qty,
c.kode_barang,
c.nama_barang,
b.id_barang,
b.hpp,b.sat","b.no_keluar='$_POST[id]'");
	$jumlah=count($dttmp);
	//start auto jurnal total
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
				$max=$db->select("ak_jurnal","max(IDJ)as id");
				foreach($max as $val){}

				$id=$val['id']+1;
				$datajur = array(  'IDJ' => $id,
					   'IDKM'=> $idgen,
					   'NO_JURNAL' => $idj,
					   'DEBET' => $_POST['total'],
					   'KREDIT' => $_POST['total'],
					   'TGL_JURNAL' => date("Y-m-d"),
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_SESSION['ID_CABANG'],
					   'ID_GUD' => $valtmp['id_gudang'],
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
				//echo"create ak_jurnal<br>";
		//end auto jurnal total
	if($jumlah>0){
		//echo"create ak_jurnal_dtl<br>";
		foreach($dttmp as $valtmp){
		//===konv====
		$dtk=$db->select("m_konversi","*","id_barang='$valtmp[id_barang]' and sat2='$valtmp[sat]'");
		foreach($dtk as $dtkk){}
		if($dtkk['konv']!=''){
			$qty=$valtmp['qty']*$dtkk['konv'];
			$hpp=$valtmp['hpp']/$dtkk['konv'];
		}else{
			$qty=$valtmp['qty'];
			$hpp=$valtmp['hpp'];
		}//===end konv====	
		$cek=$db->select("tx_mutasi","*","id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]' ORDER BY id_mutasi DESC LIMIT 0,1");
			foreach($cek as $mutan){}
			$ak=$db->select("tx_mutasi","max(id_mutasi)as id");
		    foreach($ak as $ka){}
		    $idn=$ka['id']+1;
			$akhir=$mutan['akhir']-$qty;
			$tglmutasi=date("Y-m-d H:i:s");
			$datai = array( 
		 		'id_mutasi' => $idn,
				'no_ref' => $_POST['id'],
				'awal' => $mutan['akhir'],
				'masuk' => 0,
				'keluar' =>  $qty,
				'akhir' => $akhir,
				'hpp' => $hpp,
				'tgl_mutasi' => $tglmutasi,
				'jenis_mutasi' => 1,
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_gudang' => $valtmp['id_gudang'],
				'id_barang' => $valtmp['id_barang']
				);
			$exec= $db->insert("tx_mutasi", $datai);
			include("jurnal_dtl.php");
			
   	 }//end 
	}//end if 
	
	
	
	/* */ echo "<script>window.location='index.php?x=appbrgkel'</script>";
}


if($_POST['jenis']=='tolak'){
	$data = array("status" => 2);
	$db->update("tx_brg_keluar",$data,"no_keluar='$_POST[id]'");
	echo "<script>window.location='index.php?x=appbrgkel'</script>";
}
?>

