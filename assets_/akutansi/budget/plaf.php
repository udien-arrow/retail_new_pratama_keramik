<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	
?>

<div class="table-responsive">
<div class="table-responsive pre-scrollable">
<form action="javascript:void(0)" method="post" id="budget">
<input type="hidden" name="id_budget" id="id_budget" value="<?=$_GET['id']?>" />
<input type="hidden" name="account" id="account" value="<?=$_GET['acc']?>" />
	<table width="100%" border="0" class="table table-columned">
      <thead>
      <tr>
        <th width="6%" align="center">No</th>
        <th width="40%" align="center">Nama Cabang</th>
        <th width="25%" align="center">Jumlah</th>
        
      </tr>
      </thead>
      <tbody>
      <?php
      $c=$db->select("m_cabang a LEFT JOIN ak_budget_dtl b ON a.id_cabang=b.id_cabang","a.id_cabang,nama_cabang, b.jumlah,(select jumlah from ak_budget c where c.id_budget='$_GET[id]') as tot","id_budget='$_GET[id]'");
      $no=1;
      foreach($c as $cab){
      ?>
      <tr>
        <td><?=$no?>&nbsp;</td>
        <td><?=$cab[nama_cabang]?>&nbsp;</td>
        <td><input type="text" name="cab_<?=$cab[id_cabang]?>" id="cab_<?=$cab[id_cabang]?>" value="<?=$cab['jumlah']?>"onkeyup="hitung()"/>&nbsp;</td>
      </tr>
      <?php
        $no++;
      }
      ?>
      <tr>
        <td>&nbsp;</td>
        <td>Total&nbsp;</td>
        <td><input type="text" name="total" id="total" value="<?=$cab['tot']?>"/>&nbsp;</td>
       
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><button type="button" onclick="simpanL()" class="btn btn-primary">Save changes</button>&nbsp;</td>
      </tr>
      </tbody>
    </table>
   </form> 
</div>
</div>

<script>
//format angka/uang	
	<?php
	 $c1=$db->select("m_cabang","id_cabang");
	 foreach($c1 as $cab1){
	 echo "$(\"#cab_".$cab1[id_cabang]."\").number(true,0);\n";}
	 echo "$(\"#total\").number(true,0);\n"
	?>
function hitung(){
	var total;
	<?php
	 $c1=$db->select("m_cabang","id_cabang");
	 foreach($c1 as $cab1){
	 $tt.="Number($(\"#cab_".$cab1[id_cabang]."\").val().replace(/,/g, \"\"))+";}
	?>	
	total = <?=rtrim($tt, "+")?>;
	$("#total").val(total);
} 
function simpanL(){

	var data=$("#budget").serialize();
	$.ajax({
		  type:"post",
		  url:"page.php?x=budgets",
		  data:data,
		  success:function(data){
			   $("#comment").html(data);
				//alert(data);
				location.reload();
		  }
	});// } 
	//alert("OK");
}

</script>
