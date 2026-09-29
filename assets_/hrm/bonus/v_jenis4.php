<table width="100%" border="1" cellpadding="0" cellspacing="0" class="scrolls">
	<thead>
    <?php
    if($_GET['id']!='' && $_GET['per']!=''){
			$peri=date("Y-m-d",strtotime($_GET['per']));
			$kon=$db->select("m_pegawai","id_pegawai as pegawai,nik,nama_pegawai","id_cabang!='99' and id_aktif=1 and id_pegawai not in(select id_pegawai from hr_bonus where periode='$peri' and jenis=4)  and id_status in ('3','2')");
			$jum=count($kon);
	}
	?>
    <tr height="30px" bgcolor="#EBEBEB">
          <td width="1%"align="center" ><b>No</b></td>
          <td align="center" width="8%" ><b>Kode</b></td>
          <td align="center" width="15%" ><b>Nama</b></td>
          <td align="center" width="8%" ><b>Status </b></td>
          <td align="center" width="8%" ><b>Pangkat</b></td>
          <td align="center" width="8%" ><b>Tgl Lahir</b></td>
          <td align="center" width="8%" ><b>Cabang</b></td>
          <td align="center" width="8%" ><b>Tunjangan</b></td>
          <td align="center" width="8%" ><b>Faktor Kali</b></td>
          <td align="center" width="8%" ><b>Jumlah Bonus</b></td>
          <td align="center" width="2%" ><b>Pot <br>Pelanggaran</b></td>
          <td align="center" width="2%" ><b>Pot Lain2</b></td>
          <td align="center" width="2%" ><input type="checkbox"  value="<?=$d['nama_gudang']?>" onclick="checkedAll(<?=$jum?>)" id="call"></td>
          </tr>
       </thead>  
          
        <?php
		$sub=explode("/",$_GET['per']);;
			if($sub[0]==01){
				$thn=$sub[2]-1;
				$bln="01";
		    }else{
			 	$thn=$sub[2];
				$bln=$sub[0]-1;
		    }
		    $peraw=$thn.'-'.$bln.'-26';
		   $perak=$sub[2].'-'.$sub[0].'-27';
        $no=1;
        foreach($kon as $d){ 
			$tun_um['nominal']='';
			$tun_fung['nominal']='';
			$tun_rep['nominal']='';
			$tun_pres['nominal']='';
		 
			foreach($db->select("m_pegawai a 
			left join m_cabang b on a.id_cabang=b.id_cabang
			left join hr_param_tunjkel c on b.id_wilayah_pem=c.id_wilayah
			","a.tgl_lahir,a.id_cabang,b.nama_cabang,c.nominal","a.id_pegawai='$d[pegawai]'") as $dt2);
			
			foreach($db->select("hr_kontrakpeg a left join hr_m_kontrakpeg b on a.id_status=b.id_status","b.nama_kontrak,a.id_status","a.id_pegawai='$d[pegawai]' order by a.id_kontrak desc limit 0,1") as $kt);
			
			foreach($db->select("hr_jabatanpeg a join hr_m_pangkat b on a.id_pangkat=b.id_pangkat","a.id_pangkat,b.pangkat","a.id_pegawai='$d[pegawai]' order by a.tgl_jabat desc limit 0,1") as $kt2);
			
			$total=$dt2['nominal']*$_GET['fk'];
			if($kt2['id_pangkat']!=1){
		?>
    <tr>
          <td align="center"  bgcolor="#EBEBEB"><?=$no?></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['nik']?></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['nama_pegawai']?></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?=$kt['nama_kontrak']?>
          <input type="hidden" name="stpeg[<?=$no?>]" value="<?=$kt['nama_kontrak']?>"></td>
          <td align="left" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?=$kt2['pangkat']?></td>
          <td align="left" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?=$dt2['tgl_lahir']?>
          <input type="hidden" name="tgl_kontrak[<?=$no?>]" value="<?=$dt2['tgl_lahir']?>"></td>
          <td align="left" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?=$dt2['nama_cabang']?>
          <input type="hidden" name="idcab[<?=$no?>]" value="<?=$dt2['id_cabang']?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?=number_format($dt2['nominal']).""?>
          <input type="hidden" name="total[<?=$no?>]" value="<?=$dt2['nominal']?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?=$_GET['fk']?>
          <input type="hidden" name="faktor_kali[<?=$no?>]" value="<?=$_GET['fk']?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?=number_format($total)?>
          <input type="hidden" name="jumlah_bonus[<?=$no?>]" value="<?=$total?>"></td>
          <td align="center" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">
           <?php  
		    $potpelpr['potongan']='';
			$perak=date("Y-m-d",strtotime($_GET['per']));
		    //foreach($db->select("hr_pelanggaran","potongan","id_pegawai='$d[pegawai]' and tgl_akhir>='$perak' order by id_pelanggaran desc limit 0,1")as $potpelpr);
			foreach($db->select("hr_pelanggaran","potongan","id_pegawai='$d[pegawai]' and tgl <'$perak' and tgl_akhir>'$perak' order by id_pelanggaran desc limit 0,1")as $potpelpr);		
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
	} ?>
</table>