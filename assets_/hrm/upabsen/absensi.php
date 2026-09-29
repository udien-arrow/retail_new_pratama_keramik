	<script type="text/javascript" src="../../../assets/js/core/libraries/jquery_ui/datepicker.min.js"></script>
<script>
$(".datepicker").datepicker();
	 // Month and year menu
     $(".datepicker-menus").datepicker({
        changeMonth: true,
        changeYear: true
     });
</script>

<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	
?>
<div class="table-responsive">
<div class="table-responsive pre-scrollable">

<?php
foreach($db->select("hr_absensi","jenis","id_pegawai='$_GET[id]' and date='$_GET[date]'")as $cek);

if($cek['jenis']!=''){
foreach($db->select("hr_absensi a left join m_pegawai b on a.id_pegawai=b.id_pegawai","a.*,b.nama_pegawai","a.id_pegawai='$_GET[id]' and a.date='$_GET[date]'")as $dtp);
?>
  <table width="75%" border="0"  class="table datatable table-bordered ">
    <thead>
          <tr >
            <th width="32%" bgcolor="#28343a" align="left"><font style="color:#FFF"><b>No Induk</b></font></th>
            <th width="68%" align="left"><b><?=$dtp['nik']?></b></b></th>
          </tr>
        </thead>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Nama Pegawai</b></font></td>
           <td align="left"><b><?=$dtp['nama_pegawai']?></b></b></td>
         </tr>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Tanggal</b></font></td>
           <td align="left"><b><?=$dtp['date']?></b></td>
         </tr>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>On Duty</b></font></td>
           <td align="left"><b><?=$dtp['on_duty']?></b></td>
         </tr>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Off Duty</b></font></td>
           <td align="left"><b><?=$dtp['off_duty']?></b></td>
         </tr>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Clock In</b></font></td>
           <td align="left"><b><?=$dtp['clock_in']?></b></td>
         </tr>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Clock Out</b></font></td>
           <td align="left"><b><?=$dtp['clock_out']?></b></td>
         </tr>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Work Time</b></font></td>
           <td align="left"><b><?=$dtp['work_time']?></b></td>
         </tr>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Att Time</b></font></td>
           <td align="left"><b>
             <?=$dtp['att_time']?>
           </b></td>
         </tr>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>AC No</b></font></td>
           <td align="left"><b><?=$dtp['acc_no']?></b></td>
         </tr>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Status Kerja</b></font></td>
           <td align="left">
		   <?php
           	foreach($db->select("hr_jenis_absen","*","id_jenis='$dtp[jenis]'")as $v)
			echo "<b>$v[nama_jenis]</b>";
		   
		   ?></td>
         </tr>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Time Table</b></font></td>
           <td align="left"><b>
             <?=$dtp['timetable']?>
           </b></td>
         </tr>
      </table>
<?php 
}else{
	foreach($db->select("m_pegawai","id_pegawai,nama_pegawai","id_pegawai='$_GET[id]'")as $dtp);
?> 
<form method="post" name="frmd" id="frmd">   
 <table width="75%" border="0"  class="table datatable table-bordered ">
    <thead>
          <tr >
            <th width="32%" bgcolor="#28343a" align="left"><font style="color:#FFF"><b>No Induk</b></font></th>
            <th width="68%" align="left"><b><input type="text" size="25" name="idpega" id="idpega"  value="<?=$_GET['id']?>" readonly></b></b></th>
          </tr>
        </thead>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Nama Pegawai</b></font></td>
           <td align="left"><b>
             <input type="text" size="25" name="nama" readonly value="<?=$dtp['nama_pegawai']?>">
           </b></b></td>
         </tr>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Tanggal</b></font></td>
           <td align="left"><b>
             <input type="text"  size="25" name="date" readonly value="<?=$_GET['date']?>" id="tgl">
           </b></td>
         </tr>
         
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Status Kerja</b></font></td>
           <td align="left">
             <select name="jenis" id="jenis">
               <option value="">-jenis-</option>
               <?php
				$query=$db->select("hr_jenis_absen","*");
				foreach($query as $sel){	
			?>
	   <option value="<?=$sel['id_jenis'].'_'.$sel['kode']?>">
		 <?=$sel['nama_jenis']?>
               </option>
               <?php }?>
             </select>
          </td>
         </tr>
         <tr>
           <td bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Keterangan</b></font></td>
           <td align="left"><b>
             <input type="text" size="25" name="ket" value="">
           </b></td>
         </tr>
         <tr>
           <td bgcolor="#28343a" align="left">&nbsp;</td>
           <td align="left"><span class="form-group">
             <input type="button" class="btn btn-info" name="go" id="go" value="Simpan" onclick="save(idpega.value)">
           </span></td>
         </tr>
      </table>
</form>

<?php 
}?>  
      
</div>
<p>&nbsp;</p>
</div>
<script>

function save(idpega){
	var str=$('#frmd').serialize();	
	$.ajax({
			type: "POST",
			url: "assets/hrm/upabsen/simpanab.php",
			data: "idpeg="+idpega+"&str="+str+"&tambah=tambah",
			cache: false,
			success: function(result){
				var expl=result.split("_");
					alert('sukses');
					window.document.getElementById('nm'+expl[1]+'_'+expl[2]).style.backgroundColor= expl[3];
					document.getElementById('nm'+expl[1]+'_'+expl[2]).onmouseover = function() {ChangeColorover(this.id)};
					document.getElementById('nm'+expl[1]+'_'+expl[2]).onmouseout = function() {ChangeColorout(this.id,expl[3])};
					$(".close").click();
			}
			
	});
}

function ChangeColorover(elementid)
{
  document.getElementById(elementid).style.background = "white";
}
function ChangeColorout(elementid,j)
{
	  document.getElementById(elementid).style.background = j;
}

</script>