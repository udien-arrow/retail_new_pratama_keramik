<script>

	$.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 2,4,5,3,6,7 ]
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
	if($_GET['cab']!=''){
	
	?>
	 $('#example5').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/laporan/lapbiujs/data.php?cab=<?=$_GET[cab]?>&a=<?=$_GET[a]?>&b=<?=$_GET[b]?>",
				"dataType": "jsonp"
				}
	} );
	
	<?php } ?>
	
	function pindahData2(cab,a,b){
		window.location="index.php?x=lapbiujs&cab="+cab+"&a="+a+"&b="+b;
	}
	
	var tamp=0;
	function hitungan1(i){
			$.get('assets/laporan/lapbiujs.php?id='+id, function(data) {
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
			
			
			aa=0;
			var hit = new Array();
			$(".hit2").each(function(){
				hit.push(
					isi=$(this).val());
					aa = parseFloat(aa)+parseFloat(isi);
			});
			
			
			$("#hiu2").text(aa);
			formatAngka(',')
			
			
			aa=0;
			var hit = new Array();
			$(".hit1").each(function(){
				hit.push(
					isi=$(this).val());
					aa = parseFloat(aa)+parseFloat(isi);
			});
			
			
			$("#hiu1").text(aa);
			formatAngka(',')
	}
	setTimeout(function(){ hitungan() }, 1000);
	$(".dataTables_filter").keyup(function(event){
		$("#hiu").text(0);
		formatAngka(',')
		
		$("#hiu2").text(0);
		formatAngka(',')
		
		$("#hiu1").text(0);
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
	  
	   a = $("#hiu2").text();
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
	  $("#hiu2").text(c)
	  
	  
	   a = $("#hiu1").text();
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
	  $("#hiu1").text(c)
	}
	
</script>