    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #C4DAE7 ;
				padding:2px;
			}
			.scrolls {
				overflow-x: scroll;
				overflow-y: hidden;
				white-space:nowrap
			}
	</style>
    <div class="col-lg-1">
    </div>
    <div class="col-lg-10">
		<form action="index.php?x=payrol_s" id="form_index" method="post">
   		  <div class="panel panel-flat" >
		    <div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
                        <ul class="icons-list">
							<li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example44')"></button></li>
                         </ul>
                            </div>
                     </div>
            <div class="dataTables_wrapper">
                    </div><br>
                    <?php include("bulantahun.php");?><input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData(tahun.value,tahunsd.value)">
                   
                   <br>
                   <div class="panel-body scrolls">
                   <div class="form-group">
					<table id="example44" width="100%" border="1" cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover dataTable no-footer scrolls">
    <thead>
    <tr height="30px" bgcolor="#EBEBEB">
          <td align="center" width="10%" ><b>Kode</b></td>
          <td align="center" width="15%" ><b>Nama</b></td>
          <td align="center" width="8%" ><b>Gol</b></td>
          <td align="center" width="8%" ><b>St Jab</b></td>
          <td align="center" width="8%" ><b>Jabatan</b></td>
          <td align="center" width="8%" ><b>Status</b></td>
          <?php
		  for($i=$_GET['tahun'];$i<=$_GET['tahunsd'];$i++){
          ?>
          <td align="center" width="8%" >Jun <?=$i?>
          </td>
          <td align="center" width="8%" >Des <?=$i?>
          </td>
          <?php }?>
          <td align="center" width="8%" >Rata2
          </td>
          </tr>
    </thead>
    <?php 
	$dat=$db->select("m_pegawai a 
	left join m_jabatan b on a.id_jabatan=b.id_jabatan
	left join hr_st_jabatan c on a.id_st_jabatan=c.id_st_jabatan
	left join hr_m_kontrakpeg d on a.id_status=d.id_status
	","a.*,b.nama_jabatan,c.st_jabatan,d.nama_kontrak","a.id_status<=3 and a.id_aktif<5");
	foreach($dat as $ardate){
	?>    
    <tr height="30px" bgcolor="#EBEBEB">
      <td align="center" ><?=$ardate['nik']?></td>
      <td align="left" ><?=$ardate['nama_pegawai']?></td>
      <td align="left" >
      <?php
	  $hh['tingkat_golongan']='';
      foreach($db->select("hr_jabatanpeg a join hr_m_tingkat_golongan b on a.id_tingkat_gol=b.id_tingkat_gol","a.id_tingkat_gol,b.tingkat_golongan","a.id_pegawai='$ardate[id_pegawai]' order by a.tgl_jabat desc limit 0,1")as $hh);
	  echo $hh['tingkat_golongan'];
	  ?>
      </td>
      <td align="left" ><?=$ardate['st_jabatan']?></td>
      <td align="left" ><?=$ardate['nama_jabatan']?></td>
      <td align="left" ><?=$ardate['nama_kontrak']?></td>
     <?php
	 $dt2['nilai']='';
	 $dt22['nilai']='';
	 $k=0;
	 $tot=0;
		  for($i=$_GET['tahun'];$i<=$_GET['tahunsd'];$i++){
          ?>
          <td align="center" width="8%">
          	<?php
				$tgl=$i.'-06-01';
            	foreach($db->select("hr_penilaian_pegawai","*","id_pegawai='$ardate[id_pegawai]' and date='$tgl'")as $dt2);
				if($dt2['nilai']!=''){
				echo $dt2['nilai'];
				$k++;
				}
			?>
          </td>
          <td align="center" width="8%">
          	<?php
				$tgl=$i.'-12-01';
            	foreach($db->select("hr_penilaian_pegawai","*","id_pegawai='$ardate[id_pegawai]' and date='$tgl'")as $dt22);
				if($dt22['nilai']!=''){
				echo $dt22['nilai'];
				$k++;
				}
				
			?>
          </td>
     <?php 
	 $tot=$tot+($dt2['nilai']+$dt22['nilai']);
	 }?>
     		<td align="center" width="8%">
     		<?php echo $tot/$k?>
            </td>
    </tr>    
    <?php }?>
</table>
                    </div>
      </div>
            <input type="hidden" name="harga_in" id="harga_in"  value=""  required>
            <input type="hidden" name="id" id="id"  value=""  required>
   			<input type="hidden" name="sat_in" id="sat_in" required>
   		  </div>
			</form>
		</div>

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