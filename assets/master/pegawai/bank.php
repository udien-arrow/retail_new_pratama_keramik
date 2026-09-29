<form method="POST" name="bankacc" id="bankacc">
<div class="col-lg-4">
	<div class="form-group">
    
    </div>
    <div class="form-group">
	  <label class="control-label col-lg-4">Nama Bank</label>
	  <div class="col-lg-8">
             		<input type="text" name="nama_bank" id="nama_bank" class="form-control" autocomplete="off" value="">
             <input type="hidden" name="idbank" id="idbank" class="form-control" autocomplete="off" value="">
	  </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">No Rekening</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="no_rek" id="no_rek" class="form-control" autocomplete="off" value="">
             </div>
    </div>
   
    <div class="form-group">
    		<label class="control-label col-lg-4">default Bank</label>
    		 <div class="col-lg-8">
       		   <select name="default">
               		<option value="ya">Ya</option>
                 <option value="no">Tidak</option>
               </select>
             </div>
    </div>
    <div class="form-group">
    <label class="control-label col-lg-4"></label>
                        <div class="col-lg-8">
                            <input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="savebank()">
                            
        </div>
     </div> 
</div>
<div class="col-lg-8">
</div>
<table width="60%" border="1" bordercolor="#E5E5E5">
  <tr height="30px">
    <td width="40%">&nbsp;<b>Nama Bank</b></td>
    <td><b>No Rekening</b></td>
    <td align="center"><b>Default</b></td>
    <td align="center"><b>Aksi</b></td>
    </tr>
  <tbody id="dataacc">
  		
  </tbody>
</table>

</form>