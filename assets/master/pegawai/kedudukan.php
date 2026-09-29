<style>
	td {
		padding:2px;
		
		}
</style>
<form method="POST" name="kedudukanform" id="kedudukanform" enctype="multipart/form-data">
<div class="col-lg-4">
	<div class="form-group">
    </div>
    <div class="form-group">
	  <label class="control-label col-lg-4">Cabang</label>
	  <div class="col-lg-8">
             		<select name="caba" id="caba" class="select">
                          <option value="">---Pilih cabang---</option>
                          <?php
                              $query=$db->select("m_cabang","*");
                              foreach($query as $sel){	
                          ?>
                              <option value="<?=$sel['id_cabang']?>"><?=$sel['nama_cabang']?></option>
                          
                          <?php }?>    
                      </select>
	  </div>
    </div>
    <div class="form-group">
	  <label class="control-label col-lg-4">Nama Jabatan</label>
	  <div class="col-lg-8">
             		<select name="nmjab" id="nmjab" class="select">
                          <option value="">---Pilih Jabatan---</option>
                          <?php
                              $query=$db->select("m_jabatan","*");
                              foreach($query as $sel){	
                          ?>
                              <option value="<?=$sel['id_jabatan']?>"><?=$sel['nama_jabatan']?></option>
                          
                          <?php }?>    
                      </select>
        <input type="hidden" name="id_tdjab" id="id_tdjab" class="form-control" autocomplete="off" value="">
	  </div>
    </div>
     <div class="form-group">
	  <label class="control-label col-lg-4">Nama ST Jabatan</label>
	  <div class="col-lg-8">
   		<select name="stjab" id="stjab" class="select">
                          <option value="">---Pilih ST Jabatan---</option>
                          <?php
                              $query=$db->select("hr_st_jabatan","*");
                              foreach($query as $sel){	
                          ?>
                              <option value="<?=$sel['id_st_jabatan']?>"><?=$sel['st_jabatan']?></option>
                          
                          <?php }?>    
                      </select>
	  </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Golongan</label>
    		 <div class="col-lg-8">
    		   <select name="golongan" id="golongan" class="select">
                          <option value="">---Pilih Golongan---</option>
                          <?php
                              $query=$db->select("hr_m_tingkat_golongan","*");
                              foreach($query as $sel){	
                          ?>
                              <option value="<?=$sel['id_tingkat_gol']?>"><?=$sel['tingkat_golongan']?></option>
                          
                          <?php }?>    
                      </select>
    		 </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Pangkat</label>
    		 <div class="col-lg-8">
       		   <select name="pangkat" id="pangkat" class="select">
                          <option value="">---Pilih Pangkat---</option>
                          <?php
                              $query=$db->select("hr_m_pangkat","*");
                              foreach($query as $sel){	
                          ?>
                              <option value="<?=$sel['id_pangkat']?>"><?=$sel['pangkat']?></option>
                          
                          <?php }?>    
                      </select>
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Jenis</label>
    		 <div class="col-lg-8">
       		   <select name="jenis" id="jenis" class="select">
                          <option value="">---Pilih Jenis---</option>
                          <option value="1">Demosi</option>
                          <option value="2">Promosi</option>
                          <option value="3">Mutasi</option>   
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
    		<label class="control-label col-lg-4">Tgl SK</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="tglsk" id="tglsk" class="form-control datepicker" autocomplete="off" value="">
             </div>
    </div>
     <div class="form-group">
    		<label class="control-label col-lg-4">Tgl Jabatan</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="tgljab" id="tgljab" class="form-control datepicker" autocomplete="off" value="">
             </div>
    </div>
    <div class="form-group">
    		<label class="control-label col-lg-4">Upload SK</label>
    		 <div class="col-lg-8">
       		   <input id="uploadImage" type="file" name="imagesk" />
             </div>
    </div>
     <div class="form-group">
    		<label class="control-label col-lg-4">Keterangan</label>
    		 <div class="col-lg-8">
       		   <input type="text" name="ket" id="ketk" class="form-control" autocomplete="off" value="">
             </div>
    </div>
     <div class="form-group">
    		<label class="control-label col-lg-4">Jenis Parameter</label>
    		 <div class="col-lg-8">
       		   <select name="jenpar" id="jenpar" class="select">
                          <option value=""></option>
                          <option value="1">Jabatan</option>
                          <option value="2">St Jabatan</option>
                          <option value="3">Golongan</option>   
                          <option value="4">Pangkat</option>   
                          <option value="5">Pindah Cabang</option>   
                </select>
             </div>
    </div>
    
    <div class="form-group">
    <label class="control-label col-lg-4"></label>
                        <div class="col-lg-8">
                            <input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="savekedudukan()">
                            
        </div>
     </div> 
</div>
<div class="col-lg-8">

<table width="100%" border="1" bordercolor="#E5E5E5">
  <tr height="30px">
    <td width="3%"><b>No</b></td>
    <td width="19%">&nbsp;<b>Jabatan </b></td>
    <td width="5%"><b>St Jab</b></td>
    <td width="14%"><b>Pangkat</b></td>
    <td width="6%" align="center"><b>Gol</b></td>
     <td width="9%" align="center"><b>No SK</b></td>
     <td width="7%" align="center"><b>Tgl SK</b></td>
     <td width="7%" align="center"><b>Tgl Jab</b></td>
     <td width="13%" align="center"><b>Cabang</b></td>
    <td width="9%" align="center"><b>Aksi</b></td>
    </tr>
  <tbody id="datakedudukan">
  		
  </tbody>
</table>
</div>
</form>