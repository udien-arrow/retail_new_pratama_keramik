<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,  
            targets: [ 2,3,4 ]
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
				"url": "assets/master/upahhar/data.php",
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
	/*function tampildepp(dep){
		location.href="index.php?x=barang&cd=k2&dep="+dep;
	}	
	function tampilsubdep(dep,subdep){
		location.href="index.php?x=barang&cd=k2&dep="+dep+"&sub="+subdep;
	}		
	function tampilkat(dep,subdep,kat){
		location.href="index.php?x=barang&cd=k2&dep="+dep+"&sub="+subdep+"&kat="+kat;
	}*/
	function tampildepp(dep){
		$("#subdep").load("assets/master/barang/subdep.php?id="+dep);
	}	
	function tampilsubdep(dep,subdep){
		//alert(subdep);
		$("#kat").load("assets/master/barang/kat.php?id="+dep+"&idsub="+subdep);
	}
		
	
	keranjang($('#kode').val());
	function openIframeAll(id,sat2,konversi)
			{   //alert(id+" - "+sat2+" - "+konversi);	
				if($('#sat').val()==0){ alert("Pilih Satuan Dasar");} else {
				$.ajax({
							type:"post",
							url:"assets/master/barang/simpan_konversi.php",
							data:"action=add&ID="+id+"&SAT2="+sat2+"&KONV="+konversi+"&SAT="+$('#sat').val(),
							success:function(data){
								 $("#comment").html(data);
								 //alert(data);
								 keranjang($('#kode').val());
							}
						  });
				}
			}
			
	function konv()
			{   
				$.ajax({
							type:"GET",
							url:"assets/master/barang/konv.php",
							data:"sat1="+$('#sat').val()+"&sat2="+$('#sat2').val(),
							success:function(data){
								$("#konversi").val(data);
							}
						  });
				
			}	
			function keranjang (id){
				$.get('assets/master/barang/konversi.php?id='+id,
				function(data) {
				  // alert(data);
				   $('#keranjang').html(data);
				});
			}	
		
		function hapuskeranjang(id)
		{
			$.ajax({
							type:"post",
							url:"assets/master/barang/simpan_konversi.php",
							data:"action=hapus&ID="+id,
							success:function(data){
								 $("#comment").html(data);
								 //alert(data);
								 keranjang($('#kode').val());
							}
						  });
		}
		function checkedAll(num){
    var id= document.getElementById('call');
    	if(id.checked==true){
			for (var i =1; i <= num; i++) 
    		{
			document.getElementById('split'+i).checked=true;
			}
		}else{
			for (var i =1; i <= num; i++) 
    		{
			document.getElementById('split'+i).checked=false;
    		}			
		}
      }


</script>