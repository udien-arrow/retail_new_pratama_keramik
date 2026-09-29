<form method="POST" name="alamatform" id="alamatform">
<div class="col-lg-4">
	<div class="form-group">
    
    </div>
    <div class="form-group">
	  <label class="control-label col-lg-4">Alamat</label>
	  <div class="col-lg-8">
             		<input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" value="">
             <input type="hidden" name="id_alamat" id="id_alamat" class="form-control" autocomplete="off" value="">
	  </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Keterangan</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="ket" id="ket" class="form-control" autocomplete="off" value="">
             </div>
    </div>
   
    <div class="form-group">
    <label class="control-label col-lg-4"></label>
                        <div class="col-lg-8">
                            <input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="savealamat()">
                            
        </div>
     </div> 
</div>
<div class="col-lg-8">
</div>
<table width="60%" border="1" bordercolor="#E5E5E5">
  <tr height="30px">
    <td width="40%"><b>Alamat</b></td>
    <td align="center"><b>Keterangan</b></td>
    <td align="center"><b>Aksi</b></td>
    </tr>
  <tbody id="dataalamat">
  		
  </tbody>
</table>

</form>