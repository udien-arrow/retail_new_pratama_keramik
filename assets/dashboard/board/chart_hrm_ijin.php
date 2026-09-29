	<script type="text/javascript" src="assets/js/js/jqueryhc.js"></script>
<style>
	.tabl2{ padding:3px;

		}
</style>
<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: '10 Besar Karyawan Sering Ijin (A,I,S)'
            },
            xAxis: {
                categories: ['Alpha', 'Ijin', 'Sakit']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total '
                }
            },
            legend: {
                reversed: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
                series: [
				{
                	name: 'John',
                	data: [5, 3, 4, 7, 2]
				}, {
					name: 'Jane',
					data: [2, 2, 3, 2, 1]
				}, {
					name: 'Joe',
					data: [3, 4, 4, 2, 5]
            	}


				/*{
                	name: 'John',
                	data: [5, 3, 4, 7, 2]
				}, {
					name: 'Jane',
					data: [2, 2, 3, 2, 1]
				}, {
					name: 'Joe',
					data: [3, 4, 4, 2, 5]
            	}*/

			]
        });
    });
    

		</script>
	</head>
	<body>
<script src="assets/js/js/highcharts.js"></script>
<script src="assets/js/js/exporting.js"></script>
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
<br>
<table width="80%" border="1" cellpadding="2" cellspacing="0" align="center" class="tabl2">
    <tr height="30px">
          <td width="1%"align="center" >No</td>
          <td align="center" width="5%" ><b>Kode</b></td>
          <td align="center" width="25%" ><b>Nama Pegawai</b></td>
          <td align="center" width="10%" ><b>Jumlah</b></td>
          </tr>
         <?php
		 
		 if($_POST['bulan']=='all'){$bul="";}else{$bul="month(a.date)='$_POST[bulan]' and";}
		 
			$kon=$db->select("hr_ijin a JOIN m_pegawai b ON a.id_pegawai = b.id_pegawai","b.nik,a.id_pegawai,b.nama_pegawai,count(a.jenis) AS jumlah","$bul year(a.date)='$_POST[tahun]' and jenis in('S','I','A') GROUP BY a.id_pegawai ORDER BY count(a.jenis) desc LIMIT 0,10");
			$no=1;
			foreach($kon as $d){  
		 ?>
    <tr>
          <td align="left"  ><?php echo $no?></td>
          <td align="center"  ><?php echo $d['nik'];?></td>
          <td align="center"  ><?php echo $d['nama_pegawai']?></td>
          <td align="right"  ><?php echo number_format($d['jumlah'])?></td>
    </tr>
        <?php $no++;} ?>
</table>

