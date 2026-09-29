<form method="POST" name="emerform" id="emerform">
<div class="col-lg-4">
	<div class="form-group">
    
    </div>
    <div class="form-group">
	  <label class="control-label col-lg-4">Nama </label>
	  <div class="col-lg-8">
             		<input type="text" name="nama_hub" id="nama_hub" class="form-control" autocomplete="off" value="">
             <input type="hidden" name="id_hub" id="id_hub" class="form-control" autocomplete="off" value="">
	  </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Hubungan</label>
    		 <div class="col-lg-8">
       		 <select name="hub" id="hub" class="select">
             	<option value="ayah">Ayah</option>
                <option value="ibu">ibu</option>
                <option value="saudara kandung">Saudara kandung</option>
                <option value="saudara">Saudara</option>
                <option value="teman">Teman</option>
                <option value="suami">Suami</option>
                <option value="istri">Istri</option>
                <option value="anak">Anak</option>
                <option value="lain2">Lain2</option>
             </select>
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">No HP</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="no_hp" id="no_hp" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">No Telp</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="no_telp" id="no_telp" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    <label class="control-label col-lg-4"></label>
                        <div class="col-lg-8">
                            <input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="saveemer()">
                            
        </div>
     </div> 
</div>
<div class="col-lg-8">
</div>
<table width="60%" border="1" bordercolor="#E5E5E5">
  <tr height="30px">
    <td width="40%">&nbsp;<b>Nama </b></td>
    <td><b>Hubungan</b></td>
    <td align="center"><b>No Hp</b></td>
     <td align="center"><b>No Telp</b></td>
    <td align="center"><b>Aksi</b></td>
    </tr>
  <tbody id="dataemer">
  		
  </tbody>
</table>

</form>