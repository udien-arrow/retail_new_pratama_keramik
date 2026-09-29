    <!-- Theme JS files -->
	<style>
			.tables, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
			table, tr, td {
			border: none;
		}
	</style>
    <div class="col-lg-5">
		<form action="index.php?x=cetakspj" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Cetak SPB</h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                            <tr>
                                <td width="55%">No SPB</td>
                                <td width="10%">Tanggal</td>
                                <td width="15%">#</td>
                            </tr>
                        </thead>

                    </table>   
                                    
		   			<input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=cetakspj" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-7">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Sales Order</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="panel-body">
                        <div class="form-group">
					<?php
                    $supp=$db->select("tx_sales_spb","*","no_spb='$_GET[id]'");
                    foreach($supp as $valsupp){}
					?>
                                              <table width="300px" cellspacing="0" cellpadding="0">
                        <tr>
                                             <td><b>&nbsp;No SPB</b></td>
                                             <td><b>&nbsp;: <?=$valsupp['no_spb']?></b></td>
                                      
                        </tr>
                                            <td><b>&nbsp;Tgl </b></td>
                                            <td> <b>&nbsp;: <?=$valsupp['tgl']?></b></td>
                          </tr>
                          </tr>
                          </table>
                                  
                                </div>
                                <div class="form-group">
                       			  <?php
											include("keranjang_v.php");
											?> 
                                
                      </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
<?php
if($_POST[simpan]){
	$tgl=date('Y-m-d');
	$dttmp=$db->select("tx_sales_order a join tx_sales_order_dtl b on a.no_sales=b.no_sales","b.*,a.id_gudang,a.id_cus,a.jenis,a.jenis_jual","b.no_sales='$_POST[idnyas]'");
	foreach($dttmp as $datatmp){}
	$asd=$db->select("m_customer_plafon","*","id_cus='$datatmp[id_cus]' and jenis_plafon='$datatmp[jenis_jual]'"); 
		foreach($asd as $tempon){}
		$nospj=$db->nourut('no_spj', 'tx_do', 'SPJ', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
		$nofp=$db->nourut('no_faktur_pajak', 'tx_piutang', 'FP', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
		$nofj=$db->nourut('no_faktur_jual', 'tx_piutang', 'FJ', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
		$iddo=$db->idurut("tx_do","id_spj");
		$jumlah=count($dttmp);
		if($jumlah>0){
		foreach($dttmp as $valtmp){
		$total=0;
		$bar=$db->select("m_barang_gudang","*","id_barang='$valtmp[id_barang]' and id_gudang='$valtmp[id_gudang]'");
		foreach($bar as $barang){}
		$cek=$db->select("tx_mutasi","*","id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]' ORDER BY id_mutasi DESC LIMIT 0,1");
			foreach($cek as $mutan){}
			$ak=$db->select("tx_mutasi","max(id_mutasi)as id");
		    foreach($ak as $ka){}
		    $idn=$ka['id']+1;
			$akhir=$mutan['akhir']-$valtmp['qty'];
			$tglmutasi=date("Y-m-d H:i:s");
			$datai = array( 
		 		'id_mutasi' => $idn,
				'no_ref' => $nospj,
				'awal' => $mutan['akhir'],
				'masuk' => 0,
				'keluar' =>  $valtmp['qty'],
				'akhir' => $akhir,
				'hpp' => $barang['hpp'],
				'tgl_mutasi' => $tglmutasi,
				'jenis_mutasi' => 11,
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_gudang' => $valtmp['id_gudang'],
				'id_barang' => $valtmp['id_barang']
				);
			$total=$akhir*$barang['hpp'];
			$jumlah_so=$jumlah_so+($valtmp['qty']*$valtmp['harga']);
			$jumlah_piutang=$jumlah_piutang+($valtmp['qty']*$valtmp['harga']);
			$data33 = array( 
					'stok' => $akhir, 
					'total' => $total, 
					);
			//$exec= $db->update("m_barang_gudang", $data33,"id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]'");
			//$exec= $db->insert("tx_mutasi", $datai);
			$iddodtl=$db->idurut("tx_do_dtl","id_dtl");
			$datadtl = array( 
					'id_dtl' => $iddodtl, 
					'id_spj' => $iddo, 
					'no_spj' => $nospj, 
					'id_barang' => $valtmp['id_barang'], 
					'qty' => $valtmp['qty'], 
					'harga' => $valtmp['harga'],					
					'id_satuan' => $valtmp['id_satuan'], 
					'status' => 0,
					'hpp_akhir' => $barang['hpp'], 
					);
		
		//$exec= $db->insert("tx_do_dtl", $datadtl);
		}
		$datado = array( 
					'id_spj' => $iddo, 
					'no_spj' => $nospj, 
					'tgl_spj' => $tgl, 
					'stampdate' => date("Y-m-d H:i:s"), 
					'tempo_normal' => date('Y-m-d', strtotime($tempon['tempo_normal'].'days', strtotime($tgl))), 
					'tempo_tambahan' => date('Y-m-d', strtotime($tempon['tempo_normal']+$tempon['tempo_tambahan'].'days', strtotime($tgl))),					
					'id_gudang' => $datatmp['id_gudang'], 
					'id_cus' => $datatmp['id_cus'], 
					'id_user' => $_SESSION['ID_LOGIN'], 
					'no_ref' => $_POST['idnyas'], 
					'no_spb' => $_POST['nospb'], 
					'jenis_jual' => $datatmp['jenis_jual'], 
					'jenis_kirim' => $datatmp['jenis'], 
					'jumlah_so' => $jumlah_so,
					);
			$dataj = array(
			'no_faktur_jual' => $nofj, 
			'no_faktur_pajak' => $nofp,
			'no_ref' => $nospj,
			'status' => 1,
			'tgl' => $tgl,
			'total_piutang' => $jumlah_piutang,
			'id_cus' => $datatmp['id_cus']
			);
			//$exec= $db->insert("tx_piutang", $dataj);
			//$exec= $db->insert("tx_do", $datado);
			$data3 = array( 
					'status_so' => 4, 
					);
			//$exec= $db->update("tx_sales_order", $data3,"no_sales='$_POST[idnyas]'");
			
			$cekcus=$db->select("m_customer","*","id_cus='$datatmp[id_cus]'");
			foreach($cekcus as $cekcos){}
			if($cekcos['head']==""){
			$ceks=$db->select("tx_piutang_customer","id_cus","id_cus='$datatmp[id_cus]'");
			$hut=count($ceks);	
			if($hut<='0'){
			if($datatmp['jenis_jual']=='1'){
			$tot=$db->select("tx_sales_order a join tx_sales_order_dtl b on a.no_sales=b.no_sales","b.*,a.id_gudang,a.id_cus,a.jenis,a.jenis_jual","b.no_sales='$_POST[idnyas]' and a.jenis_jual='1'");
			foreach($tot as $tat){
				$totalp=$totalp+($tat['qty']*$tat['harga']);
				}
			$dataj = array(
			'id_cus' => $datatmp['id_cus'],
			'p_semen' => $totalp,
			);
			//$exec= $db->insert("tx_piutang_customer", $dataj);
			}
			}if($hut>'0'){
				$tot=$db->select("tx_sales_order a join tx_sales_order_dtl b on a.no_sales=b.no_sales","b.*,a.id_gudang,a.id_cus,a.jenis,a.jenis_jual","b.no_sales='$_POST[idnyas]' and a.jenis_jual='1'");
			foreach($tot as $tat){
				$totalp=$totalp+($tat['qty']*$tat['harga']);
				}
			$nge=$db->select("tx_piutang_customer","*","id_cus='$datatmp[id_cus]'");
			foreach($nge as $en){}		
			$gg=$en['p_semen']+$totalp;
			$dataj = array(
			'p_semen' => $gg,
			);
			var_dump($dataj);
			$exec= $db->update("tx_piutang_customer", $dataj,"id_cus='$datatmp[id_cus]'");
				}
			}else{
			$ik=$db->select("m_customer","*","kode_cus='$cekcos[head]'");	
			foreach($ik as $ki){}
			$ceks=$db->select("tx_piutang_customer","*","id_cus='$datatmp[id_cus]'");
			$hut=count($ceks);		
			if($hut<='0'){
			if($datatmp['jenis_jual']=='1'){
			$tot=$db->select("tx_sales_order a join tx_sales_order_dtl b on a.no_sales=b.no_sales","b.*,a.id_gudang,a.id_cus,a.jenis,a.jenis_jual","b.no_sales='$_POST[idnyas]' and a.jenis_jual='1'");
			foreach($tot as $tat){
				$totalp=$totalp+($tat['qty']*$tat['harga']);
				}
			$dataj = array(
			'id_cus' => $ki['id_cus'],
			'p_semen' => $totalp,
			);
			$exec= $db->insert("tx_piutang_customer", $dataj);
			}
			}
			
			
			}
			
	}
	
die();
	echo "<script>window.location='index.php?x=cetakspj&id=$_POST[nospb]'</script>";
	
}
?>
</form>


