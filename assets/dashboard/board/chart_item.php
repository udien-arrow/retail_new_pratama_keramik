<script type="text/javascript" src="assets/js/js/jqueryhc.js"></script>
<style>
	.tabl2{ padding:3px;

		}
</style>
<?php
$tglskr=date("Y-m-d");
?>
<script type="text/javascript">
$(function () {
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
               /* categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']*/
					categories: [<?php
					for($i=1;$i<=31;$i++){
						echo $i.',';
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
			$kon=$db->select("tx_do_dtl a
JOIN tx_do b ON a.id_spj = b.id_spj
JOIN m_barang c ON a.id_barang = c.id_barang","a.id_barang,c.kode_barang,c.nama_barang","month(b.tgl_spj)='$_POST[bulan]' and year(b.tgl_spj)='$_POST[tahun]' GROUP BY
a.id_barang ORDER BY sum(a.qty) desc LIMIT 0,10");
			$no=1;
			foreach($kon as $d){
			?>
			{
                name: "<?=ucfirst(strtolower($d['nama_barang']))?>",
                data: [
				<?php
					for($i=1;$i<=31;$i++){
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
				?>
				]
            },
			<?php }?>
			]
        });
    });

		</script>
	</head>
	<body>
   
<script src="assets/js/js/highcharts.js"></script>
<script src="assets/js/js/exporting.js"></script>
<div id="container3" style="min-width: 310px; height: 400px; max-width: 100%; margin: 0 auto"></div>
<br>



