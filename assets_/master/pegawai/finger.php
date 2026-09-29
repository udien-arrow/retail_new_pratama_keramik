<form method="POST" name="fingerform" id="fingerform">
<div class="col-lg-4">
	<div class="form-group">
    
    </div>
    <div class="form-group">
	  <label class="control-label col-lg-4">AC Number</label>
	  <div class="col-lg-8">
   		<input type="text" name="acno" id="acno" class="form-control" autocomplete="off" value="">
        <input type="hidden" name="idfinger" id="idfinger" class="form-control" autocomplete="off" value="">
	  </div>
    </div>
   
    <div class="form-group">
    <label class="control-label col-lg-4"></label>
                        <div class="col-lg-8">
                            <input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="savefinger()">    
        </div>
    </div> 
</div>
<div class="col-lg-8">
</div>
<table width="60%" border="1" bordercolor="#E5E5E5">
  <tr height="30px">
    <td width="13%">&nbsp;<b>No</b></td>
    <td width="63%"><b>ACNO</b></td>
    <td width="24%" align="center"><b>Aksi</b></td>
    </tr>
  <tbody id="datafinger">
  		
  </tbody>
</table>

</form>