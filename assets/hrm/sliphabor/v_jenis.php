<table id="example4" width="100%" border="1" cellpadding="0" cellspacing="0" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer scrolls">
    <tr height="30px" bgcolor="#EBEBEB">
          <td width="1%"align="center" ><b>No</b></td>
          <td align="center" width="15%" ><b>Kode</b></td>
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
          </tr>
        <?php
		if($_GET['bulan']!='' && $_GET['bulan']!=''){
			$kon=$db->select("hr_posting_gaji s 
			left join m_pegawai a on a.id_pegawai=s.id_pegawai
			left join m_cabang b on a.id_cabang=b.id_cabang
			","a.id_pegawai,a.nik,a.nama_pegawai,b.nama_cabang,s.jumlah_terima,s.jumlah_kotor","a.id_cabang!='99'");
		}
        $no=1;
       foreach($kon as $d){  
		?>
    <?php $no++;} ?>
</table>