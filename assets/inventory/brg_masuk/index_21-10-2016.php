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
		if($_GET[spb]==''){
			$sp='spj';	
		}elseif($_GET[spj]==''){
			$sp='spb';
		}

if($_POST[simpan]){
	include("simpan2.php");
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_brg_masuk_tmp",$where);
	echo "<script>window.location='index.php?x=brg_masuk&jenis=$_POST[jenis_in]&$sp=$_POST[id_in]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array(
			"id_user" => $_SESSION['ID_LOGIN'],
			"id_gudang" => $_SESSION['ID_GUDANG']
			);
	$db->delete("tx_brg_masuk_tmp",$where);
	echo "<script>window.location='index.php?x=brg_masuk&jenis=$_POST[jenis_in]&$sp=$_POST[id_in]'</script>";
}else{
?>	
<div class="col-lg-6">
		<form action="index.php?x=brg_masuk_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input <?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Penerimaan" onClick="window.location='index.php?x=brg_masuk_v'"></button></li>
							</ul>
                        </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th colspan="7">
                                <div class="form-group" >
                                   <div class="col-lg-3">
                                    <select name="jenis" id="jenis" class="select" onChange="pindahData(jenis.value)">
                                      <option value="0">---Jenis---</option>
                                   <!--   <option value="5" <?php //if($_GET['jenis']==5){echo "selected";}?>>Non Semen Upload</option>--> 
                                      <option value="1" <?php if($_GET['jenis']==1){echo "selected";}?>>Non Semen</option> 
                                     <option value="2" <?php if($_GET['jenis']==2){echo "selected";}?>>Semen</option>   
                                     <option value="3" <?php if($_GET['jenis']==3){echo "selected";}?>>Barang (-SO)</option>   															<!--<option value="6" <?php //if($_GET['jenis']==6){echo "selected";}?>>Alat</option>
                                     <option value="7" <?php //if($_GET['jenis']==7){echo "selected";}?>>Sparepart</option>  -->
                                    </select>
                                  </div> 
                                    <?php if($_GET['jenis']==1){?>
                                    <div class="col-lg-7">
                                    <select name="spb" id="spb" class="select-search" onChange="pindahData2(jenis.value,spb.value)">
										<option value="">---No PO---</option>
										<?php
											$query=$db->select("tx_po","no_po,no_prp,tgl_po,no_jwa","status=1 and id_gudang='$_SESSION[ID_GUDANG]' and st_upload=0");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['no_po'].'_'.$sel['no_prp']?>" <?php if($sel['no_po'].'_'.$sel['no_prp']==$_GET['spb']){echo "selected";}?>><?=$sel['no_po']." - ".date("Y-m-d",strtotime($sel['tgl_po']))." - ".$sel['no_jwa']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
                                    <?php }elseif($_GET['jenis']==6){ ?>
                                     <div class="col-lg-7">
                                    <select name="spb" id="spb" class="select-search" onChange="pindahData2(jenis.value,spb.value)">
										<option value="">---No PO---</option>
										<?php
											$query=$db->select("tx_po","no_po,no_prp,tgl_po","status=1 and id_gudang='$_SESSION[ID_GUDANG]' and jenis_p='4'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['no_po'].'_'.$sel['no_prp']?>" <?php if($sel['no_po'].'_'.$sel['no_prp']==$_GET['spb']){echo "selected";}?>><?=$sel['no_po']." - ".date("Y-m-d",strtotime($sel['tgl_po']))?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
                                    <?php }elseif($_GET['jenis']==7){ ?>
                                     <div class="col-lg-7">
                                    <select name="spb" id="spb" class="select-search" onChange="pindahData2(jenis.value,spb.value)">
										<option value="">---No PO---</option>
										<?php
											$query=$db->select("tx_po","no_po,no_prp,tgl_po","status=1 and id_gudang='$_SESSION[ID_GUDANG]' and jenis_p='5'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['no_po'].'_'.$sel['no_prp']?>" <?php if($sel['no_po'].'_'.$sel['no_prp']==$_GET['spb']){echo "selected";}?>><?=$sel['no_po']." - ".date("Y-m-d",strtotime($sel['tgl_po']))?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
                                    <?php }elseif($_GET['jenis']==2){?>
                                    
                                    <div class="col-lg-4">
                                    <select name="spj" id="spj" class="select-search" onChange="pindahData22(jenis.value,spj.value)">
										<option value="">---No SPJ---</option>
                                        <option value="all">---All SPJ---</option>
										<?php
											$query=$db->select("v_spj_rilis","no_spj,no_so,line_item,so_date,no_polisi,tgl_spj","id_gudang='$_SESSION[ID_GUDANG]' and status_tx=1  and no_spj not in (select no_spj from tx_spj_relokasi where status<2) and st_upload_dtl=1");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['no_so'].'_'.$sel['no_spj'].'_'.$sel['line_item']?>" <?php if($sel['no_so'].'_'.$sel['no_spj'].'_'.$sel['line_item']==$_GET['spj']){echo "selected";}?>><?=$sel['no_so'].' - '.$sel['no_spj'].' - '.$sel['tgl_spj'].' - '.$sel['no_polisi']?></option>
                                        <?php }?>
									</select>
                                     </div>
                                    
                                     <div class="col-lg-4" id="allspj" style="display:none">
                                    <select name="spj2" id="spj2" class="select-search">
										<option value="">---No SPJ---</option>
                                        <?php
											$query=$db->select("v_spj_rilis","no_spj,no_so,line_item,id_gudang,id_barang,qty_do","id_gudang<>'$_SESSION[ID_GUDANG]' and no_spj not in (select no_spj from tx_spj_relokasi where status<2) and status_tx=1");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['no_so'].'_'.$sel['no_spj'].'_'.$sel['id_gudang'].'_'.$sel['id_barang'].'_'.$sel['qty_do']?>"><?=$sel['no_so'].' - '.$sel['no_spj']?></option> 
                                        <?php }?>    
									</select>
                                    </div>
                                     <div class="col-lg-0" style="display:none" id="allspj2">
                                    <input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="save(spj2.value)" >
                                    </div>
                                    </div>
                                    
                                    <?php }elseif($_GET['jenis']==3){?>
                                    <div class="col-lg-4">
                                    <select name="spm" id="spm" class="select-search" onChange="pindahData222(jenis.value,spm.value)">
										<option value="">---No PM---</option>
										<?php
											$query=$db->select("tx_bm_order","no_order,no_spj,tgl","status=2 and id_gudang='$_SESSION[ID_GUDANG]'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['no_order'].'_'.$sel['no_spj']?>" <?php if($sel['no_order'].'_'.$sel['no_spj']==$_GET['spm']){echo "selected";}?>><?=$sel['no_order'].' - '.$sel['no_spj'].' - '.$sel['tgl']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
                                    <?php }elseif($_GET['jenis']==5){?>
                                    <div class="col-lg-4">
                                    <select name="spj" id="spj" class="select-search" onChange="pindahData22(jenis.value,spj.value)">
										<option value="">---No SPJ---</option>
                                        <?php
											$query=$db->select("v_spj_rilis","no_spj,no_so,line_item,so_date","id_gudang='$_SESSION[ID_GUDANG]' and status_tx=1  and no_spj not in (select no_spj from tx_spj_relokasi where status<2) and st_upload_dtl=2 group by no_spj");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['no_so'].'_'.$sel['no_spj'].'_'.$sel['line_item']?>" <?php if($sel['no_so'].'_'.$sel['no_spj'].'_'.$sel['line_item']==$_GET['spj']){echo "selected";}?>><?=$sel['no_so'].' - '.$sel['no_spj'].' -'.$sel['so_date']?></option>
                                        <?php }?>
									</select>
                                     </div>
                                    <?php }?> 
                                </th>
                              <th><a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                            <tr>
                                <th width="10%">Kode</th>
                                <th width="80%">Nama Barang</th>
                              	<th width="5%">Satuan</th>
                              	<th width="5%">Qty <?php if($_GET['spb']){echo 'Pesan';}elseif($_GET['spj']){echo 'DO';}?></th>
                                <th width="5%">Bonus</th>
                                <th width="5%">Qty Terima</th>
                                <th width="5%"> claim Utuh</th>
                                <th width="5%">Reject /claim Ktg</th>
                            </tr>                           
                       </thead>
            </table>
                    <?php
					if($_GET['spb']!=''){
						$explod=explode("_",$_GET['spb']);
						$po=$db->select("tx_po","id_supp,id_valuta,kurs,id_po,id_prp,disc_persen","no_po='$explod[0]'");
						foreach($po as $valpo){}
					}if($_GET['spj']!=''){
						$explod=explode("_",$_GET['spj']);
						$po=$db->select("v_spj_rilis","id_supp","no_spj='$explod[1]'");						foreach($po as $valpo){}
					}if($_GET['spm']!=''){
						$explod=explode("_",$_GET['spm']);
						$po=$db->select("tx_bm_order","id_supp","no_order='$explod[0]'");						foreach($po as $valpo){}
					}
					
					?>
		   			<input type="hidden" name="id_supp" id="id_supp"  value="<?=$valpo[id_supp]?>"  required>
            		<input type="hidden" name="id" id="id"  value="<?php if($_GET[spb]!=''){echo $_GET[spb];}elseif($_GET[spj]!=''){echo $_GET[spj];}elseif($_GET[spm]!=''){echo $_GET[spm];}?>"  required>
           			<input type="hidden" name="id_valuta" id="id_valuta"  value="<?php if($_GET[spb]==''){echo '1';}elseif($_GET[spj]==''){echo $valpo[id_valuta];}?>"  required>
                    <input type="hidden" name="kurs" id="kurs" value="<?php if($_GET[spb]==''){echo '1';}elseif($_GET[spj]==''){echo $valpo[kurs];}?>"   required>
                    <input type="hidden" name="id_po" id="id_po" value="<?=$valpo[id_po]?>"   required>
                    <input type="hidden" name="id_prp" id="id_prp" value="<?=$valpo[id_prp]?>"   required>
                     <input type="hidden" name="jenis_in" id="jenis_in" value="<?=$_GET[jenis]?>"   required>
                      <input type="hidden" name="disc_persen" id="disc_persen" value="<?=$valpo[disc_persen]?>"   required>
                    
           			 <input type="hidden" name="tambah_in" id="tambah_in" value=""   required>
   		  </div>
			</form>
		</div>
         
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Penerimaan Barang
						</h5>
					</div>
                    <div class="dataTables_wrapper">
                    <div class="table-responsive pre-scrollable">
                   
					<div class="panel-body">
                    	<div class="tabbable">
                          <form class="form-horizontal" action="index.php?x=brg_masuk" name="formku" id="formku" method="post">
                              <?php include("keranjang.php"); ?>  
                          </form>
                         </div>	
					</div>		
                    </div>			
</div>

<?php }?>