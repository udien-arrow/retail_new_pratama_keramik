<script>

 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
        orderable: false,
            	targets: [ 1,2,3,4,5 ]
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
				"url": "assets/inventory/billing/data.php?supp="+supp,
				"dataType": "jsonp"
				}
	} );
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#id').val(id);
		$('#sat_in').val($('#sat'+id).val());
		$('#qty_in').val($('#qty'+id).val());
		$('#harga_in').val($('#harga'+id).val());
		if($('#harga_in').val()=='' || $('#qty_in').val()==''){
			alert('Data tidak lengkap');	
		}else{
			javascript: document.getElementById('form_index').submit();
		}
	}
	function pindahData2(){
		//alert('as');
		window.location="index.php?x=billing&supp="+$('#supp').val()+"&noref="+$('#noref').val();
	}
	function checkedAll(num){
    	var id= document.getElementById('call');
    	if(id.checked==true){
			for (var i =1; i <= num; i++) 
    		{
				document.getElementById('split'+i).checked=true;
				$('#jum').val(num);
				
			}
			$('#total_bil').val($('#total_bil2').val());
		}else{
			for (var i =1; i <= num; i++) 
    		{
				$('#jum').val('0');
				
				document.getElementById('split'+i).checked=false;
    		}	
			$('#total_bil').val('0');		
		}
    }
	function hit(no){
		var spj= document.getElementById('split'+no);
		var id= document.getElementById('jum').value;
		var tot= document.getElementById('total'+no).value;
    	if(spj.checked==true){
			a=parseInt(id)+1;
			$('#jum').val(a);
			b=parseFloat(tot)+parseFloat($('#total_bil').val());
			$('#total_bil').val(b);
		}else{
			a=parseInt(id)-1;
			$('#jum').val(a);		
			b=parseFloat($('#total_bil').val())-parseFloat(tot);
			$('#total_bil').val(b);	
		}
	}
	function tambah_all(){
			$('#tambah_in').val('rame');
			javascript: document.getElementById('form_index').submit();
	}
	function hapus(id){
		$('#id2').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('formku').submit();
		
	}
	function batal(){
		$('#aksi').val('batal');
		javascript: document.getElementById('formku').submit();
		
	}

	function satuan(i){
		$("#sat"+i).load("assets/master/pricel/satuan.php?id="+i);	
	}

function forma(){
		$(".hargab").number( true , 0 );
	}

</script>