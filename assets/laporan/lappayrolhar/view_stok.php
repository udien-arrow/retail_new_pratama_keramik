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
							<li><input style="height:26px; line-height: 0;" type="button" class="btn btn-info" value="Excel"  onclick="tableToExcel('example4')"></button></li>
                         </ul>
                            </div>
                     </div>
            <div class="dataTables_wrapper">
                    </div><br>
                    <?php include("bulantahun.php");?><input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData(tahun.value,bulan.value)">
                   <br>
                   <div class="panel-body scrolls">
                   <div class="form-group">
					<table id="example4" width="100%" border="1" cellpadding="0" cellspacing="0" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer scrolls">
                    <thead>
    <tr height="30px" bgcolor="#EBEBEB">
         <td align="center" width="10%" ><b>Kode</b></td>
          <td align="center" width="15%" ><b>Nama</b></td>
          <td align="center" width="8%" ><b>Jabatan</b></td>
          <td align="center" width="8%" ><b>Kontrak</b></td>
          <td align="center" width="8%" ><b>Nama Cabang</b></td>
          <td align="center" width="8%" ><b>Jumlah Gaji</b></td>
          <td align="center" width="8%" ><b>Lembur</b></td>
          <td align="center" width="8%" ><b>Jumlah Penerimaan</b></td> </tr>
        </thead>
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