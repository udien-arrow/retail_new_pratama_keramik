<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
			targets: [ 1 ]
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Cari Data:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/pengbum/data.php",
				"dataType": "jsonp"
				}
	} );
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#id').val(id);
		$('#qty_in').val($('#qty'+id).val());
		$('#sat_in').val($('#sat'+id).val());
		//$('#tes2').val($('#tes'+id).val());
		$('#gud_in').val($('#gudang').val());
		$('#hpp2').val($('#hpp'+id).val());
		$('#nopol2').val($('#nopol'+id).val());
		$('#no_amm2').val($('#no_amm'+id).val());
		$('#sn2').val($('#sns'+id).val());
		var qty=parseInt($('#qty'+id).val());
		var qty2=parseInt($("#tes"+id).text());
		//alert(qty+">"+qty2);
		if(qty>qty2)
		{ 
		alert("Stok Yang di minta Melebihi Batas !!!"); 
		}
		else{
		 document.getElementById('form_index').submit();
		}
	}
	function tambah_all(){
			$('#tambah_in').val('rame');
			javascript: document.getElementById('form_index').submit();
	}
	function hapus(id){
		
		$('#id2').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('formku').submit();
		
	}
	function batal(){
		$('#aksi').val('batal');
		javascript: document.getElementById('formku').submit();
		
	}
	function pindahData(a){
		window.location="index.php?x=pengbum&gudang="+a;
	}
	function pindahData2(a,b){
		window.location="index.php?x=pengbum&gudang="+a+"&jenis="+b;
	}
	function satuan(i){
		$("#sat"+i).load("assets/master/pricel/satuan.php?id="+i);	
	}
	function sns(i,a){
		$("#sns"+i).load("assets/inventory/pengbum/sn.php?id="+i+"&gud="+a);	
	}
/*$(document).ready(function(){
	alert('a');
	
	
});*/
function cek(id){
	alert('a');
}	

</script>