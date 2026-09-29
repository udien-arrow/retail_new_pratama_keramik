    	<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit daerah</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_daerah","*","id_daerah='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=daerah_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Wilayah</label>
								   <div class="col-lg-6">
										<select class="select" name="wilayah" id="wilayah">
                                      		 <option value="">--Wilayah--</option>
											<?php
											$query=$db->select("m_wilayah","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_wilayah']?>"  <?php if($sel['id_wilayah']==$val['id_wilayah']){echo "selected";}?>><?=$sel['nama_wilayah']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                 <div class="form-group">
                                   <label class="control-label col-lg-4">Cabang</label>
								   <div class="col-lg-6">
										<select class="select-search" name="cabang" id="cabang">
                                      		 <option value="">--Cabang--</option>
											<?php
											$query=$db->select("m_cabang","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_cabang']?>"  <?php if($sel['id_cabang']==$val['id_cabang']){echo "selected";}?>><?=$sel['nama_cabang']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                 <div class="form-group">
                                   <label class="control-label col-lg-4">Area</label>
								   <div class="col-lg-6">
										<select class="select" name="area" id="area">
                                      		 <option value="">--Area--</option>
											<?php
											$query=$db->select("m_area","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_area']?>"  <?php if($sel['id_area']==$val['id_area']){echo "selected";}?>><?=$sel['nama_area']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Lokasi Gudang Cabang</label>
								   <div class="col-lg-6">
										<select class="select-search" name="gudang" id="gudang">
                                      		 <option value="">--Gudang--</option>
											<?php
											$query=$db->select("m_gudang","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_gudang']?>"  <?php if($sel['id_gudang']==$val['id_gudang']){echo "selected";}?>><?=$sel['nama_gudang']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Kode daerah</label>
									<div class="col-lg-5">
										<input type="text" name="kode2" id="kode2" class="form-control" autocomplete="off" value="<?=$val['kode_daerah']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama daerah</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_daerah']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_daerah']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=daerah'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>	
                </div>				
		</div>
        <div class="col-lg-7">
		<form action="index.php?x=daerah" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master
                        <input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example4')"></button></h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">Kode </th>
                                <th width="25%">Wilayah</th>
                                <th width="15%">Cabang</th>
                                <th width="15%">Area</th>
                             	<th width="15%">Gudang Penerima</th>
                             	<th width="12%">Daerah</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
			</form>
		</div>
       
<?php
if($_POST[aksi]=='hapus'){
	$where = array("id_daerah" => $_POST['id']);
	$db->delete("m_daerah",$where);
	echo "<script>window.location='index.php?x=daerah'</script>";
}
?>
<script>


	var tableToExcel = (function() {
		
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))

  }
})()


</script> 