<table width="2000px" border="1" cellpadding="0" cellspacing="0" id="example5">
    <tr height="30px">
          <td width="5%"align="center" >No</td>
          <td align="center" width="15%" ><b>Nama</b></td>
          <td align="center" width="8%" ><b>Tgl Kontrak</b></td>
          <td align="center" width="8%" ><b>Periode</b></td>
          <td align="center" width="8%" ><b>Periode Dibayar</b></td>
          <td align="center" width="8%" ><b>Masa Kerja <?php if($_GET['jen']==1){echo "(tahun)";}else{echo "(bulan)";}?></b></td>
          <td align="center" width="8%" ><b>Gaji Pokok</b></td>
          <td align="center" width="8%" ><b>Tunjangan Tetap</b></td>
          <td align="center" width="8%" ><b>Insentif Presensi</b></td>
          <td align="center" width="8%" ><b>Total</b></td>
          <td align="center" width="8%" ><b>Faktor Kali</b></td>
          <td align="center" width="8%" ><b>Jumlah Bonus</b></td>
          <td align="center" width="8%" ><b>Pot Pelanggaran</b></td>
          <td align="center" width="8%" ><b>Pot Lain</b></td>
          <td align="center" width="8%" ><b>Jumlah Terima</b></td>
          <td align="center" width="8%" ><b>Cetak</b></td>
          </tr>
        <?php
		if($_GET[tahun]!='' && $_GET[jen]!=''){
			$kon=$db->select("hr_bonus a 
			left join m_pegawai b on a.id_pegawai=b.id_pegawai","a.*,b.nama_pegawai","year(a.periode)='$_GET[tahun]' and a.jenis='$_GET[jen]'");
		}
        $no=1;
        foreach($kon as $d){ 
		$jumlah=$jumlah+$d['jumlah_terima'];
		$totals=$totals+$d['total']; 
		?>
    <tr>
          <td align="center"  ><?php echo $no?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo ucfirst(strtolower($d['nama_pegawai']));?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['tgl_kontrak'];?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['periode'];?></td>
           <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['periode_dibayar'];?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['masa_kerja'];?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo number_format($d['gaji_pokok']);?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo number_format($d['tunjangan_tetap']);?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo number_format($d['insentif_presensi']);?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo number_format($d['total']);?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['faktor_kali'];?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">&nbsp;</td>
           <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?php echo number_format($d['pot_pelanggaran']);?></td>
           <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?php echo number_format($d['pot_lain']);?></td>
           <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?php echo number_format($d['jumlah_terima']);?></td>
           <td align="center" bgcolor="FFFFCC" class=""  style="cursor:pointer"  onMouseOut="this.style.backgroundColor='#FFFFCC';"><a href='javascript:void(0)' onClick=window.open('cetak.php?page=bonus&id=<?=$d[id_pegawai]?>&jenis=1&tahun=<?=$_GET[tahun]?>') class='icon-printer2' style='cursor:pointer'></a></td>
           
          </tr>
        <?php $no++;} ?>
        <tr>
        <td colspan="9"></td>
        <td align="right"><?php echo number_format($totals);?></td>
        <td colspan="4"></td>
        <td align="right"><?php echo number_format($jumlah);?></td>
        </tr>
</table>