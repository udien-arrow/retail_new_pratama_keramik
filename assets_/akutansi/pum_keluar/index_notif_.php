    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:1px;
			}
	</style>
<?php
if($_POST[simpan]){
	$dttmp=$db->select("tx_prp_tmp","id_user,id_supp,no_order","id_user='$_SESSION[ID_LOGIN]' and id_supp='$_POST[id_supp]' group by id_supp");
	
	foreach($dttmp as $valtmp){	
		$tgl=date("Y-m-d",strtotime($_POST['tgl']));
	  if($valtmp['id_user']<>''){ 
		$idgen=$db->nourut('no_prp', 'tx_prp', 'PP', '00', $tgl);
		
		
		$id=$db->idurut("tx_prp","id_prp");
		$his=date('H:i:s');
		
		$data = array( 
					'id_prp' => $id, 
					'no_prp' => $idgen, 
					'stampdate' => date('Y-m-d H:i:s'),
					'tgl' => date("Y-m-d",strtotime($_POST['tgl'])).' '.$his,
					'duedate' => date("Y-m-d",strtotime($_POST['duedate'])),
					'ket' => $_POST['ket'],
					'id_gudang' => $_POST['gudang'],
					'id_supp' => $_POST['id_supp'],
					'id_user' => $valtmp['id_user'],
					'no_order' => $valtmp['no_order'],
					'ket' => $_POST['ket'],
					'disc_persen' => $_POST['dg_persen'],
					'disc_jumlah' => $_POST['dg_rupiah'],
					'total' => $_POST['grant'],
					'id_valuta' => $_POST['id_valuta'],
					'kurs' => $_POST['kurs'],
					'acc_code' => $_POST['rekening'],
					'status' => '0',
					
					);
		$exec= $db->insert("tx_prp", $data);

		$dttmp2=$db->select("tx_prp_tmp","*","id_user='$valtmp[id_user]' and id_supp='$valtmp[id_supp]'");
		foreach($dttmp2 as $valtmp2){
			$iddtl=$db->idurut("tx_prp_dtl","id_dtl");
			if($_POST['ppn']>0){$ppn="y";}else{$ppn="n";}
			$data = array( 
					'id_dtl' => $iddtl, 
					'id_prp' => $id,
					'no_prp' => $idgen, 
					'id_barang' => $valtmp2['id_barang'],
					'qty' => $valtmp2['qty'],
					'qty_sisa' => 0,
					'bonus' => $valtmp2['bonus'],
					'sat' => $valtmp2['sat'],
					'harga_beli' => $valtmp2['harga_beli'],
					'disc_persen' => $valtmp2['disc'],
					'disc_rupiah' => $valtmp2['disc_rupiah'],
					'kurs' => $_POST['kurs'],
					'ppn' => $ppn,
					'status' => 0,
					);
			$exec= $db->insert("tx_prp_dtl", $data);
			//var_dump($data);
			$where = array(	 "id_user" => $valtmp['id_user'],
							 "id_supp" => $valtmp['id_supp']);
			$db->delete("tx_prp_tmp",$where);
		}
	  }
	}//end if jumlah
	
			echo "<script>window.location='index.php?x=prp&spb=$_POST[spb22]&id_supp=$_POST[id_supp]'</script>";
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_prp_tmp",$where);
	echo "<script>window.location='index.php?x=prp&jenis=$_POST[jenis]&spb=$_POST[spb2]&supp=$_POST[supp]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array(
			"id_user" => $_SESSION['ID_LOGIN'],
			"id_supp" => $_POST['supp2']
			);
	$db->delete("tx_prp_tmp",$where);
	echo "<script>window.location='index.php?x=prp&jenis=$_POST[jenis]&spb=$_POST[spb2]&supp=$_POST[supp]'</script>";
}else{
?>	
<div class="col-lg-6">
		<form action="index.php?x=prp_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Permintaan Pembelian" onClick="window.location='index.php?x=prp_v'"></button></li>
							</ul>
                        </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th colspan="8">
                                <div class="form-group" >
                                   <div class="col-lg-4">
                                     <select name="gud" id="gud" class="select-search" onChange="pindahData3(gud.value,supp.value)">
                                       <option value="">---Gudang---</option>
                                       <?php
											$query=$db->select("m_gudang","id_gudang,nama_gudang","status='1'");
											foreach($query as $sel){	
			                            ?>
                                       <option value="<?=$sel['id_gudang']?>" <?php if($sel['id_gudang']==$_GET['gud']){echo "selected";}?>>
                                         <?=$sel['nama_gudang']?>
                                       </option>
                                       <?php 
											
										}
										
										
										?>
                                     </select>
                                   </div> 
                                   
                                  <div class="col-lg-4">
                                    <select name="supp" id="supp" class="select-search" onChange="pindahData3(gud.value,supp.value)">
										<option value="">---Supplier---</option>
										<?php
											$query=$db->select("m_supplier","id_supp,nama_supp,id_valuta");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_supp']?>" <?php if($sel['id_supp']==$_GET['supp']){echo "selected";}?>><?=$sel['nama_supp']?></option>
                                        
                                        <?php 
											if($_GET['supp']==$sel['id_supp']){
												$valu=$sel['id_valuta'];
											}
										}
										
										
										?>    
									</select>
                                    
                                    </div> 
                                </div>
                                </th>
                              <th>&nbsp;</th>
                            </tr>
                            <tr>
                                <th width="10%"></th>
                               
                                <th width="80%">Nama Barang</th>
                              	<th width="5%">Satuan</th>
                              	<th width="5%">Qty Minta</th>
                                <th width="5%">Qty</th>
                                <th width="5%">Bonus</th>
                                <th width="5%">Harga</th>
                              	<th width="5%">Disc%</th>
                                <th width="5%">
                                <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a>
                              </th>
                            </tr>
                            
                        </thead>

                    </table>
                    <?php
						$jum2=$db->select("v_barang","*");
						$jum=count($jum2);
					?>
		   			<input type="hidden" name="qty_in" id="qty_in"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
                    <input type="hidden" name="disc_in" id="disc_in"    required>
                    <input type="hidden" name="harga_in" id="harga_in"  value="0" required>
                    <input type="hidden" name="bonus_in" id="bonus_in"  value="0" required>
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" required>
                    
                    
   		  </div>
			</form>
		</div>
         
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang 
						<?php
                        echo $title;
						if($_GET[spb]!=''){
						$spb=$db->select("tx_order a left join m_gudang b on a.id_gudang=b.id_gudang","a.id_gudang,a.tgl,b.nama_gudang","a.no_order='$_GET[spb]'");
					     foreach($spb as $valspb) {}
						 
						 echo " Tgl: ".date("d-m-Y",strtotime($valspb[tgl]))." | ".$valspb[nama_gudang];
						}
						?></h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body">
                    			<div class="tabbable">
									<ul class="nav nav-tabs">
										<?php
                                        $tmp=$db->select("tx_prp_tmp a left join m_supplier b on a.id_supp=b.id_supp","a.id_supp,b.nama_supp","a.id_user='$_SESSION[ID_LOGIN]' group by id_supp");														                                        $no=1;
										foreach($tmp as $valtmp){
										?>
                                        <li class="<?php if($no==1){echo "active";}?>">
                                        <a href="#id_<?=$valtmp['id_supp']?>" data-toggle="tab"><?php  if($valtmp['id_supp']==''){echo "Non";}else{echo $valtmp['nama_supp'];}?>
                                        </a></li>
                                        <?php $no++;}?>
									</ul>

									<div class="tab-content">
                                    
                                    
                                    <?php
                                        $tmp=$db->select("tx_prp_tmp a left join m_supplier b on a.id_supp=b.id_supp","a.id_supp,b.nama_supp,b.id_valuta,b.jenis_pemb,b.pkp","a.id_user='$_SESSION[ID_LOGIN]' group by id_supp");														                                        $no=1;
										foreach($tmp as $valtmp){
									?>
                                   		 
                                    
										<div class="tab-pane <?php if($no==1){echo "active";}?>" id="id_<?=$valtmp['id_supp']?>">
                                        <form class="form-horizontal" action="index.php?x=prp" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
                                          <input type="hidden" name="aksi" id="aksi"    required>
                                          <input type="hidden" name="id2" id="id2"  value=""  required>
                                          <input type="hidden" name="jenis" id="jenis"  value="<?php echo $_GET[jenis]?>"  required>
                                          <input type="hidden" name="supp" id="supp"  value="<?php echo $_GET[supp]?>"  required>
                                          <input type="hidden" name="spb2" id="spb2"  value="<?php echo $_GET[spb]?>"  required>
                                          <input type="hidden" name="supp2" id="supp2"  value=""  required>
                                        	<?php
											include("keranjang.php");
											?>  
                                    	 </form>
                                        </div>	
                                       
                                    <?php $no++;}?>
                                    
									</div>
                                    
								</div>	
					</div>		
                    </div>			
</div>

<?php }?>