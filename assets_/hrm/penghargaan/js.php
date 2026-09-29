<script>
<?php if($_GET['slug']==''){?>
		var a='4';
		var d='data';
		var f='3';
<?php } if($_GET['slug']==1){?>
		var a='5';
		var d='data_sub';
		var f='4';
<?php }?>
	
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 1,2 ]
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
				"url": "assets/hrm/penghargaan/"+d+".php?slug=<?=$_GET['slug']?>&id=<?=$_GET['id']?>",
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
		$( "#aaa" ).change(function () {
			$( "#aaa option:selected" ).each(function() {
				 if($(this).text()==1){
					$("#coba").hide();
				 }
				 if($(this).text()==2){
					$("#coba").show();
				 }  
			});
 		 })
		 
		 

</script>