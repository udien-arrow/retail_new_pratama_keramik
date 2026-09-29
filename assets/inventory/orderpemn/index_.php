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
<?php

if($_POST[simpan]){
	$dttmp=$db->select("tx_order_tmp","id_user,jenis,ke_gudang","id_user='$_SESSION[ID_LOGIN]' group by ke_gudang");
	foreach($dttmp as $valtmp){	
	  if($valtmp['id_user']<>''){
		  
		$idgen=$db->nourut('no_order', 'tx_order', 'SPB', sprintf("%02s", $_SESSION['ID_GUDANG']), $_POST[tgl]);
	
		
		$id=$db->idurut("tx_order","id_order");
		$data = array( 
					'id_order' => $id, 
					'no_order' => $idgen, 
					'stampdate' => date('Y-m-d H:i:s'),
					'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
					'duedate' => date("Y-m-d",strtotime($_POST['due'])),
					'ket' => $_POST['ket'],
					'id_gudang' => $_SESSION['ID_GUDANG'],
					'id_gudang_tujuan' => $valtmp['ke_gudang'],
					'id_user' => $valtmp['id_user'],
					'jenis' => $valtmp['jenis'],
					'status' => 0,
					);
		$exec= $db->insert("tx_order", $data);
		$dttmp2=$db->select("tx_order_tmp","*","id_user='$valtmp[id_user]' and ke_gudang='$valtmp[ke_gudang]'");
		foreach($dttmp2 as $valtmp2){
			$iddtl=$db->idurut("tx_order_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $iddtl, 
					'id_barang' => $valtmp2['id_barang'],
					'sat' => $valtmp2['sat'],
					'id_order' => $id,
					'no_order' => $idgen,
					'qty' => $valtmp2['qty'],
					'status' => 0,
					);
			$exec= $db->insert("tx_order_dtl", $data);
			
			$where = array(	 "id_user" => $valtmp['id_user'],
							 "ke_gudang" => $valtmp['ke_gudang']);
			$db->delete("tx_order_tmp",$where);
		}
	  }
	}//end if jumlah
			echo "<script>window.location='index.php?x=order'</script>";
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_order_tmp",$where);
	
	echo "<script>window.location='index.php?x=order&jenis=$_POST[jenis]&gud=$_POST[gud]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_order_tmp",$where);
	echo "<script>window.location='index.php?x=order'</script>";
}else{
	$jum=$db->jumlah_hari($_GET[bulan],date('Y'));
	$explo=explode("_",$_GET['tahap']);
	echo $jum.'_'.$explo[1];
	
?>	
    <div class="col-lg-<?php if($_GET[jenis]=='3'){echo '8';}else{echo '6';}?>">
		<form action="index.php?x=order_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Permintaan Barang</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Permintaan" onClick="window.location='index.php?x=order_v'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th colspan="<?php if($_GET['jenis']!=3){echo '5';}else{echo '10';}?>">
                                <div class="form-group" >
                                 <label class="control-label col-lg-1">Filter </label>
                                  <div class="col-lg-4">
                                    
                                    <select name="jenis" id="jenis" class="select" onChange="pindahData(jenis.value)">
                                      <option value="0">---Jenis Permintaan---</option>
                                      <option value="1" <?php if($_GET['jenis']==1){echo "selected";}?>>Pembelian Non Semen</option> 
                                      <option value="3" <?php if($_GET['jenis']==3){echo "selected";}?>>Pembelian Semen</option>
                                      <!--<option value="2" <?php //if($_GET['jenis']==2){echo "selected";}?>>Transit Gudang</option>-->    
                                    </select>
                                   
                                    </div> 
                                    <?php if($_GET['jenis']==3){?>
                                    <div class="col-lg-2">
                                    <?php include('bulan.php');?>
                                    </div>
                                    <div class="col-lg-2">
                                      <select name="tahap" id="tahap" class="select" >
                                        <?php
											$query=$db->select("m_tahap","id_tahap,nama_tahap,tgl_awal,tgl_akhir");
											foreach($query as $sel){	
			                            ?>
                                        <option value="<?=$sel['id_tahap'].'_'.$sel['tgl_awal'].'_'.$sel['tgl_akhir']?>" <?php if($sel['id_tahap'].'_'.$sel['tgl_awal'].'_'.$sel['tgl_akhir']==$_GET['tahap']){echo "selected";}?>>
                                          <?=$sel['nama_tahap']?>
                                        </option>
                                        <?php }?>
                                      </select>
                                    </div>
                                    <div class="col-lg-1">
                                    <input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData3('<?=$_GET['jenis']?>',gud.value,'<?=$bulan?>',tahap.value)">
                                    </div>
                                    <?php }elseif($_GET['jenis']==2){?>
                                    <div class="col-lg-5">
                                    <select name="gud" id="gud" class="select" onChange="pindahData2(jenis.value,gud.value)">
										
										<?php
											$query=$db->select("m_gudang","id_gudang,nama_gudang","id_gudang<>'$_SESSION[ID_GUDANG]'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_gudang']?>" <?php if($sel['id_gudang']==$_GET['gud']){echo "selected";}?>><?=$sel['nama_gudang']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
                                    <?php }else{?>
                                    <input type="hidden" name="gud" value="0">
                                    <?php }?> 
                                </div>
                                
                                </th>
                              <th>&nbsp;</th>
                            </tr>
                            <?php
                            if($_GET['jenis']==3){
							?>
                            <tr>
                                <th width="5%">Kode</th>
                              	<th width="70%">Nama Barang</th>
                                <th width="5%">Satuan</th>
                                <th width="5%">Stok</th>
                              	<th width="5%">Qty </th>
                                <th width="5%">Qty </th>
                                <th width="5%">Qty </th>
                                <th width="5%">Qty </th>
                                <th width="5%">Qty </th>
                                <th width="5%">Qty </th>
                                <th width="5%">
                                <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a>
                              </th>
                            </tr>
                            <?php }else{?>
                             <tr>
                                <th width="5%">Kode</th>
                              	<th width="70%">Nama Barang</th>
                                <th width="5%">Satuan</th>
                                <th width="5%">Stok</th>
                              	<th width="5%">Qty </th>
                                <th width="5%">
                                <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a>
                              </th>
                            </tr>
                            <?php }?>
                        </thead>

                    </table>
                    <?php
						$jum2=$db->select("v_barang","*");
						$jum=count($jum2);
					?>
		   			<input type="hidden" name="qty_in" id="qty_in"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
                    <input type="hidden" name="gud_in" id="gud_in"  value="0" required>
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=order" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-<?php if($_GET[jenis]=='3'){echo '4';}else{echo '6';}?>">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Permintaan Barang</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                     
                   <br>
                  <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Tanggal </label>
                              <div class="col-lg-4">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date("d-m-Y")?>">
                                  </div>
                               </div>
                               <label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Duedate </label>
                               <div class="col-lg-4">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="due" id="due" value="<?php echo date('d-m-Y', strtotime('+7 days'));?>">
                                  </div>
                               </div>
                               
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Ket </label>						
                              	<div class="col-lg-8">
                                  <div class="form-group">
                              	 
                                  <input type="text" class="form-control" name="ket" id="ket" >
                                  </div>
                               </div>			
                            
                            
                     </div>  
                     <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;</label>									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="batal()">
										 Batal 
                                        </button>
                                        <input type="hidden" name="aksi" id="aksi"    required>
								      <input type="hidden" name="id2" id="id2"  value=""  required>
									  <input type="hidden" name="jenis" id="jenis"  value="<?php echo $_GET[jenis]?>"  required>
                               <input type="hidden" name="gud" id="gud"  value="<?php echo $_GET[gud]?>"  required>
							</div>
                            
                            
                     </div>       
					<div class="panel-body">
                    		
								<div class="tabbable">
									<ul class="nav nav-tabs">
										<?php
                                        $tmp=$db->select("tx_order_tmp a left join m_gudang b on a.ke_gudang=b.id_gudang","a.ke_gudang,b.nama_gudang","id_user='$_SESSION[ID_LOGIN]' group by id_gudang");										$no=1;
										foreach($tmp as $valtmp){
										?>
                                        <li class="<?php if($no==1){echo "active";}?>">
                                        <a href="#id_<?=$valtmp['ke_gudang']?>" data-toggle="tab"><?php if($valtmp['ke_gudang']=='0'){echo "Pembelian";}else{echo $valtmp['nama_gudang'];}?>
                                        </a></li>
                                        
                                        <?php $no++;}?>
									</ul>

									<div class="tab-content">
                                    <?php
                                        $tmp=$db->select("tx_order_tmp a left join m_gudang b on a.ke_gudang=b.id_gudang","a.ke_gudang,b.nama_gudang","id_user='$_SESSION[ID_LOGIN]' group by id_gudang");										$no=1;
										foreach($tmp as $valtmp){
												
									?>
										<div class="tab-pane <?php if($no==1){echo "active";}?>" id="id_<?=$valtmp['ke_gudang']?>">
                                        	<?php
                                            include("keranjang.php");
											?>
                                            
										</div>
                                    <?php $no++;}?>
                                    	

										
									</div>
								</div>
							
                    
                                <div class="form-group">
                                    	
                                     
                                </div>
                                  
					
					</div>	
                    
				</div>					
		</div>
</form>
<?php }?>