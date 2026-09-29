<script>

	$.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 1 ]
        }],
         dom: '<"datatable-header"f><"datatable-scroll"t>',
        language: {
            search: '<span>Cari Data:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
	<?php 
	if($_GET['a']!=''){
	?>
	 $('#example5').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/laporan/lapsiapaset/data.php?a=<?=$_GET[a]?>&b=<?=$_GET[b]?>&jenis=<?=$_GET[jenis]?>",
				"dataType": "jsonp"
				}
	} );
	
	<?php } ?>
	
	function pindahData2(a,b){
		window.location="index.php?x=lapsiapaset&a="+a+"&b="+b;
	}
	function mutas(id){
		window.location="index.php?x=lapsiapaset&gud=<?=$_GET[gud]?>&id="+id;
	}
	function pindah(gud,id,tg,tgsd){
		
		window.location="index.php?x=lappersediaan&gud="+gud+"&id="+id+"&tg="+tg+"&tgsd="+tgsd;
	}
	function satuan(i){	
		$("#sat"+i).load("assets/laporan/persediaan/mutasi.php?id="+i+"&gud=<?=$_GET[gud]?>");
	}
	function hitung(i){	
		$("#tes").load("assets/laporan/lapperaset/hitung.php?id="+i+"&gud=<?=$_GET[gud]?>");
	}
	function satuan2(i,sat){
		hg=$("#harga_asli"+i).val();
		
		explo=sat.split("_");
		
		harga=parseFloat(hg)*parseInt(explo[1]);
		
		$("#harga"+i).val(harga);
	}
	var tamp=0;
	function hitungan1(i){
			$.get('assets/laporan/lapsiapaset.php?id='+id, function(data) {
			//alert(data);
				$('#bmu_'+cust+'_'+nom).val(data);  	
			});
	}
	
	function hit2(){
		if($("#hiu2").val()==0){
			$("#hiu3").val('0')
		}
	}
	
	function hitungan(){
			aa=0;
			var hit = new Array();
			$(".hit").each(function(){
				hit.push(
					isi=$(this).val());
					aa = parseFloat(aa)+parseFloat(isi);
			});
			
			
			$("#hiu").text(aa);
			formatAngka(',')
	}
	setTimeout(function(){ hitungan() }, 1000);
	$(".dataTables_filter").keyup(function(event){
		$("#hiu").text(0);
		formatAngka(',')
		hitungan();
	});
	
	function formatAngka(separator) {
	  a = $("#hiu").text();
	  b = a.replace(/[^\d]/g,"");
	  c = "";
	  panjang = b.length;
	  j = 0;
	  for (i = panjang; i > 0; i--) {
		j = j + 1;
		if (((j % 3) == 1) && (j != 1)) {
		  c = b.substr(i-1,1) + separator + c;
		} else {
		  c = b.substr(i-1,1) + c;
		}
	  }
	  $("#hiu").text(c)
	}
	
</script>