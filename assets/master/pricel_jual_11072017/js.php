<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 3,4,5,2 ]
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
	 <?php if($_GET['cab']!=''){?>
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/master/pricel_jual/data.php?cab=<?=$_GET['cab']?>&per=<?=$_GET['per']?>",
				"dataType": "jsonp"
				}
	} );
	<?php }?>
	function pindahan(jen,cab,per){
		location.href="index.php?x=pricel_jual&cab="+cab+"&per="+per+"&jen="+jen;
	}
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#id').val(id);
		$('#harga_in').val($('#harga'+id).val());
		$('#harga_inc').val($('#harga_cetak'+id).val());
		///alert('a');
		$('#sat_in').val($('#sat'+id).val());
		//alert('as');
		if($('#harga_in').val()==0 || $('#sat_in').val()=='' || $('#cab').val()=='' || $('#harga_in').val()==''){
			alert('Data tidak lengkap');	
		}else{
			javascript: document.getElementById('form_index').submit();
		}
	}
	function tambah_all(){
			$('#tambah_in').val('rame');
			javascript: document.getElementById('form_index').submit();
	}
	function pindah(gud,persen){
		window.location="index.php?x=pricel_jual&cab="+gud+"&per="+persen;
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
	function hitung(i){
		patok=$('#hpp_h'+i).val();
		patok_h=$('#harga_h'+i).val();
		sat=$('#sat'+i).val();
		expl=sat.split("_");
		
		
		harga=patok*expl[1];
		$('#hpp'+i).val(harga);
		harga2=patok_h*expl[1];
		$('#harga'+i).val(harga2);
		
		
	}
	function satuan(i){
		$("#sat"+i).load("assets/master/pricel_jual/satuan.php?id="+i);	
	}
	//$('.btn btn-default btn-icon kv-fileinput-upload').click(id);
	$(".kv-fileinput-upload").click(function(){
		alert('as');
	}); 
	function cekPel(d){
		
		//$('#mod').click();
		$.get('assets/master/pricel_jual/cekharga.php?id='+d, function(data) {
				$('#hahaha').html(data);    
		});
	}	

</script>