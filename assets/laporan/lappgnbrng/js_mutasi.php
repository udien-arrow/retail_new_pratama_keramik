<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 1 ]
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
	<?php if($_GET[gud]!=''){?>
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/laporan/persediaan/data.php?gud=<?=$_GET[gud]?>",
				"dataType": "jsonp"
				}
	} );
	<?php }?>
	function pindahData2(gud){
		window.location="index.php?x=lappersediaan&gud="+gud;
		
		
	}
	function satuan(i){	
		$("#sat"+i).load("assets/laporan/persediaan/mutasi.php?id="+i+"&gud=<?=$_GET[gud]?>");
	}
	function satuan2(i,sat){
		hg=$("#harga_asli"+i).val();
		
		explo=sat.split("_");
		
		harga=parseFloat(hg)*parseInt(explo[1]);
		
		$("#harga"+i).val(harga);
	}
	
</script>