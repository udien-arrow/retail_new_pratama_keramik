<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	session_start();
	
?>
<div class="table-responsive">
<div class="table-responsive pre-scrollable">
<form method="POST" name="tambah" id="tambah">
   <div class="form-group">
<p> &nbsp; <b>Data</b></p>
<div id="datareal">
<table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                            	<th width="5%">No</th>
                             	<th width="12%">Keterangan</th>
                            </tr>
                            <?php 
							$ks=$db->select("am_model a join am_katagori b on a.ID_AKATAGORI=b.ID_AKATAGORI JOIN am_katagori_dtl c on b.ID_AKATAGORI=c.id_am","c.keterangan,
c.id_am","ID_AMODEL='$_GET[id]'");
							$no=1;
							foreach($ks as $ck){
							 ?>
                           	<tr>
                            	<td><?=$no;?></td>
                            	<td><?=$ck['keterangan']?></td>
                            </tr>
                            <?php $no++; } ?>
                        </thead>

</table>
</div>

</div>
</form>