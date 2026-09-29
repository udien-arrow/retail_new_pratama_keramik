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
		<form action="index.php?x=appjual_c" id="form_index" method="post">
   		  <div class="panel panel-flat">
			<div class="panel-heading">
						<h5 class="panel-title">View Permintaan Penjualan</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Back" onClick="window.location='index.php?x=appjual'"></button></li>
							</ul>
              </div>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>  
                            <tr>
                                <td width="10%">No Sales Biaya</td>
                              	<td width="5%">Tgl</td>
                                <td width="5%">Jenis Jual</td>
                                <td width="25%">Keterangan</td>
                              	<td width="8%">#</td>
                            </tr>
                        </thead>

                    </table>
                   
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=appjual_c" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Permintaan Penjualan</h5>
					</div>
                    
                    <div class="dataTables_wrapper"></div>
                  	<div class="panel-body">
                   				<div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>No Permintaan</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$_GET['id']?></b>
                                </div>
                                <?php
                                foreach($jum=$db->select("tx_sales_biaya","*","no_sb='$_GET[id]'")as $vsb);
								foreach($db->select("tx_sales_biaya_dtl a 
								join tx_sales_order b on a.id_cus=b.id_cus_shipto
								join m_customer c on a.id_cus=c.id_cus
								","c.nama_usaha,b.ship_to","a.no_sb='$_GET[id]' order by biaya_retri desc limit 0,1")as $c);
								?>
                                <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;<b>Customer</b>
                                        &nbsp;&nbsp;&nbsp;<b>: <?=$c['nama_usaha'].'-'.$c['ship_to']?></b>
                                  
                                </div>
                                
                               
                               <div class="form-group">
                <table width="100%" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="4"align="left"><b>&nbsp;Detil Biaya</b></td>
                  </tr>
                  <tr>
                        <td width="9%"align="center"><strong>No</strong></td>
                        <td width="80" colspan="2" align="center"><strong>Nama Biaya</strong></td>
                        <td width="15%" align="center"><strong>Jumlah</strong></td>
                  </tr>
                  <?php if($vsb['jenis_jual']=='FRC'){
					$ak=$db->select("tx_sales_biaya_r_dtl a join m_retribusi b on a.id_retribusi=b.id_retribusi","a.*,b.nama_retribusi","a.no_sb='$_GET[id]'");
					$no=1;
					foreach($ak as $dta){  
					
				  ?>
                  <tr>
                    <td align="center"><?=$no?></td>
                    <td colspan="2">&nbsp;<?=$dta['nama_retribusi'];?></td>
                    <td align="right"><?=number_format($dta['nilai']);?>&nbsp;</td>
                  </tr>
                  <?php 
				  $no++;
				  }?>
                  
                  <tr>
                    <td align="center"><?=$no+1?></td>
                    <td colspan="2">&nbsp;Total Retribusi</td>
                    <td align="right"><?=number_format($vsb['biaya_retri'])?>&nbsp;</td>
                  </tr>
                    <tr>
                      <td align="center"><?=$no+2?></td>
                      <td colspan="2">&nbsp;Total BBM</td>
                      <td align="right"><?=number_format($vsb['biaya_ujs'])?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center"><?=$no+3?></td>
                      <td colspan="2">&nbsp;Biaya Lain2</td>
                      <td align="right"><?=number_format($vsb['biaya_lain'])?>&nbsp;</td>
                    </tr>
                     <tr>
                        <td colspan="3" align="right"><b> Total UJS</b>&nbsp;</td>
                       
                        <td align="right"><b><?php echo number_format($totujs=$vsb['biaya_retri']+$vsb['biaya_ujs']+$vsb['biaya_lain'])?>&nbsp;                        </b></td>
                </tr>
                 <tr>
                        <td colspan="3" align="right"><b>Total Gaji Supir</b>&nbsp;</td>
                        <td align="right"><b><?php
						foreach($db->select("tx_sales_biaya_supir a join tx_sales_biaya_dtl b on a.no_so=b.no_so","sum(ifnull(a.biaya_supir,0)+ifnull(a.insentif_jarak,0))as ij","b.no_sb='$_GET[id]' group by b.no_sb")as $bsv);
						echo number_format($totgasup=$bsv['bs']+$bsv['ij'])?>&nbsp;</b></td>
                </tr>
                 <tr>
                        <td colspan="3" align="right"><b>Total Bongkar Toko</b>&nbsp;</td>
                        <td align="right"><b><?php
						foreach($db->select("tx_tkbm_bongkartoko","sum(biaya_bongkar)as bt","no_sb='$_GET[id]' group by no_sb")as $bt);
						echo number_format($botok=$bt['bt'])?>&nbsp;</b></td>
                </tr>
                <?php }?>
                 <?php if($vsb['jenis_jual']=='SWC'){?>
                     <tr>
                    <td align="center">1</td>
                    <td colspan="2">&nbsp;Biaya Switch</td>
                    <td align="right"><?=number_format($vsb['biaya_switch'])?>&nbsp;</td>
                  </tr>
                   <?php }if($vsb['jenis_jual']=='LCO'){?>
                    <tr>
                      <td align="center">1</td>
                      <td colspan="2">&nbsp;Biaya Sewa Locco</td>
                      <td align="right"><?=number_format($vsb['biaya_sewa_lco'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                   
                </table>	
              </div>
                  </div>	
                  
            <?php if($vsb['status_jurnal']!=1){?>      
            <!-- <div class="form-group">
        	<label class="col-lg-2">&nbsp;&nbsp;&nbsp;Pembayaran</label>
            <div class="col-lg-6">
             <select name="pemb" id="pemb" class="select-search col-lg-12">
				  <?php 
                  /*$cc=$db->select("ak_parameterjur a join ak_acc b on a.acc_code=b.account","a.acc_code,b.description","a.id_m_parameterjur='21'");
                foreach($cc as $dtt){
                  ?>
                <option value="<?=$dtt['acc_code']?>"><?=$dtt['description']?></option>
                <?php 
                  }*/
                  ?>
              </select>
              <input type="hidden" name="jenis" id="jenis"  value=""  required>
              <input type="hidden" name="id" id="id"  value="<?=$_GET['id']?>"  required>
              <input type="hidden" name="ujs" id="ujs"  value="<?=$totujs?>"  required>
              <input type="hidden" name="gasup" id="gasup"  value="<?=$totgasup?>"  required>
              <input type="hidden" name="botok" id="botok"  value="<?=$botok?>"  required>
              <input type="hidden" name="swc" id="swc"  value="<?=$vsb['biaya_switch']?>"  required>
               <input type="hidden" name="lco" id="lco"  value="<?=$vsb['biaya_sewa_lco']?>"  required>
              <input type="hidden" name="jenisju" id="jenisju"  value="<?=$vsb['jenis_jual']?>"  required>
            </div>	
            
            <div class="col-lg-3">
               <button type="button" style="height:30px; line-height: 0;" class="btn btn-info btn-sm" name="setuju" onClick="appsetuju22()">Posting</button>
               </div>
        </div>-->
        <?php }?>
           <div class="form-group">
           
           </div>
        
				</div>					
		</div>
        
</form>
<?php
if($_POST['jenis']=='setuju'){
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
					   'IDKM' => $_POST['id'],
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
		//end auto jurnal total
	$dttime=date("Y-m-d H:i:s");
	if($_POST['jenisju']=='FRC'){
			//====jurnal debet===================
			$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='16' and status='1'");
			foreach($ckpph as $ckpph2){}
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $ckpph2['acc_code'],
									   'DEBET' => $_POST['ujs'],
									   'KREDIT' => "0",
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Total Retribusi",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//====jurnal debet===================
			$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='38' and status='1'");
			foreach($ckpph as $ckpph2){}
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $ckpph2['acc_code'],
									   'DEBET' => $_POST['botok'],
									   'KREDIT' => "0",
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Bongkar Toko",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);	
			//====jurnal kredit===================
			$total=$_POST['botok']+$_POST['ujs'];
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $_POST['pemb'],
									   'DEBET' => 0,
									   'KREDIT' => $total,
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Biaya Pengiriman",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);	
	}//end frc
	if($_POST['jenisju']=='LCO'){
			//====jurnal debet===================
			$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='39' and status='1'");
			foreach($ckpph as $ckpph2){}
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $ckpph2['acc_code'],
									   'DEBET' => $_POST['lco'],
									   'KREDIT' => "0",
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Biaya Locco",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//====jurnal kredit===================
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $_POST['pemb'],
									   'DEBET' => 0,
									   'KREDIT' => $_POST['lco'],
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Biaya Locco",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);	
	}//end frc
	if($_POST['jenisju']=='SWC'){
			//====jurnal debet===================
			$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='18' and status='1'");
			foreach($ckpph as $ckpph2){}
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $ckpph2['acc_code'],
									   'DEBET' => $_POST['swc'],
									   'KREDIT' => "0",
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Biaya Switch",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//====jurnal kredit===================
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $_POST['pemb'],
									   'DEBET' => 0,
									   'KREDIT' => $_POST['swc'],
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Biaya Switch",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);	
	}//end frc
	$dataup = array( 
				'status_jurnal' => 1,
			  );
	$execjur= $db->update("tx_sales_biaya", $dataup,"no_sb='$_POST[id]'");
	echo "<script>window.open='cetak.php?page=appjual_c&id=$_POST[id]'</script>";
}
?>

