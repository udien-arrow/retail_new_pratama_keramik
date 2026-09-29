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
	/*function supi(cust,supi){
		
		var nom=$('#nom_'+cust).val();
		for(no=1;no<nom;no++){   
			//alert();
			bar=$('#bar_'+cust+'_'+no).val();
			klik(cust,supi,no,bar);
		}   
		haha(cust);
	}*/
	function supi(supi){
		var nom=$('#nome').val();
   		  //alert(nom);
		  for(no=1;no<=nom;no++){   
			var cu=$('#cu_'+no).val();
			var nom2=$('#nom_'+cu).val();
			for(no2=1;no2<nom2;no2++){   
				bar=$('#bar_'+cu+'_'+no2+'_'+no).val();
				qty=$('#qty_'+cu+'_'+no2+'_'+no).val();
				klik(cu,supi,no2,bar,qty,no);
				klik2(cu,qty,no2,bar,no);
			}
			
			//hitsup(cu)
		  } 
		  haha();  
	}
	function haha(){
		setTimeout(function(){ hitsup() }, 2000);
		setTimeout(function(){ hitsup2() }, 2000);
	}
	function direct2(){
		//alert('a');
		location.href="index.php?x=appjual_d&id=<?=$_GET['id']?>";
	}
	function hitsup(){
		//nos=$('#nom_'+cust).val();
		tota=0;
		
		var nom=$('#nome').val();
   		//alert(nom);
		  for(no=1;no<=nom;no++){
			var cu=$('#cu_'+no).val();
			var nom2=$('#nom_'+cu).val();
			for(no2=1;no2<nom2;no2++){   
				jum=$('#bsin_'+cu+'_'+no2+'_'+no).val();
				tota=parseInt(tota)+parseInt(jum);
			}
		  }
		 // alert(tota);
		$('#gajisup').val(tota);
	}
	function hitsup2(){
		tota=0;
		var nom=$('#nome').val();
   		//alert(nom);
		  for(no=1;no<=nom;no++){
			var cu=$('#cu_'+no).val();
			var nom2=$('#nom_'+cu).val();
			for(no2=1;no2<nom2;no2++){   
				jum=$('#bmu_'+cu+'_'+no2+'_'+no).val();
				tota=parseInt(tota)+parseInt(jum);
			}
		  }
		$('#totbongkartoko').val(tota);
	}
	/*function hitsup(cust){
		
		nos=$('#nom_'+cust).val();
		tota=0;
		for(noo=1;noo<nos;noo++){  
			jum=$('#bsin_'+cust+'_'+noo).val();
			//alert(jum);
			tota=parseInt(tota)+parseInt(jum);
		}
		//alert(tot);
		$('#totsup').text(tota);
		$('#gajisup').val(tota);
	}*/
	function klik(cust,supi,nom,bar,qty,nom2){
		$.get('assets/inventory/appjual/bisup.php?bar='+bar+'&supir='+supi+'&qty='+qty, function(data) {
				//alert(data);
				$('#bsin_'+cust+'_'+nom+'_'+nom2).val(data);  	
		});
	}
	function klik2(cust,qty,nom,bar,nom2){
		$.get('assets/inventory/appjual/bibong.php?cust='+cust+'&bar='+bar+'&qty='+qty, function(data) {
		//	alert(nom2);
				$('#bmu_'+cust+'_'+nom+'_'+nom2).val(data);  	
		});
	}
	/*function clear(cust){
		var nom=$('#nom_'+cust).val();
		for(no=1;no<nom;no++){   
			$('#bsin_'+cust+'_'+no).val(''); 
		}
		 
		supi($('#cust').val(),$('#supirr').val());
	}*/
	function nil(a){
	 	//alert(a.substr(0, 1));
	if(a.substr(0, 1)!='-'){	
		uk=0;
		pat = $("#totujs2").val();
		//nil = $("#bl").val();
		if(a>0){
			uk=parseInt(a)+parseInt(pat);
			$("#totujs").val(uk);
		}else{
			//alert('a');
			$("#totujs").val($("#totujs2").val());		
		}
	}else{
		a=parseInt(a.substr(1, 11));
		uk=0;
		pat = $("#totujs2").val();
		if(a>0){
			uk=parseFloat(pat)-parseFloat(a);
			$("#totujs").val(uk);
		}else{
			//alert('a');
			$("#totujs").val($("#totujs2").val());		
		}
	}
	}
	
	
	$(".hargab").number( true , 0 );
	
	function appsetuju(){
		if (confirm("Data Disetujui, apakah anda yakin?")) {
           
		   if($('#jenis_jual').val()=='LCO'){
			    //if($('#nopol').val()!=''){
					$('#jenis').val('setuju');
					javascript: document.getElementById('formku').submit();
				//}else{
					//alert('Data Belum Lengkap');	
				//}
		   }else{ 
				if($('#nopol').val()!='' && $('#supirr').val()!=''){
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
	function appsetuju3(){
		if (confirm("Data Disetujui, apakah anda yakin?")) {
           	if($('#cabangto').val()!=''){
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
		alert('a');
		var jumcus = $('#jumlah_cus').val();	
		for(i=1;i<jumcus;i++){
			var cus=$('#custo_'+i).val();
			var no=$('#nomer_'+cus).val();
			for(j=1;j<no;j++){
				bar=$('#bar_'+cus+'_'+j+'_'+i).val();	
				qty=$('#qty_'+cus+'_'+j+'_'+i).val();	
				//inp=$('#biam_'+cus+'_'+j).val()
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
	function kenda(id,kend,gud){
		$.get('assets/inventory/appjual/keranjang_retri.php?id='+id+'&gud='+gud+'&kend='+kend, function(data) {
		//alert(data);
				$('#ker_retri').html(data);    
		});
		
		//clear($('#cust_old').val());
		$('#cust_old').val(id);
		//$('#mod2').click();
		haha();
	}
	
	
	

</script>