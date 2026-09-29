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
		<form action="index.php?x=order_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Permintaan Penjualan" onClick="window.location='index.php?x=jualriject'"></button></li>
							</ul>
                            </div>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>  
                            <tr>
                                <td width="10%">No Sales</td>
                              	<td width="5%">Tgl</td>
                                <td width="5%">Jenis</td>
                                <td width="25%">Customer</td>
                              	<td width="5%">Approve</td>
                                <td width="8%">#</td>
                            </tr>
                        </thead>
                    </table>
		   			<input type="hidden" name="harga_in" id="harga_in"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in" required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=jualriject_v" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                  	<?php
                   	$kon=$db->select("tx_jual_riject az
								JOIN tx_jual_riject_dtl a ON az.no_sales = a.no_sales
								JOIN m_barang_gudang b ON a.id_barang = b.id_barang
								AND az.id_gudang = b.id_gudang
								JOIN m_satuan c ON a.id_satuan = c.id_satuan
								join m_customer d on az.id_cus=d.id_cus
								","a.qty,
								b.nama_barang,
								a.id_barang,
								a.harga,
								c.nama_satuan,
								d.nama_usaha,
								a.no_sales","az.no_sales='$_GET[id]'");				
					?>
				  <div class="panel-body">
                   				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Permintaan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b>  
                                </div>
                                <?php foreach($kon as $c){ } ?>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Customer</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$c['nama_usaha']?></b>
                                </div>
                               <div class="form-group">
                               <?php
                              foreach( $dt=$db->select("tx_jual_riject","*","no_sales='$_GET[id]'")as $dt2);
							  if($dt2['status_so']==3){
							   ?>
                               <a href='javascript:void(0)' onClick=window.open('cetak.php?id=<?=$dt2['no_sales']?>&page=cetakspjriject&jenis=1') >
                    <button style="float:right" class="btn btn-primary" type="button">Cetak SPJ</button></a>&nbsp;
                    <?php
							   }if($dt2['status_so']==2){
					?>
                               <button style="float:right" class="btn btn-primary" type="button" name="simpan" value="simpan" onclick="pindahkk()">Barang Keluar</button>
                               <?php }?>
                               </div>
                                <div class="form-group">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td align="center"><strong>No</strong></td>
                                            <td align="center"><strong>Nama Barang</strong></td>
                                            <td align="center"><strong>Satuan </strong></td>
                                            <td align="center"><strong>Harga</strong></td>
                                            <td align="center"><strong>Stok Digudang</strong></td>
                                            <td align="center"><strong>Qty</strong></td>
                                            <td align="center"><strong>Total</strong></td>
                                          </tr>
                                          <?php
										  $no=1;
										  $cek=0;
                                          foreach($kon as $d){
										  ?>
                                          
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['nama_barang'];?>&nbsp;</td>
                                            <td align="left">&nbsp;
                                            <?=$d['nama_satuan']?></td>
                                            <td align="left">&nbsp;<?=number_format($d['harga'])?></td>
                                            <td align="right">
                                            <?php
											//echo $d['id_barang'].'-'.$dt2['id_gudang'];
											$mutasi=$db->cek_mutasi_riject($d['id_barang'],$dt2['id_gudang']);
											if($mutasi['akhir']==''){
												$mutasi['akhir']=0;
											}else{
												$mutasi['akhir']=$mutasi['akhir'];
											}
											
											echo $mutasi['akhir'];
											if($d['qty']>$mutasi['akhir']){
												$cek=$cek+1;
											}
											?>&nbsp;
                                            </td>
                                            <td align="right"><?=number_format($d['qty'])?>
  &nbsp;</td>
                                            <td align="right"><?=number_format($to=$d['harga']*$d['qty'])?>                                              &nbsp;</td>
                                          </tr>
                                          <?php $no++;
										  $total=$total+$to;
										  } ?>
                                          <tr>
                                            <td colspan="6" align="center">Total</td>
                                            <td align="right"><?=number_format($total)?> &nbsp;</td>
                                          </tr>
                                       	</table>             
                                      <input type="hidden" id="cek" name="cek" value="<?=$cek?>">
         	                          <input type="hidden" id="aksi" name="aksi" value="">
                                      <input type="hidden" id="idnyas" name="idnyas" value="<?=$_GET['id']?>">
                               </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
<?php
if($_POST['aksi']=='simpan'){
	$tgl=date('Y-m-d');
	$dttmp=$db->select("tx_jual_riject a join tx_jual_riject_dtl b on a.no_sales=b.no_sales","b.*,a.id_gudang,a.id_cus,a.id_cus_shipto,ship_to,a.jenis,a.jenis_jual,a.id_cabang,a.id_cabang_direct","b.no_sales='$_POST[idnyas]'");
	foreach($dttmp as $datatmp){}
	
	$s=$db->select("m_customer","ifnull(pkp,0) as pkp,ifnull(account,0) as account","id_cus='$datatmp[id_cus]'");
	foreach($s as $pps){}
	$cek=$db->select("m_customer","ifnull(pkp,0) as pkp","id_cus='$datatmp[id_cus]'");
	foreach($cek as $cik){}
		$nospj=$db->nourut('no_spj', 'tx_do_riject', 'SPR', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		$iddo=$db->idurut("tx_do_riject","id_spj");
		$jumlah=count($dttmp);
		if($jumlah>0){
		foreach($dttmp as $valtmp){
		$total=0;
		//================stok=========================================
		$bar=$db->select("m_barang_gudang","*","id_barang='$valtmp[id_barang]' and id_gudang='$valtmp[id_gudang]'");
		foreach($bar as $barang){}
		$cek=$db->select("tx_mutasi_reject","*","id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]' ORDER BY id_mutasi DESC LIMIT 0,1");
			foreach($cek as $mutan){}
			$ak=$db->select("tx_mutasi_reject","max(id_mutasi)as id");
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
			
			
			$jumlah_so=$jumlah_so+($valtmp['qty']*$valtmp['harga']);
			$jumlah_piutang=$jumlah_piutang+($valtmp['qty']*$valtmp['harga']);
			////ambill mutasi
			$mutasi=$db->cek_mutasi($valtmp['id_barang'],$valtmp['id_gudang']);
			if($mutasi['akhir']==''){
				$mutasi['akhir']=0;
			}else{
				$mutasi['akhir']=$mutasi['akhir'];
			}
			//end ambil
			$total=($akhir+$mutasi['akhir'])*$barang['hpp'];
			$data33 = array( 
					'stok' => $akhir+$mutasi['akhir'], 
					'total' => $total, 
					);
			$exec= $db->update("m_barang_gudang", $data33,"id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]'");		
			$exec= $db->insert("tx_mutasi_reject", $datai);
			//===================end stok
			$iddodtl=$db->idurut("tx_do_riject_dtl","id_dtl");
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
			$exec= $db->insert("tx_do_riject_dtl", $datadtl);
		//start auto jurnal
				$dpp=$valtmp['harga']/1.1;
				$hrgbeli=$dpp*$valtmp['qty'];
				
				if($cik['pkp']==1){
				$ppn=$hrgbeli*(10/100);	
				}else{
				$ppn=0;}
					
				$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","*","a.id_barang='$valtmp[id_barang]'");
				foreach($ba as $bar){}
				
				$hap=$db->select("m_barang_gudang","hpp","id_barang='$valtmp[id_barang]' and id_gudang='$valtmp[id_gudang]'");
				foreach($hap as $hpps){}
				$cogs=$valtmp['qty']*$hpps['hpp'];
				$tppn+=$ppn;
				$tpph+=$pph;
				$thutang+=$ppn+$hrgbeli;
				$dttime=date("Y-m-d H:i:s");
				
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['sales'],
							   'DEBET' => "0",
							   'KREDIT' => $hrgbeli,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Penjualan Riject ".$_POST['jenis'],
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $nospj,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);	
			
			
			//cogs
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['cogs'],
							   'DEBET' => $cogs,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal COGS Riject ".$_POST['jenis'],
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $nospj,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			
			//persediaan
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['inventory_riject'],
							   'DEBET' => "0",
							   'KREDIT' => $cogs,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Persediaan Riject".$_POST['jenis'],
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $nospj,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal
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
		//start auto jurnal ppn
		if($cik['pkp']==1){
		$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='3' and status='1'");
		foreach($ckpph as $ckpph2){}
		$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => "0",
							   'KREDIT' => $tppn,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal PPN Keluaran Riject ".$_POST['jenis'],
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $nospj,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
		}
			//end auto jurnal ppn	
			//start auto jurnal hutang
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $pps['account'],
							   'DEBET' => $thutang,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Piutang Riject ".$_POST['jenis'],
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $nospj,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
						
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal hutang
			$datado = array( 
					'id_spj' => $iddo, 
					'no_spj' => $nospj, 
					'tgl_spj' => $tgl, 
					'stampdate' => date("Y-m-d H:i:s"), 
					'id_gudang' => $datatmp['id_gudang'], 
					'id_cus' => $datatmp['id_cus'], 
					'id_cus_shipto' => $datatmp['id_cus_shipto'], 
					'ship_to' => $datatmp['ship_to'], 
					'id_user' => $_SESSION['ID_LOGIN'], 
					'id_cabang' => $datatmp['id_cabang'],
					'id_cabang_direct' => $datatmp['id_cabang_direct'], 
					'no_ref' => $_POST['idnyas'], 
					'jenis_jual' => $datatmp['jenis_jual'], 
					'jenis_kirim' => $datatmp['jenis'], 
					'jumlah_so' => $jumlah_so,
					);
			$exec= $db->insert("tx_do_riject", $datado);
			
			//=====update==============
			$data3 = array( 
					'status_so' => 3, 
					);
			$exec= $db->update("tx_jual_riject", $data3,"no_sales='$_POST[idnyas]'");
	}

	echo "<script>window.location='index.php?x=jualriject_v'</script>";
	
	
}
?>