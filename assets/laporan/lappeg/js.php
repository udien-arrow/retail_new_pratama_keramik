<script>

	$.extend( $.fn.dataTable.defaults, {
        autoWidth: true,
        columnDefs: [{ 
            orderable: false,
            targets: [ 2 ]
        }],
         dom: '<"datatable-header"f><"datatable-scroll"t>',
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
	
	 $('#example5').DataTable( {
			"processing": true,
			"serverSide": true,
			"scrollX": true,
			"scrollY": "400px",
       		"scrollCollapse": true,
        	"paging": true,
			"fixedColumns":  {
            "leftColumns": "1"
			},
			"ajax": {
				"url": "assets/laporan/lappeg/data.php?cab=<?=$_GET[cab]?>&a=<?=$_GET[a]?>&b=<?=$_GET[b]?>",
				"dataType": "jsonp"
				}
			
	} );
	

	
	function pindahData2(cab){
		window.location="index.php?x=lappeg&cab="+cab;
	}
	
	
	
</script>