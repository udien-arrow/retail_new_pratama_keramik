<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 3,4,2,1,5,6,7 ]
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
				"url": "assets/inventory/app_spj/data.php",
				"dataType": "jsonp"
				}
	} );
	function appsetuju(id){
		if (confirm("Gudang penerima akan dialihkan, apakah anda yakin?")) {
            $('#id').val(id);
			$('#stain').val($('#sta'+id).val());
			$('#jenis').val('setuju');
			$('#spjin').val($('#spj'+id).val());
			$('#gudin').val($('#gud'+id).val());
			//alert('a');
			javascript: document.getElementById('form_index').submit();
        }
        return false;
	}
	function apptolak(id){
		if (confirm("Data Ditolak, apakah anda yakin?")) {
            $('#id').val(id);
			$('#stain').val($('#sta'+id).val());
			$('#spjin').val($('#spj'+id).val());
			$('#jenis').val('tolak');
			//alert(id);
			javascript: document.getElementById('form_index').submit();
        }
        return false;
		
	}
	
	
	

</script>