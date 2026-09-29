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
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_brg_keluar_tmp",$where);
	
	echo "<script>window.location='index.php?x=brgkeluar&jenis=$_POST[jenis_s]&id=$_POST[links]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_brg_keluar_tmp",$where);
	echo "<script>window.location='index.php?x=brgkeluar&jenis=$_POST[jenis_s]&id=$_POST[links]'</script>";

}else{
?>	
	
    <div class="col-lg-7">
		<form action="index.php?x=brgkeluar_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Pengeluaran Barang</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Pengeluaran Barang" onClick="window.location='index.php?x=brgkeluar_v'"></button></li>
							</ul>
                            </div>
					</div>
                     
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="6">
                        <div class="form-group" >
                        <div class="col-lg-3">
                                    
                                    <select name="jenis" id="jenis" class="select-search" onChange="pindahData2(jenis.value)">
                                      <option value="">---Jenis---</option>
                                      <option value="1" <?php if($_GET['jenis']==1){echo "selected";}?>>Transit</option>
                                      <option value="2" <?php if($_GET['jenis']==2){echo "selected";}?>>Barang Umum</option> 
                                    </select>
                                    </div>
                                    
                                  <?php if($_GET['jenis']==1){ ?>
                                  <div class="col-lg-6">
                                    <select name="id_stok" id="id_stok" class="select-search" onChange="pindahData(jenis.value,id_stok.value)">
                                      <option value="">---No Transit---</option>
                                      <?php 
									  $gudang=$db->select("tx_transit a join m_gudang b on a.id_gudang=b.id_gudang","*","a.status='1' and id_gudang_tujuan='$_SESSION[ID_GUDANG]'");
									 $exp=explode("_",$_GET['id']);
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['no_transit']."_".$val['id_gudang']?>" <?php if($exp[0]==$val['no_transit']){echo "selected";}?>> <?=$val['no_transit']." - ".$val['nama_gudang']." - ".$val['tgl']?></option> 
                                     <?php } ?>
                                    </select>
                                    </div>
                                    <?php }elseif($_GET['jenis']==2){ ?>
                                    <div class="col-lg-6">
                                    <select name="id_stok" id="id_stok" class="select-search" onChange="pindahData(jenis.value,id_stok.value)">
                                      <option value="">---No BU---</option>
                                      <?php 
									  $gudang=$db->select("tx_pengbum a join m_gudang b on a.id_gudang=b.id_gudang","*","a.status='1' and a.id_gudang='$_SESSION[ID_GUDANG]'");
									  $c=explode("_",$_GET['id']);
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['no_pengbum']."_".$val['id_gudang']?>" <?php if($c[0]==$val['no_pengbum']){echo "selected";}?>> <?=$val['no_pengbum']." - ".$val['nama_gudang']." - ".$val['tgl']?></option> 
                                     <?php } ?>
                                    </select>
                                    </div>
                                    <?php } ?>
                      </div>
                      </td>
                      </tr>
                            <tr>
                            <?php if($_GET['jenis']==1){ ?>
                              	<th width="5%">Kode</th>
                                <th width="20%">Nama Barang</th>
                                <th width="10%">Satuan</th>
                              	<th width="10%">Stok Akhir</th>
                                <th width="10%">Qty Minta</th>
                                <th width="5%">Qty Beri</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                               <?php }else{ ?>
                               <th width="5%">Kode</th>
                                <th width="20%">Nama Barang</th>
                                <th width="10%">Satuan</th>
                              	<th width="10%">Stok Akhir</th>
                                <th width="10%">Qty Minta</th>
                                <th width="5%">Qty Beri</th>
                                <th width="5%">Nopol</th>
                                <th width="5%">SN</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                               <?php } ?>
                            </tr>
                        </thead>

                    </table>
                    <?php
						$jum2=$db->select("v_barang","*");
						$jum=count($jum2);
					?>
                    <input type="hidden" name="id" id="id"  value="" placeholder='id' required>               
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="qty_minta2" id="qty_minta2"  value=""  placeholder='minta' required>
                    <input type="hidden" name="gudang2" id="gudang2"  value=""  required>
                    <input type="hidden" name="qty_beri2" id="qty_beri2"  value=""  placeholder='beri' required>
                    <input type="hidden" name="hpp2" id="hpp2"  value=""  placeholder='hpp' required><br>
					<input type="hidden" name="nopol2" id="nopol2"  value=""  placeholder='nopol2' required>
                    <input type="hidden" name="sn2" id="sn2"  value=""  placeholder='sn2' required>
                    <input type="hidden" name="tipe2" id="tipe2"  value=""  placeholder='sn2' required>
                     <input type="hidden" name="satuan2" id="satuan2"  value=""  placeholder='hpp' required>
                    <input type="hidden" name="idlink" id="idlink"  value="<?=$_GET['id']?>" required>
                     <input type="hidden" name="jenis_s" id="jenis_s"  value="<?=$_GET['jenis']?>" required>

                    
   		  </div>
			</form>
		</div>
         			
	 <form class="form-horizontal" action="index.php?x=brgkeluar" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Keranjang</h5>
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
                               <div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="batal()">
										 Batal 
                                        </button>
                                        <input type="hidden" name="aksi" id="aksi"    required>
								      <input type="hidden" name="id2" id="id2"  value=""  required>
                                      <input type="hidden" name="links" id="links"  value="<?=$_GET['id']?>"  required>
                                      <input type="hidden" name="jenis_s" id="jenis_s"  value="<?=$_GET['jenis']?>" required>
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
					<div class="panel-body">
                    			 <div class="form-group">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td width="4%"align="center"><strong>No</strong></td>
                                            <td align="center" width="30%"><strong>Nama Barang</strong></td>
                                            <td width="10%"align="center"><strong>Satuan</strong></td>
                                            <td width="10%"align="center"><strong>Qty Minta</strong></td>
                                            <td width="10%" align="center"><strong>Qty Beri</strong> </td>
                                            <td width="10%" align="center"><strong>Aksi</strong></td>
                                          </tr>
                                          <?php
										  $idgud=explode("_",$_GET['id']);
										  
                                          $kon=$db->select("tx_brg_keluar_tmp a
JOIN m_barang_gudang b ON a.id_barang = b.id_barang
JOIN m_satuan c on a.sat=c.id_satuan
AND a.ke_gudang = b.id_gudang","a.id_tmp,
a.id_barang,
a.sat,
a.qty_minta,
a.id_user,
a.ke_gudang,
a.hpp,
a.qty_beri,
c.nama_satuan,
b.kode_barang,
b.nama_barang,
a.nopol,a.sn","id_user='$_SESSION[ID_LOGIN]' and b.id_gudang= $idgud[1]");
                                          $no=1;
                                          foreach($kon as $d){  ?>
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $d['kode_barang']." - ".$d['nama_barang'];?>&nbsp;</td>
                                            <td align="center"><?=$d['nama_satuan']?>&nbsp;</td>
                                            <td align="center"><?=number_format($d['qty_minta'])?>&nbsp;</td>
                                            <td align="center"><?=number_format($d['qty_beri'])?>&nbsp;</td>
                                            <td align="center"><a href="javascript:void(0)" onclick="hapus(<?php echo $d['id_tmp'];?>)">hapus</a>&nbsp;</td>
                                          </tr>
                                          <?php $no++;} ?>
                                        </table>
                                     
                                 </div>
                                  
					
					</div>	
                  
				</div>	
               
		</div>
</form>
<?php }?>
