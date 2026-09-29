<link rel="stylesheet" href="assets/css/extras/jquery-ui.css">
<script src="assets/js/js/jquery-ui.js"></script>
<script>
	function hapus(id){
		$('#id').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('form2').submit();		
	}
	function sem(id){
		$('#aksi').val('simpan');
		javascript: document.getElementById('form2').submit();		
	}
	//format angka/uang	
	$('#example4').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
	
	$(".harga").number(true,0);
	$( "#korek" ).autocomplete({
		source: "assets/akutansi/kasmasuk/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$( "#pelangans" ).autocomplete({
		source: "assets/akutansi/kasmasuk/pelangans.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	$( "#korek1" ).autocomplete({
		source: "assets/akutansi/kasmasuk/datakorek1.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	
	function pindah2(b){
		window.location="index.php?x=pjk&jen="+b;
	}
	
	function pindah(a,b){
		window.location="index.php?x=pjk&pum="+a+"&jen="+b;
	}
	
	/**$("#spum").hide();
	$("#pepel").hide();
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
	});**/
	$('#checkbox').change(function() {
		if($(this).is(":checked")) {
			var returnVal = confirm("Are you sure?");
			$(this).attr("checked", returnVal);
		}
		if($(this).is(':checked')){$('#curr').val("kredit");}else{$('#curr').val("debet");}
	});

</script>