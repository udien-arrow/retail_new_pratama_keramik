<table width="60%" border="1" bordercolor="#E5E5E5">
 
  <tr height="30px">
    <td width="40%">&nbsp;<b>Nama Bank</b></td>
    <td><b>No Rekening</b></td>
    <td align="center"><b>Jenis</b></td>
  </tr>
  <?php for($i=1;$i<=5;$i++){
	  $valdt['nama_bank']="";
	  $valdt['no_rek']="";
	  $valdt['jenis']="";
	  $valdt['id']="";
	  $dt=$db->select("m_supplier_acc","*","id_supp='$val[id_supp]' and urut='$i'");
	  foreach($dt as $valdt){	  
		  }
	  ?>
  <tr>
    <td>
      <input type="hidden" id="id_dtl_plafon" name="id_dtl_plafon[<?=$i?>]" value="<?=$valdt['id']?>">
      <input type="text" name="nama_bank[<?=$i?>]" id="nama_bank" class="form-control" autocomplete="off" value="<?=$valdt['nama_bank']?>" ></td>
    <td><input type="text" name="no_rek[<?=$i?>]" id="no_rek" class="form-control" autocomplete="off" value="<?=$valdt['no_rek']?>" ></td>
    <td><input type="text" name="jenis[<?=$i?>]" size="8" id="jenis" class="form-control" autocomplete="off" value="<?=$valdt['jenis']?>" ></td>
  </tr>
  <?php }?>
  
</table>

                                <div class="form-group">
                                </div> 
                                <div class="form-group">
                                </div>
                              