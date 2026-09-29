<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 2,3,4,5,6 ]
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
	keranjang($('#kode').val());
	function openIframeAll(id,name)
			{   //alert(id+" - "+sat2+" - "+konversi);	
				if($('#shipto_code').val()=='' || $('#shipto_name').val()==''){ alert("Pilih Satuan Dasar");} else {
				$.ajax({
					type:"post",
					url:"assets/master/gudang/simpan_shipto.php",
					data:"action=add&code="+id+"&name="+name,
					success:function(data){
						 $("#comment").html(data);
						 //alert(data);
						 keranjang($('#kode').val());
					}
				  });
			}
	}
	function keranjang (id){
				$.get('assets/master/gudang/shipto.php?id='+id,
				function(data) {
				  // alert(data);
				   $('#keranjang').html(data);
				});
	}
	 
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/master/gudang/data.php",
				"dataType": "jsonp"
				}
	} );
	
	$('#example5').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/master/gudang/data_gudang.php?id=<?=$_GET['id']?>",
				"dataType": "jsonp"
				}
	} );
	
	$('#example6').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/master/gudang/data_gudang_in.php?id=<?=$_GET['id']?>",
				"dataType": "jsonp"
				}
	} );
	
		
	
	
	function dtlbarang(id){
			window.location="<?=$_SERVER['PHP_SELF']?>?x=gudang&id="+id;	
	}
	function edit(id){
		$('#id').val(id);
		$('#jenis4').val('edit');
		javascript: document.getElementById('form_index').submit();
		
	}
	function hapus(id){
		$('#id').val(id);
		$('#jenis4').val('hapus');
		javascript: document.getElementById('form_index').submit();
		
	}
	function hapus_bar(id){
		$('#id').val(id);
		$('#jenis3').val('hapus_bar');
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
	function tambah(id){
		
		$('#id_barang').val(id);
		$('#min_in').val($('#min'+id).val());
		$('#max_in').val($('#max'+id).val());
		javascript: document.getElementById('form_index').submit();
		
	}
	function tambah_all(){
			$('#jenis2').val('rame');
			javascript: document.getElementById('form_index').submit();
	}
</script>