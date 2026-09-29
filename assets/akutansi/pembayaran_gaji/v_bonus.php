<table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
	<thead>
    <tr height="30px" bgcolor="#EBEBEB">
    	<th rowspan="2" width="1%"><input type="checkbox" name="select-all" id="select-all" /></th>
          <th width="1%" rowspan="2"align="center" ><b>No</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Periode</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Jumlah Bonus</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Pot Pelanggaran</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Pot Lain2</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Jumlah Terima</b></th>
    </tr>
    </thead> 
    <tbody> 
      <?php $hr=$db->select("hr_bonus","
			sum(jumlah_bonus) AS jumlah_bonus,
			sum(pot_pelanggaran) AS pot_pelanggaran,
			sum(pot_lain) AS pot_lain,
			periode,
			jenis,
			sum(jumlah_terima) AS jumlah_terima","status='1' and jenis='$_GET[jenisnya]' group by periode");
		$no=1;
		$as=0;
	  foreach($hr as $hor){ ?>    
  <tr>
  <td width="5px"><input type="checkbox" class="control-primary" name="app[]" id="app[]" value="<?=$hor['periode']?>"></td>
  <td align="right"><?=$no?></td>
  <td align="right">
  <input type="hidden" name="periodes[]" value="<?=$hor['periode']?>">
  <a data-toggle="modal" id="mod" data-target="#datapelanggan" onClick="detilbon('<?=$hor[periode]?>','<?=$hor[jenis]?>')"><?=$hor['periode']?></a></td>
  <td align="right"><?=number_format($hor['jumlah_bonus'])?>
  <input type="hidden" name="jumlah_bonus[]" value="<?=$hor['jumlah_bonus']?>">
  </td>
  <td align="right"><?=number_format($hor['pot_pelanggaran'])?>
  <input type="hidden" name="pot_pelanggaran[]" value="<?=$hor['pot_pelanggaran']?>">
  </td>
  <td align="right"><?=number_format($hor['pot_lain'])?>
  <input type="hidden" name="pot_lain[]" value="<?=$hor['pot_lain']?>">
  </td>
  <td align="right"><?=number_format($hor['jumlah_terima'])?>
  <input type="hidden" name="jumlah_terima[]" value="<?=$hor['jumlah_terima']?>">
  <input type="hidden" name="jenisnya1[]" value="<?=$hor['jenis']?>">
  </td>
  </tr>
  <?php 
  $as+=$hor['jumlah_terima'];
  $no++;}  ?><br>
  <tr>
  <td colspan="6px" align="right">Total</td>
  <td align="right"><?=number_format($as)?></td>
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