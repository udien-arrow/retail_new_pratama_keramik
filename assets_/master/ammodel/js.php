<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,

            targets: [4]
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
				"url": "assets/master/ammodel/data.php",
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
	function viewdk(a){
	//alert(a);
		//$('#mod').click();
		$.get('assets/master/ammodel/detil.php?id='+a, function(data) {
				$('#hahaha').html(data);
			});
		setTimeout(function(){ dataajax(a); }, 500);
		setTimeout(function(){ datareal(a); }, 1000);
	}

	$("#depresiasi").change(function(){
    	if($("#depresiasi").val()==="1"){
		$("#dep").show();
		$("#depres").attr("required", true);
		} 
		else {
			$("#dep").hide();
			$("#depres").attr("required", false);
			}
	});
</script>