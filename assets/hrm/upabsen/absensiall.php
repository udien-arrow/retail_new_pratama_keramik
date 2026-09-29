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
  <table width="100%" border="0"  class="table datatable table-bordered ">
    <thead>
          <tr >
            <th bgcolor="#28343a" align="left"><font style="color:#FFF"><b>No</b></font></th>
            <th bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Tgl</b></font></th>
            <th bgcolor="#28343a" align="left"><font style="color:#FFF"><b>ACno</b></font></th>
            <th bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Jenis</b></font></th>
            <th bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Onduty</b></font></th>
            <th bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Offduty</b></font></th>
            <th bgcolor="#28343a" align="left"><font style="color:#FFF"><b>ClockIn </b></font></th>
            <th bgcolor="#28343a" align="left"><font style="color:#FFF"><b>ClockOut</b></font></th>
            <th bgcolor="#28343a" align="left"><font style="color:#FFF"><b>Att Time</b></font></th>
          </tr>
          <?php
		  $dt=$db->select("hr_absensi","*","month(date)='$_GET[bulan]' and year(date)='$_GET[tahun]' and id_pegawai='$_GET[id]' order by date asc");
		  $no=1;
          foreach($dt as $val){
		  ?>
          <tr >
            <th width="28%" align="left"><?=$no?></th>
            <th width="31%" align="left"><?=$val['date']?></th>
            <th width="41%" align="left"><?=$val['acno']?></th>
            <th width="41%" align="left"><?=$val['jenis']?></th>
            <th width="41%" align="left"><?=$val['on_duty']?></th>
            <th width="41%" align="left"><?=$val['off_duty']?></th>
            <th width="41%" align="left"><?=$val['clock_in']?></th>
            <th width="41%" align="left"><?=$val['clock_out']?></th>
            <th width="41%" align="left"><?=$val['att_time']?></th>
          </tr>
          <?php 
		  $no++;
		  }?>
        </thead>
      </table>
