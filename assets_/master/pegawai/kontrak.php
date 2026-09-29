<style>
	td {
		padding:2px;
		
		}
</style>
<form method="POST" name="kontrakform" id="kontrakform">
<div class="col-lg-4">
	<div class="form-group">
    
    </div>
    <div class="form-group">
	  <label class="control-label col-lg-4">Status </label>
	  <div class="col-lg-8">
             		<select name="idstatus" id="idstatus" class="select">
                          <option value="">---Pilih Status---</option>
                          <?php
                              $query=$db->select("hr_m_kontrakpeg","*");
                              foreach($query as $sel){	
                          ?>
                              <option value="<?=$sel['id_status']?>"><?=$sel['nama_kontrak']?></option>
                          
                          <?php }?>    
                      </select>
        <input type="hidden" name="id_kontrak" id="id_kontrak" class="form-control" autocomplete="off" value="">
	  </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">NIK Honorer</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="nikhon" id="nikhon" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Jenis</label>
    		 <div class="col-lg-8">
       		   <select name="aktif" id="aktif" class="select">
                          <option value="">---Pilih Jenis---</option>
                          <option value="1">Aktif</option>
                          <option value="2">Penugasan</option>
                          <option value="3">Resign</option>   
                          <option value="4">PHK</option>   
                      </select>
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">No SK</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="nosk" id="nosk" class="form-control" autocomplete="off" value="">
             </div>
    </div>
     <div class="form-group">
    		<label class="control-label col-lg-4">Tgl Mulai</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="tglmulai" id="tglmulai" class="form-control datepicker" autocomplete="off" value="">
             </div>
    </div>
     <div class="form-group">
    		<label class="control-label col-lg-4">Tgl Akhir</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="tglakhir" id="tglakhir" class="form-control datepicker" autocomplete="off" value="">
             </div>
    </div>
     <div class="form-group">
    		<label class="control-label col-lg-4">Keterangan</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="ket" id="ketko" class="form-control" autocomplete="off" value="">
             </div>
    </div>
    
    <div class="form-group">
    <label class="control-label col-lg-4"></label>
                        <div class="col-lg-8">
                            <input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="savekontrak()">
                            
        </div>
     </div> 
</div>
<div class="col-lg-8">

<table width="100%" border="1" bordercolor="#E5E5E5">
  <tr height="30px">
    <td width="3%"><b>No</b></td>
    <td width="10%">&nbsp;<b>Jenis </b></td>
    <td width="10%"><b>Status</b></td>
    <td width="10%" align="center"><b>No SK</b></td>
     <td width="7%" align="center"><b>Tgl Mulai</b></td>
     <td width="7%" align="center"><b>Tgl Akhir</b></td>
     <td width="10%" align="center"><b>NIK</b></td>
    <td width="10%" align="center"><b>Aksi</b></td>
    </tr>
  <tbody id="datakontrak">
  		
  </tbody>
</table>
</div>
</form>