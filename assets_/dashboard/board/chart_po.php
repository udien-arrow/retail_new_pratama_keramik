	<script type="text/javascript" src="assets/js/js/jqueryhc.js"></script>
<style>
	.tabl2{ padding:3px;

		}
</style>
<script type="text/javascript">
    $(document).ready(function () {
		
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '10 Besar Supplier'
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
				if($_POST['bulan']=='all'){$bul="";}else{$bul="month(a.tgl_po)='$_POST[bulan]' and";}
		 
                   foreach($db->select("tx_po a join m_supplier b on a.id_supp=b.id_supp","sum(a.jumlah)as jumlah,a.id_supp,b.nama_usaha","$bul year(a.tgl_po)='$_POST[tahun]' group by a.id_supp ORDER BY sum(jumlah) desc limit 0,10") as $pros){
				
					echo"{name:'$pros[nama_usaha]', y:$pros[jumlah],id:'$pros[id_supp]'},";	
					}
				?>
                ]
				
            }]
        });
    });
    
//});
		</script>
	</head>
	<body>
<script src="assets/js/js/highcharts.js"></script>
<script src="assets/js/js/exporting.js"></script>
<div class="form-group">
	<div class="col-lg-6">
		<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
	</div>
</div>
