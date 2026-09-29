<link rel="stylesheet" href="assets/css/extras/jquery-ui.css">
<!-- <script src="assets/js/js/jquery-ui.js"></script> -->
<script>
//$('#nama_barang').prop('readonly', true);
$('#harga_barang').prop('readonly', true);
$('#qty_stok').prop('readonly', true);
$('#grantot').prop('readonly', true);
$('#subtot').prop('readonly', true);
$('#kembali').prop('readonly', true);
$("#fg_nomer_kartu").hide();
$("#fg_bayar_tunai").hide();
$("#fg_bayar_kartu").hide();
$("#fg_bank").hide();
$("#jenis_bayar").change(function(){
	if($("#jenis_bayar").val()==="1"){
	$("#fg_nomer_kartu").show();
	$("#fg_bayar_tunai").show();
	$("#fg_bayar_kartu").show();
	$("#fg_bank").show();
	$("#bayar_tunai").focus();
	} 
	else if ($("#jenis_bayar").val()==="2"){
	$("#fg_nomer_kartu").hide();
	$("#fg_bayar_tunai").hide();
	$("#fg_bayar_kartu").hide();
	$("#fg_bank").hide();	
		}
	});
	
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
	
$('#disc2').keyup(function(){
        //alert("key usd");
        var val2 = $('#subtot').val().replace(/[^\d]/g,"") - ($('#subtot').val().replace(/[^\d]/g,"")*$('#disc2').val().replace(/[^\d]/g,"")/100);
        $('#grantot').val(val2);
	var n = parseInt($('#grantot').val().replace(/\D/g,''),10);
    $('#grantot').val(n.toLocaleString());                                

});

$('#bayar_tunai').keyup(function(){
        //alert("key usd");
		/*
		if($("#bayar_kartu").val()===""){
        var val3 = $('#bayar_tunai').val().replace(/[^\d]/g,"") - $('#grantot').val().replace(/[^\d]/g,"");
        $('#kembali').val(val3); 
		}else{ */
		//document.getElementById("kembali").value = "";
		
		var val3 = ( parseFloat($('#bayar_tunai').val().replace(/[^\d]/g,"")||0)) - parseFloat($('#grantot').val().replace(/[^\d]/g,"")||0);
		$('#kembali').val(val3);
		var n = parseInt($('#kembali').val().replace(/\D -/g,''),10);
    	$('#kembali').val(n.toLocaleString());  	

});

$('#bayar_kartu').keyup(function(){
        //alert("key usd");
		
		//document.getElementById("kembali").value = "";
		var val4 = ( parseFloat($('#bayar_tunai').val().replace(/[^\d]/g,"")||0)+parseFloat($('#bayar_kartu').val().replace(/[^\d]/g,"")||0)) - parseFloat($('#grantot').val().replace(/[^\d]/g,"")||0);

		$('#kembali').val(val4);
		var n = parseInt($('#kembali').val().replace(/\D/g,''),10);
    $('#kembali').val(n.toLocaleString()); 		
		//	}
		
});

$("#kode_barang").keypress(function(e) {
if(e.which == 13) {
cari($("#kode_barang").val());
return false;
}
});

$("#cus").keypress(function(e) {
if(e.which == 13) {
$("#jenis_jual").focus();
return false;
}
})

$("#jenis_jual").keypress(function(e) {
if(e.which == 13) {
$("#disc2").focus();
return false;
}
})

$("#disc2").keypress(function(e) {
if(e.which == 13) {
$("#jenis_bayar").focus();
return false;
}
})

$("#qty").keypress(function(e) {
if(e.which == 13) {
$("#disc").focus();
return false;
}
});

$("#bayar_tunai").keypress(function(e) {
if(e.which == 13) {
$("#bayar_kartu").focus();
return false;
}
});

$("#bayar_kartu").keypress(function(e) {
if(e.which == 13) {
$("#nomer_kartu").focus();
return false;
}
});

$("#nomer_kartu").keypress(function(e) {
if(e.which == 13) {
$("#bank").focus();
return false;
}
});

function runScript(b) {
		cari(b);
    
}


function cari(b){
	$.ajax({
		  type:"get",
		  url:"assets/inventory/penjualangro/dtbarang.php",
		  data:"barang="+$('#kode_barang').val(),
		  success:function(data){
			  //alert(data);
			   if(data==""){
				   	//alert("Maaf barang tidak ada!!!");
					document.getElementById("form_index").reset();
					$("#kode_barang").focus();
					} else {
						alert(data);
						var explode = data.split('_')
			   			$('#'+b+'1').val(data);
						$('#kode_barang').val(explode[0]);
						$('#nama_barang').val(explode[1]);
						$('#id_barang').val(explode[2]);
						var subexp = explode[3].split('*')
						//$('#harga_barang').val(explode[3]);
						$('#harga_barang').val(subexp[0]);
						$('#harga_barang_c').val(subexp[1]);
						$('#qty_stok').val(explode[4]);
						var n = parseInt($('#harga_barang').val().replace(/\D/g,''),10);
    					$('#harga_barang').val(n.toLocaleString())
						$("#qty").focus();
				}
		  }
	}); 
	
	
	}


    function balik(){
		javascript: document.getElementById('kode_barang').focus();
		
	}

	function hapus(id){
		$('#id').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('keranjang').submit();
		
	}
	function hold(){
		location.href="index.php?x=penjualangro&st=h";
	}
	function balikHold(no){
		location.href="index.php?x=penjualangro&st=b&no="+no;
	}
	function cekHold(){
	
		$.get('assets/inventory/penjualangro/fak.php', function(data) {

				$('#hahaha2').html(data);    
		});
	}
	function batal(){
		$('#aksi').val('batal');
		javascript: document.getElementById('formku').submit();
	}
	
	
		$("#kode_barang").autocomplete({
		source: "assets/inventory/penjualangro/datakorek.php", 
		minLength:2, 
		change: function (event, ui) {
        if (!ui.item) {
			//alert('1');
            this.value = '';
			
        }
    }});
	
</script>