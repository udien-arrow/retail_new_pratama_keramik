<table width="60%" border="1" bordercolor="#E5E5E5">
 
  <tr height="30px">
    <td width="40%">&nbsp;<b>Kode Ship to</b></td>
    <td><b>Nama Ship to</b></td>
    </tr>
  <?php for($i=1;$i<=5;$i++){
	  $valdt['shipto_code']="";
	  $valdt['shipto_name']="";
	  $valdt['id']="";
	  $dt=$db->select("m_customer_shipto","*","id_cus='$val[id_cus]' and urut='$i'");
	  foreach($dt as $valdt){	  
		  }
	  ?>
  <tr>
    <td>
      <input type="hidden" id="id_dtl_shipto" name="id_dtl_shipto[<?=$i?>]" value="<?=$valdt['id']?>">
      <input type="text" name="shipto_code[<?=$i?>]" id="shipto_code" class="form-control" autocomplete="off" value="<?=$valdt['shipto_code']?>" ></td>
    <td><input type="text" name="shipto_name[<?=$i?>]" id="shipto_name" class="form-control" autocomplete="off" value="<?=$valdt['shipto_name']?>" ></td>
    </tr>
  <?php }?>
  
</table>

                                <div class="form-group">
                                </div> 
                                <div class="form-group">
                                </div>
                              