<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,

            targets: [ 10 ]
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
			"scrollX": true,
			"ajax": {
				"url": "assets/master/amasset/data.php",
				"dataType": "jsonp"
				}
	} );
	function edit(id){
		$('#id').val(id);
		javascript: document.getElementById('form_index').submit();
		
	}
	function hapus(id){
		$('#id').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('form_index').submit();
		
	}
	function validate_frm()
		{
			
		try{
			x = document.formku;
			if (x.nama.value.length == 0)
			{
				alert('Nama tidak boleh kosong!');
				x.nama.focus();
				return(false);
			}
			return(true);
			}catch(e){
				alert('Error '+ e.description);
			}
		}
	$('#pri').number( true, 0 );	
	
function viewdk(a){
		//alert(a);
		//$('#mod').click();
		$.get('assets/master/amasset/detil.php?id='+a, function(data) {
				$('#hahaha').html(data);
			});
		setTimeout(function(){ dataajax(a); }, 500);
		//datareal(a);
	}
	
function simpan1(){
	str2=$('#tambah').serialize();
	$.ajax({
			type: "POST",
			url: "assets/master/amasset/tambah.php?jen=simpan",
			data: "&"+str2,
			cache: false,
			success: function(result){
					//alert(result);
					alert("Sukses Simpan");
					//$('#rel').html(); 
					//$('#datadt').html(data);
					setTimeout(function(){ dataajax(result); }, 500);
					//datareal(result);
					//$('#ketr').val('');
			}	
	});
}


function dataajax(a) {
	//alert(a);
	$.get('assets/master/amasset/datadtl.php?id='+a, function(data) {
		$('#rel').html(data);    
	});
} 
</script>