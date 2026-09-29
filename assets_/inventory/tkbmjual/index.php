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
	$dttmp=$db->select("tx_tkbm_tmp","no_masuk,id_user,no_spj,id_cabang,jenis_jual","jenis_tx='2' and id_user='$_SESSION[ID_LOGIN]' group by no_masuk");
	foreach($dttmp as $valtmp){	
	  if($valtmp['no_masuk']<>''){
		$id=$db->idurut("tx_tkbm_penjualan","id_tkbm_j");
		$data = array( 
					'id_tkbm_j' => $id, 
					'no_spj' => $valtmp['no_masuk'],
					'no_so' => $valtmp['no_spj'],
					'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
					'stampdate' => date("Y-m-d H:i:s"),
					'id_user' => $valtmp['id_user'],
					'jenis_jual' => $valtmp['jenis_jual'],
					'id_cabang' => $valtmp['id_cabang'],
					);
		$exec= $db->insert("tx_tkbm_penjualan", $data);
		//start auto jurnal total
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
				$max=$db->select("ak_jurnal","max(IDJ)as id");
				foreach($max as $val){}
				$idn=$val['id']+1;
				$datajur = array(  'IDJ' => $idn,
					   'IDKM'=> $idgen,
					   'NO_JURNAL' => $idj,
					   'DEBET' => $_POST['total'],
					   'KREDIT' => $_POST['total'],
					   'TGL_JURNAL' => date("Y-m-d"),
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_SESSION['ID_CABANG'],
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
		//end auto jurnal total
		$dttmp2=$db->select("tx_tkbm_tmp","*","no_masuk='$valtmp[no_masuk]'");
		foreach($dttmp2 as $valtmp2){
			$iddtl=$db->idurut("tx_tkbm_penjualan_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $iddtl, 
					'id_tkbm_j' => $id,
					'id_barang' => $valtmp2['id_barang'],
					'qty' => $valtmp2['qty'],
					'nilai' => $valtmp2['nilai'],
					'berat' => $valtmp2['berat'],
					'total' => $valtmp2['total'],
					'jenis_tkbm' => $valtmp2['jenis_tkbm'],
					'no_masuk' => $valtmp2['no_ref'],
					'id_jenis_kendaraan' => $valtmp2['id_jenis_kendaraan'],
					);
			$exec= $db->insert("tx_tkbm_penjualan_dtl", $data);
			include("jurnal_dtl.php");
			$where = array(	 
						"id_tmp" => $valtmp2['id_tmp']);
			$db->delete("tx_tkbm_tmp",$where);
		}
	  		  if($ttot>0){
				include("jurnal_lawan.php");
				}
	  
	  } 
	}//end if jumlah
			echo "<script>window.location='index.php?x=tkbmjual'</script>";
	
}
if($_POST[aksi]=='hapus'){
	$where = array("id_tmp" => $_POST['id2']);
	$db->delete("tx_tkbm_tmp",$where);
	
	echo "<script>window.location='index.php?x=tkbmjual&id=$_POST[links]'</script>";
}elseif($_POST[aksi]=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_tkbm_tmp",$where);
	echo "<script>window.location='index.php?x=tkbmjual&id=$_POST[links]'</script>";

}else{
?>	
	
    <div class="col-lg-6">
		<form action="index.php?x=tkbmjual_s" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Data TKBM" onClick="window.location='index.php?x=tkbmjual_v'"></button></li>
							</ul>
                            </div>
					</div>
                     
		    <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                        <tr>
                        <td colspan="5">
                        <div class="form-group" >
                                  <div class="col-lg-8">
                                    <select name="id_stok" id="id_stok" class="select-search" onChange="pindahData(id_stok.value,jenis.value)">
                                      <option value="">---No SPJ---</option>
                                      <?php 
									  $gudang=$db->select("tx_do","no_spj,no_ref,id_cabang","id_cabang='$_SESSION[ID_CABANG]' and jenis_kirim='FRC' and no_spj not in(select no_spj from tx_tkbm_penjualan)");
									  $exp=explode("_",$_GET['id']);
									  foreach($gudang as $val){
									  ?>
                                      <option value="<?=$val['no_spj']."_".$val['no_ref']."_".$val['id_cabang']?>" <?php if($exp[0]==$val['no_spj']){echo "selected";}?>> <?=$val['no_spj']." - ".$val['no_ref']?></option> 
                                     <?php } ?>
                                    </select>
                                    </div>
                                    <div class="col-lg-3">
                                    <select name="jenis" id="jenis" class="select-search" onChange="pindahData(id_stok.value,jenis.value)">
                                      <option value="1" <?php if($_GET['jenis']==1){echo "selected";}?>>FORKLIF</option> 
                                      <option value="2" <?php if($_GET['jenis']==2){echo "selected";}?>>MUAT</option> 
                                      <option value="3" <?php if($_GET['jenis']==3){echo "selected";}?>>POK</option> 
                                     </select>
                                    </div>
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-lg-1">
                                    </select>
                                    </div>
                      </div>
                      </td>
                      </tr>
                           <?php if($_GET['jenis']!='3'){?>
                            <tr>
                              	<th width="5%">Kode</th>
                                <th width="20%">Nama Barang</th>
                                <th width="10%">Satuan</th>
                              	<th width="10%">Qty</th>
                                <th width="10%">Qty Muat</th>
                                <th width="10%">Berat(kg)</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                            </tr>
                            <?php }if($_GET['jenis']=='3'){?>
                            
                            <th width="5%">Kode</th>
                                <th width="20%">Nama Barang</th>
                                <th width="10%">Satuan</th>
                              	<th width="10%">No Masuk</th>
                                <th width="10%">Qty</th>
                                <th width="10%">Qty Muat</th>
                                <th width="10%">Berat(kg)</th>
                                <th width="5%"> <a href='javascript:void(0)' onclick='tambah_all()' class='icon-add' style='cursor:pointer'></a></th>
                               </tr> 
                            <?php }?>
                        </thead>

                    </table>
                    <input type="hidden" name="tambah_in" id="tambah_in"  value="" placeholder='tambah'  required>
                    <input type="hidden" name="qty" id="qty"  value=""  placeholder='minta' required>
         			<input type="hidden" name="gabung" id="gabung"  value=""  placeholder='minta' required>           

                    
            <input type="hidden" name="kendara" id="kendara"  value=""  placeholder='minta' required>
   		  </div>
			</form>
		</div>
         			
	 <form class="form-horizontal" action="index.php?x=tkbmjual" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
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
                                  <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date("Y-m-d")?>">
                              	  </div>
                               </div>
                               <div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="batal()">
										 Batal 
                                        </button>
                                       <input type="hidden" name="links" id="links"  value="<?=$_GET['id']?>"  required>
						         <input type="hidden" name="id2" id="id2"  value=""  required>
                                 <input type="hidden" name="aksi" id="aksi"  value=""  required>
                               </div>
                                
                    </div>
                    
					<div class="panel-body">
                    			 <div class="form-group">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td width="5%"align="center"><strong>No</strong></td>
                                            <td align="center" width="15%"><strong>Jenis</strong></td>
                                            <td align="center" width="34%"><strong>Nama Barang</strong></td>
                                            <td width="12%"align="center"><strong>Truck</strong></td>
                                            <td width="8%"align="center"><strong>Qty </strong></td>
                                            <td width="8%" align="center"><strong>Nilai</strong> </td>
                                            <td width="9%" align="center"><strong>Total</strong></td>
                                            <td width="9%" align="center"><strong>Aksi</strong></td>
                                          </tr>
                                          <?php
										  $idgud=explode("_",$_GET['id']);
										  
                                          $kon=$db->select("tx_tkbm_tmp a 
										  join m_barang b on a.id_barang=b.id_barang
										  join m_satuan c on b.id_satuan=c.id_satuan
										  left join m_kendaraan d on a.id_jenis_kendaraan=d.id
										  ","a.*,b.nama_barang,c.nama_satuan,d.nopol","a.id_user='$_SESSION[ID_LOGIN]' and a.jenis_tx='2'");
                                          $no=1;
                                          foreach($kon as $d){  ?>
                                          <tr>
                                            <td align="center"><?php echo $no?>&nbsp;</td>
                                            <td><?php 
											if($d['jenis_tkbm']==1){
												echo "Forklif";
											}if($d['jenis_tkbm']==2){
												echo "Muat";
											}if($d['jenis_tkbm']==3){
												echo "POk";
											}
											?></td>
                                            <td align="left">&nbsp;<?php echo $d['nama_barang'];?>&nbsp;</td>
                                            <td align="left"><?=$d['nopol']?>&nbsp;</td>
                                            <td align="right"><?=number_format($d['qty'])?>&nbsp;</td>
                                            <td align="right"><?=$d['nilai']?>&nbsp;</td>
                                            <td align="right"><?=number_format($d['total'])?></td>
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
