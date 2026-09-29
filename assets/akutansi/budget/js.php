<script>
	function hapus(id){
		$('#id').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('form1').submit();		
	}
	
	function modalnya(a,b){
		//alert("ok");
		$.get('assets/akutansi/budget/plaf.php?id='+a+'&acc='+b, function(data) {
				$('#bud').html(data);    
		});
		$("#mod").click();	
		//$("#id_budget").val(a);
		//$("#account").val(b);	
	}
	
function pindahData(a,b,c){
		window.location="index.php?x=budget&tahun="+a+"&bulan="+b+"&cabang="+c;
		
	}

function appsetuju(){
		if (confirm("Data Disetujui, apakah anda yakin?")) {
			$('#jenisnya').val('setuju');
			javascript: document.getElementById('formku').submit();
        }
        return false;
		
	}
</script>