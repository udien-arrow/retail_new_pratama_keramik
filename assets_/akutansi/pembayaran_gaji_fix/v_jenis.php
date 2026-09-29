<table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
	<thead>
    <tr height="30px" bgcolor="#EBEBEB">
    	<th rowspan="2"><input type="checkbox" name="select-all" id="select-all" /></th>
          <th width="1%" rowspan="2"align="center" ><b>No</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Periode</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Gaji Pokok</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Tunj Umum</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Tunj Repre</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Tunj Fungsi</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Ins Presensi</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Tunj Penemp</b></th>
          <?php 
		  $tj22=$db->select("hr_m_potongan_opr","*","type='2'");
		  foreach($tj22 as $tjas){
?>
          <th width="8%" rowspan="2" align="center" ><b><?=$tjas['nama_jenis']?></b></th>
          <?php }?>
          <th width="8%" rowspan="2" align="center" ><b>Jamsostek 7.24%</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Tunj Kesehatan</b></th>
         
          <th width="8%" rowspan="2" align="center" ><b>Jumlah Kotor</b></th>
          <?php 
		  $tj22=$db->select("hr_m_potongan_opr","*","type='1'");
		  foreach($tj22 as $tjas){
		  ?>
          <th width="8%" rowspan="2" align="center" ><b><?=$tjas['nama_jenis']?></b></th>
          <?php }?>
          <th width="8%" rowspan="2" align="center" ><b>Jamsostek 9.24%</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Iuran BPJS <br>kesehatan</b></th>
          <th width="8%" colspan="3" align="center" ><b>Potongan Pelanggaran</b></th>
          <th width="8%" rowspan="2" align="center" ><b>Jumlah Penerimaan</b></th>
          </tr>
    <tr>
      <td align="center" ><b>Representative</b></td>
      <td align="center" ><b>Fungsional</b></td>
      <td align="center" ><b>Presensi</b></td>
    </tr>
    </thead> 
    <tbody> 
      <?php $hr=$db->select("hr_posting_gaji","sum(gaji_pokok) AS gaji_pokok,
	sum(tunj_umum) AS tunj_umum,
	sum(tunj_fungsi) AS tunj_fungsi,
	sum(tunj_repre) AS tunj_repre,
	sum(tunj_presensi) AS tunj_presensi,
	sum(tunj_penempatan) AS tunj_penempatan,
	sum(tunj_pengabdian) AS tunj_pengabdian,
	sum(ub_notebook) AS ub_notebook,
	sum(ub_komunikasi) AS ub_komunikasi,
	sum(ub_motor) AS ub_motor,
	sum(ub_diklat) AS ub_diklat,
	sum(ins_cabang) AS ins_cabang,
	sum(rapel) AS rapel,
	sum(lain2) AS lain2,
	sum(jamsostek_724) AS jamsostek_724,
	sum(tunj_sehat) AS tunj_sehat,
	sum(jumlah_kotor) AS jumlah_kotor,
	sum(simpan_pinjam) AS simpan_pinjam,
	sum(simpanan_wajib) AS simpanan_wajib,
	sum(pensiun) AS pensiun,
	sum(hutang) AS hutang,
	sum(lain22) AS lain22,
	sum(jamsostek_924) AS jamsostek_924,
	sum(potbpjssehat) AS potbpjssehat,
	sum(potpel_pr) AS potpel_pr,
	sum(potpel_pf) AS potpel_pf,
	sum(potpel_pp) AS potpel_pp,
	bulan,tahun,
	sum(jumlah_terima) AS jumlah_terima","status='0' group by bulan,tahun");
		$no=1;
		$as=0;
	  foreach($hr as $hor){ ?>    
  <tr>
  <td><input type="checkbox" class="control-primary" name="app[]" id="app[]" value="<?=$hor['bulan']."_".$hor['tahun']?>"></td>
  <td align="right"><?=$no?></td>
  <td align="right">
  <input type="hidden" name="periodes[]" value="<?=$hor['bulan']."-".$hor['tahun']?>">
  <a data-toggle="modal" id="mod" data-target="#datapelanggan" onClick="detil('<?=$hor[bulan]?>','<?=$hor[tahun]?>')"><?=$hor['bulan']."-".$hor['tahun']?></a></td>
  <td align="right"><?=number_format($hor['gaji_pokok'])?>
  <input type="hidden" name="gaji_pokok[]" value="<?=$hor['gaji_pokok']?>">
  </td>
  <td align="right"><?=number_format($hor['tunj_umum'])?>
  <input type="hidden" name="tunj_umum[]" value="<?=$hor['tunj_umum']?>">
  </td>
  <td align="right"><?=number_format($hor['tunj_repre'])?>
  <input type="hidden" name="tunj_repre[]" value="<?=$hor['tunj_repre']?>">
  </td>
  <td align="right"><?=number_format($hor['tunj_fungsi'])?>
  <input type="hidden" name="tunj_fungsi[]" value="<?=$hor['tunj_fungsi']?>">
  </td>
  <td align="right"><?=number_format($hor['tunj_presensi'])?>
  <input type="hidden" name="tunj_presensi[]" value="<?=$hor['tunj_presensi']?>">
  </td>
  <td align="right"><?=number_format($hor['tunj_penempatan'])?>
  <input type="hidden" name="tunj_penempatan[]" value="<?=$hor['tunj_penempatan']?>">
  </td>
  <td align="right"><?=number_format($hor['tunj_pengabdian'])?>
  <input type="hidden" name="tunj_pengabdian[]" value="<?=$hor['tunj_pengabdian']?>">
  </td>
  <td align="right"><?=number_format($hor['ub_notebook'])?>
  <input type="hidden" name="ub_notebook[]" value="<?=$hor['ub_notebook']?>">
  </td>
  <td align="right"><?=number_format($hor['ub_komunikasi'])?>
  <input type="hidden" name="ub_komunikasi[]" value="<?=$hor['ub_komunikasi']?>">
  </td>
  <td align="right"><?=number_format($hor['ub_diklat'])?>
  <input type="hidden" name="ub_diklat[]" value="<?=$hor['ub_diklat']?>">
  </td>
  <td align="right"><?=number_format($hor['ins_cabang'])?>
  <input type="hidden" name="ins_cabang[]" value="<?=$hor['ins_cabang']?>">
  </td>
  <td align="right"><?=number_format($hor['rapel'])?>
  <input type="hidden" name="rapel[]" value="<?=$hor['rapel']?>">
  </td>
  <td align="right"><?=number_format($hor['lain2'])?>
  <input type="hidden" name="lain2[]" value="<?=$hor['lain2']?>">
  </td>
  <td align="right"><?=number_format($hor['ub_motor'])?>
  <input type="hidden" name="ub_motor[]" value="<?=$hor['ub_motor']?>">
  </td>
  <td align="right"><?=number_format($hor['jamsostek_724'])?>
  <input type="hidden" name="jamsostek_724[]" value="<?=$hor['jamsostek_724']?>">
  </td>
  <td align="right"><?=number_format($hor['tunj_sehat'])?>
  <input type="hidden" name="tunj_sehat[]" value="<?=$hor['tunj_sehat']?>">
  </td>
  <td align="right"><?=number_format($hor['jumlah_kotor'])?>
  <input type="hidden" name="jumlah_kotor[]" value="<?=$hor['jumlah_kotor']?>">
  </td>
  <td align="right"><?=number_format($hor['simpan_pinjam'])?>
  <input type="hidden" name="simpan_pinjam[]" value="<?=$hor['simpan_pinjam']?>">
  </td>
  <td align="right"><?=number_format($hor['simpanan_wajib'])?>
  <input type="hidden" name="simpanan_wajib[]" value="<?=$hor['simpanan_wajib']?>">
  </td>
  <td align="right"><?=number_format($hor['pensiun'])?>
  <input type="hidden" name="pensiun[]" value="<?=$hor['pensiun']?>">
  </td>
  <td align="right"><?=number_format($hor['hutang'])?>
  <input type="hidden" name="hutang[]" value="<?=$hor['hutang']?>">
  </td>
  <td align="right"><?=number_format($hor['lain22'])?>
  <input type="hidden" name="lain22[]" value="<?=$hor['lain22']?>">
  </td>
  <td align="right"><?=number_format($hor['jamsostek_924'])?>
  <input type="hidden" name="jamsostek_924[]" value="<?=$hor['jamsostek_924']?>">
  </td>
  <td align="right"><?=number_format($hor['potbpjssehat'])?>
  <input type="hidden" name="potbpjssehat[]" value="<?=$hor['potbpjssehat']?>">
  </td>
  <td align="right"><?=number_format($hor['potpel_pr'])?>
  <input type="hidden" name="potpel_pr[]" value="<?=$hor['potpel_pr']?>">
  </td>
  <td align="right"><?=number_format($hor['potpel_pf'])?>
  <input type="hidden" name="potpel_pf[]" value="<?=$hor['potpel_pf']?>">
  </td>
  <td align="right"><?=number_format($hor['potpel_pp'])?>
  <input type="hidden" name="potpel_pp[]" value="<?=$hor['potpel_pp']?>">
  </td>
  <td align="right"><?=number_format($hor['jumlah_terima'])?>
  <input type="hidden" name="jumlah_terima[]" value="<?=$hor['jumlah_terima']?>">
  </td>
  </tr>
  <?php 
  $as+=$hor['jumlah_terima'];
  $no++;}  ?><br>
  <tr>
  <td colspan="30px" align="right">Total</td>
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