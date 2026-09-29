<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr height="30px">
          <td width="1%"align="center" >No</td>
          <td align="center" width="15%" ><b>Nama</b></td>
          <td align="center" width="8%" ><b>Status Pegawai</b></td>
          <td align="center" width="8%" ><b>Tgl Lahir</b></td>
          <td align="center" width="8%" ><b>Periode</b></td>
          <td align="center" width="8%" ><b>Cabang</b></td>
          <td align="center" width="8%" ><b>Wilayah</b></td>
          <td align="center" width="8%" ><b>Tunjangan Keluarha</b></td>
          <td align="center" width="8%" ><b>Faktor Kali</b></td>
          <td align="center" width="8%" ><b>Jumlah Bonus</b></td>
          <td width="2%" align="center"><input type="checkbox" name="select-all" id="select-all" /></td>
          </tr>
        <?php
		
		if($_GET[tahun]!='' && $_GET[jen]!=''){
			$kon=$db->select("hr_bonus a 
			left join m_pegawai b on a.id_pegawai=b.id_pegawai
			left join m_cabang c on a.id_cabang=c.id_cabang
			left join m_wilayah d on c.id_wilayah_pem=d.id_wilayah
			","a.*,b.nama_pegawai,c.nama_cabang,d.nama_wilayah","year(a.periode)='$_GET[tahun]' and a.jenis='$_GET[jen]'");
		}
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"  ><?php echo $no?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo ucfirst(strtolower($d['nama_pegawai']));?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo ucfirst(strtolower($d['stpeg']));?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['tgl_kontrak'];?></td>
          <td bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['periode'];?></td>
          <td align="left" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['nama_cabang'];?></td>
          <td align="left" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['nama_wilayah'];?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo number_format($d['total']);?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['faktor_kali'];?></td>
          <td align="right" bgcolor="FFFFCC" class=""  style="cursor:pointer" onClick="ruwetall('<?=$d[id_pegawai]?>','<?=$_GET[tahun]?>','<?=$_GET[bulan]?>')" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?php echo number_format($d['jumlah_bonus']);?></td>
          <td>
           <?php if($d['status']==1){ }else{?>
           <input type="checkbox" class="control-primary" name="app[]" id="app[]" value="<?=$d['id_pegawai']?>">
           <?php } ?>
           </td>
          </tr>
        <?php $no++;} ?>
</table>