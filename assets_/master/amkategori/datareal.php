<?php
require( '../../../webclass.php' );
$db=new kelas;
error_reporting(0);
session_start();
?>
<table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                            	<th width="5%">No</th>
                             	<th width="12%">Keterangan</th>
                                <th width="12%">Aksi</th>
                            </tr>
                            <?php 
							$ks=$db->select("am_katagori_dtl","*","id_am='$_GET[id]'");
							$no=1;
							foreach($ks as $ck){
							 ?>
                           	<tr>
                            	<td><?=$no;?></td>
                            	<td><?=$ck['keterangan']?></td>
                                <td>
                                <input type="hidden" name="hapustemp" id="hapustemp" value="<?=$ck['id_tmp']?>">
                                <ul class='icons-list'><li class='text-danger-200'><a href='javascript:void(0)' 
                                onclick="editreal('<?=$ck[id_dtl]?>','<?=$ck[keterangan]?>')" style='cursor:pointer' class='icon-pencil7'></a></li></ul></td>
                            </tr>
                            <?php $no++; } ?>
                        </thead>

</table>