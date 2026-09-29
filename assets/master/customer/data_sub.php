<table width="100%" border="1" bordercolor="#E5E5E5">
 
  <tr height="30px">
    <td width="20%">&nbsp;<b>Nama Badan</b></td>
    <td>&nbsp;<b>Nama Sub</td>
    <td width="10%">&nbsp;<b>Fax</td>
    <td width="10%">&nbsp;<b>Telp</td>
    <td>Alamat</td>
    <td>&nbsp;<b>Faktur Pajak</td>
  </tr>
  <?php for($i=1;$i<=5;$i++){
	  $valdt['nama_sub']="";
	  $valdt['fax_sub']="";
	  $valdt['entitas_usaha_sub']="";
	  $valdt['telp1_sub']="";
	  $valdt['faktur_sub']="";
	   $valdt['alamat_sub']="";
	   $valdt['id_cus_sub']="";
	  
	  $dt=$db->select("m_customer_sub","*","id_cus='$val[id_cus]' and urut='$i'");
	  foreach($dt as $valdt){
		  
		  }
	  
	  ?>
  <tr>
    <td>
      <select  class="select" title=""  name="entitas_usaha_sub[<?=$i?>]" id="entitas_usaha_sub">
        <option value="">-Pilih-</option>
        <option value="1" <?php if($valdt['entitas_usaha_sub']==1){echo "selected";}?>>PT</option>
        <option value="2" <?php if($valdt['entitas_usaha_sub']==2){echo "selected";}?>>CV</option>
        <option value="3" <?php if($valdt['entitas_usaha_sub']==3){echo "selected";}?>>Firma</option>
        <option value="4" <?php if($valdt['entitas_usaha_sub']==4){echo "selected";}?>>Perusahaan Perorangan</option>
      </select>
      <input type="hidden" id="id_dtl_sub" name="id_dtl_sub[<?=$i?>]" value="<?=$valdt['id_cus_sub']?>">
   </td>
    <td>
      <input type="text" name="nama_sub[<?=$i?>]" id="nama_sub" class="form-control" autocomplete="off" value="<?=$valdt['nama_sub']?>" >
   </td>
    <td><input type="text" name="fax_sub[<?=$i?>]" id="fax_sub" class="form-control" autocomplete="off" value="<?=$valdt['fax_sub']?>" ></td>
    <td><input type="text" name="telp1_sub[<?=$i?>]" id="telp1_sub" class="form-control" autocomplete="off" value="<?=$valdt['telp1_sub']?>" ></td>
    <td><input type="text" name="alamat_sub[<?=$i?>]" id="alamat_sub" class="form-control" autocomplete="off" value="<?=$valdt['alamat_sub']?>" ></td>
    <td>
    	<select name="faktur_sub[<?=$i?>]" id="faktur_sub" class="select">
        	<option value=""  <?php if($valdt['faktur_sub']==0){echo "selected";}?>>Tidak</option>
            <option value="1"  <?php if($valdt['faktur_sub']==1){echo "selected";}?>>Ya</option>
        	
        </select>
    </td>
  </tr>
  <?php }?>
  
</table>

                                <div class="form-group">
                                </div> 
                                <div class="form-group">
                                </div>
                              