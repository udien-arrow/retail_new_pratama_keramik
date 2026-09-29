<form method="POST" name="fingernya" id="fingernya">
<input type="hidden" name="fingern" id="fingern" class="form-control" value="<?=$val['id_pegawai']?>" readonly>
<table width="60%" border="1" bordercolor="#E5E5E5">
 <tbody id="kirim">
 </tbody>
 <tr height="30px">
    <td width="10%">&nbsp;<b>No Urut</b></td>
    <td><b>Id Finger</b></td>
  </tr>
  <?php for($i=1;$i<=10;$i++){
	  $valdt['acno']="";
	  $valdt['id']="";
	  
	  $dt=$db->select("hr_finger","*","id_pegawai='$val[id_pegawai]' and urut='$i'");
	  foreach($dt as $valdt){	  
	  }
  ?>
  <tr>
    <td>
      <input type="" name="id_dtl[<?=$i?>]" id="id_dtl" class="form-control" autocomplete="off" value="<?=$valdt['id']?>" size="4" readonly >
      <input type="text" name="urut[<?=$i?>]" id="urut" class="form-control" autocomplete="off" value="<?=$i?>" size="4" readonly ></td>
    <td><input type="text" name="acno[<?=$i?>]" id="acno" class="form-control" autocomplete="off" value="<?=$valdt['acno']?>" ></td>
  </tr>
  <?php }?>
  
</table>

                                <div class="form-group">
                                </div> 
                                <div class="form-group">
                                </div>
<div class="form-group">
                        <label class="control-label col-lg-4"></label>
                        <div class="col-lg-5">
                            <input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="savefinger(fingern.value)">
                            <button class="btn btn-success" type="button" onClick="window.location='index.php?x=pegawai'">
                             Batal 
                            </button>
                        </div>
                    </div> 
</form>