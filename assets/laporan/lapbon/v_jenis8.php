<table width="100%" border="1" cellpadding="0" cellspacing="0" class="scrolls">
	<thead>
    <?php
    if($_GET['id']!='' && $_GET['per']!=''){
			$peri=date("Y-m-d",strtotime($_GET['per']));
			$kon=$db->select("m_pegawai","id_pegawai as pegawai,nik,nama_pegawai,id_status,id_cabang,id_jabatan","id_cabang!='99' and id_aktif=1 and id_status<=3 and id_pegawai not in(select id_pegawai from hr_bonus where periode='$peri' and jenis=1)");
			$jum=count($kon);
	}
	?>
    <tr height="30px" bgcolor="#EBEBEB">
          <td width="1%"align="center" ><b>No</b></td>
          <td align="center" width="8%" ><b>Kode</b></td>
          <td align="center" width="15%" ><b>Nama</b></td>
          <td align="center" width="8%" ><b>Tgl Kontrak</b></td>
          <td align="center" width="8%" ><b>Masa <br> (Tahun)</b></td>
          <td align="center" width="8%" ><b>Gaji Pokok</b></td>
          <td align="center" width="8%" ><b>Tunj Tetap</b></td>
          <td align="center" width="8%" ><b>Insentif Presensi</b></td>
          <td align="center" width="8%" ><b>Total</b></td>
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
		if($d['id_status']<=3){	
			 
			$tun_um['nominal']='';
			$tun_fung['nominal']='';
			$tun_rep['nominal']='';
			$tun_pres['nominal']='';
		 	$gp['nominal_bulan']='';
			$total=0;
			$totalall=0;
			
			foreach($db->select("hr_kontrakpeg","*","id_pegawai='$d[pegawai]' order by id_kontrak desc limit 0,1") as $dt2);
			foreach($db->select("hr_jabatanpeg","*","id_pegawai='$d[pegawai]' order by tgl_jabat desc limit 0,1") as $kd);
			foreach($db->select("hr_m_indeks_gapok order by tgl_berlaku desc limit 0,1","*") as $ix);
			foreach($db->select("hr_m_nilaidasar","*","id_tingkat_gol='$kd[id_tingkat_gol]' order by tgl_berlaku desc limit 0,1") as $ni);
			foreach($db->select("hr_m_kontrakpeg","*","id_status='$dt2[id_status]'") as $per);
			//tunjangan
			foreach($db->select("hr_tunjangan","*","id_tingkat_gol='$kd[id_tingkat_gol]' and id_tunjangan=1 order by tgl_berlaku desc limit 0,1") as $tun_um);
			foreach($db->select("hr_tunjangan","*","id_tingkat_gol='$kd[id_tingkat_gol]' and id_tunjangan=3 order by tgl_berlaku desc limit 0,1") as $tun_fung);
			foreach($db->select("hr_tunjangan","*","id_pangkat='$kd[id_pangkat]' and idm_jabatan='$kd[id_st_jabatan]' and id_tunjangan=2 order by tgl_berlaku desc limit 0,1") as $tun_rep);
			foreach($db->select("hr_tunjangan","*","id_pangkat='$kd[id_pangkat]' and idm_jabatan='$kd[id_st_jabatan]' and id_tunjangan=4 order by tgl_berlaku desc limit 0,1") as $tun_pres);
			//tunj
			if($dt2['id_aktif']==1){
				$aktf="100";	
			}else{
				$aktf="0";	
			}
			
			$gapok=(($ix['nilai_index']*$ni['nilaidasar'])*$per['gaji_pokok']/100)*$aktf/100;
			$tunjum=(($tun_um['nominal'])*$per['tunj_umum']/100)*$aktf/100;
			$tunfung=(($tun_fung['nominal'])*$per['tunj_fungsi']/100)*$aktf/100;
			$tunrepre=(($tun_rep['nominal'])*$per['tunj_repre']/100)*$aktf/100;
			$tunpres=(($tun_pres['nominal'])*$per['tunj_presensi']/100)*$aktf/100;
			$total=$tunjum+$tunfung+$tunrepre;
			$totalall=$total+$tunpres+$gapok;
		}
		if($d['id_status']==4){
			foreach($db->select("hr_upah_harian","nominal_bulan","id_cabang='$d[id_cabang]' and id_jabatan='$d[id_jabatan]'")as $gp);
			//echo $gp['nominal_bulan'].'aaaaaaaaaaaaaaaaa',$d[id_jabatan];
			$gapok=$gp['nominal_bulan'];
			$total=0;
			$totalall=$gapok;
			$tunpres=0;
			$tunpres=0;
		}
		if($d['id_status']==5){
			$gapok=0;
			$total=0;
			$totalall=0;
			$tunpres=0;
			$tunpres=0;
		}
		
		$tgl=date("Y-m-d",strtotime($dt2['tglmulai']));
			$tgl2=date("Y-m-d",strtotime($_GET['per']));
			$date1 = new DateTime($tgl);
			$date2 = new DateTime($tgl2);
			$diff = $date1->diff($date2);
			$masa=round(($diff->days/365),2);
			if($masa<$_GET['fk']){
				$fak=$masa;	
				$jum=$fak*$totalall;
			}else{
				$fak=$_GET['fk'];	
				$jum=$fak*$totalall;
			}
		
			
		?>
    <tr>
          <td align="center"  bgcolor="#EBEBEB"><?=$no?></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['nik']?></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['nama_pegawai']?></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?=$dt2['tglmulai']?>
          <input type="hidden" name="tgl_kontrak[<?=$no?>]" value="<?=$dt2['tglmulai']?>"></td>
          <td align="left" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?=$masa?>
          <input type="hidden" name="masa_kerja[<?=$no?>]" value="<?=$masa?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?=number_format($gapok)?>
          <input type="hidden" name="gaji_pokok[<?=$no?>]" value="<?=$gapok?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?=number_format($total)?>
          <input type="hidden" name="tunj_tetap[<?=$no?>]" value="<?=$total?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?=number_format($tunpres).""?>
          <input type="hidden" name="presensi[<?=$no?>]" value="<?=$tunpres?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?=number_format($totalall)?>
          <input type="hidden" name="total[<?=$no?>]" value="<?=$totalall?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?=$fak?>
          <input type="hidden" name="faktor_kali[<?=$no?>]" value="<?=$fak?>"></td>
          
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">
           <?php echo number_format($jum,0);?>
          <input type="hidden" name="jumlah_bonus[<?=$no?>]" value="<?=$jum?>" size="10" class="harga"></td>
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
    <?php $no++;} ?>
</table>