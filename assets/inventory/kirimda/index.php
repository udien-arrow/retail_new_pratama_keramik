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
						<h5 class="panel-title">Cetak SPJ Penjualan DA</h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer">
                        <thead> 
                            <tr>
                                <td width="25%">No SO</td>
                                <td width="25%">No SPJ</td>
                                <td width="45%">Ship to</td>
                                <td width="10%">Tanggal Rilis</td>
                                <td width="10%">#</td>
                            </tr>
                        </thead>

                    </table>   
                                    
		   			<input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=kirimda" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-7">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil SO Rilis</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="panel-body">
                        <div class="form-group">
					<?php
                    $supp=$db->select("v_kirimda","*","no_spj='$_GET[id]'");
                    foreach($supp as $valsupp){}
					?>
                        <table width="300px" cellspacing="0" cellpadding="0">
  <tr>
                       <td><b>&nbsp;No SO</b></td>
                       <td><b>&nbsp;: <?=$valsupp['no_so']?></b></td>
                
  </tr>
                      <tr>
                        <td><b>&nbsp;No SPJ</b></td>
                        <td><b>&nbsp;:
                          <?=$valsupp['no_spj']?>
                        </b></td>
                      </tr>
                      <tr>
                        <td><b>&nbsp;No Shipto</b></td>
                        <td><b>&nbsp;:
                          <?=$valsupp['shipto']?>
                        </b></td>
                      </tr>
                      <td><b>&nbsp;Tgl </b></td>
                      <td> <b>&nbsp;: <?=$valsupp['tgl_spj']?></b></td>
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
	$dttmp=$db->select("v_kirimda a left join tx_po b on a.no_so=b.no_so","a.*,b.jenis_p,b.id_daerah,b.jenis_kirim,b.id_gudang,b.id_supp,b.no_prp","a.no_spj='$_POST[idnyas]'");
	foreach($dttmp as $datatmp){}
	
	$sip=explode("-",$datatmp['shipto']);
	foreach($db->select("m_customer","head","id_cus='$datatmp[id_cus]'")as $cek);//$datatmp[id_daerah]
	if($cek['head']!=''){
		foreach($db->select("m_customer","id_cus","kode_cus='$cek[head]'")as $cek2);
		$idcus=$cek2['id_cus'];
		$idcusto=$datatmp['id_cus'];
	}else{
		$idcus=$datatmp['id_cus'];
		$idcusto=$datatmp['id_cus'];
	}
	
	if($datatmp['jenis_p']==3){$jenisju='1';}if($datatmp['jenis_p']==1){$jenisju='2';}
	$asd=$db->select("m_customer_plafon","*","id_cus='$datatmp[id_cus]' and jenis_plafon='$jenisju'");
	foreach($asd as $tempon){}
		$jumlah_so=0;
		$nospj=$db->nourut('no_spj', 'tx_do', 'SPJ', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
		//$nofp=$db->nourut('no_faktur_pajak', 'tx_piutang', 'FP', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
		foreach($db->select("m_fakturpajak","no_faktur","status=0 order by no_faktur asc limit 1")as $dtfp);
		$nofp=$dtfp['no_faktur'];
		
		$nofj=$db->nourut('no_faktur_jual', 'tx_piutang', 'FJ', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
		$supplier=$db->select("m_supplier","ifnull(pkp,0) as pkp,ifnull(account,0) as account,pph","id_supp='$datatmp[id_supp]'");
		foreach($supplier as $supplier1){};
		$s=$db->select("m_customer","ifnull(pkp,0) as pkp,ifnull(account,0) as account","id_cus='$tempon[id_cus]'");
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		foreach($s as $pps){}
		$iddo=$db->idurut("tx_do","id_spj");
		$s=$db->select("m_customer","ifnull(pkp,0) as pkp,ifnull(account,0) as account","id_cus='$idcus'");
		$dttime=date("Y-m-d H:i:s");
		$idms=$db->nourut('no_masuk', 'tx_brg_masuk', 'IM', sprintf("%02s", $_SESSION['ID_CABANG']), date('Y-m-d'));
		$idmss=$db->idurut("tx_brg_masuk","id_masuk");		
		$jumlah=count($dttmp);
		if($jumlah>0){
		foreach($dttmp as $heads){
			$titil+=$heads['qty_do']*$heads['price'];
			}
		$data = array( 
					'tgl' => date('Y-m-d H:i:s'),
					'id_masuk' => $idmss, 
					'no_masuk' => $idms,
					'stampdate' => date('Y-m-d H:i:s'),
					'id_gudang' => $heads['id_gudang'],
					'dari_gudang' => 0,
					'status' => 0,
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_ref' => 0,
					'no_ref' => $heads['no_so'],
					'id_supp' => $heads['id_supp'],
					'disc_persen' => 0,
					'total' => $titil,
					'kurs' => 0,
					'id_valuta' => 0,
					'line' => 0,
					'ket' => $_POST['ket'],
					'jenis' => 5,
					'surat_jalan' => $_POST['idnyas'],
					'id_cabang' => $_SESSION['ID_CABANG'],
					);
		$exec= $db->insert("tx_brg_masuk", $data);	
			
		foreach($dttmp as $valtmp){
			  foreach($db->select("tx_sales_order_dtl","*","no_sales='$_POST[no_order]' and id_barang='$valtmp[id_barang]'")as $isi){};
			  
			  //hanya biasa
			$iddtl12=$db->idurut("tx_brg_masuk_dtl","id_dtl");	
				$data2 = array( 		
						'id_dtl' => $iddtl12,
						'id_masuk' => $idmss,
						'no_masuk' => $idms,
						'id_barang' => $valtmp['id_barang'],
						'qty' => $valtmp['qty_do'],
						'qty_terima' => $valtmp['qty_do'],
						'harga_beli' => $valtmp['price'],
						'kurs' => 0,
						'ppn' => 0,
						'total' => $valtmp['qty_do']*$valtmp['price'],
						'status' => 1,
						'sat' => $valtmp['id_satuan'],
					);
				$exec= $db->insert("tx_brg_masuk_dtl", $data2);
			
			$iddodtl=$db->idurut("tx_do_dtl","id_dtl");
			$datadtl = array( 
					'id_dtl' => $iddodtl, 
					'id_spj' => $iddo, 
					'no_spj' => $nospj, 
					'id_barang' => $valtmp['id_barang'], 
					'qty' => $valtmp['qty_do'], 
					'harga' => $isi['harga'],					
					'id_satuan' => $valtmp['id_satuan'], 
					'status' => 0,
					'hpp_akhir' => 0, 
					);
			$exec= $db->insert("tx_do_dtl", $datadtl);
			$jumlah_so=$jumlah_so+($valtmp['qty_do']*$isi['harga']);
			
			if($supplier1['pph']!=0){
					$th=$supplier1['pph']/100;	
				}else{
					$th=0;
				}
			
			$das=$db->select("tx_so a join tx_so_dtl b on a.sales_order=b.sales_order JOIN tx_rilis_dtl d on d.no_so=b.sales_order","b.price","d.no_spj='$_POST[idnyas]' and b.id_barang='$valtmp[id_barang]'");
            foreach($das as $dass){}
			
			$cogs=$valtmp['qty_do']*$dass['price']/(1.1+$th);
			
			$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","*","a.id_barang='$valtmp[id_barang]'");
			foreach($ba as $bar){}
			
			$dpp=$isi['harga'];
			$hrgbeli=$dpp*$valtmp['qty_do'];
				
			$cec=$db->select("m_customer","ifnull(pkp,0) as pkp","id_cus='$idcus'");
				foreach($cec as $cak){}
				if($supplier1['pkp']==1){
				$ppn=$cogs*(10/100);	
				}else{
				$ppn=0;
				}
			$hutangsem=$cogs+$ppn;
			
			//$hargaj=$db->select("tx_prp_dtl","*","no_prp='$datatmp[no_prp]' and id_barang='$valtmp[id_barang]'");
			//foreach($hargaj as $hargajual){}
			$cec=$db->select("m_customer","ifnull(pkp,0) as pkp","id_cus='$idcus'");
			foreach($cec as $cak){}
			$piutang=$valtmp['qty_do']*$isi['harga'];
				
			
			//$penjualan=$piutang-$ppnj;
			$penjualan=$valtmp['qty_do']*($isi['harga']/1.1);
			if($cak['pkp']==1){
					$ppnj=$penjualan*10/100;
				}else{
					$ppnj=0;
				}
			$tpiutang+=$piutang;
			$tpenjualan+=$penjualan;
			$tppnj=$ppnj;
			$thutangsem+=$hutangsem;
			$tcogs=$cogs;
			
			$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='1' and status='1'");
			foreach($ckpph as $ckpph2){}
			if($supplier1['pkp']==1){
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => $ppn,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal PENGELUARAN Barang PPN MASUKAN DA",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $nospj,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
			//$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			}
			
			//cogs
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['cogs'],
							   'DEBET' => $cogs,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AUTO JURNAL COGS BARANG KELUAR DA",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $nospj,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			
		}
		//start auto jurnal total
				$max=$db->select("ak_jurnal","max(IDJ)as id");
				foreach($max as $val){}
				$id=$val['id']+1;
				$datajur = array(  'IDJ' => $id,
					   'IDKM'=> $nospj,
					   'NO_JURNAL' => $idj,
					   'DEBET' => "0",
					   'KREDIT' => "0",
					   'TGL_JURNAL' => date("Y-m-d"),
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_SESSION['ID_CABANG'],
					   'ID_GUD' => $valtmp['id_gudang'],
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
		//end auto jurnal total
		
		
		//start auto jurnal hutang
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $pps['account'],
							   'DEBET' => $tpiutang,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal PENGELUARAN Barang Hutang DA",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $nospj,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
						
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
		//end auto jurnal hutang
		
		
		
		//start auto jurnal penjualan
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['sales'],
							   'DEBET' => "0",
							   'KREDIT' => $tpenjualan,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal PENGELUARAN Barang Penjualan DA",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $nospj,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
						
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal penjualan
			
		//start auto jurnal hutang Semen
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $supplier1['account'],
							   'DEBET' => "0",
							   'KREDIT' => $thutangsem,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal PENGELUARAN Barang Hutang Semen DA",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $nospj,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
						
			//$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal hutang semen
		
		$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['intransit'],
							   'DEBET' => "0",
							   'KREDIT' => $tcogs,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal SDP Semen",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $nospj,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
		$execjur= $db->insert("ak_jurnal_dtl", $datajur);
		
		//start auto jurnal ppn
		$cek=$db->select("m_supplier","ifnull(pkp,0) as pkp","id_supp='$datatmp[id_supp]'");
		foreach($cek as $cik){}
		if($cik['pkp']==1){
		$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='3' and status='1'");
		foreach($ckpph as $ckpph2){}
		$datajur = array(  	   'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => "0",
							   'KREDIT' => $tppnj,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal PENGELUARAN Barang PPN DA",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $nospj,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
		}
		
		$datado = array( 
					'id_spj' => $iddo, 
					'no_spj' => $nospj, 
					'tgl_spj' => $tgl, 
					'stampdate' => date("Y-m-d H:i:s"), 
					'n_tempo_n' => $_POST['tn'], 
					'n_tempo_t' => $_POST['tt'],
					'tempo_normal' => date('Y-m-d', strtotime($_POST['tn'].'days', strtotime($tgl))), 
					'tempo_tambahan' => date('Y-m-d', strtotime($_POST['tn']+$_POST['tt'].'days', strtotime($tgl))),								
					'id_gudang' => '', 
					'id_cabang' => $_SESSION['ID_CABANG'], 
					'id_cus' => $idcus, 
					'id_cus_shipto' => $idcusto, 
					'id_user' => $_SESSION['ID_LOGIN'], 
					'no_ref' => $_POST['idnyas'], 
					'no_spb' => '', 
					'jenis_jual' => $jenisju, 
					'jenis_kirim' => $datatmp['jenis_kirim'], 
					'jumlah_so' => $jumlah_so,
					'ship_to' => $sip[0], 
					);
			$dataj = array(
			'no_faktur_jual' => $nofj, 
			'no_faktur_pajak' => $nofp,
			'no_ref' => $nospj,
			'status' => 1,
			'tgl' => $tgl,
			'total_piutang' => $jumlah_so,
			'id_cus' => $idcus,
			'id_user' => $_SESSION['ID_LOGIN'],
			'stampdate' => date("Y-m-d H:i:s"), 
			'tempo_normal' => date('Y-m-d', strtotime($_POST['tn'].'days', strtotime($tgl))), 
			'tempo_tambahan' => date('Y-m-d', strtotime($_POST['tn']+$_POST['tt'].'days', strtotime($tgl))),		
			'jenis_jual' => $jenisju, 
			'jenis_kirim' => $datatmp['jenis_kirim'], 
			'status_bayar' => 0, 
			'id_cabang' => $_SESSION['ID_CABANG'],
			'n_tempo_n' => $_POST['tn'], 
			'n_tempo_t' => $_POST['tt'],
			);
			$exec= $db->insert("tx_do", $datado);
			$exec= $db->insert("tx_piutang", $dataj);
			
			$data = array( 		
							'status_tx' => 2,
						);
			$exec= $db->update("tx_rilis_dtl", $data,"no_spj='$_POST[idnyas]'");
			//
			$data5 = array( 
					'status' => 1, 
					'id_cabang' => $_SESSION['ID_CABANG'], 
					'no_spj' => $nospj, 
					);
			$exec= $db->update("m_fakturpajak", $data5,"no_faktur='$nofp'");
	}
	echo "<script>window.location='index.php?x=kirimda&id=$_POST[idnyas]'</script>";
	
}
?>
</form>
<?php
if($konval['no_ref']==''){
if($jum==0){
?>
<div class="col-lg-5">
</div>
<div class="col-lg-7">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Switch</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
<form class="form-horizontal" action="index.php?x=kirimda" name="formku2" id="formku2" method="post" onSubmit="return(validate_frm())">
               <div class="form-group" >
               
               </div>
               <div class="form-group" >
               
               </div>
               <div class="form-group" >
                
			<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Pelanggan </label>                                 <div class="col-lg-4">
                <select name="custo" id="custo" class="select-minimum" onChange="pindahdata()">
                    <?php if($_GET[cus]!=''){
                    $expl=explode("_",$_GET[cus]);
                    ?>
                <option value="<?=$_GET[cus]?>" selected><?=$expl[2]?></option>
                <?php }?>
               </select>
               </div>
               
               </div>
               <?php if($_GET['cus']!=''){?>
                <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Shipto</label>
                  <div class="col-lg-6">
                              	    <select name="shipto" id="shipto" class="select-search" required>
                              	      	<?php
											$query=$db->select("m_customer_shipto a join m_customer b on a.id_cus=b.id_cus","a.shipto_code,a.shipto_name,b.nama_usaha,a.id_cus","a.id_cus='$expl[0]'");
											foreach($query as $sel){	
			                            ?>
                              	      <option value="<?=$sel['shipto_code'].'_'.$sel['id_cus']?>">
                              	        <?=$sel['nama_usaha'].' - '.$sel['shipto_code'].' - '.$sel['shipto_name']?>
                           	          </option>
                              	      <?php 	
										}
									?>
                           	      </select>
                                  <?php
                                  $exp=explode("-",$valsupp['shipto']);
								  foreach($db->select("m_customer_shipto","id_cus","shipto_code='$exp[0]'")as $ha);
								  ?>
                                  <input type="hidden" name="shipto_awal" value="<?php echo $exp[0].'_'.$ha['id_cus']?>">
                                  <input type="hidden" name="no_spj" value="<?php echo $valsupp['no_spj']?>">
                    </div>   
                               <div class="col-lg-1">
               		<button style="float:right" class="btn btn-primary" type="submit" name="simpan2" value="simpan"  onClick="return confirm('Data Akan Dikirim ke BM untuk dilakukan pengecekan Limit & Tempo!!')">Send</button>
               </div>   
                   
                    </div>
               <?php }?>
                    
</form> 
<?php }
}
?> 
<?php
if($_POST[simpan2]){
	if($_POST['shipto']!=''){
		$explo=explode("_",$_POST['shipto']);
		$explo2=explode("_",$_POST['shipto_awal']);
		
		$datadtl = array( 
					'id_cus' => $explo2[1], 
					'shipto_code' => $explo2[0], 
					'id_cus_to' => $explo[1], 
					'shipto_code_to' => $explo[0], 
					'no_spj' => $_POST['no_spj'],					
					'stampdate' => date("Y-m-d H:i:s"), 
					'status' => 0,
					'id_cabang' => $_SESSION['ID_CABANG'],
					);
		$exec= $db->insert("tx_switch_history", $datadtl);	
	}	
	echo "<script>window.location='index.php?x=kirimda&id=$_POST[no_spj]'</script>";
}	
?>	
	                          
                           


