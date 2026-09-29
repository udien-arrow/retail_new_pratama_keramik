<link rel="stylesheet" href="assets/css/extras/jquery-ui.css">
<script src="assets/js/js/jquery-ui.js"></script>

<script>
	<?php 
	if($_GET['cab']!=''){
	
	?>
	/* $('#example5').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/laporan/lapopname/data.php?cab=<?=$_GET[cab]?>&a=<?=$_GET[a]?>&b=<?=$_GET[b]?>",
				"dataType": "jsonp"
				}
	} );*/
	
	<?php } ?>
	function pindahData2(a,b,c,d,cab){
		var ac1=c.split("-");
		var ac2=d.split("-");
		if(a==="" || b===""){
			alert("Mohon Isikan Periode Laporan!");
			}else{
		window.location="index.php?x=lapgl&cab="+cab+"&d1="+a+"&d2="+b+"&a1="+ac1[0].trim()+"&a2="+ac2[0].trim();}
	}
	
	$( "#ac1" ).autocomplete({
		source: "assets/laporan/lapbukubesar/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	
	$( "#ac2" ).autocomplete({
		source: "assets/laporan/lapbukubesar/datakorek.php", 
		minLength:2,  
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }} 
	});
	
	
	
	
	
	
	
</script>