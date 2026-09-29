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
          <td align="center" width="8%" ><b>Aktif</b></td>
          <td align="center" width="8%" ><b>St Pegawai</b></td>
          <td align="center" width="8%" ><b>Pangkat</b></td>
          <td align="center" width="8%" ><b>ST Jab</b></td>
          <td align="center" width="3%" ><b>Gol</b></td>
          <td align="center" width="8%" ><b>ST Kel</b></td>
          <td align="center" width="8%" ><b>Cabang</b></td>
          <td align="center" width="8%" ><b>Jumlah Kotor</b></td>
          <td align="center" width="8%" ><b>Jumlah Penerimaan</b></td>
          <td align="center" width="8%" ><b>Cetak Slip</b></td>
          </tr>
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

