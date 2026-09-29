
<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 1,2,3 ]
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
				"url": "assets/inventory/appjual/data.php",
				"dataType": "jsonp"
				}
	} );
	function supi(cust,supi){
		var nom=$('#nom_'+cust).val();
		for(no=1;no<nom;no++){   
			//alert();
			bar=$('#bar_'+cust+'_'+no).val();
			klik(cust,supi,no,bar);
		}   
		haha(cust);
	}
	function haha(cust){
		setTimeout(function(){ hitsup(cust) }, 1000);
		
	}
	function hitsup(cust){
		nos=$('#nom_'+cust).val();
		//alert(cust);
		tota=0;
		for(noo=1;noo<nos;noo++){  
			jum=$('#bsin_'+cust+'_'+noo).val();
			//alert(jum);
			tota=parseInt(tota)+parseInt(jum);
		}
		//alert(tot);
		$('#totsup').text(tota);
		$('#gajisup').val(tota);
	}
	function klik(cust,supi,nom,bar){
		$.get('assets/inventory/appjual/bisup.php?bar='+bar+'&supir='+supi, function(data) {
				
				$('#bsin_'+cust+'_'+nom).val(data);  
				
		});
		
	}
	function clear(cust){
		var nom=$('#nom_'+cust).val();
		for(no=1;no<nom;no++){   
			$('#bsin_'+cust+'_'+no).val(''); 
		} 
		supi($('#cust').val(),$('#supirr').val());
		
	}
	function appsetuju(){
		if (confirm("Data Disetujui, apakah anda yakin?")) {
           
		   if($('#jenis_jual').val()=='LCO'){
			    if($('#nopol').val()!=''){
					$('#jenis').val('setuju');
					javascript: document.getElementById('formku').submit();
				}else{
					alert('Data Belum Lengkap');	
				}
		   }else{ 
				if($('#jenisken').val()!='' && $('#supirr').val()!=''){
					$('#jenis').val('setuju');
					javascript: document.getElementById('formku').submit();
				}else{
					alert('Data Belum Lengkap');	
				}
		   }
		}
        return false;
		
	}
	function appsetuju2(){
		if (confirm("Data Disetujui, apakah anda yakin?")) {
           	if($('#ambil').val()!=''){
					$('#jenis').val('setuju');
					javascript: document.getElementById('formku').submit();
				}else{
					alert('Data Belum Lengkap');	
				}
		}
        return false;
		
	}
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#no_so_in').val(id);
		javascript: document.getElementById('form_index').submit();
		
	}
	function hapus(id){
		$('#id2').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('formku').submit();
		
	}
	function apptolak(){
		if (confirm("Data Ditolak, apakah anda yakin?")) {
            $('#jenis').val('tolak');
			javascript: document.getElementById('formku').submit();
        }
        return false;
		
	}
	function pel(id){
		$.get('assets/inventory/salesorder/plaf.php?id='+id, function(data) {
				$('#hahaha').html(data);    
		});
	}
	function muatan(id){
		if(id==''){
			alert('Jenis Kendaraan Belum dipilih');
		}else{
			$.get('assets/inventory/appjual/muatan.php?id='+id, function(data) {
				$('#hahaha2').html(data);    
			});	
		}
	}
	
	function hit(){
		var jumcus = $('#jumlah_cus').val();	
		for(i=1;i<jumcus;i++){
			var cus=$('#custo_'+i).val();
			var no=$('#nomer_'+cus).val();
			for(j=1;j<no;j++){
				bar=$('#bar_'+cus+'_'+j).val();	
				qty=$('#qty_'+cus+'_'+j).val();	
				inp=$('#biam_'+cus+'_'+j).val()
				$.get('assets/inventory/appjual/hitungpkbm.php?id='+bar+'&qty='+qty+'&cusi='+cus+'&ji='+j, function(data) {
						expp=data.split("_");
						if($('#ambil').val()==2){
							$('#biam_'+expp[1]+'_'+expp[2]).val(expp[0]);
							$('#berat_'+expp[1]+'_'+expp[2]).val(expp[3]);	
						}else{
							$('#biam_'+expp[1]+'_'+expp[2]).val('0');	
							$('#berat_'+expp[1]+'_'+expp[2]).val('0');	
						}
				});
				
			}
		}
		
		
	}
	
	function kenda(id,kend){
		//muatan(kend);
		
		$.get('assets/inventory/appjual/keranjang_retri.php?id='+id+'&kend='+kend, function(data) {
		//alert(data);
				$('#ker_retri').html(data);    
		});
		
		clear($('#cust_old').val());
		$('#cust_old').val(id);
		$('#mod2').click();
	}
	
	
	

</script>