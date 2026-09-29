<form method="POST" name="statuskelform" id="statuskelform">
<div class="col-lg-4">
	<div class="form-group">
    
    </div>
    <div class="form-group">
	  <label class="control-label col-lg-4">Status Keluarga</label>
	  <div class="col-lg-8">
             		 <select name="statuskel" id="statuskel" class="select">
                          <option value="">---Pilih Status---</option>
                          <?php
                              $query=$db->select("hr_m_statuskel","*");
                              foreach($query as $sel){	
                          ?>
                              <option value="<?=$sel['id_statuskel']?>"><?=$sel['statuskel']?></option>
                          
                          <?php }?>    
                      </select>
             <input type="hidden" name="id_statuskel" id="id_statuskel" class="form-control" autocomplete="off" value="">
	  </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Anak</label>
ke    		 
<div class="col-lg-8">
    		   <input type="text" name="anak" id="anak" class="form-control" autocomplete="off" value="">
    		 </div>
    </div>
    <div class="form-group">
    <label class="control-label col-lg-4"></label>
                        <div class="col-lg-8">
                            <input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="savestatuskel()">
                            
        </div>
     </div> 
</div>
<div class="col-lg-8">
</div>
<table width="60%" border="1" bordercolor="#E5E5E5">
  <tr height="30px">
    <td width="40%">&nbsp;<b>Status Keluarga</b></td>
    <td><b>Anak ke</b></td>
    <td align="center"><b>Aksi</b></td>
    </tr>
  <tbody id="datastatuskel">
  		
  </tbody>
</table>

</form>