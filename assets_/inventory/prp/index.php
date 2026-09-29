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
$spb=explode("_",$_GET['spb']);
if($_POST[simpan]){
	include("simpan_in.php");
	/* echo "<script>window.location='index.php?x=prp&spb=$_POST[spb22]&id_supp=$_POST[id_supp]'</script>"; */
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_prp_tmp",$where);
	echo "<script>window.location='index.php?x=prp&jenis=$_POST[jenis]&spb=$_POST[spb22]&supp=$_POST[supp]&jenisnya=1'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array(
			"id_user" => $_SESSION['ID_LOGIN'],
			"id_supp" => $_POST['supp2']
			);
	$db->delete("tx_prp_tmp",$where);
	echo "<script>window.location='index.php?x=prp&jenis=$_POST[jenis]&spb=$_POST[spb22]&supp=$_POST[supp]&jenisnya=1'</script>";
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
                              <th colspan="7">
                                <div class="form-group" >
                                <div class="col-lg-4">
                                    <select name="jenis" id="jenis" class="select" onChange="pindahData7('1',jenis.value)">
                                      <option value="0">---Jenis---</option>
                                      
                                      <option value="2" <?php if($_GET['jenis']==2){echo "selected";}?>>Permintaan Dari Gudang</option>    
                                      <option value="3" <?php if($_GET['jenis']==3){echo "selected";}?>>Minimun Barang</option>
                                      <option value="4" <?php if($_GET['jenis']==4){echo "selected";}?>>Tolak Revisi</option>     
                                    </select>
                                    </div> 
                                    
                        <?php if($_GET['jenis']==4){?>
                        			 <div class="col-lg-4">
                                     <select name="spb" id="spb" class="select-search" onChange="pindahData2(jenis.value,spb.value,'1')">
										<option value="">---NO PP---</option>
										<?php
											$query=$db->select("tx_prp a","a.*","a.status=8 and a.jenis_p='$_GET[jenisnya]' and no_prp not in(select no_order from tx_prp where no_order=a.no_prp)");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['no_prp'].'_'.$sel['id_daerah'].'_'.$sel['shipto_code'].'_'.$sel['jenis_kirim']?>" <?php if($sel['no_prp'].'_'.$sel['id_daerah'].'_'.$sel['shipto_code'].'_'.$sel['jenis_kirim']==$_GET['spb']){echo "selected";}?>><?=$sel['no_prp']." - ".date("Y-m-d",strtotime($sel['tgl']))?></option>
                                        
                                        <?php 
										$jenisp=$sel['jenis_p'];
										} ?>    
									</select>
                                    </div>
                                    <?php } if($_GET['jenis']==2){
							
										?>
                                    <div class="col-lg-4">
                                    <select name="spb" id="spb" class="select-search" onChange="pindahData2(jenis.value,spb.value,'1')">
										<option value="">---No SPB---</option>
										<?php
											$query=$db->select("tx_order a join m_cabang b on a.id_cabang=b.id_cabang","a.no_order,a.id_order,b.nama_cabang,a.shipto_code,a.id_daerah,a.jenis_kirim,a.tgl","a.status=0 and a.id_gudang_tujuan=0 and a.jenis='$_GET[jenisnya]' order by tgl desc");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['no_order'].'_'.$sel['id_daerah'].'_'.$sel['shipto_code'].'_'.$sel['jenis_kirim']?>" <?php if($sel['no_order'].'_'.$sel['id_daerah'].'_'.$sel['shipto_code'].'_'.$sel['jenis_kirim']==$_GET['spb']){echo "selected";}?>><?=$sel['no_order'].' - '.$sel['nama_cabang'].' - '.$sel['shipto_code'].' - '.$sel['tgl']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
                                    <?php }elseif($_GET['jenis']==3){?>
                                     <div class="col-lg-4">
                                     <select name="spb" id="spb" class="select-search" onChange="pindahData2(jenis.value,spb.value,'1')">
										<option value="">---Gudang---</option>
										<?php
											$query=$db->select("tx_prp_notif a join m_gudang b on a.id_gudang=b.id_gudang","a.id_gudang,b.nama_gudang","b.status='1' and a.status='0' group by id_gudang");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_gudang']?>" <?php if($sel['id_gudang']==$_GET['spb']){echo "selected";}?>><?=$sel['nama_gudang']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
                                    <?php }elseif($_GET['jenis']==1){?>
                                     <div class="col-lg-4">
                                     <select name="spb" id="spb" class="select-search" onChange="pindahData2(jenis.value,spb.value,'1')">
										<option value="">---No SO---</option>
										<?php
											if($_GET['jenisnya']==3){
												$jenju=1;	
											}if($_GET['jenisnya']==1){
												$jenju=2;	
											}
											$query=$db->select("tx_sales_order a join m_cabang b on a.id_cabang=b.id_cabang","a.no_sales,a.ship_to,a.id_cabang,b.nama_cabang,a.tgl_sales,a.id_cus,a.jenis","a.status_so='1' and a.jenis='DA' and a.jenis_jual='$jenju' and no_sales not in (select no_order from tx_prp)");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['no_sales'].'_'.$sel['id_cus'].'_'.$sel['ship_to'].'_'.$sel['jenis']?>" <?php if($sel['no_sales'].'_'.$sel['id_cus'].'_'.$sel['ship_to'].'_'.$sel['jenis']==$_GET['spb']){echo "selected";}?>><?=$sel['no_sales'].'-'.$sel['nama_cabang'].'-'.$sel['tgl_sales']?></option>
                                        <?php }?>    
									</select>
                                    </div>
                                    <?php }?>
                                    <div class="col-lg-4">
                                    <?php 
									if($_GET['jenis']==4 && $_GET['supp']==''){
										$expl=explode("_",$_GET['spb']);
										$supnya=$db->select("tx_prp","*","no_prp='$expl[0]'");
										foreach($supnya as $supar){}
										$wp=$supar['id_supp'];
									}else{
										$wp=$_GET['supp'];
									}
									?>
                                    <select name="supp" id="supp" class="select-search" onChange="pindahData3(jenis.value,spb.value,supp.value,'1')">
										<option value="">---Supplier---</option>
										<?php
											$query=$db->select("m_supplier","id_supp,nama_supp,nama_usaha,id_valuta");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_supp']?>" <?php if($sel['id_supp']==$wp){echo "selected";}?>><?=$sel['nama_usaha']?></option>
                                        <?php } ?>
                                        <?php 
											if($_GET['supp']==$sel['id_supp']){
												$valu=$sel['id_valuta'];
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
                        if($_GET['jenis']=='2'){
						$spb1=$db->select("tx_order a left join m_gudang b on a.id_gudang=b.id_gudang","a.id_gudang,a.tgl,b.nama_gudang,a.jenis","a.no_order='$spb[0]'");
					     foreach($spb1 as $valspb) {}
						}if($_GET['jenis']==4){
							$valspb['jenis']=$jenisp;	
						}if($_GET['jenis']==1){
							$valspb['jenis']=3;
						}
						?>
                    <input type="hidden" name="qty_in" id="qty_in"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
                    <input type="hidden" name="disc_in" id="disc_in"    required>
                    <input type="hidden" name="harga_in" id="harga_in"  value="0" required>
                    <input type="hidden" name="bonus_in" id="bonus_in"  value="0" required>
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" required>
                    <input type="hidden" name="tgl_kirim" id="tgl_kirim_in"  value="" required>
                    <input type="hidden" name="jenis_barang" id="jenis_barang"  value="<?=$valspb['jenis']?>" required>
                    
   		  </div>
			</form>
		</div>
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang 
                        <?php echo $title;  //echo " Tgl: ".date("d-m-Y",strtotime($valspb[tgl]))." | ".$valspb[nama_gudang];?>
                        </h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    			<div class="tabbable">
									<ul class="nav nav-tabs">
										<?php
                                        $tmp=$db->select("tx_prp_tmp a left join m_supplier b on a.id_supp=b.id_supp","a.id_supp,b.nama_supp,b.nama_usaha","a.id_user='$_SESSION[ID_LOGIN]' group by id_supp");														                                        $no=1;
										foreach($tmp as $valtmp){
										?>
                                        <li class="<?php if($no==1){echo "active";}?>">
                                        <a href="#id_<?=$valtmp['id_supp']?>" data-toggle="tab"><?php  if($valtmp['id_supp']==''){echo "Non";}else{echo $valtmp['nama_usaha'];}?>
                                        </a></li>
                                        <?php $no++;}?>
									</ul>
									<div class="tab-content">
                                    
                                    <?php 
                                        $tmp=$db->select("tx_prp_tmp a left join m_supplier b on a.id_supp=b.id_supp","a.id_supp,b.nama_supp,b.id_valuta,b.jenis_pemb,b.pkp,jenis_barang,a.jenis","a.id_user='$_SESSION[ID_LOGIN]' group by id_supp");														                                        $no=1;
										foreach($tmp as $valtmp){
											$valtmp['jenis_barang'];
									?>
                                   		 
                                    
										<div class="tab-pane <?php if($no==1){echo "active";}?>" id="id_<?=$valtmp['id_supp']?>">
                                        <form class="form-horizontal" action="index.php?x=prp" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
                                          <input type="hidden" name="aksi" id="aksi"    required>
                                          <input type="hidden" name="id2" id="id2"  value=""  required>
                                          <input type="hidden" name="jenis" id="jenis"  value="<?php echo $_GET[jenis]?>"  required>
                                          <input type="hidden" name="supp" id="supp"  value="<?php echo $_GET[supp]?>"  required>
                                          <input type="hidden" name="spb2" id="spb2"  value="<?php echo $spb[0]?>"  required>
                                          <input type="hidden" name="supp2" id="supp2"  value=""  required>
                                        	<?php
											if($valtmp['jenis_barang']==1 && $valtmp['jenis']!=1){
												include("keranjang.php");
											}elseif($valtmp['jenis_barang']==3 && $valtmp['jenis']!=1){
												include("keranjang.php");
											}elseif(($valtmp['jenis_barang']==3 && $valtmp['jenis']==1) || ($valtmp['jenis_barang']==1 && $valtmp['jenis']==1)){
												include("keranjang_semen_da.php");	
											}elseif($valtmp['jenis_barang']==4 or $valtmp['jenis_barang']==5 && $valtmp['jenis']!=1 ){
												include("keranjangnond.php");
											}
											?>  
                                    	 </form>
                                        </div>	
                                       
                                    <?php $no++;
									$valtmp['jenis_barang']="";
									}?>
                                    
									</div>
                                    
								</div>	
					</div>		
                    </div>			
</div>

<?php }?>