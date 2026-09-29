<table width="100%" border="1" cellpadding="0" cellspacing="0" id="example5">
    <tr height="30px">
          <td width="1%"align="center" >No</td>
          <td align="center" width="15%" ><b>Nama</b></td>
          <td align="center" width="8%" ><b>Tgl PDMP</b></td>
          <td align="center" width="8%" ><b>Periode</b></td>
          <td align="center" width="8%" ><b>Masa Kerja (Tahun)</b></td>
          <td align="center" width="8%" ><b>Nilai Emas (Gram)</b></td>
          <td align="center" width="8%" ><b>Harga Emas</b></td>
          <td align="center" width="8%" ><b>Faktor Kali</b></td>
          <td align="center" width="8%" ><b>Jumlah Bonus</b></td>
          <td width="2%" align="center"><input type="checkbox" name="select-all" id="select-all" /></td>
          </tr>
        <?php
		
		if($_GET[tahun]!='' && $_GET[jen]!=''){
			$kon=$db->select("hr_bonus a 
			left join m_pegawai b on a.id_pegawai=b.id_pegawai
			","a.*,b.nama_pegawai","year(a.periode)='$_GET[tahun]' and a.jenis='$_GET[jen]' and status='1'");
		}
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"  ><?php echo $no?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo ucfirst(strtolower($d['nama_pegawai']));?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['tgl_kontrak'];?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['periode'];?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['masa_kerja'];?></td>
      <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['nilai_tanda'];?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo number_format($d['total']);?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['faktor_kali'];?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?php echo number_format($d['jumlah_bonus']);?></td>
          
          </tr>
        <?php $no++;} ?>
</table>