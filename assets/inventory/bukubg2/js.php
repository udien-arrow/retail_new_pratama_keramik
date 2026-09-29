<link rel="stylesheet" href="assets/css/extras/jquery-ui.css">
<script src="assets/js/js/jquery-ui.js"></script>

<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 2,1,3 ]
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
				"url": "assets/inventory/bukubg2/data.php",
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
	$( "#account" ).autocomplete({
		source: "assets/master/kas_bank/datakorek.php", 
		minLength:2, 
		change: function (event, ui) {
        if (!ui.item) {
            this.value = '';
        }
    }
  
	});
	
$('#nominal').number( true, 0 );
	
	
</script>