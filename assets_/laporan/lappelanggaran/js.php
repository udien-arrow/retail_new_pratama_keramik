<script>
	$.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 1,2,4,5 ]
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
	<?php 
	if($_GET['a']!=''){
	
	?>
	 $('#example5').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/laporan/lappelanggaran/data.php?a=<?=$_GET[a]?>&b=<?=$_GET[b]?>",
				"dataType": "jsonp"
				}
	} );
	
	<?php } ?>
	
	function pindahData2(a,b){
		window.location="index.php?x=lappelanggaran&a="+a+"&b="+b;
	}
	
</script>