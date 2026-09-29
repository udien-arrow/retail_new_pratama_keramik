<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 3,4 ]
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
				"url": "assets/inventory/app_prp/data.php",
				"dataType": "jsonp"
				}
	} );
	function appsetuju(id,no){
		if (confirm("Data Disetujui, apakah anda yakin?")) {
            $('#id').val(id);
			$('#jenis').val('setuju');
			//a=$('#jenis_p2'+id).val();
			//$('#jenis_p').val(a);	
			javascript: document.getElementById('formku').submit();
        }
        return false;
		
	}
	function apptolak(id,no){
		if (confirm("Data Ditolak, apakah anda yakin?")) {
            $('#id').val(id);
			$('#jenis').val('tolak');
			//a=$('#jenis_p2'+id).val();
			//$('#jenis_p').val(a);	
			javascript: document.getElementById('formku').submit();
        }
        return false;
		
	}
	
	function apptolakrev(id,no){
		if (confirm("Data Ditolak, apakah anda yakin?")) {
            $('#id').val(id);
			$('#jenis').val('tolakrev');
			//a=$('#jenis_p2'+id).val();
			//$('#jenis_p').val(a);	
			javascript: document.getElementById('formku').submit();
        }
        return false;
		
	}
	
	
	

</script>