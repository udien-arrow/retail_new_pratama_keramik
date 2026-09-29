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
		source: "assets/akutansi/bank_masuk/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$( "#korek1" ).autocomplete({
		source: "assets/akutansi/bank_masuk/datakorek1.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$("#spum").hide();
	$("#pepel").hide();
	$("#npum").hide();
	$("#korek").prop('required',true);
	$("#jenjur").change(function(){
    	if($("#jenjur").val()==="spum"){
		$("#spum").show();
		$("#BM").hide();
		$("#jml").attr("readonly", true);
		$("#pums").prop('required',true);
		$("#aruskas").prop('required',true);
		$("#korek").prop('required',false);
		$("#pums").change(function(){
			var l=$("#pums").val();
			var s=l.split("_")
			$("#jml").val(s[1]);
	});
		} 
		else if($("#jenjur").val()==="BM"){
			$("#spum").hide();
			$("#BM").show();
			$("#jml").attr("readonly", false);
			$("#aruskas").prop('required',true);
			$("#korek").prop('required',true);
			}
	});
</script>