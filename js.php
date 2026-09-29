<script>
function pindahMenu(slug){
	
	//$.get('assets/layout/page.php?x='+slug, function(data) {
    $.get('http://localhost/waruabadi/'+slug, function(data) { 
	    $('#isi_data').html(data);    
    });  
}
</script>
