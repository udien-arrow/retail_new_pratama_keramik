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
	
	include("simpan2.php");
	
}
elseif($_POST[aksi]=='hapus'){
	$where = array("id_usage" => $_POST['id2']);
	$db->delete("tx_usage_tmp",$where);
	//echo"hapus";
	echo "<script>window.location='index.php?x=pgnbrng&a=$_POST[tglku]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_usage_tmp",$where);
	echo "<script>window.location='index.php?x=pgnbrng&jenis=$_POST[jenis_s]&id=$_POST[links]'</script>";
//echo"batal";
}else{
	///echo"here";
?>	
	
    <div class="col-lg-7">
		<form action="index.php?x=pgnbrng_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Penggunaan Barang</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Penggunaan Barang" onClick="window.location='index.php?x=pgnbrng_v'"></button></li>
							</ul>
                            </div>
					</div>
                     
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="6">
                        <div class="form-group" >
                        			                            
                                    <div class="col-lg-3">
                              
                                      <div class="input-group">
                                      
                                      <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                       <?php
										$r="";
										$d="datepicker";
										if(!empty($_GET[a])){
											$r="readonly=\"readonly\"";
											$d="";
											}
		
										?>
                                      <input type="text" class="form-control <?=$d?>" name="tg" id="tg" value="<?php echo $_GET[a]?>" <?=$r?>>
                                      </div>
                               		</div>
                               		<!--
                               		<div class="col-lg-3">
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                      <input type="text" class="form-control datepicker" name="tgsd" id="tgsd" value="<?php echo $_GET[b]?>">
                                      </div>                                  
                               		</div> -->
                                    <div class="col-lg-2">
                                   
                                
                               			<input style="height:30px; line-height: 0;" type="button" class="btn btn-info" value="Cari" onClick="pindahData2(tg.value)">
                               		</div>
                      </div>
                      </td>
                      </tr>
                            
                            <tr>
                            	<th width="10%">Kode</th>
                                <th width="20%">Nama Barang</th>
                                <th width="10%">Satuan</th>
                              	<th width="15%">Total Penerimaan Barang</th>
                                <th width="10%">Sisa</th>
                                <th width="5%">Waste</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                        </thead>

                    </table>
                    <?php
						//$jum2=$db->select("v_barang","*");
						//$jum=count($jum2);
					?>
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="qty_masukku" id="qty_masukku"  value="" placeholder='qty_masuk' required>
                    
                    <input type="hidden" name="id_barangku" id="id_barangku"  value="" placeholder='id_barang' required>               
                    <input type="hidden" name="hppku" id="hppku"  value="" placeholder='hpp'  required>
                    <input type="hidden" name="wasteku" id="wasteku"  value=""  placeholder='waste' required>
                    <input type="hidden" name="sisaku" id="sisaku"  value=""  placeholder='sisa' required>
                    <input type="hidden" name="id_satuanku" id="id_satuanku"  value=""  placeholder='id_satuan' required>
                    <input type="hidden" name="tglku" id="tglku"  value="<?=$_GET[a]?>" placeholder='qty_masuk' required>
                    
                    
   		  </div>
			</form>
		</div>
         			
	<form class="form-horizontal" action="index.php?x=pgnbrng" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
    <input type="hidden" name="tglku" id="tglku"  value="<?=$_GET[a]?>" placeholder='qty_masuk' required>
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                   <br>
                  <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;Tanggal</label>
                              <div class="col-lg-4">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                   <input type="text" class="form-control daterange-single" name="tgl" id="tgl" value="<?php echo date("Y-m-d")?>">
                                   <input type="hidden" name="no_ref" id="no_ref"  value="<?php $gg=explode('_',$_GET['id']);echo $gg[0]?>"   required>
                                   <input type="hidden" name="kegudang" id="kegudang"  value="<?php $gg=explode('_',$_GET['id']);echo $gg[1]?>"   required>
                                  </div>
                               </div>
                               
                                
                    </div>
                    
					<div class="panel-body">
                    			 <div class="form-group">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <th width="10%">Kode</th>
                                            <th width="20%">Nama Barang</th>
                                            <th width="10%">Satuan</th>
                                            <th width="15%">Total Penerimaan Barang</th>
                                            <th width="10%">Sisa</th>
                                            <th width="5%">Waste</th>
                                            <th width="5%">Terpakai</th>
                                            <th width="5%">&nbsp;</th>
                                            
                                          </tr>
                                          <?php
										  $idgud=explode("_",$_GET['id']);
										  
                                          $kon=$db->select("tx_usage_tmp a
															LEFT JOIN m_barang_gudang b ON a.id_barang = b.id_barang
															LEFT JOIN m_satuan c ON a.id_satuan = c.id_satuan
															LEFT JOIN m_gudang d ON a.id_gudang = d.id_gudang",
															"a.id_usage AS id_usage,
															b.id_cabang AS id_cabang,
															a.id_gudang AS id_gudang,
															b.kode_barang AS kode_barang,
															b.nama_barang AS nama_barang,
															c.nama_satuan AS nama_satuan,
															a.qty_masuk AS qty_masuk,
															a.qty_keluar AS qty_keluar,
															a.qty_waste AS qty_waste,
															a.qty_sisa AS qty_sisa"
															,"a.id_gudang='$_SESSION[ID_GUDANG]' GROUP BY a.id_usage");
                                          $no=1;
                                          foreach($kon as $d){  ?>
                                          <tr>
                                            <!--<td align="center"><?php echo $no?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['kode_barang']." - ".$d['nama_barang'];?>&nbsp;</td>
                                            <td align="center"><?=$d['nama_satuan']?>&nbsp;</td>
                                            <td align="center"><?=number_format($d['qty_minta'])?>&nbsp;</td>
                                            <td align="center"><?=number_format($d['qty_beri'])?>&nbsp;</td>
                                            <td align="center"><a href="javascript:void(0)" onclick="hapus(<?php echo $d['id_tmp'];?>)">hapus</a>&nbsp;</td>-->
                                            <td align="center"><?=$d['kode_barang']?></td>
                                            <td align="center"><?=$d['nama_barang']?></td>
                                            <td align="center"><?=$d['nama_satuan']?></td>
                                            <td align="center"><?=number_format($d['qty_masuk'],2)?></td>
                                            <td align="center"><?=number_format($d['qty_sisa'],2)?></td>                                            
                                            <td align="center"><?=number_format($d['qty_waste'],2)?></td>
                                            <td align="center"><?=number_format($d['qty_keluar'],2)?></td>
                                            <td align="center"><a href="javascript:void(0)" onclick="hapus(<?php echo $d['id_usage'];?>,'$_GET[a]')">hapus</a>&nbsp;</td>
                                          </tr>
                                          <?php $no++;} ?>
                                        </table>
                                     
                                 </div>
                                 
                                 
                                  
					
					</div>
                    <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;Keterangan</label>
                              <div class="col-lg-4">
                              	  <div class="input-group">
                                  <textarea rows="2" cols="30" class="form-control" name="keterangan"></textarea> 
                                  </div>
                              </div>
                              
                    </div>
                  	
                    <div class="form-group">
                    	<div class="col-lg-5">
                                <input type="hidden" name="aksi" id="aksi"    required>
                                <input type="hidden" name="id2" id="id2"  value=""  required>
                                <input type="hidden" name="links" id="links"  value="<?=$_GET['id']?>"  required>
                                <input type="hidden" name="jenis_s" id="jenis_s"  value="<?=$_GET['jenis']?>" required>
                                
                                <button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
                                 Simpan 
                                </button>
                                <button class="btn btn-success" type="button" onClick="batal()">
                                 Batal 
                                </button>
                                   			
						</div>
                    </div>
                    
                    
				</div>	
               
		</div>
</form>
<?php }?>
