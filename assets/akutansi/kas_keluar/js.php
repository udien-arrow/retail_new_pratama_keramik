
<link rel="stylesheet" href="assets/css/extras/jquery-ui.css">
<script src="assets/js/js/jquery-ui.js"></script>
<script>
	function hapus(id){
	
		$('#id').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('form2').submit();		
	}
	//format angka/uang	
	$(".harga").number(true,0);
	$( "#korek" ).autocomplete({
		source: "assets/akutansi/kas_keluar/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$( "#korek1" ).autocomplete({
		source: "assets/akutansi/kas_keluar/datakorek1.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	
	function modalnya(){
		$("#mod").click();
		$.get('assets/akutansi/kas_keluar/plaf.php', function(data) {
				$('#bud').html(data);    
		});
	
		//$("#id_budget").val(a);
		//$("#account").val(b);	
	}
		
	function checkmin(){
		if($("#totd").val() < 0){alert("Data Tidak Dapat Diproses"); return false;} else {return true;}
		
	}

	$('#checkbox').change(function() {
		if($(this).is(":checked")) {
			var returnVal = confirm("Are you sure?");
			$(this).attr("checked", returnVal);
		}
		if($(this).is(':checked')){$('#curr').val("kredit");}else{$('#curr').val("debet");}
	});

	
	$("#pum").hide();
	$("#bag").hide();
	$("#bam").hide();
	$("#korek").prop('required',true);
	$("#jenjur").change(function(){
		
    	if($("#jenjur").val()==="pu"){
			$("#pum").show();
			$("#km").hide();
			$("#bag").hide();
			$("#arusjas").show();
			$("#aruskas1").prop('required', false);
			$("#korek").prop('required',false);
			$("#bam").hide();
		} 
		else if($("#jenjur").val()==="km"){
			$("#pum").hide();
			$("#km").show();
			$("#bag").hide();
			$("#bam").hide();
			$("#aruskas1").prop('required',false);
		 	$("#korek").prop('required',true);
			}
		else if($("#jenjur").val()==="bag"){
			$("#pum").hide();
			$("#km").show();
			$("#bag").show();
			$("#bam").hide();
			$("#aruskas1").prop('required',false);
			}
		else if($("#jenjur").val()==="bma"){
			$("#pum").hide();
			$("#km").show();
			$("#bag").hide();
			$("#bam").show();
			$("#aruskas1").prop('required',false);
			}
	});
	function validate_frm(){
		
		}
</script>