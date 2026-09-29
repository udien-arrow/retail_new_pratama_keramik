<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 3,4,1 ]
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
				"url": "assets/inventory/appriject/data.php",
				"dataType": "jsonp"
				}
	} );
	function appsetuju(){
		
		if (confirm("Data disetujui, apakah anda yakin?")) {
            //$('#id').val(id);
			//$('#stain').val($('#sta'+id).val());
			//$('#no_orderin').val($('#no_order'+id).val());
			$('#jenis').val('setuju');
			javascript: document.getElementById('form_index2').submit();
        }
        return false;
	}
	function apptolak(id){
		if (confirm("Data Ditolak, apakah anda yakin?")) {
            $('#id').val(id);
			$('#no_orderin').val($('#no_order'+id).val());
			$('#stain').val($('#sta'+id).val());
			$('#jenis').val('tolak');
			javascript: document.getElementById('form_index').submit();
        }
        return false;
		
	}
	
	
	

</script>