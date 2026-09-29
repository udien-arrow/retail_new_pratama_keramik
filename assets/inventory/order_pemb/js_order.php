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
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/order_pemb/data_order.php",
				"dataType": "jsonp"
				}
	} );
	function openBo(id){
		if($("#stat_"+id).val()==0){
			$("#tr_"+id).show();
			$("#stat_"+id).val('1');
			document.getElementById('#sli_'+id).remove();
			//document.getElementById('#slide_'+id).className = "icon-diff-removed";
		}
		if($("#stat_"+id).val()==1){
			$("#tr_"+id).hide();
			$("#stat_"+id).val('0');
			document.getElementById('#sli_'+id).className = "icon-diff-removed";
		}
	}
	
	
	function hapuss(id2){
		//alert(id2);
		window.location="index.php?x=order-pemb&hp="+id2;
	}

</script>