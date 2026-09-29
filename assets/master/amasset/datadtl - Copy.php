<?php 
require( '../../../webclass.php' );
$db=new kelas;
error_reporting(0);
session_start();
$ce=$db->select("am_asset_dtl","*","id_asset='$_GET[id]'");
foreach($ce as $cek){}
if($_GET['id']==$cek['id_asset']){ ?>
<table class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                             	<th width="2%"><b>No</b></th>
                                <th width="15%"><b>Jenis</b></th>
                                <th width="25%"><b>Keterangan</b></th>
                            </tr>
                            <?php 
							$ks=$db->select("am_asset_dtl a join am_katagori_dtl b on a.id_kategori_dtl=b.id_dtl and a.id_kategori=b.id_am","*","a.id_asset='$_GET[id]'");
	$no=1;
							foreach($ks as $ck){
							 ?>
                           	<tr>
                            	<td><?=$no?></td>
                                <td><?=$ck['keterangan']?></td>
                                <td><?=$ck['nilai']?></td>
                            </tr>
                            <?php $no++; } ?>
                        </thead>

</table>

<?php }else{ ?>
<table class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                             	<th width="2%"><b>No</b></th>
                                <th width="15%"><b>Jenis</b></th>
                                <th width="25%"><b>Keterangan</b></th>
                            </tr>
                            <?php 
							$ks=$db->select("am_asset a
JOIN am_model b ON a.ID_AMODEL = b.ID_AMODEL
JOIN am_katagori c ON b.ID_AKATAGORI = c.ID_AKATAGORI
JOIN am_katagori_dtl d ON c.ID_AKATAGORI = d.id_am","a.ID_AMASSET,
	d.id_dtl,
	d.id_am,
	d.keterangan","a.ID_AMASSET='$_GET[id]' and d.status='1'");
	$no=1;
							foreach($ks as $ck){
							 ?>
                           	<tr>
                            	<td><?=$no?></td>
                                <td><?=$ck['keterangan']?></td>
                                <td>
                                <input type="hidden" name="relo" value="<?=$ck['ID_AMASSET']?>" class="form-control" style="width:200px">
                               <input type="hidden" name="id_kategori[]" value="<?=$ck['id_am']?>" class="form-control" style="width:200px">
                               <input type="hidden" name="id_kategori_dtl[]" value="<?=$ck['id_dtl']?>" class="form-control" style="width:200px">
                               <input type="hidden" name="id_am[]" value="<?=$ck['ID_AMASSET']?>" class="form-control" style="width:200px">
                               <input type="text" name="nilai[]" class="form-control" style="width:200px">
                               </td>
                            </tr>
                            <?php $no++; } ?>
                        </thead>

</table><br>
 <div class="form-group">
									<label class="control-label col-lg-5"></label>
										<input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="simpan1()">
								</div>  
<?php } ?>