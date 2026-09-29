<link rel="stylesheet" href="assets/css/extras/jquery-ui.css">
<!-- <script src="assets/js/js/jquery-ui.js"></script> -->
<script>
//$('#nama_barang').prop('readonly', true);
//$('#harga_barang').prop('readonly', true);
	
//keyup number function
$(".numbformat").on('keyup', function(){
	if ($(this).val()==""){
		return true
		}else{
    var n = parseInt($(this).val().replace(/\D/g,''),10);
    $(this).val(n.toLocaleString());
	}
});
//end


$('#setor').keyup(function(){
        //alert("key usd");
		/*
		if($("#bayar_kartu").val()===""){
        var val3 = $('#bayar_tunai').val().replace(/[^\d]/g,"") - $('#grantot').val().replace(/[^\d]/g,"");
        $('#kembali').val(val3); 
		}else{ */
		//document.getElementById("kembali").value = "";
		
		var val3 = ( parseFloat($('#jumlah').val().replace(/[^\d]/g,"")||0)) - parseFloat($('#setor').val().replace(/[^\d]/g,"")||0);
		//$('#kembali').val(val3);
		//var n = parseInt($('#kembali').val().replace(/\D -/g,''),10);
		var n = parseInt(val3,10);
		
    	$('#sisa').val(n.toLocaleString()); 
		

});

	
</script>