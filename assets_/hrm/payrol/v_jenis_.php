<table width="100%" border="1" cellpadding="0" cellspacing="0" class="scrolls">
	<thead>
    <tr height="30px" bgcolor="#EBEBEB">
          <td width="1%" rowspan="2"align="center" ><b>No</b></td>
          <td width="15%" rowspan="2" align="center" ><b>Kode</b></td>
          <td width="15%" rowspan="2" align="center" ><b>Nama</b></td>
          <td width="10%" rowspan="2" align="center" ><b>Aktif</b></td>
          <td width="8%" rowspan="2" align="center" ><b>St Pegawai</b></td>
          <td width="8%" rowspan="2" align="center" ><b>Pangkat</b></td>
          <td width="8%" rowspan="2" align="center" ><b>ST Jab</b></td>
          <td width="3%" rowspan="2" align="center" ><b>Gol</b></td>
          <td width="8%" rowspan="2" align="center" ><b>ST Kel</b></td>
          <td width="8%" rowspan="2" align="center" ><b>Cabang</b></td>
          <td width="8%" rowspan="2" align="center" ><b>Gaji Pokok</b></td>
          <td width="8%" rowspan="2" align="center" ><b>Tunj Umum</b></td>
          <td width="8%" rowspan="2" align="center" ><b>Tunj Repre</b></td>
          <td width="8%" rowspan="2" align="center" ><b>Tunj Fungsi</b></td>
          <td width="8%" rowspan="2" align="center" ><b>Ins Presensi</b></td>
          <td width="8%" rowspan="2" align="center" ><b>Tunj Penemp</b></td>
          <?php 
		  $tj22=$db->select("hr_m_potongan_opr","*","type='2'");
		  foreach($tj22 as $tjas){
?>
          <td width="8%" rowspan="2" align="center" ><b><?=$tjas['nama_jenis']?></b></td>
          <?php }?>
          <td width="8%" rowspan="2" align="center" ><b>Jamsostek 7.24%</b></td>
          <td width="8%" rowspan="2" align="center" ><b>Tunj Kesehatan</b></td>
         
          <td width="8%" rowspan="2" align="center" ><b>Jumlah Kotor</b></td>
          <?php 
		  $tj22=$db->select("hr_m_potongan_opr","*","type='1'");
		  foreach($tj22 as $tjas){
		  ?>
          <td width="8%" rowspan="2" align="center" ><b><?=$tjas['nama_jenis']?></b></td>
          <?php }?>
          <td width="8%" rowspan="2" align="center" ><b>Jamsostek 9.24%</b></td>
          <td width="8%" rowspan="2" align="center" ><b>Iuran BPJS <br>kesehatan</b></td>
          <td width="8%" colspan="3" align="center" ><b>Potongan Pelanggaran</b></td>
          <td width="8%" rowspan="2" align="center" ><b>Jumlah Penerimaan</b></td>
          </tr>
    <tr height="30px" bgcolor="#EBEBEB">
      <td align="center" ><b>Representative</b></td>
      <td align="center" ><b>Fungsional</b></td>
      <td align="center" ><b>Presensi</b></td>
    </tr>
       </thead>  
          
        <?php
		if($_GET['bulan']!='' && $_GET['bulan']!=''){
			$kon=$db->select("m_pegawai a left join m_cabang b on a.id_cabang=b.id_cabang LEFT JOIN hr_kontrakpeg c on a.id_pegawai=c.id_pegawai","a.id_pegawai,a.nik,a.nama_pegawai,b.nama_cabang,a.id_cabang","a.id_cabang!='99' and a.id_status<=3 and c.id_aktif='1' GROUP BY a.id_pegawai ORDER BY c.tglmulai DESC ");
		}
        $no=1;
		$s=0;
		$gp=0;
		$st=0;
		$str=0;
		$tr=0;
		$tu=0;
		$stf=0;
		$stpn=0;
		$stjk=0;
       foreach($kon as $d){  
	   $hari=cal_days_in_month(CAL_GREGORIAN,$_GET['bulan'],$_GET['tahun']);
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
			
		   foreach($db->select("hr_kontrakpeg a left join hr_m_kontrakpeg b on a.id_status=b.id_status","case a.id_aktif when '1' then 'Aktif' when '2' then 'Penugasan' when '3' then 'Resign' when '4' then 'PHK' when '5' then 'Tidak Aktif' end as nama_kon,b.*,a.id_aktif,a.id_status","a.id_pegawai='$d[id_pegawai]' order by a.tglmulai desc limit 0,1")as $ak);
		   echo $ak['nama_kon'];
		   ?>
	      <input type="hidden" name="id_aktif[<?=$no?>]" value="<?=$ak['id_aktif']?>">
          <!--aktif-->
          </td>
          <td bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo ucfirst(strtolower($ak['nama_kontrak']));?>
          <input type="hidden" name="id_status[<?=$no?>]" value="<?=$ak['id_status']?>"></td>
          <td align="left" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;">
		    <?php 
			foreach($db->select("hr_jabatanpeg a 
		   left join hr_m_pangkat b on a.id_pangkat=b.id_pangkat
		   left join hr_st_jabatan c on a.id_st_jabatan=c.id_st_jabatan
		   left join hr_m_tingkat_golongan d on a.id_tingkat_gol=d.id_tingkat_gol
		   ","a.id_pangkat,a.id_st_jabatan,b.pangkat,c.st_jabatan,d.tingkat_golongan,a.id_tingkat_gol","a.id_pegawai='$d[id_pegawai]' order by a.tgl_jabat desc limit 0,1")as $ak1);
		   echo ucfirst(strtolower($ak1['pangkat']));
		   ?>
          <input type="hidden" name="id_pangkat[<?=$no?>]" value="<?=$ak1['id_pangkat']?>"></td>
          <td align="left" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo $ak1['st_jabatan'];?>
          <input type="hidden" name="id_st_jabatan[<?=$no?>]" value="<?=$ak1['id_st_jabatan']?>"></td>
          <td align="left" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;">
		   <?php 
		   $gol=$db->select("hr_m_tingkat_golongan","*","id_tingkat_gol='$ak1[id_tingkat_gol]'");
		   foreach($gol as $gil){}
		    ?>
		   <?php echo $gil['tingkat_golongan'];?>

          <input type="hidden" name="id_golongan[<?=$no?>]" value="<?=$ak1['id_tingkat_gol']?>"></td>
          <td align="left" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;">
            <?php 
			$ak2['id_statuskel']='';
		   foreach($db->select("hr_statuskel a 
		   left join hr_m_statuskel b on a.id_statuskel=b.id_statuskel
		   ","b.statuskel,a.id_statuskel","a.id_pegawai='$d[id_pegawai]' order by a.tglinput desc limit 0,1")as $ak2);
		   
		   echo $ak2['statuskel'];
		   ?>
            <input type="hidden" name="id_statuskel[<?=$no?>]" value="<?=$ak2['id_statuskel']?>">
           </td>
          <td align="left" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?php echo ucfirst(strtolower($d['nama_cabang']));?>
          <input type="hidden" name="id_cabang[<?=$no?>]" value="<?=$d['id_cabang']?>"></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;">
           <?php 
		   foreach($db->select("hr_m_indeks_gapok order by tgl_berlaku desc limit 0,1","nilai_index")as $ak3);
		   foreach($db->select("hr_m_nilaidasar","nilaidasar","id_tingkat_gol='$ak1[id_tingkat_gol]' order by tgl_berlaku desc limit 0,1")as $ak4);
		   
		   if($ak['id_aktif']==1){$aktif=100; }else{$aktif=0;}
		   $kontr=$ak['gaji_pokok']; 
		   $gp=(($ak4['nilaidasar']*$ak3['nilai_index'])*$kontr/100)*$aktif/100;
		   
		   $ck=$db->select("hr_kontrakpeg","*","id_pegawai='$d[id_pegawai]' and id_status<='3' ORDER BY tglmulai ASC LIMIT 0,1");
		   foreach($ck as $cak){
			   }
			 
			 $datetime1 = new DateTime($cak['tglmulai']);
			$datetime2 = new DateTime(date("$_GET[tahun]-$_GET[bulan]-27"));
			$difference = $datetime1->diff($datetime2);
			$hasil=$difference->days;
			if($hasil<'20'){
				$s=$gp*($hasil/$hari);
			}elseif($hasil>='20'){
				$s=$gp;	
			}
		   echo number_format($s,0);
		   ?>
           
           
           <input type="hidden" name="gaji_pokok[<?=$no?>]" value="<?=$s?>">
           </td>
           <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;">
           <?php 
		   foreach($db->select("hr_tunjangan","nominal","id_tingkat_gol='$ak1[id_tingkat_gol]' and id_tunjangan='1' order by tgl_berlaku desc limit 0,1")as $tju);
		   $kontr_um=$ak['tunj_umum'];
		   $tu=(($tju['nominal'])*$kontr_um/100)*$aktif/100;
		   
		   if($hasil<'20'){
				$st=$tu*($hasil/$hari);
			}elseif($hasil>='20'){
				$st=$tu;	
			}
		   //tunjangan umum
		   echo number_format($st,0);
		   ?>
           
           <input type="hidden" name="tunj_umum[<?=$no?>]" value="<?=$st?>">
           </td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;">
           <?php 
		   foreach($db->select("hr_tunjangan","nominal","id_pangkat='$ak1[id_pangkat]' and  idm_jabatan='$ak1[id_st_jabatan]' and id_tunjangan='2' order by tgl_berlaku desc limit 0,1")as $tpre);
		   $kontr_pre=$ak['tunj_repre'];
		   $tr=(($tpre['nominal'])*$kontr_pre/100)*$aktif/100;
		   
		   if($hasil<'20'){
				$str=$tr*($hasil/$hari);
			}elseif($hasil>='20'){
				$str=$tr;	
			}
		   
		  //tunjangan repre
		   echo number_format($str,0);
		   ?>
           <input type="hidden" name="tunj_repre[<?=$no?>]" value="<?=$str?>">
           </td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">
          <?php 
		   foreach($db->select("hr_tunjangan","nominal","id_tingkat_gol='$ak1[id_tingkat_gol]' and id_tunjangan='3' order by tgl_berlaku desc limit 0,1")as $tfu);
		   $kontr_tfu=$ak['tunj_fungsi'];
		   $tf=(($tfu['nominal'])*$kontr_tfu/100)*$aktif/100;
		   if($hasil<'20'){
				$stf=$tf*($hasil/$hari);
			}elseif($hasil>='20'){
				$stf=$tf;	
			}
		   
		  //tunjangan fungsi
		   
		   echo number_format($stf,0);
		   ?>
          <input type="hidden" name="tunj_fungsi[<?=$no?>]" value="<?=$stf?>">
           </td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">
           <?php 
		   foreach($db->select("hr_tunjangan","nominal","id_pangkat='$ak1[id_pangkat]' and  idm_jabatan='$ak1[id_st_jabatan]' and id_tunjangan='4' order by tgl_berlaku desc limit 0,1")as $ins);
		   $kontr_ins=$ak['tunj_presensi'];
		   echo number_format($tp=(($ins['nominal'])*$kontr_ins/100)*$aktif/100,0);
		   ?>
            <input type="hidden" name="ins_presensi[<?=$no?>]" value="<?=$tp?>">
           </td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">
           <?php 
		   foreach($db->select("hr_tunjangan","nominal","id_cabang='$d[id_cabang]' and id_tunjangan='5' order by tgl_berlaku desc limit 0,1")as $penm);
		   $kontr_penm=$ak['tunj_penem'];
		   $tpn=(($penm['nominal'])*$kontr_penm/100)*$aktif/100;
		   if($hasil<'20'){
				$stpn=$tpn*($hasil/$hari);
			}elseif($hasil>='20'){
				$stpn=$tpn;	
			}
		   
		  //tunjangan penm
		   
		   
		   echo number_format($stpn,0);
		   ?>
           <input type="hidden" name="tunj_penempatan[<?=$no?>]" value="<?=$stpn?>">
           </td>
          <?php 
		  $tj22=$db->select("hr_m_potongan_opr","*","type='2'");
		  
		  if($_GET['bulan']==01){
				$thn=$_GET['tahun']-1;
				$bln="01";
		  }else{
			 	$thn=$_GET['tahun'];
				$bln=sprintf("%02s", $_GET['bulan']-1);
		  }
		  $per=$thn.'-'.$bln.'-1';
		  
		  $tgl1=$thn.'-'.$bln.'-26';
		  $tgl2=$_GET['tahun'].'-'.$_GET['bulan'].'-27';
			  
		  foreach($tj22 as $tjas){
			  $sumt['nominal']='';		
			  foreach($db->select("hr_operasional","sum(nominal)as nominal","id_pegawai='$d[id_pegawai]' and jenis='$tjas[id_jenis]' and date between '$tgl1' and '$tgl2'") as $sumt);
			
?>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3';">
           <?php echo number_format($sumt['nominal']);?>
           <input type="hidden" name="<?='op'.$tjas['id_jenis']?>[<?=$no?>]" value="<?=$sumt['nominal']?>">
           </td>
          <?php 
		  $to=$to+$sumt['nominal'];
		  }?>
           <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">
            <?php
		   $jms['umr']=''; 
		   $jms['tarif_perusahaan']='';
		   foreach($db->select("hr_m_jamsos order by tgl_berlaku desc limit 0,1","*")as $jms);
		   if($gp<=$jms['umr']){
			   $jmsos=($jms['umr']*$jms['tarif_perusahaan'])/100;
		   }else{
			   $jmsos=($gp*$jms['tarif_perusahaan'])/100;
		   }
		   echo number_format($tjm=$jmsos*$aktif/100,0);
		   ?>
            <input type="hidden" name="jamsostek_724[<?=$no?>]" value="<?=$tjm?>">
           </td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">
           <?php
		   $tnjs['nominal']='';
		   foreach($db->select("hr_m_tunjsehat","*","id_pangkat='$ak1[id_pangkat]' and id_statuskel='$ak2[id_statuskel]' order by tgl_berlaku desc limit 0,1")as $tnjs);
		    $tjk=$tnjs['nominal']*$aktif/100;
			if($hasil<'20'){
				$stjk=$tjk*($hasil/$hari);
			}elseif($hasil>='20'){
				$stjk=$tjk;	
			}
		  //tunjangan kesehatan
		   echo number_format($stjk,0);
		   ?>
           <input type="hidden" name="tunj_sehat[<?=$no?>]" value="<?=$stjk?>">
           </td>
         
         <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><b>
           <?php echo number_format($jk=$s+$stu+$str+$stf+$stp+$stpn+$to+$tjm+$stjk);?>
           <input type="hidden" name="jumlah_kotor[<?=$no?>]" value="<?=$jk?>"></b>
           </td>
           <?php 
		  $tj22=$db->select("hr_m_potongan_opr","*","type='1'");
		  
		  if($_GET['bulan']==01){
				$thn=$_GET['tahun']-1;
				$bln="01";
		  }else{
			 	$thn=$_GET['tahun'];
				$bln=sprintf("%02s", $_GET['bulan']-1);
		  }
		  $per=$thn.'-'.$bln.'-1';
		  
		  $tgl1=$thn.'-'.$bln.'-26';
		  $tgl2=$_GET['tahun'].'-'.$_GET['bulan'].'-27';
		  
		  foreach($tj22 as $tjas){
			  foreach($db->select("hr_operasional","sum(nominal)as nominal","id_pegawai='$d[id_pegawai]' and jenis='$tjas[id_jenis]' and date between '$tgl1' and '$tgl2'") as $sumt2);
?>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3';">
           <?php echo number_format($sumt2['nominal']);?>
           <input type="hidden" name="<?='po'.$tjas['id_jenis']?>[<?=$no?>]" value="<?=$sumt2['nominal']?>">
      </td>
          <?php 
		  $to2=$to2+$sumt2['nominal'];
		  }?>
           <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"> <?php
		   $jmsos=''; 
		   foreach($db->select("hr_m_jamsos order by tgl_berlaku desc limit 0,1","*")as $jms2);
		   if($gp<=$jms2['umr']){
			   $jmsos=($jms2['umr']*$jms2['tarif_bayar'])/100;
		   }else{
			   $jmsos=($gp2*$jms2['tarif_bayar'])/100;
		   }
		   echo number_format($tjm2=$jmsos*$aktif/100,0);
		   ?>
           <input type="hidden" name="jamsostek_924[<?=$no?>]" value="<?=$tjm2?>"></td>
            <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"> 
		   <?php
		   $ibk=0;
		   if($gp>0){
		   echo number_format($ibk=($jms2['umr']*1)/100,0);
		   }
		   ?>
           <input type="hidden" name="ibk[<?=$no?>]" value="<?=$ibk?>"></td>
           <td align="right" bgcolor="FFFFCC" class="" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;" onMouseOut="this.style.backgroundColor='#FFFFCC';">
		   <?php
		   $potpelpr['potongan']='';
		   $potpekpf_n=0;
		   $potpekpp_n=0;
		   $potpekpr_n=0;
		   if($_GET['bulan']==01){
				$thn=$_GET['tahun']-1;
				$bln="01";
		   }else{
			 	$thn=$_GET['tahun'];
				$bln=$_GET['bulan']-1;
		   }
		   $peraw=$thn.'-'.$bln.'-27';
		   $perak=$_GET['tahun'].'-'.$_GET['bulan'].'-26';
		   
		   foreach($db->select("hr_pelanggaran","potongan","id_pegawai='$d[id_pegawai]' and tgl <'$peraw' and tgl_akhir>'$perak' order by id_pelanggaran desc limit 0,1")as $potpelpr);
		   
		   if($tr>0){
			   $potpekpr_n=$tr*$potpelpr['potongan']/100;
		   }
		   if($tf>0){
			   $potpekpf_n=$tf*$potpelpr['potongan']/100;
		   }
		   if($tp>0){
			   $potpekpp_n=$tp*$potpelpr['potongan']/100;
		   }
		   echo number_format($potpekpr_n,0);
		   ?>
		   <b>
		   <input type="hidden" name="potpel_pr[<?=$no?>]" value="<?=$potpekpr_n?>">
		   </b></td>
           
      <td align="right" bgcolor="FFFFCC" class="" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;" onMouseOut="this.style.backgroundColor='#FFFFCC';"><?php echo number_format($potpekpf_n,0);?><b>
        <input type="hidden" name="potpel_pf[<?=$no?>]" value="<?=$potpekpf_n?>">
      </b></td>
      <td align="right" bgcolor="FFFFCC" class="" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;" onMouseOut="this.style.backgroundColor='#FFFFCC';"><?php echo number_format($potpekpp_n,0);?><b>
        <input type="hidden" name="potpel_pp[<?=$no?>]" value="<?=$potpekpp_n?>">
      </b></td>
           <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;"><b><?php echo number_format($tot=$jk-$to2-$tjm2-$potpekpr_n-$potpekpf_n-$potpekpp_n-$ibk);?></b>
          <input type="hidden" name="jumlah_terima[<?=$no?>]" value="<?=$tot?>"></td>
  </tr>
    <?php $no++;
	$total1=$total1+$s;
	$total2=$total2+$st;
	$total3=$total3+$str;
	$total4=$total4+$stf;
	$total5=$total5+$tp;
	$total6=$total6+$tjm;
	$total7=$total7+$stjk;
	$total8=$total8+$jk;
	
	
	$total9=$total9+$stpn;
	$total10=$total10+$tjm2;
	$total11=$total11+$ibk;
	
	$total11=$total11+$ibk;
	$total11=$total11+$ibk;
	$total11=$total11+$ibk;
	$total11=$total11+$ibk;
	
	} ?>
    
  <tr>
          <td colspan="10" align="center"  bgcolor="#EBEBEB"><b>TOTAL</b></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;"><?=$total1?></td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#ffffff' ;">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3';">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3';">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;" onMouseOut="this.style.backgroundColor='#FFFFCC';">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;" onMouseOut="this.style.backgroundColor='#FFFFCC';">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;" onMouseOut="this.style.backgroundColor='#FFFFCC';">&nbsp;</td>
          <td align="right" bgcolor="FFFFCC" class="" onMouseOut="this.style.backgroundColor='#FFFFCC';" 
           onMouseOver="this.style.backgroundColor='#2196f3' ;">&nbsp;</td>
  </tr>   
</table>