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
						<h5 class="panel-title">Approve Pengeluaran Barang</h5>
                         <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Pengeluaran Barang" onClick="window.location='index.php?x=brgkeluar2_v'"></button></li>
							</ul>
                            </div>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead> 
                            <tr>
                            	<td width="20%">No Permintaan</td>
                                <td width="10%">Tgl</td>
                                <td width="20%">Unit</td>
                                <td width="10%">Status</td>
                                <td width="5%">#</td>
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
						<h5 class="panel-title">View Detil Permintaan</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="panel-body">
                        <div class="form-group">
					<?php
                    $supp=$db->select("tx_sales_order","*","no_sales='$_GET[id]'");
                    foreach($supp as $valsupp){}
					?>
                                              <table width="300px" cellspacing="0" cellpadding="0">
                        <tr>
                                             <td><b>&nbsp;No Permintaan</b></td>
                                             <td><b>&nbsp;: <?=$valsupp['no_sales']?></b></td>
                                      
                        </tr>
                                            <td><b>&nbsp;Tgl </b></td>
                                            <td> <b>&nbsp;: <?=$valsupp['tgl_sales']?></b></td>
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
if($_POST['aksi']=='setuju'){
		$tgl=date('Y-m-d');
		$dttmp=$db->select("tx_sales_order","*","no_sales='$_POST[idnyas]'");
	
		foreach($dttmp as $datatmp){}
		$nospj=$db->nourut('no_spj', 'tx_do', 'BK', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
		//$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		$iddo=$db->idurut("tx_do","id_spj");
		
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
					);
		$exec= $db->insert("tx_do", $datado);
		
		$jum=0;
		foreach($_POST['qty_beri'] as $key => $val){
		if($val>0){
			$total=0;
			//================stok=========================================
			$bar=$db->select("m_barang_gudang","*","id_barang='".$_POST['idbar'][$key]."' and id_gudang='$datatmp[id_gudang]'");
			foreach($bar as $barang){}
			$cek=$db->select("tx_mutasi","*","id_gudang='$datatmp[id_gudang]' and id_barang='".$_POST['idbar'][$key]."' ORDER BY id_mutasi DESC LIMIT 0,1");
			foreach($cek as $mutan){}
			$ak=$db->select("tx_mutasi","max(id_mutasi)as id");
		    foreach($ak as $ka){}
		    $idn=$ka['id']+1;
			$akhir=$mutan['akhir']-$val;
			$tglmutasi=date("Y-m-d H:i:s");
			$datai = array( 
		 		'id_mutasi' => $idn,
				'no_ref' => $nospj,
				'awal' => $mutan['akhir'],
				'masuk' => 0,
				'keluar' =>  $val,
				'akhir' => $akhir,
				'hpp' => $barang['hpp'],
				'tgl_mutasi' => $tglmutasi,
				'jenis_mutasi' => 11,
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_gudang' => $datatmp['id_gudang'],
				'id_barang' => $_POST['idbar'][$key]
				);
			
			////ambill mutasi
			$mutasi=$db->cek_mutasi_riject($_POST['idbar'][$key],$datatmp['id_gudang']);
			if($mutasi['akhir']==''){
				$mutasi['akhir']=0;
			}else{
				$mutasi['akhir']=$mutasi['akhir'];
			}
			$total=($akhir+$mutasi['akhir'])*$barang['hpp'];
			//end ambil
			$data33 = array( 
					'stok' => $akhir+$mutasi['akhir'], 
					'total' => $total, 
					);
			$exec= $db->update("m_barang_gudang", $data33,"id_gudang='$datatmp[id_gudang]' and id_barang='".$_POST['idbar'][$key]."'");		
			$exec= $db->insert("tx_mutasi", $datai);
			//===================end stok
			
			$iddodtl=$db->idurut("tx_do_dtl","id_dtl");
			$datadtl = array( 
					'id_dtl' => $iddodtl, 
					'id_spj' => $iddo, 
					'no_spj' => $nospj, 
					'id_barang' => $_POST['idbar'][$key], 
					'qty' => $val, 
					'harga' => $barang['hpp'],					
					'id_satuan' => $valtmp['id_satuan'], 
					'status' => 0,
					);
		$exec= $db->insert("tx_do_dtl", $datadtl);
		//up dtl
		$data3 = array( 
					'status' => 1, 
					);
		$exec= $db->update("tx_sales_order_dtl", $data3,"no_sales='$_POST[idnyas]' and id_barang='".$_POST['idbar'][$key]."'");
		
		}//end if
	}//end for
	$cekorddtl=$db->select("tx_sales_order_dtl","count(*)as jum","no_sales='$_POST[idnyas]' and status=0");
	foreach($cekorddtl as $valj){}
	if($valj['jum']==0){
			$data3 = array( 
					'status_so' => 4, 
					);
			$exec= $db->update("tx_sales_order", $data3,"no_sales='$_POST[idnyas]'");
	}
			
			echo "<script>
			window.open('cetak.php?page=cetakspj2&id=".$nospj."','_blank');
			window.location='index.php?x=cetakspj&id=".$nospj."'</script>";
	
	
}
?>
</form>


