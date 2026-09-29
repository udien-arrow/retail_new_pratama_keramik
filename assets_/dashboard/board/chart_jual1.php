<script type="text/javascript" src="assets/js/js/jqueryhc.js"></script>
<style>
	.tabl2{ padding:3px;

		}
</style>
<script type="text/javascript">
    $(document).ready(function () {
		//==========================================================================================================================
        $('#container1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '10 Besar Pelanggan Order'
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
				if($_POST['bulan']=='all'){$bul="";}else{$bul="month(a.tgl_spj)='$_POST[bulan]' and";}
                	
				$cb=$db->select("tx_do a join m_customer b on a.id_cus=b.id_cus","sum(a.jumlah_so)as jumlah,a.id_cus,b.nama_usaha","$bul year(a.tgl_spj)='$_POST[tahun]' group by a.id_cus ORDER BY sum(jumlah_so) desc limit 0,10");
				$jum=count($cb);
				if($jum>0){
						foreach($cb as $pros){
							echo"{name:'$pros[nama_usaha]', y:$pros[jumlah],id:'$pros[id_cus]'},";	
						}
				}else{
						echo "{name:'kosong',y:0,id:'1'},";	
				}
				?>
                ]
				
            }]
        });
		//==========================================================================================================================
		$('#container2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Pelanggan yang Melebihi Tempo'
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
					$cb=$db->select("tx_do a join m_customer b on a.id_cus=b.id_cus","sum(a.jumlah_so)as jumlah,a.id_cus,b.nama_usaha","a.tempo_tambahan<='2016-07-22' and $bul year(a.tempo_tambahan)='$_POST[tahun]' group by a.id_cus ORDER BY sum(jumlah_so) desc");
					$jum=count($cb);
                    if($jum>0){
						foreach($cb as $pros){
							echo"{name:'$pros[nama_usaha]', y:$pros[jumlah],id:'$pros[id_cus]'},";	
						}
					}else{
						echo "{name:'kosong',y:0,id:'1'},";	
					}
				?>
                ]
            }]
        });
		//===================================================================================================================
		 $('#container3').highcharts({
            title: {
                text: '10 Besar Item Penjualan',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
					categories: [<?php
				if($_POST['bulan']!='all'){	
					$ak=date("t",strtotime($_POST['tahun'].'-'.$_POST['bulan'].'-01'));
					for($i=1;$i<=$ak;$i++){
						echo $i.',';
					}
				}else{
					for($i=1;$i<=12;$i++){
						echo $i.',';
					}
				}
					
					?>]
            },
            yAxis: {
                title: {
                    text: 'Jumlah Qty'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ' Qty'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [
				<?php
				if($_POST['bulan']!='all'){ 
					$bul="month(b.tgl_spj)='$_POST[bulan]' and ";
				}else{
					$bul="";
				}
				$kon=$db->select("tx_do_dtl a
				JOIN tx_do b ON a.id_spj = b.id_spj
				JOIN m_barang c ON a.id_barang = c.id_barang","a.id_barang,c.kode_barang,c.nama_barang","$bul year(b.tgl_spj)='$_POST[tahun]' GROUP BY
				a.id_barang ORDER BY sum(a.qty) desc LIMIT 0,10");
				$no=1;
				
				foreach($kon as $d){ //====================================
				?>
				{
                name: "<?=ucfirst(strtolower($d['nama_barang']))?>",
                data: [
				<?php
				if($_POST['bulan']!='all'){ 	
					$ak=date("t",strtotime($_POST['tahun'].'-'.$_POST['bulan'].'-01'));
					for($i=1;$i<=$ak;$i++){
						$tg=$_POST['tahun'].'-'.$_POST['bulan'].'-'.sprintf("%02s", $i);
						$kon1=$db->select("tx_do_dtl a LEFT JOIN tx_do b ON a.id_spj=b.id_spj","a.id_barang,sum(qty) AS qty","tgl_spj='$tg'
and id_barang='$d[id_barang]' GROUP BY a.id_barang");
						$hh=count($kon1);
						foreach($kon1 as $d1){}
						if($hh==0){
							$h=0;
						}else{
							$h=$d1['qty'];
						}	
								echo $h.',';
							
					}
				}else{
					for($i=1;$i<=12;$i++){
						$bula=sprintf("%02s", $i);
						$kon1=$db->select("tx_do_dtl a LEFT JOIN tx_do b ON a.id_spj=b.id_spj","a.id_barang,sum(qty) AS qty","year(tgl_spj)='$_POST[tahun]' and month(tgl_spj)='$bula' and id_barang='$d[id_barang]' GROUP BY a.id_barang");
						$hh=count($kon1);
						foreach($kon1 as $d1){}
						if($hh==0){
							$h=0;
						}else{
							$h=$d1['qty'];
						}	
								echo $h.',';
								
					}
				}
					
				 ?>
					]
           		},
				<?php 
			
				}?>
			]
        });
		
    });

</script>
	</head>
	<body>
<script src="assets/js/js/highcharts.js"></script>
<script src="assets/js/js/exporting.js"></script>
<div class="form-group">
	<div class="col-lg-6">
		<div id="container1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>
    <div class="col-lg-6">
		<div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>
    <div class="col-lg-12">
		<div id="container3"></div>
    </div>
</div>
