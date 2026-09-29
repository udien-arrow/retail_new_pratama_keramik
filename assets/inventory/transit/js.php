<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 5 ]
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
				"url": "assets/inventory/transit/data.php?gud=<?=$_GET[gud]?>",
				"dataType": "jsonp"
				}
	} );
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#id').val(id);
		$('#qty_in').val($('#qty'+id).val());
		$('#sat_in').val($('#sat'+id).val());
		//$('#tes2').val($('#tes'+id).val());
		$('#gud_in').val($('#gud').val());
		if(parseFloat($('#qty'+id).val())>parseFloat($("#tes"+id).text()))
		{ 
			//alert("Stok Yang di minta Melebihi Batas !!!"); 
			document.getElementById('form_index').submit();
			}
		else
		if($('#harga_in').val()=='' || $('#sat_in').val()=='' || $('#gud').val()=='0'){
			alert('Data tidak lengkap');	
		}else{
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
	
	function pindahData2(gud){

		window.location="index.php?x=transit&gud="+gud;
	}
	function satuan(i){
		$("#sat"+i).load("assets/inventory/order/satuan.php?id="+i);	
	}
/*$(document).ready(function(){
	alert('a');
	
	
});*/
function cek(id){
	alert('a');
}	

</script>