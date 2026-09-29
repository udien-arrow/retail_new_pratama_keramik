<script>

 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            prpable: false,
            width: '100px',
            targets: [ 2,3,4,5 ]
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
	<?php if($_GET['jenis']!=''){?>
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/prp/data.php?spb=<?=$_GET[spb]?>&jenis=<?=$_GET[jenis]?>&supp=<?=$_GET[supp]?>",
				"dataType": "jsonp"
				}
	} );
	<?php }?>
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#id').val(id);
		$('#qty_in').val($('#qty'+id).val());
		$('#sat_in').val($('#sat'+id).val());
		$('#harga_in').val($('#harga'+id).val());
		$('#bonus_in').val($('#bonus'+id).val());
		
		if($('#harga_in').val()=='' || $('#qty').val()=='0'){
			alert('Data tidak lengkap');	
		}else{
			javascript: document.getElementById('form_index').submit();
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
	function pindahData(spb){
		window.location="index.php?x=prp&jenis="+spb+"&spb=";
		
	}
	function pindahData2(jen,spb){
		window.location="index.php?x=prp&jenis="+jen+"&spb="+spb;
		
	}
	function pindahData3(jen,spb,supp){
		window.location="index.php?x=prp&jenis="+jen+"&spb="+spb+"&supp="+supp;
		
	}

	function satuan(i,sat){
		
		$("#sat"+i).load("assets/inventory/prp/satuan.php?id="+i+"&jenis=<?=$_GET[jenis]?>&spb=<?=$_GET[spb]?>&supp=<?=$_GET[supp]?>&cd=b2");
	}
	function satuan2(i,sat){
		hg=$("#harga_asli"+i).val();
		
		explo=sat.split("_");
		
		harga=parseFloat(hg)*parseInt(explo[1]);
		
		$("#harga"+i).val(harga);
	}



</script>