<script>
	
	
	function pindahData2(grup){
		window.location="index.php?x=nilaiper&cab="+grup;
	}
	
	var tamp=0;
	function hitungan1(i){
			$.get('assets/laporan/lappenjualannon.php?id='+id, function(data) {
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