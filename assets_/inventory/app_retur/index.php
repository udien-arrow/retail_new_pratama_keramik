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
		<form action="index.php?x=apprt" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Retur Pembelian</h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                            <tr>
                                <td width="15%">No Retur</td>
                                <td width="10%">Tanggal</td>
                                <td width="10%">Keterangan</td>
                                <td width="5%">#</td>
                            </tr>
                        </thead>
                    </table>                   
		   			<input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			
   		  </div>
			</form>
		</div>
        <form class="form-horizontal" action="index.php?x=apprt" name="formku" id="formku" method="post">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Retur Pembelian</h5>
                         <?php if($_GET['id']==""){}else{ ?>
                        <a href='javascript:void(0)' onClick="apptolak('<?=$_GET[id]?>')">
                        <input style="float:right;width:70px;" value="Tolak" class="btn btn-danger" readonly></a>	
                        
                        <a href='javascript:void(0)' onClick="appsetuju('<?=$_GET[id]?>')">
                        <input style="float:right;width:70px;" value="Terima" class="btn btn-primary" readonly></a>
                        <?php } ?>
					</div>
                    <div class="dataTables_wrapper"></div>
				  	<div class="panel-body">
                   				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Retur</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b>
                                  
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
	$tabel = "tx_mutasi";
	$tabel2 = "m_barang_gudang";
	$tabel4 = "tx_retur_pem";
	$tabel3 = "tx_retur_pem_dtl";
	$data = array("status" => 1);
	$db->update("tx_transit",$data,"no_transit='$_POST[id]'");
	
	
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 6,
						'level' => 1,
						'type' => 0,
						);
	$exec= $db->insert("m_approving", $data);
	$dttmp=$db->select("tx_retur_pem_dtl","*","no_retur='$_POST[id]'");
	foreach($dttmp as $valtmp4){}
	$s=$db->select("m_supplier","ifnull(pph,0) as pph,ifnull(account,0) as account","id_supp='$valtmp4[id_sup]'");
	foreach($s as $pps){}
	//start auto jurnal total
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
				$max=$db->select("ak_jurnal","max(IDJ)as id");
				foreach($max as $val){}
				$id=$val['id']+1;
				$datajur = array(  'IDJ' => $id,
					   'IDKM'=> $valtmp4['no_retur'],
					   'NO_JURNAL' => $idj,
					   'DEBET' => '0',
					   'KREDIT' => '0',
					   'TGL_JURNAL' => date("Y-m-d"),
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_SESSION['ID_CABANG'],
					   'ID_GUD' => $valtmp4['id_gudang'],
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
		//end auto jurnal total
	
	$jumlah=count($dttmp);
	$tanggal=date('Y-m-d H:i:s');
	if($jumlah>0){
	foreach($dttmp as $valtmp){
	 $cek=$db->select("tx_mutasi","*","id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]' ORDER BY id_mutasi DESC LIMIT 0,1");
	 foreach($cek as $mutan){}
		$akhir=$mutan['akhir']-$valtmp['qty_kembali'];
		$idn=$db->idurut("tx_mutasi","id_mutasi");
		$data = array( 
		 		'id_mutasi' => $idn,
				'no_ref' => $_POST['id'],
				'awal' => $mutan['akhir'],
				'masuk' => 0,
				'keluar' => $valtmp['qty_kembali'],
				'akhir' => $akhir,
				'hpp' => $valtmp['hpp'],
				'tgl_mutasi' => $tanggal,
				'jenis_mutasi' => 10,
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_gudang' => $valtmp['id_gudang'],
				'id_barang' => $valtmp['id_barang']
				);
		$hit=$db->select("m_barang_gudang","*","id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]'");
		foreach($hit as $dg){}
		////ambill mutasi
			$mutasi=$db->cek_mutasi_riject($valtmp['id_barang'],$valtmp['id_gudang']);
			if($mutasi['akhir']==''){
				$mutasi['akhir']=0;
			}else{
				$mutasi['akhir']=$mutasi['akhir'];
			}
			//end ambil
		$total=($akhir+$mutasi['akhir'])*$dg['hpp'];	
		$barang = array( 
				'stok' => $akhir+$mutasi['akhir'],
				'total' => $total,
				);
		$updates = array( 
				'status' => 1,
				);
		$exec= $db->insert($tabel, $data);
		$exc= $db->update($tabel4,$updates,"no_retur='$_POST[id]'");
		$exc= $db->update($tabel3,$updates,"no_retur='$_POST[id]'");
		$exc= $db->update($tabel2,$barang,"id_barang='$valtmp[id_barang]' and id_gudang='$valtmp[id_gudang]'");
		
		
		
		//start auto jurnal
				$dpp=$valtmp['harga_beli']/1.1;
				$ppn=$dpp*(10/100)*$valtmp['qty_kembali'];				
				$hrgbeli=$dpp*$valtmp['qty_kembali'];
				$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","inventory","a.id_barang='$valtmp[id_barang]'");
				foreach($ba as $bar){}
				$tppn+=$ppn;
				$thutang+=$ppn+$hrgbeli;
				$dttime=date("Y-m-d H:i:s");
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['inventory'],
							   'DEBET' => "0",
							   'KREDIT' => $hrgbeli,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Barang Keluar",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $valtmp['no_retur'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
					
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal
		
		}
	}
		//start auto jurnal ppn
		$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='1' and status='1'");
		foreach($ckpph as $ckpph2){}
		$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => "0",
							   'KREDIT' => $tppn,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Retur Barang PPN",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $valtmp['no_retur'],
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal ppn
			//start auto jurnal hutang
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $pps['account'],
							   'DEBET' => $thutang,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Retur Barang Hutang",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $valtmp['no_retur'],
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );	
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal hutang
	
	echo "<script>window.location='index.php?x=apprt'</script>";
}
if($_POST['jenis']=='tolak'){
	$data = array("status" => 2);
	$db->update("tx_retur_pem",$data,"no_retur='$_POST[id]'");
	//=====approve============
	$id=$db->idurut("m_approving","id");
	$data = array( 
						'id' => $id, 
						'no' => $_POST['id'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 4,
						'level' => 1,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);	
	echo "<script>window.location='index.php?x=apprt'</script>";
}
?>

