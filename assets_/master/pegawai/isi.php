<?php
require( '../../../webclass.php' );
$db=new kelas;

if($_GET['tp']=='bank'){
	$dt=$db->select("hr_pegawai_acc","*","id_peg='$_GET[idpeg]'");
	foreach($dt as $valdt){	  
	?>
		<tr>
		<td><?=$valdt['nama_bank']?></td>
		<td><?=$valdt['no_rek']?></td>
		<td><?=$valdt['jenis']?></td>
        <td><?=$valdt['def']?></td>
        <td align="center">
			<a href='javascript:void(0)' onclick="editbank('<?=$valdt['id']?>','<?=$valdt['nama_bank']?>','<?=$valdt['no_rek']?>','<?=$valdt['jenis']?>')" class='icon-pencil7' style='cursor:pointer'></a> | 
			<a href='javascript:void(0)' onclick="hapusbank('<?=$valdt['id']?>')" style='cursor:pointer' class='icon-trash'></a>
        </td>
	  </tr>
	<?php
	}	
}
if($_GET['tp']=='pengalaman'){
	$dt=$db->select("hr_pegawai_pengalaman","*","id_peg='$_GET[idpeg]'");
	foreach($dt as $valdt){	  
	?>
		<tr>
		<td><?=$valdt['nama_perusahaan']?></td>
		<td><?=$valdt['tahun_mulai']?></td>
		<td><?=$valdt['tahun_akhir']?></td>
        <td><?=$valdt['bagian']?></td>
        <td><?=$valdt['jabatan']?></td>
        <td align="center">
			<a href='javascript:void(0)' onclick="editpengalaman('<?=$valdt['id']?>','<?=$valdt['nama_perusahaan']?>','<?=$valdt['tahun_mulai']?>','<?=$valdt['tahun_akhir']?>','<?=$valdt['bagian']?>','<?=$valdt['jabatan']?>')" class='icon-pencil7' style='cursor:pointer'></a> | 
			<a href='javascript:void(0)' onclick="hapuspengalaman('<?=$valdt['id']?>')" style='cursor:pointer' class='icon-trash'></a>
        </td>
	  </tr>
	<?php
	}	
}
if($_GET['tp']=='finger'){
	$no=1;
	$dt=$db->select("hr_finger","*","id_pegawai='$_GET[idpeg]'");
	foreach($dt as $valdt){	  
	
	?>
		<tr>
		<td><?=$no?></td>
		<td><?=$valdt['acno']?></td>
		<td align="center">
			<a href='javascript:void(0)' onclick="editfinger('<?=$valdt['id']?>','<?=$valdt['acno']?>')" class='icon-pencil7' style='cursor:pointer'></a> | 
			<a href='javascript:void(0)' onclick="hapusfinger('<?=$valdt['id']?>')" style='cursor:pointer' class='icon-trash'></a>
        </td>
	  </tr>
	<?php
	$no++;
	}	
}
if($_GET['tp']=='emer'){
	$dt=$db->select("hr_emergency","*","id_pegawai='$_GET[idpeg]'");
	foreach($dt as $valdt){	  
	?>
		<tr>
		<td><?=$valdt['nama_hubungan']?></td>
		<td><?=$valdt['hubungan']?></td>
		<td><?=$valdt['mobile']?></td>
        <td><?=$valdt['telp']?></td>
        <td align="center">
			<a href='javascript:void(0)' onclick="editemer('<?=$valdt['id_hub']?>','<?=$valdt['nama_hubungan']?>','<?=$valdt['hubungan']?>','<?=$valdt['mobile']?>','<?=$valdt['telp']?>')" class='icon-pencil7' style='cursor:pointer'></a> | 
			<a href='javascript:void(0)' onclick="hapusemer('<?=$valdt['id_hub']?>')" style='cursor:pointer' class='icon-trash'></a>
        </td>
	  </tr>
	<?php
	}	
}

if($_GET['tp']=='alamat'){
	$dt=$db->select("hr_alamat","*","id_pegawai='$_GET[idpeg]'");
	foreach($dt as $valdt){	  
	?>
		<tr>
		<td><?=$valdt['alamat_peg']?></td>
		<td><?=$valdt['ket']?></td>
		<td align="center">
			<a href='javascript:void(0)' onclick="editalamat('<?=$valdt['id_alamat']?>','<?=$valdt['alamat_peg']?>','<?=$valdt['ket']?>')" class='icon-pencil7' style='cursor:pointer'></a> | 
			<a href='javascript:void(0)' onclick="hapusalamat('<?=$valdt['id_alamat']?>')" style='cursor:pointer' class='icon-trash'></a>
        </td>
	  </tr>
	<?php
	}	
}

if($_GET['tp']=='pendidikan'){
	$dt=$db->select("hr_pendidikan","*","id_pegawai='$_GET[idpeg]'");
	foreach($dt as $valdt){	  
	?>
		<tr>
		<td><?=$valdt['jenispend']?></td>
        <td><?=$valdt['tempat']?></td>
        <td><?=$valdt['tahun_awal']?></td>
        <td><?=$valdt['tahun_akhir']?></td>
        <td><?=$valdt['jurusan']?></td>
        <td><?=$valdt['universitas']?></td>
        <td><?=$valdt['nomor_ijazah']?></td>
        <td><?=$valdt['tgl_lulus']?></td>
        <td><?=$valdt['nilai']?></td>
		<td><?=$valdt['ket_pend']?></td>
		<td align="center">
			<a href='javascript:void(0)' onclick="editpendidikan('<?=$valdt['id_pend']?>','<?=$valdt['jenispend']?>','<?=$valdt['tempat']?>','<?=$valdt['tahun_awal']?>','<?=$valdt['tahun_akhir']?>','<?=$valdt['ket_pend']?>','<?=$valdt['jurusan']?>','<?=$valdt['universitas']?>','<?=$valdt['nomor_ijazah']?>','<?=$valdt['tgl_lulus']?>','<?=$valdt['nilai']?>')" class='icon-pencil7' style='cursor:pointer'></a> | 
			<a href='javascript:void(0)' onclick="hapuspendidikan('<?=$valdt['id_pend']?>')" style='cursor:pointer' class='icon-trash'></a>
        </td>
	  </tr>
	<?php
	}	
}

if($_GET['tp']=='statuskel'){
	$dt=$db->select("hr_statuskel a join hr_m_statuskel b on a.id_statuskel=b.id_statuskel","*","id_pegawai='$_GET[idpeg]'");
	foreach($dt as $valdt){	  
	?>
		<tr>
		<td><?=$valdt['statuskel']?></td>
        <td><?=$valdt['anak']?></td>
        <td align="center">
			<a href='javascript:void(0)' onclick="editstatuskel('<?=$valdt['id_tdstatuskel']?>','<?=$valdt['id_statuskel']?>','<?=$valdt['anak']?>')" class='icon-pencil7' style='cursor:pointer'></a> | 
			<a href='javascript:void(0)' onclick="hapusstatuskel('<?=$valdt['id_tdstatuskel']?>')" style='cursor:pointer' class='icon-trash'></a>
        </td>
	  </tr>
	<?php
	}	
}
if($_GET['tp']=='kedudukan'){
	$dt=$db->select("hr_jabatanpeg a 
	left join m_jabatan b on a.id_jabatan=b.id_jabatan
	left join hr_st_jabatan bb on a.id_st_jabatan=bb.id_st_jabatan
	left join hr_m_pangkat c on a.id_pangkat=c.id_pangkat
	left join hr_m_tingkat_golongan d on a.id_tingkat_gol=d.id_tingkat_gol
	left join m_cabang e on a.id_cabang=e.id_cabang
	","a.*,b.nama_jabatan,c.pangkat,d.tingkat_golongan,e.nama_cabang,bb.st_jabatan","id_pegawai='$_GET[idpeg]' order by a.tgl_jabat asc");
	$no=1;
	foreach($dt as $valdt){	  
	?>
		<tr>
		<td><?=$no?></td>
        <td><?=$valdt['nama_jabatan']?></td>
        <td><?=$valdt['st_jabatan']?></td>
        <td><?=$valdt['pangkat']?></td>
        <td><?=$valdt['tingkat_golongan']?></td>
        <td><?=$valdt['no_sk']?></td>
		<td><?=$valdt['tgl_sk']?></td>
        <td><?=$valdt['tgl_jabat']?></td>
        <td><?=$valdt['nama_cabang']?></td>
		<td align="center">
			<a href='javascript:void(0)' onclick="editkedudukan('<?=$valdt['id_tdjab']?>','<?=$valdt['id_jabatan']?>','<?=$valdt['id_tingkat_gol']?>','<?=$valdt['id_pangkat']?>','<?=$valdt['no_sk']?>','<?=$valdt['tgl_sk']?>','<?=$valdt['tgl_jabat']?>','<?=$valdt['ket_tdjabpeg']?>','<?=$valdt['id_cabang']?>')" class='icon-pencil7' style='cursor:pointer'></a> | 
			<a href='javascript:void(0)' onclick="hapuskedudukan('<?=$valdt['id_tdjab']?>')" style='cursor:pointer' class='icon-trash'></a>
        </td>
	  </tr>
	<?php
	$no++;
	}	
}

if($_GET['tp']=='kontrak'){
	$dt=$db->select("hr_kontrakpeg a 
	left join hr_m_kontrakpeg b on a.id_status=b.id_status
	","a.*,b.nama_kontrak","id_pegawai='$_GET[idpeg]'");
	$no=1;
	foreach($dt as $valdt){	  
	?>
		<tr>
		<td><?=$no?></td>
        <td><?=$valdt['nama_kontrak']?></td>
        <td><?php 
		if($valdt['id_aktif']==1){
			echo "Aktif";
		}if($valdt['id_aktif']==2){
			echo "Penugasan";
		}if($valdt['id_aktif']==3){
			echo "Resign";
		}if($valdt['id_aktif']==4){
			echo "PHK";
		}
		
		?></td>
        <td><?=$valdt['sk_kontrak']?></td>
        <td><?=$valdt['tglmulai']?></td>
		<td><?=$valdt['tglakhir']?></td>
        <td><?=$valdt['nik_peg']?></td>
		<td align="center">
			<a href='javascript:void(0)' onclick="editkontrak('<?=$valdt['id_kontrak']?>','<?=$valdt['id_status']?>','<?=$valdt['id_aktif']?>','<?=$valdt['sk_kontrak']?>','<?=$valdt['tglmulai']?>','<?=$valdt['tglakhir']?>','<?=$valdt['ket_tdjab']?>','<?=$valdt['nik_peg']?>')" class='icon-pencil7' style='cursor:pointer'></a> | 
			<a href='javascript:void(0)' onclick="hapuskontrak('<?=$valdt['id_kontrak']?>')" style='cursor:pointer' class='icon-trash'></a>
        </td>
	  </tr>
	<?php
	$no++;
	}	
}

?>  
  
