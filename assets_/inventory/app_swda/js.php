<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
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
	function pel(id){
		$.get('assets/inventory/salesorder/plaf.php?id='+id, function(data) {
				$('#hahaha').html(data);    
		});
	}
	function apptolak(){
		if (confirm("Data Ditolak, apakah anda yakin?")) {
            $('#jenisnya').val('tolak');
			javascript: document.getElementById('formku').submit();
        }
        return false;
	}
	function appsetuju(){
		if (confirm("Data Disetujui, apakah anda yakin?")) {
         	$('#jenisnya').val('setuju');
			javascript: document.getElementById('formku').submit();
		}
        return false;
		
	}
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/app_swda/data.php",
				"dataType": "jsonp"
				}
	} );
	
	function pindahData(jen){
		window.location="index.php?x=app_swda&jenis="+jen;
		
	}
	
	
	
	

</script>