<script>
 	$.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 6 ]
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
			"url": "assets/akutansi/kaskecil/data.php",
			"dataType": "jsonp"
		}
	});

	function edit(id){
		$('#id').val(id);
		window.location="index.php?x=kaskecil_d&id="+id;
	}
	function cetak(id){
		$('#id').val(id);
		window.location="cetak.php?page=lapkaskecil&id="+id;
	}
	
	function hapus(idx,id){
		//alert (id);
		window.location="index.php?x=kaskecil_d&id="+id+"&idx="+idx+"&aksi=hapus";
	}

	function clos(id){
		alert ("Kas Kecil No "+id+" sudah di Close");
	}

	function validate_frm() {			
		try{
			x = document.formku;
			if (x.jml.value.length == 0)
			{
				alert('Jumlah tidak boleh kosong!');
				x.jml.focus();
				return(false);
			}
			return(true);
		}catch(e){
			alert('Error '+ e.description);
		}
	}

	$("#jml").number( true , 0 );
		
</script>