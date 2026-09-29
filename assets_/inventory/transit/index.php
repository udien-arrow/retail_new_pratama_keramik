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
	$dttmp=$db->select("tx_transit_tmp","id_user,ke_gudang","id_user='$_SESSION[ID_LOGIN]' group by ke_gudang");
	foreach($dttmp as $valtmp){	
	  if($valtmp['id_user']<>''){
		  
		$idgen=$db->nourut('no_transit', 'tx_transit', 'TB', sprintf("%02s", $_SESSION['ID_GUDANG']), $_POST[tgl]);
		$id=$db->idurut("tx_transit","id_transit");
		$data = array( 
					'id_transit' => $id, 
					'no_transit' => $idgen, 
					'stampdate' => date('Y-m-d H:i:s'),
					'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
					'duedate' => date("Y-m-d",strtotime($_POST['due'])),
					'ket' => $_POST['ket'],
					'id_gudang' => $_SESSION['ID_GUDANG'],
					'id_cabang' => $_SESSION['ID_CABANG'],
					'id_gudang_tujuan' => $valtmp['ke_gudang'],
					'id_user' => $valtmp['id_user'],
					'shipto' => $_POST['shipto'],
					'status' => 1,
					);
		$exec= $db->insert("tx_transit", $data);
		$dttmp2=$db->select("tx_transit_tmp","*","id_user='$valtmp[id_user]' and ke_gudang='$valtmp[ke_gudang]'");
		foreach($dttmp2 as $valtmp2){
			$iddtl=$db->idurut("tx_transit_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $iddtl, 
					'id_barang' => $valtmp2['id_barang'],
					'sat' => $valtmp2['sat'],
					'id_transit' => $id,
					'no_transit' => $idgen,
					'qty' => $valtmp2['qty'],
					'status' => 0,
					);
			$exec= $db->insert("tx_transit_dtl", $data);
			
			$where = array(	 "id_user" => $valtmp['id_user'],
							 "ke_gudang" => $valtmp['ke_gudang']);
			$db->delete("tx_transit_tmp",$where);
		}
	  }
	}//end if jumlah
			echo "<script>alert('Sukses Simpan Data Dengan Nomer TB $idgen');window.location='index.php?x=transit'</script>";
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_transit_tmp",$where);
	echo "<script>	window.location='index.php?x=transit&gud=$_POST[gud]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_transit_tmp",$where);
	echo "<script>window.location='index.php?x=transit'</script>";
}else{
?>	
    <div class="col-lg-6">
		<form action="index.php?x=transit_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Permintaan Transit Barang </h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Permintaan" onClick="window.location='index.php?x=transit_v'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th colspan="5">
                                <div class="form-group" >
                                 <label class="control-label col-lg-2">Kepada </label>
                                    <div class="col-lg-5">
                                    <select name="gud" id="gud" class="select-search" onChange="pindahData2(gud.value)">
										<option value="">--Pilih Gudang--</option>
										<?php
											$query=$db->select("m_gudang","id_gudang,nama_gudang","id_gudang<>'$_SESSION[ID_GUDANG]'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_gudang']?>" <?php if($sel['id_gudang']==$_GET['gud']){echo "selected";}?>><?=$sel['nama_gudang']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
                                 </div>
                                
                                </th>
                              <th>&nbsp;</th>
                            </tr>
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
                            
                        </thead>

                    </table>
                    <?php
						$jum2=$db->select("v_barang","*");
						$jum=count($jum2);
					?>
		   			<input type="hidden" name="qty_in" id="qty_in"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
                    <!--<input type="" name="tes2" id="tes2"    required>-->
                    <input type="hidden" name="gud_in" id="gud_in"  value="0" required>
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=transit" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Permintaan Transit Barang</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                     
                   <br>
                  <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Tanggal </label>
                              <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker1" name="tgl" id="tgl" value="<?php echo date("d-m-Y")?>">
                                  </div>
                               </div>
                               <label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Duedate </label>
                               <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker1" name="due" id="due" value="<?php echo date('d-m-Y', strtotime('+7 days'));?>">
                                  </div>
                               </div>
                               
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Keterangan </label>						
                              	<div class="col-lg-8">
                                  <div class="form-group">
                              	 
                                  <input type="text" class="form-control" name="ket" id="ket" >
                                  </div>
                               </div>			
                            
                            
                     </div>  
                     <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Shipto </label>						
                              	<div class="col-lg-8">
                                  <div class="form-group">

                              	 <select name="shipto" id="shipto" class="select-search">
										<option value="">--Pilih Shipto--</option>
										<?php
											$query=$db->select("m_gudang_shipto","*","id_gudang='$_SESSION[ID_GUDANG]'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['shipto_code']?>" selected="selected"><?=$sel['shipto_code'].' '.$sel['shipto_name']?></option>

                                        <?php }?>    
									</select>
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
                                        $tmp=$db->select("tx_transit_tmp a left join m_gudang b on a.ke_gudang=b.id_gudang","a.ke_gudang,b.nama_gudang","id_user='$_SESSION[ID_LOGIN]' group by id_gudang");										$no=1;
										foreach($tmp as $valtmp){
										?>
                                        <li class="<?php if($no==1){echo "active";}?>">
                                        <a href="#id_<?=$valtmp['ke_gudang']?>" data-toggle="tab"><?php if($valtmp['ke_gudang']=='0'){echo "Pembelian";}else{echo $valtmp['nama_gudang'];}?>
                                        </a></li>
                                        
                                        <?php $no++;}?>
									</ul>

									<div class="tab-content">
                                    <?php
                                        $tmp=$db->select("tx_transit_tmp a left join m_gudang b on a.ke_gudang=b.id_gudang","a.ke_gudang,b.nama_gudang","id_user='$_SESSION[ID_LOGIN]' group by ke_gudang");										$no=1;
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