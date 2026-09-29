<form method="POST" name="pengalamanform" id="pengalamanform">
<div class="col-lg-4">
	<div class="form-group">
    
    </div>
    <div class="form-group">
	  <label class="control-label col-lg-4">Nama Perusahaan</label>
	  <div class="col-lg-8">
             		<input type="text" name="nama_peru" id="nama_peru" class="form-control" autocomplete="off" value="">
             <input type="hidden" name="id_peru" id="id_peru" class="form-control" autocomplete="off" value="">
	  </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Tahun Mulai</label>
    		 <div class="col-lg-8">
    		   <input type="text" name="tahun_mulai" id="tahun_mulai" class="form-control" autocomplete="off" value="">
    		 </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Tahun Akhir</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="tahun_akhir" id="tahun_akh" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Bagian</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="bagian" id="bagian" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Jabatan</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="jabatan" id="jabat" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    
   
    <div class="form-group">
    <label class="control-label col-lg-4"></label>
                        <div class="col-lg-8">
                            <input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="savepengalaman()">
                            
        </div>
     </div> 
</div>
<div class="col-lg-8">
</div>
<table width="60%" border="1" bordercolor="#E5E5E5">
  <tr height="30px">
    <td width="40%">&nbsp;<b>Nama Perusahaan</b></td>
    <td><b>Tahun Awal</b></td>
    <td align="center"><b>Tahun Akhir</b></td>
     <td align="center"><b>Bagian</b></td>
     <td align="center"><b>Jabatan</b></td>
     <td align="center"><b>Aksi</b></td>
    </tr>
  <tbody id="datapengalaman">
  		
  </tbody>
</table>

</form>