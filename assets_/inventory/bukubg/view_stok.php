    <!-- Theme JS files -->
	<style>
			.tables, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
			table, tr, td {
			border: none;
		}
	.scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap
}
	</style>
    <div class="col-lg-1">
    </div>
    <div class="col-lg-10">
		<form action="index.php?x=bukubg_v" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title;?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Buku BG" onClick="window.location='index.php?x=bukubg'"></button></li>
							</ul>
                            </div>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="6">
                        <div class="form-group" >
                                  <div class="col-lg-9">
                                    
                                    </div>
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-lg-1">
                                    </select>
                                    </div>
                      </div>
                      </td>
                      </tr>
                            <tr>
                              	<th width="5%">No Tagihan</th>
                                <th width="15%">Nama Usaha</th>
                                <th width="10%">No SPJ</th>
                                <th width="10%">No FJ</th>
                                <th width="5%">Seri BG</th>
                              	<th width="8%">Dibayar</th>
                                <th width="10%">Bank BG</th>
                                <th width="5%">Jatuh Tempo</th>
                                <th width="5%">Jenis BG</th>
                                <th width="5%">Roolback</th>
                            </tr>
                        </thead>

                    </table>   
                                    
		   			<input type="hidden" name="jenis" id="jenis"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			
   		  </div>
			</form>
		</div>
         

<?php
if($_POST['jenis']=='setuju'){
	$split=explode("_",$_POST['id']);
	//start auto jurnal total
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
				$max=$db->select("ak_jurnal","max(IDJ)as id");
				foreach($max as $val){}
				$id=$val['id']+1;
				$datajur = array(  'IDJ' => $id,
					   'IDKM'=> $idgen,
					   'NO_JURNAL' => $idj,
					   'DEBET' => $split[6],
					   'KREDIT' => $split[6],
					   'TGL_JURNAL' => date("Y-m-d"),
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_SESSION['ID_CABANG'],
					   'ID_GUD' => $_SESSION['ID_GUDANG'],
					   'IDKM' => $split[2],
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
	//end auto jurnal total
	//===============jurnal=================
				$dttime=date("Y-m-d H:i:s");
				//=================jurnal lawan=============
				$s=$db->select("m_customer","ifnull(pph,0) as pph,ifnull(account,0) as account","id_cus='$split[7]'");
				foreach($s as $pps){}
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $pps['account'],
							   'DEBET' => $split[6],
							   'KREDIT' => 0,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AJ Roolback BG Cair No Seri:  ".$split[3]." ".$split[8]."",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $split[2],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				//jurnal lawan
				$s2=$db->select("tx_buku_bg","ifnull(account_balik,0) as account","id_buku='$split[0]'");
				foreach($s2 as $pps2){}
				
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $pps2['account'],
							   'DEBET' => 0,
							   'KREDIT' => $split[6],
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AJ Roolback BG Cair No Seri: ".$split[3]." ".$split[8]."",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' =>$split[2],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				//tg
				$datas = array(  
						 'jenis_bg' => 2,
						);
				$exec = $db->update("tx_tagihan_kembali_dtl", $datas,"no_ta='".$split[2]."' and no_seribg='".$split[3]."'");
				//pem
				$where = array(  
						 'no_tk' => $split[2],
						 'id_cus' => $split[7],
						 'jenis_pembayaran' => 3,
						);
				$exec = $db->delete("tx_pembayaran_sales", $where);
				//piu
				$datas = array(  
						 'status_bayar' => 0,
						);
				$exec = $db->update("tx_piutang", $datas,"no_faktur_jual='".$split[8]."' and id_cus='".$split[7]."'");
				
				//buku
				$datas = array(  
						 'jenis_bg' => 2,
						);
				$exec = $db->update("tx_buku_bg", $datas,"id_buku='".$split[0]."'");
				echo "<script>window.location='index.php?x=bukubg_v'</script>"; 
				
		
}

?>
