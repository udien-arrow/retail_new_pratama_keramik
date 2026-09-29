<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 2,3,4,5,6,7,8 ]
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
				"url": "assets/inventory/bukubg/data_stok.php",
				"dataType": "jsonp"
				}
	} );
	function appsetuju(id){
		if (confirm("Data Disetujui, apakah anda yakin?")) {
            $('#id').val(id);
			$('#jenis').val('setuju');
			javascript: document.getElementById('form_index').submit();
        }
        return false;
		
	}
	function apptolak(id){
		if (confirm("Data Ditolak, apakah anda yakin?")) {
            $('#id').val(id);
			$('#jenis').val('tolak');
			javascript: document.getElementById('form_index').submit();
        }
        return false;
		
	}
	
	
   $('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    }
	 else {
    $(':checkbox').each(function() {
          this.checked = false;
	});
	 }
});

function roll(id){
	if (confirm("Data Akan diganti blonk, apakah anda yakin?")) {
            $('#id').val($('#idbuku'+id).val());
			$('#jenis').val('setuju');
			javascript: document.getElementById('form_index').submit();
       }
        return false;

	
	}


</script>