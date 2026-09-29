<table width="100%" border="1" cellpadding="0" cellspacing="0" class="scrolls">
	<thead>
    <?php
    if($_GET['id']!=''  && $_GET['per']!=''){
			$peri=date("Y-m-d",strtotime($_GET['per']));
			$kon=$db->select("m_pegawai","id_pegawai as pegawai,nik,nama_pegawai,tgl_mulai","id_cabang!='99' and id_aktif=1 and id_pegawai not in(select id_pegawai from hr_bonus where periode='$peri' and jenis=6) and datediff('$peri',tgl_mulai)/365>=10  and id_status<4");
			$jum=count($kon);
			
	}
	?>
    <tr height="30px" bgcolor="#EBEBEB">
          <td width="1%"align="center" ><b>No</b></td>
          <td align="center" width="8%" ><b>Kode</b></td>
          <td align="center" width="15%" ><b>Nama</b></td>
          <td align="center" width="8%" ><b>Tgl PDMP</b></td>
          <td align="center" width="8%" ><b>Masa Kerja (Tahun)</b></td>
          <td align="center" width="8%" ><b>Nilai (gram)</b></td>
          <td align="center" width="8%" ><b>Harga Emas</b></td>
          <td align="center" width="8%" ><b>Faktor Kali</b></td>
          <td align="center" width="8%" ><b>Jumlah Bonus</b></td>
          <td align="center" width="2%" ><b>Pot <br>Pelanggaran</b></td>
          <td align="center" width="2%" ><b>Pot Lain2</b></td>
          <td align="center" width="2%" ><input type="checkbox"  value="<?=$d['nama_gudang']?>" onclick="checkedAll(<?=$jum?>)" id="call"></td>
          </tr>
       </thead>  
        <?php
		
        $no=1;
        foreach($kon as $d){
			$tgl=date("Y-m-d",strtotime($d['tgl_mulai']));
			$tgl2=date("Y-m-d",strtotime($_GET['per']));
			
			$date1 = new DateTime($tgl);
			$date2 = new DateTime($tgl2);
			$diff = $date1->diff($date2);
			$masa=round(($diff->days/365),2);
			
			
			if($masa<$_GET['fk']){
				$fak=$masa;	
			}else{
				$fak=$_GET['fk'];	
			}
			
			foreach($db->select("hr_param_ikbat","*","masa_kerja_akhir>'$masa' and masa_kerja<'$masa'") as $dt2);
			$jum=$fak*$dt2['nominal']*$_GET['ne'];
			//echo $masa.'_'.$fak.'_'.$jum.'_'.$dt2['nominal'].'_'.$_GET['ne'];
		?>
    <tr>
          <td align="center"  bgcolor="#EBEBEB"><?=$no?></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['nik']?></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['nama_pegawai']?></td>
          <td align="left" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?=$d['tgl_mulai']?>
          <input type="hidden" name="tgl_kontrak[<?=$no?>]" value="<?=$d['tgl_mulai']?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?=$masa.""?>
          <input type="hidden" name="masa_kerja[<?=$no?>]" value="<?=$masa?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?=number_format($dt2['nominal']).""?>
          <input type="hidden" name="nilaitanda[<?=$no?>]" value="<?=$dt2['nominal']?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?=number_format($_GET['ne']).""?>
          <input type="hidden" name="total[<?=$no?>]" value="<?=$_GET['ne']?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?=$fak?>
          <input type="hidden" name="faktor_kali[<?=$no?>]" value="<?=$_GET['fk']?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?=number_format($jum)?>
          <input type="hidden" name="jumlah_bonus[<?=$no?>]" value="<?=$jum?>"></td>
          <td align="center" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">
           <?php  
		    $potpelpr['potongan']='';
			$perak=date("Y-m-d",strtotime($_GET['per']));
		    foreach($db->select("hr_pelanggaran","potongan","id_pegawai='$d[pegawai]' and tgl_akhir>='$perak' order by id_pelanggaran desc limit 0,1")as $potpelpr);	
		   ?>
           <input type="text" name="potpel[<?=$no?>]" id="potpel[<?=$no?>]" value="<?php echo $jum*$potpelpr['potongan']/100;	?>" size="6" class="harga"></td>
           <td align="center" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3';">
           
           <input type="text" name="potlain[<?=$no?>]" id="potlain[<?=$no?>]" value="0" size="6" class="harga"></td>
          <td align="center" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><input type="checkbox"  name="id_pegawai[<?=$no?>]" id="split<?=$no?>" value="<?=$d['pegawai']?>"></td>
         
  </tr>
    <?php $no++;
			}
	 ?>
</table>