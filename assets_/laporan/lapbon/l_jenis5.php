<table width="100%" border="1" cellpadding="0" cellspacing="0" id="example5">
    <tr height="30px">
          <td width="1%"align="center" >No</td>
          <td align="center" width="15%" ><b>Nama</b></td>
          <td align="center" width="8%" ><b>Pangkat</b></td>
          <td align="center" width="8%" ><b>Tgl Lahir</b></td>
          <td align="center" width="8%" ><b>Periode</b></td>
          <td align="center" width="8%" ><b>Fasilitas Jabatan</b></td>
          <td align="center" width="8%" ><b>Faktor Kali</b></td>
          <td align="center" width="8%" ><b>Jumlah Bonus</b></td>
          
          </tr>
        <?php
		
		if($_GET[tahun]!='' && $_GET[jen]!=''){
			$kon=$db->select("hr_bonus a 
			left join m_pegawai b on a.id_pegawai=b.id_pegawai
			left join hr_m_pangkat c on a.id_pangkat=c.id_pangkat
			","a.*,b.nama_pegawai,c.pangkat","year(a.periode)='$_GET[tahun]' and a.jenis='$_GET[jen]'");
		}
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"  ><?php echo $no?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo ucfirst(strtolower($d['nama_pegawai']));?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['pangkat'];?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['tgl_kontrak'];?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['periode'];?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo number_format($d['total']);?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['faktor_kali'];?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?php echo number_format($d['jumlah_bonus']);?></td>
          
          </tr>
        <?php $no++;} ?>
</table>