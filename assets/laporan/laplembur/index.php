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
		<form action="index.php?x=lembur_s" id="form_index" method="post">
   		  <div class="panel panel-flat" >
		    <div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Laporan Lembur Pegawai" onClick="window.location='index.php?x=lembur_v'"></button></li>
							</ul>
                            </div>
                     </div>
            <div class="dataTables_wrapper">
                    </div><br>
                    <?php include("bulantahun.php");?>
                 <input type="button" class="btn btn-info" name="go" id="go" value="Go" onclick="pindahData(tahun.value,bulan.value,cabang.value)">
                 <input type="submit" class="btn btn-info" name="simpan" id="simpan" value="Simpan" >
                   
                   <br>
                   <div class="panel-body scrolls">
                   <div class="form-group">
					<table id="example4" width="100%" border="1" cellpadding="0" cellspacing="0" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer scrolls">
                    <thead>
    <tr height="30px" bgcolor="#EBEBEB">
          <td align="center" width="5%" ><b>Nik</b></td>
          <td align="center" width="5%" ><b>ACNO</b></td>
          <td align="center" width="20%" ><b>Nama</b></td>
          <td align="center" width="10%" ><b>Date</b></td>
          <td align="center" width="8%" ><b>ClockOut</b></td>
          <td align="center" width="8%" ><b>Off Duty</b></td>
          <td align="center" width="8%" ><b>Att Time</b></td>
          <td align="center" width="8%" ><b>Lembur</b></td>
          <td align="center" width="2%" ><b>
            <input type="checkbox" id="call">
          </b></td>
          </tr>
        </thead>
</table>
                    </div>
      </div>
   		  </div>
			</form>
		</div>

