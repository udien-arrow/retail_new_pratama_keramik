<table width="100%" border="1" bordercolor="#E5E5E5">
 
  <tr height="30px">
    <td width="40%">&nbsp;<b>Nama Jenis</b></td>
    <td><b>Limit PKB</b></td>
    <td><b>Limit PKC</b></td>
    <td align="center"><b>Tempo Pembayaran (Hari)</b></td>
    <td align="center"><b>Tempo Pembayaran Tambahan (Hari)</b></td>
  </tr>
  <?php for($i=1;$i<=3;$i++){
	  $valdt['hubungan_keluarga']="";
	  $valdt['limit_plafon']="";
	  $valdt['tempo_normal']="";
	  $valdt['tempo_tambahan']="";
	  $valdt['tempo_pembayaran']="";
	  $valdt['limit_pkc']="";
	  $valdt['limit_pkb']="";
	  $valdt['id']="";
	  
	  $dt=$db->select("m_customer_plafon","*","id_cus='$val[id_cus]' and urut='$i'");
	  foreach($dt as $valdt){}
	  ?>
  <tr>
    <td>
      <input type="hidden" id="id_dtl_plafon" name="id_dtl_plafon[<?=$i?>]" value="<?=$valdt['id']?>">
      <select  class="select" title=""  name="jenis_plafon[<?=$i?>]" id="jenis_plafon">
        <?php if($i==1){?>
        <option value="1" <?php if($valdt['jenis_plafon']==1){echo "selected";}?>>Semen</option>
         <?php }if($i==2){?>
        <option value="2" <?php if($valdt['jenis_plafon']==2){echo "selected";}?>>Non Semen</option>
         <?php }if($i==3){?>
        <option value="3" <?php if($valdt['jenis_plafon']==3){echo "selected";}?>>Expeditur</option>
        <?php }?>
      </select>
   </td>
    <td><input type="text" name="limit_plafon[<?=$i?>]" id="limit_plafon" class="form-control limit_plafon" autocomplete="off" value="<?=$valdt['limit_pkb']?>" ></td>
    <td><input type="text" name="limit_plafon_tam[<?=$i?>]" id="limit_plafon_tam" class="form-control limit_plafon" autocomplete="off" value="<?=$valdt['limit_pkc']?>" ></td>
    <td><input type="text" name="tempo[<?=$i?>]" size="8" id="tempo" class="form-control" autocomplete="off" value="<?=$valdt['tempo_normal']?>" ></td>
    <td><input type="text" name="tempo_tam[<?=$i?>]" size="8" id="tempo_tam" class="form-control" autocomplete="off" value="<?=$valdt['tempo_tambahan']?>" ></td>
  </tr>
  <?php 
  	  
  }?>
  
</table>

                                <div class="form-group">
                                </div> 
                                <div class="form-group">
                                </div>
                              