
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
	//$idgen=$db->nourut('kode_price', 'm_pricelist_jual', 'PCJ', '00');
	$idgen=$db->nourut('kode_price', 'm_pricelist_jual', 'PCJ', '00', $tgl);
	$dttmp=$db->select("m_pricelist_jual_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$jumlah=count($dttmp);
	if($jumlah>0){
		$id=$db->idurut("m_pricelist_jual","id_price");
		$data = array( 
					'id_price' => $id, 
					'kode_price' => $idgen, 
					'id_cabang' => $_POST['cab'],
					'tgl_update' => date('Y-m-d H:i:s'),
					'tgl_berlaku' => $_POST['tgl'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'status' => 1,
					'jenis' => $_POST['jenis'],
					);
		$exec= $db->insert("m_pricelist_jual", $data);
		
		foreach($dttmp as $valtmp){
			$supp=$valtmp['id_cabang'];
			$data = array( 
					'id_price' => $id, 
					'id_barang' => $valtmp['id_barang'],
					'harga' => $valtmp['harga'],
					'harga_cetak' => $valtmp['harga_cetak'],
					'sat' => $valtmp['sat'],
					);
			$exec= $db->insert("m_pricelist_jual_dtl", $data);
			$where = array("id_user" => $_SESSION['ID_LOGIN']);
			$db->delete("m_pricelist_jual_tmp",$where);
		}
		$data = array( 
					'id_cabang' => $supp, 
					);
		$exec= $db->update("m_pricelist_jual", $data,"id_price='$id'");
			
			
	}//end if jumlah
			echo "<script>window.location='index.php?x=pricel_jual'</script>";
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id" => $_POST['id2']);
	$db->delete("m_pricelist_jual_tmp",$where);
	
	echo "<script>window.location='index.php?x=pricel_jual&cab=$_POST[cab]&per=$_POST[persen]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("m_pricelist_jual_tmp",$where);
	echo "<script>window.location='index.php?x=pricel_jual'</script>";

}else{
?>	
    <div class="col-lg-6">
		<form action="index.php?x=pricel_jual_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Pricelist Penjualan</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Pricelist Jual" onClick="window.location='index.php?x=pricel_jual_v'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th colspan="6">
                                <div class="form-group" align="left">
                                <div class="col-lg-5">
                                    <select name="cab" id="cab" class="select-search" onChange="pindah(cab.value,persen.value)" >
                                      <option value="">---Pilih Cabang---</option>
                                     	<?php
											$query=$db->select("m_cabang","*","status='1'");
											foreach($query as $sel){	
			                            ?>
                                      <option value="<?=$sel['id_cabang']?>" <?php if($sel['id_cabang']==$_GET['cab']){echo "selected";}?>><?=$sel['nama_cabang']?></option> 
                                      <?php }?>    
                                    </select>
                                   </div>
                                <div class="col-lg-2">
                                    <input type="text" placeholder="%" name="persen" id="persen" class="form-control" value="<?=$_GET['per']?>">
                                   </div>
                               <div class="col-lg-1">
                                    <input type="button" placeholder="" name="Go" id="Go" class="btn btn-info" value="Go" onClick="pindah(cab.value,persen.value)" >
                                   </div>
                                   <!--<div class="col-lg-6">
                                    <a href="mod/hrd/presensi2/format_presensi.csv" ><img id="expxls" name="expxls" src="img/fineFiles/24/excel.png" alt="" width="22" height="22" border="0"  title="Format Presensi"/></a>
              <input name="file" id="file" value="" size="10" class="file-input" data-show-preview="false" type="file"> 
              						</div>-->
                                    
              
                                    
                                </div></th>
                              <th>
                              
                              </th>
                            </tr>
                            <tr>
                                <th width="5%">Id</th>
                              	<th width="70%">Nama Barang</th>
                                <th width="5%">Satuan</th>
                                <th width="5%">Hpp</th>
                              	<th width="5%">Harga</th>
                                <th width="5%">Harga Cetak</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                        </thead>

                    </table>
                    <input type="hidden" name="harga_in" id="harga_in"  value=""  required>
                    <input type="hidden" name="harga_inc" id="harga_inc"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
           			<input type="hidden" name="sat_in" id="sat_in"    required>
           			 <input type="hidden" name="tambah_in" id="tambah_in" value=""    required>
   		  </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=pricel_jual" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang Pricelist Penjualan</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                   <br>
                  <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;Tgl Berlaku</label>
                              <div class="col-lg-4">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control daterange-single" name="tgl" id="tgl" value="<?php echo date("Y-m-d")?>">
                                  </div>
                               </div>
							<div class="col-lg-4">
                              	  <div class="input-group">
                              	  <select class="select" name="jenis" id="jenis" onchange="pindahan(jenis.value,'<?=$_GET['cab']?>','<?=$_GET['per']?>')">
                                  		<option value="1" <?php if($_GET['jen']==1){echo "selected";}?>>Retail</option>
                                        <option value="2" <?php if($_GET['jen']==2){echo "selected";}?>>Grosir</option>
                                  </select>
                                  </div>
                               </div>
	
                               <div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="batal()">
										 Batal 
                                        </button>
                                        <input type="hidden" name="aksi" id="aksi"    required>
								      <input type="hidden" name="id2" id="id2"  value=""  required>
									  <input type="hidden" name="cab" id="cab"  value="<?php echo $_GET[cab]?>"  required>
                                      <input type="hidden" name="persen" id="persen"  value="<?php echo $_GET[per]?>"  required>
								</div>
                    </div>
					<div class="panel-body">
                    			
                    
                                <div class="form-group">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td width="4%"align="center"><strong>No</strong></td>
                                            <td align="center" width="50%"><strong>Nama Barang</strong></td>
                                            <td width="10%"align="center"><strong># </strong></td>
                                            <td width="10%" align="center"><strong>Harga<br>Lama</strong> </td>
                                            <td width="10%" align="center"><strong>Harga</strong></td>
                                            <td width="10%" align="center"><strong>Aksi</strong></td>
                                          </tr>
                                          <?php
										  if($_GET['jen']==''){
												$jen=1;  
										  }else{
											  $jen=$_GET['jen'];  
										  }
										  
                                          $kon=$db->select("m_pricelist_jual_tmp a 
										  left join m_barang b on a.id_barang=b.id_barang
										  left join m_satuan c on a.sat=c.id_satuan
										   ","a.id,a.harga,b.kode_barang,b.nama_barang,c.nama_satuan,(select harga f from m_pricelist_jual_dtl f join m_pricelist_jual g on f.id_price=g.id_price where g.jenis='$jen' and
 g.id_cabang=a.id_cabang and f.id_barang=a.id_barang and g.tgl_berlaku<=CURDATE() ORDER BY g.tgl_berlaku desc limit 0,1)as harga_lama","a.id_user='$_SESSION[ID_LOGIN]'");
                                          $no=1;
                                          foreach($kon as $d){  ?>
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['kode_barang']." - ".$d['nama_barang'];?>&nbsp;</td>
                                            <td align="left">&nbsp;
                                            <?=$d['nama_satuan']?></td>
                                            <td align="right"><?=number_format($d['harga_lama'])?>&nbsp;</td>
                                            <td align="right"><?=number_format($d['harga'])?>                                              &nbsp;</td>
                                            <td align="center"><a href="javascript:void(0)" onclick="hapus(<?php echo $d['id'];?>)">hapus</a>&nbsp;</td>
                                          </tr>
                                          <?php $no++;} ?>
                                        </table>
                                     
                                 </div>
                                  
					
					</div>	
                    
				</div>					
		</div>
</form>
<?php }?>