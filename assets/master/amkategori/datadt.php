<?php
require( '../../../webclass.php' );
$db=new kelas;
error_reporting(0);
session_start();
?>
<table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                             	<th width="12%">Keterangan</th>
                                <th width="12%">Status</th>
                                <th width="12%">Aksi</th>
                            </tr>
                            <?php 
							$ks=$db->select("am_katagori_dtl","*","id_am='$_GET[id]'");
							foreach($ks as $ck){
							 ?>
                           	<tr>
                            	<td><?=$ck['keterangan']?></td>
                                <td><?php if($ck['status']==1){ echo "Aktif";}else{ echo "Tidak Aktif";} ?></td>
                                <td>
                                <input type="hidden" name="hapustemp" id="hapustemp" value="<?=$ck['id_tmp']?>">
                                <ul class='icons-list'><li class='text-danger-200'><a href='javascript:void(0)' onclick='hapustmp(<?=$ck[id_dtl]?>)' style='cursor:pointer' class='icon-trash'></a></li></ul></td>
                            </tr>
                            <?php } ?>
                        </thead>

</table>