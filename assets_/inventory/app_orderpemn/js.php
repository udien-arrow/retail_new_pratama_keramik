<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 3 ]
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
				"url": "assets/inventory/app_orderpemn/data.php?jenis=<?=$_GET['jenis']?>&st=<?=$_GET['st']?>&sta=<?=$_GET['sta']?>&level=<?=$_GET['level']?>&cab=<?=$_GET['cab']?>&kode=<?=$_GET['kode']?>",
				"dataType": "jsonp"
				}
	} );
	
	function pindahData(jen,a,b,c,d){
		window.location="index.php?x=app_orderpemn&jenis="+jen+"&st="+a+"&level="+b+"&sta="+c+"&cab="+d;
		
	}
	
	function pindahData2(a){
		window.location="index.php?x=app_orderpemn&cab="+a;
		
	}
	
	function appsetuju(id){
		if (confirm("Data Disetujui, apakah anda yakin?")) {
            $('#id').val(id);
			$('#jenisnya').val('setuju');
			javascript: document.getElementById('formku').submit();
        }
        return false;
		
	}
	function apptolak(id){
		if (confirm("Data Ditolak, apakah anda yakin?")) {
            $('#id').val(id);
			$('#jenisnya').val('tolak');
			javascript: document.getElementById('formku').submit();
        }
        return false;
		
	}
	
	
	

</script>