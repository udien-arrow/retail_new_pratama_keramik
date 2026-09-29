<form method="POST" name="pendidikanform" id="pendidikanform">
<div class="col-lg-4">
	<div class="form-group">
    
    </div>
    <div class="form-group">
	  <label class="control-label col-lg-4">Nama Pendidikan</label>
	  <div class="col-lg-8">
             		<input type="text" name="nama_pend" id="nama_pend" class="form-control" autocomplete="off" value="">
             <input type="hidden" name="id_pend" id="id_pend" class="form-control" autocomplete="off" value="">
	  </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Tempat</label>
    		 <div class="col-lg-8">
    		   <input type="text" name="tempat" id="tempat" class="form-control" autocomplete="off" value="">
    		 </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Tahun Awal</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="tahun_awal" id="tahun_awal" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Tahun Akhir</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="tahun_akhir" id="tahun_akhir" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Jurusan</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="jurusan" id="jurusan" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Universitas</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="universitas" id="universitas" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Nomor Ijazah</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="nomor_ijazah" id="nomor_ijazah" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Tanggal Lulus</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="tgl_lulus" id="tgl_lulus" class="form-control datepicker" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Nilai</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="nilai" id="nilai" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Keterangan</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="ket" id="ketp" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    <label class="control-label col-lg-4"></label>
                        <div class="col-lg-8">
                            <input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="savependidikan()">
                            
        </div>
     </div> 
</div>
<div class="col-lg-8">
</div>
<table width="60%" border="1" bordercolor="#E5E5E5">
  <tr height="30px">
    <td width="40%">&nbsp;<b>Nama Pendidikan </b></td>
    <td><b>Tempat</b></td>
    <td align="center"><b>Tahun Awal</b></td>
     <td align="center"><b>Tahun Akhir</b></td>
     <td align="center"><b>Jurusan</b></td>
     <td align="center"><b>Universitas</b></td>
     <td align="center"><b>Nomor Ijazah</b></td>
     <td align="center"><b>Tgl Lulus</b></td>
     <td align="center"><b>Nilai</b></td>
     <td align="center"><b>Keterangan</b></td>
    <td align="center"><b>Aksi</b></td>
    </tr>
  <tbody id="datapendidikan">
  		
  </tbody>
</table>

</form>