<table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
	<thead>
    <tr height="30px" bgcolor="#EBEBEB">
    	<th width="2%"><input type="checkbox" name="select-all" id="select-all" /></th>
          <th width="2%"align="center" ><b>No</b></th>
          <th width="15%" align="center" ><b>Periode</b></th>
          <th width="20%" align="center" ><b>Gaji Pokok</b></th>
          <th width="20%" align="center" ><b>Lembur</b></th>
          </tr>
    </thead> 
    <tbody> 
      <?php $hr=$db->select("hr_posting_gaji_habor","sum(jumlah_terima) AS jumlah_terima,
	sum(lembur) AS lembur,
	bulan,tahun","status='0' group by bulan,tahun");
		$no=1;
		$as=0;
	  foreach($hr as $hor){ ?>    
  <tr>
  <td><input type="checkbox" class="control-primary" name="app[]" id="app[]" value="<?=$hor['bulan']."_".$hor['tahun']?>"></td>
  <td align="right"><?=$no?></td>
  <td align="right"><a data-toggle="modal" id="mod" data-target="#datapelanggan" onClick="detil2('<?=$hor[bulan]?>','<?=$hor[tahun]?>')"><?=$hor['bulan']."-".$hor['tahun']?></a></td>
  <td align="right"><?=number_format($hor['jumlah_terima'])?></td>
  <td align="right"><?=number_format($lain=$hor['lembur'])?></td>
  </tr>
  <?php 
  $as+=($hor['jumlah_terima']+$hor['lembur']);
  $no++;}  ?><br>
  <tr>
  <td colspan="4" align="right">Total </td>
  <td align="right"><?=number_format($hor['jumlah_terima'])?></td>
  </tr>
  </tbody>
</table>
<div id="datapelanggan" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h6 class="modal-title">Detil</h6>
							</div>
							<div class="modal-body" id="hahaha">
                            </div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								
							</div>
						</div>
  </div>
</div>