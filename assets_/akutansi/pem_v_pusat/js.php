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
		source: "assets/akutansi/pem_v_pusat/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$( "#pelangans" ).autocomplete({
		source: "assets/akutansi/pem_v_pusat/pelangans.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$( "#korek1" ).autocomplete({
		source: "assets/akutansi/pem_v_pusat/datakorek1.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	
	$("#spum").hide();
	//$("#pepel").hide();
	$("#jenjur").change(function(){
    	if($("#jenjur").val()==="spum"){
		$("#spum").show();
		$("#km").hide();
		$("#pepel").hide();
		$("#jml").attr("readonly", true);
		$("#pums").change(function(){
			var l=$("#pums").val();
			var s=l.split("_")
			$("#jml").val(s[1]);
	});
		} 
		else if($("#jenjur").val()==="km"){
			$("#spum").hide();
			$("#pepel").hide();
			$("#km").show();
			$("#jml").attr("readonly", false);
			}
		else if($("#jenjur").val()==="pepel"){
			$("#spum").hide();
			$("#km").show();
			$("#pepel").show();
			$("#jml").attr("readonly", false);
			}
	});
</script>