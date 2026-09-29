<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 2,3,4 ]
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
				"url": "assets/inventory/kirimda/data.php",
				"dataType": "jsonp"
				}
	} );
	$("#custo").load("assets/inventory/salesorder/pelanggan.php");	
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
	function pindahdata(){
		window.location="index.php?x=kirimda&id=<?=$_GET['id']?>&cus="+$('#custo').val();
	}
	
function pindahk(){
$('#idnyas').val($('#ids'+i).val());
}

</script>