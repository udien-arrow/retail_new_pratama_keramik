<script>
$(".datepicker").datepicker();
	 // Month and year menu
     $(".datepicker-menus").datepicker({
        changeMonth: true,
        changeYear: true
     });
     </script>
<?php
	require( '../../../webclass.php' );
	$dep='';
	$db=new kelas;
	$exp=explode("_",$_GET['id']);
	$sat=$db->select("m_barang a join m_satuan b on a.id_satuan=b.id_satuan","a.id_satuan as sat,b.nama_satuan","a.id_barang='$exp[0]'");		
	
	foreach($sat as $val){
	?>
	<option value="<?php echo $val['sat']?>"><?php echo $val['nama_satuan']?></option>
	<?php
	
	}
	
	
