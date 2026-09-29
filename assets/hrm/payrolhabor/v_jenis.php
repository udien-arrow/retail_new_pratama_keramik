<table width="100%" border="1" cellpadding="0" cellspacing="0" class="scrolls">
	<thead>
    <tr height="30px" bgcolor="#EBEBEB">
          <td width="1%"align="center" ><b>No</b></td>
          <td width="5%" align="center" ><b>Kode</b></td>
          <td width="15%" align="center" ><b>Nama</b></td>
          <td width="5%" align="center" ><b>Aktif</b></td>
          <td width="5%" align="center" ><b>Status</b></td>
          <td width="8%" align="center" ><b>Jabatan</b></td>
          <td width="8%" align="center" ><b>Cabang</b></td>
          <td width="8%" align="center" ><b>Gaji Pokok</b></td>
          <td width="8%" align="center" ><b>Masuk Kerja</b></td>
          <td width="8%" align="center" ><b>Gaji Penerimaan</b></td>
          <td width="8%" align="center" ><b>Jumlah Lembur</b></td>
          <td width="8%" align="center" ><b>Lembur</b></td>
          <td width="8%" align="center" ><b>Total Penerimaan</b></td>
     </tr>
    </thead>     
        <?php
		if($_GET['bulan']!='' && $_GET['bulan']!=''){
			$kon=$db->select("m_pegawai a 
			left join m_cabang b on a.id_cabang=b.id_cabang
			left join m_jabatan c on a.id_jabatan=c.id_jabatan
			","a.id_pegawai,a.nik,a.nama_pegawai,b.nama_cabang,a.id_cabang,a.id_jabatan,c.nama_jabatan","a.id_cabang!='99' and a.id_status=4 and a.id_cabang='$_SESSION[ID_CABANG]'");
		}
        $no=1;
       foreach($kon as $d){  
		?>
    <tr>
          <td align="center"  bgcolor="#EBEBEB"><?=$no?></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['nik']?><input type="hidden" name="id_pegawai[<?=$no?>]" value="<?=$d['id_pegawai']?>"></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['nama_pegawai']?></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;">
	      <?php 
		    $ak['nama_kon']='';
		    $ak['nama_kontrak']='';
		    $ak1['pangkat']='';
			$ak1['st_jabatan']='';
			$ak1['tingkat_golongan']='';
			$ak1['id_tingkat_gol']='';
			$ak4['nilaidasar']='';
			$ak4['nilai_index']='';
			$ak2['statuskel']='';
		    $ak1['id_st_jabatan']='';
			$ak1['id_pangkat']='';
			$tpre['nominal']='';
			$ins['nominal']='';
			$tfu['nominal']='';
			$tju['nominal']='';
			$penm['nominal']='';
		  	$ak['id_aktif']='';
			$ak['id_status']='';
			$gp='';$tu='';$tr='';$tf='';$tp='';$tpn='';$to='';$tjm='';$tjk='';
			
		   foreach($db->select("hr_kontrakpeg a left join hr_m_kontrakpeg b on a.id_status=b.id_status","case a.id_aktif when '1' then 'Aktif' when '2' then 'Penugasan' when '3' then 'Resign' when '4' then 'PHK' end as nama_kon,b.*,a.id_aktif,a.id_status","a.id_pegawai='$d[id_pegawai]' order by a.tglmulai desc limit 0,1")as $ak);
		   echo $ak['nama_kon'];
		   ?>
	      <input type="hidden" name="id_aktif[<?=$no?>]" value="<?=$ak['id_aktif']?>"></td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo ucfirst(strtolower($ak['nama_kontrak']));?>
          <input type="hidden" name="id_status[<?=$no?>]" value="<?=$ak['id_status']?>"></td>
          <td align="left" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $d['nama_jabatan'];?></td>
          <td align="left" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo ucfirst(strtolower($d['nama_cabang']));?>
          <input type="hidden" name="id_cabang[<?=$no?>]" value="<?=$d['id_cabang']?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;">
           <?php 
		   foreach($db->select("hr_upah_harian","nominal_bulan,nominal_hari,nominal_lembur","id_cabang='$d[id_cabang]' and id_jabatan='$d[id_jabatan]'")as $gp2);
		   
		   echo number_format($gp=$gp2['nominal_bulan'],0);
		   ?>
           <input type="hidden" name="gaji_pokok[<?=$no?>]" value="<?=$gp?>">
           </td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">
	      <?php 
		  if($_GET['bulan']==01){
				$thn=$_GET['tahun']-1;
				$bln="01";
		  }else{
			 	$thn=$_GET['tahun'];
				$bln=sprintf("%02s",$_GET['bulan']-1);
		  } 
		  $tglawal=$thn.'-'.$bln.'-26';
		  $tglakhir=$thn.'-'.$_GET['bulan'].'-27';
		  $jum=count($db->select("hr_absensi","id_pegawai","id_pegawai='$d[id_pegawai]' and date between '$tglawal' and '$tglakhir'"));
		   echo $jum;
		   ?></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><?php
		   echo number_format($total=$jum*$gp2['nominal_hari']);
		   ?>
          <input type="hidden" name="gaji_terima[<?=$no?>]" value="<?=$total?>"></td>
      <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">
           <?php
		   $jmsos=''; 
		   foreach($db->select("hr_lembur","sum(substr(jam,1,1))as jam","id_pegawai='$d[id_pegawai]' and date between '$tglawal' and '$tglakhir'")as $lem);
		  echo $lem['jam'];
		   ?>
      </td>
           <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"> 
           <?php
            echo number_format($lembur=$lem['jam']*$gp2['nominal_lembur'],0);
		   ?>
           <input type="hidden" name="lembur[<?=$no?>]" value="<?=$lembur?>"></td>
      <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><b><?php echo number_format($tot=$total+$lembur);?></b>
        <input type="hidden" name="jumlah_terima[<?=$no?>]" value="<?=$tot?>"></td>
  </tr>
    <?php $no++;} ?>
</table>