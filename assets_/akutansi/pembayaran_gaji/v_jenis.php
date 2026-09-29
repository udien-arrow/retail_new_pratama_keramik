<table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
	<thead>
    <tr height="30px" bgcolor="#EBEBEB">
    	<th><input type="checkbox" name="select-all" id="select-all" /></th>
          <th width="1%"align="center" ><b>No</b></th>
          <th width="8%" align="center" >Cabang</th>
          <th width="8%" align="center" ><b>Periode</b></th>
          <th width="8%" align="center" ><b>Gaji Bruto</b></th>
          <th width="8%" align="center" ><b>Tunj Tetap</b></th>
          <th width="8%" align="center" ><b>Tunj Tidak Tetap</b></th>
          <th width="8%" align="center" ><b>Simpan Pinjam</b></th>
          <th width="8%" align="center" ><b>Simpanan Wajib</b></th>
          <th width="8%" align="center" ><b>Pensiun</b></th>
          <th width="8%" align="center" ><b>Hutang</b></th>
          <th width="8%" align="center" ><b>Lain2</b></th>
          <th width="8%" align="center" ><b>Total</b></th>
          </tr>
    </thead> 
    <tbody> 
      <?php $hr=$db->select("hr_posting_gaji a join m_cabang b on a.id_cabang=b.id_cabang","a.id_cabang,b.nama_cabang,sum(gaji_pokok+tunj_pengabdian+ub_notebook+ub_komunikasi+ub_motor+ub_diklat+ins_cabang+rapel+lain2+jamsostek_724+tunj_sehat-potpel_pr-potpel_pf-potpel_pp) AS gaji_bruto,
	sum(tunj_umum+tunj_fungsi+tunj_repre) AS tunj_tetap,
	sum(tunj_presensi+tunj_penempatan) AS tunj_tidaktetap,
	sum(simpan_pinjam) AS simpan_pinjam,
	sum(simpanan_wajib) AS simpanan_wajib,
	sum(pensiun) AS pensiun,
	sum(hutang) AS hutang,
	sum(lain22+jamsostek_924+potbpjssehat) AS lain22,
	bulan,tahun,
	sum(jumlah_terima) AS jumlah_terima","a.status='0' group by bulan,tahun,a.id_cabang");
		$no=1;
		$as=0;
	  foreach($hr as $hor){ ?>    
  <tr>
  <td><input type="checkbox" class="control-primary" name="app[]" id="app[]" value="<?=$hor['bulan']."_".$hor['tahun']."_".$hor['id_cabang']?>"></td>
  <td align="right"><?=$no?></td>
  <td align="left"><a data-toggle="modal" id="mod" data-target="#datapelanggan" onClick="detil('<?=$hor[bulan]?>','<?=$hor[tahun]?>','<?=$hor[id_cabang]?>')"><?=$hor['nama_cabang']?></a></td>
  <td align="right"><?=$hor['bulan']."-".$hor['tahun']?></td>
  <td align="right"><?=number_format($hor['gaji_bruto'])?></td>
  <td align="right"><?=number_format($tetap=$hor['tunj_tetap'])?></td>
  <td align="right"><?=number_format($tdktetap=$hor['tunj_tidaktetap'])?></td>
  <td align="right"><?=number_format($simpin=$hor['simpan_pinjam'])?></td>
  <td align="right"><?=number_format($simwa=$hor['simpanan_wajib'])?></td>
  <td align="right"><?=number_format($pensiun=$hor['pensiun'])?></td>
  <td align="right"><?=number_format($hutang=$hor['hutang'])?></td>
  <td align="right"><?=number_format($lain=$hor['lain22'])?></td>
  <td align="right"><?=number_format($tot=$hor['gaji_bruto']+$hor['tunj_tetap']+$hor['tunj_tidaktetap']-$hor['simpan_pinjam']-$hor['simpanan_wajib']-$hor['pensiun']-$hor['hutang']-$hor['lain22'])?></td>
  </tr>
  <?php 
  $as+=$tot;
  $no++;}  ?><br>
  <tr>
  <td colspan="12" align="right">Grant Total </td>
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