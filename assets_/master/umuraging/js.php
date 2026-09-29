<script>
<?php if($_GET['slug']==''){?>
		var a='4';
		var d='data';
		var f='3';
<?php } if($_GET['slug']==1){?>
		var a='5';
		var d='data_sub';
		var f='4';
<?php } if($_GET['slug']==2){?>
		var a='6';
		var d='data_kat';
		var f='3';
<?php }?>
	
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
          
            targets: [ ''+a ]
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
	 $('#example'+a).DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/master/umuraging/"+d+".php?slug=<?=$_GET['slug']?>&id=<?=$_GET['id']?>&idsub=<?=$_GET['idsub']?>",
				"dataType": "jsonp"
				}
	} );
	function edit(id){
		$('#id').val(id);
		javascript: document.getElementById('form_index').submit();
		
	}
	function hapus(id){
		$('#id').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('form_index').submit();
		
	}
	function validate_frm()
		{
			
		try{
			x = document.formku;
			if (x.nama.value.length == 0)
			{
				alert('Nama tidak boleh kosong!');
				x.nama.focus();
				return(false);
			}
			return(true);
			}catch(e){
				alert('Error '+ e.description);
			}
		}

</script>