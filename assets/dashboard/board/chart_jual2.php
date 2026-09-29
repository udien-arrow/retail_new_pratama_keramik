<script type="text/javascript" src="assets/js/js/jqueryhc.js"></script>
<style>
	.tabl2{ padding:3px;

		}
</style>
<?php
$tglskr=date("Y-m-d");
?>
<script type="text/javascript">
    $(document).ready(function () {
		
        $('#container2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Pelanggan Expired Order'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Jumlah',
                data: [
				<?php
				 if($_POST['bulan']=='all'){$bul="";}else{$bul="month(a.tempo_tambahan)='$_POST[bulan]' and";}
				
                   foreach($db->select("tx_do a join m_customer b on a.id_cus=b.id_cus","sum(a.jumlah_so)as jumlah,a.id_cus,b.nama_usaha","a.tempo_tambahan<='2016-07-22' and $bul year(a.tempo_tambahan)='$_POST[tahun]' group by a.id_cus ORDER BY sum(jumlah_so) desc") as $pros){
					echo"{name:'$pros[nama_usaha]', y:$pros[jumlah],id:'$pros[id_cus]'},";	
					}
				?>
                ]
				
				/* data: [
                    ['Firefoxa',   45.0],
                    ['IE',       26.8],
                    {
                        name: 'Chrome',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Safari',    8.5],
                    ['Opera',     6.2],
                    ['Others',   0.7]
                ]*/
            }]
        });
    });
    
//});
		</script>
	</head>
	<body>
<script src="assets/js/js/highcharts.js"></script>
<script src="assets/js/js/exporting.js"></script>
<div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
<br>


