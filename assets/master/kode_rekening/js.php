<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
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
		
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/master/kode_rekening/data.php",
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
	function call(id){
		var expl=id.split('_');
		call2(expl[1])
	}
	function call2(st){
		//alert(st);
		if(st==1){
			$('#st').show();	
		}
		if(st==0){
			$('#st').hide();	
		}
	}
	
	
	function cab(){
		var jenis=$('#jenis1').val();
		if(jenis== 1 || jenis==2){}	
		
	}
	
	function jenis() {
			$("#jenis1").select2("val", "0");
			$("#jenis1").load("assets/master/kode_rekening/jenis.php?kel="+$("#kel").val());		
	}
	function head(a,b) {		
			$("#head1").select2("val", "0");
			$("#head1").load("assets/master/kode_rekening/head.php?kel="+a+"&jen="+b);
	}
		$("#kel").change(function(){
			//head();
			jenis();
			head($("#kel").val(),$("#jenis1").val());
		});
		
		$("#jenis1").change(function(){
			head($("#kel").val(),$("#jenis1").val());
			//jenis();
		});
	
		$( "#parent" ).change(function () {
			//alert('a');
			$( "#parent option:selected" ).each(function() {				
				 if($(this).text()=='Yes'){
					$("#sub1").hide();
					 }
 				if($(this).text()=='No'){
						$("#sub1").show();
						head($("#kel").val(),$("#jenis1").val());
					 }
				});
 	  	});

		
</script>