<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 7 ]
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
	<?php if($_GET['cus']){?>
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/buku_tagihan/data.php?cus=<?=$_GET['cus']?>",
				"dataType": "jsonp"
				}
	} );
	<?php }?>
	function com(id){
		
		
	}
	function ambilbg(id){
		$.get('assets/inventory/buku_tagihan/ambilbg.php?id='+id, function(data) {
			spl=data.split('_');
			if(spl[1]==1){
				$('#bukubg'+id).show();
			}
		});
	}
	function show(id){
		$.get('assets/inventory/buku_tagihan/bukubg.php?id='+id, function(data) {
				$('#hahaha').html(data);    
		});
	}
	
	
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#id').val(id);
		$('#totalpiutang2').val($('#totalpiutang'+id).val());
		$('#idcus2').val($('#idcus'+id).val());
		$('#tempo_normal2').val($('#tempo_normal'+id).val());
		$('#tempo_tambahan2').val($('#tempo_tambahan'+id).val());
		if($('#idcus').val()==''){
			alert('Data tidak lengkap');	
		}else{
		    javascript: document.getElementById('form_index').submit();
		}
	}
	//$("#cus").load("assets/inventory/buku_tagihan/pelanggan.php");	
	function pindahdatapel(aa,j){
		window.location="index.php?x=bukta&cus="+aa+"&jen="+j;
	}
	function pindahjen(){
		window.location="index.php?x=bukta&cus="+$('#cusa').val()+"&jenis="+$('#jenis').val();
	}
	function pindahData(id){
		//alert(id);
		window.location="index.php?x=korpi&id="+id;
	}
	function hapus(id){
		$('#id2').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('formku').submit();
		
	}
	
	function tambah_all(){
			$('#tambah_in').val('rame');
			javascript: document.getElementById('form_index').submit();
	}
	function batal(){
		$('#aksi').val('batal');
		javascript: document.getElementById('formku').submit();
		
	}

	function selisih(d){
		alert($("#tes"+d).val());
		stok=$("#tes").val();
		fisik=$("#stokfisik").val();
		selisih = stok-fisik;
		$("#selisih").val(selisih);
	}

	function satuan(i,g){
		//alert(g);
		$("#stok_sys"+i).load("assets/inventory/stok_opname/mutasi.php?id="+i+"&gudang="+g);	
	}
	//$('.btn btn-default btn-icon kv-fileinput-upload').click(id);
	$(".kv-fileinput-upload").click(function(){
		alert('as');
	}); 
	function forma(){
		$(".hargab").number( true , 0 );
	}
$(".hargab").number( true , 0 );
	
$('#cek_all').click(function(event) {   
     if(this.checked) {
      // Iterate each checkbox
      $(':checkbox').each(function() {
          this.checked = true;
      });
  }
  else {
    $(':checkbox').each(function() {
          this.checked = false;
      });
  }
});
function cekPel(){
		$.get('assets/inventory/buku_tagihan/fak.php', function(data) {
				//alert(data);
				$('#hahaha2').html(data);    
		});
	}
	function hitung(no){
		var a=$("#total_piutang"+no).val();	
		var b=$("#dibayar"+no).val();
		
		if( b ==''){
			$("#dibayar"+no).val('0')
			$("#sisa"+no).val('0')
		}else{
			if(parseInt(b)>parseInt(a)){
				$("#dibayar"+no).val('0')
				$("#sisa"+no).val('0')
			}else{
				$("#sisa"+no).val( parseFloat(a) - parseFloat(b))
			}
		}
			
	}
function hitungan(no){
		var id = document.getElementById('no_faktur'+no);
    	if(id.checked==true){
			tot = $("#tot").val();
			dibay = $("#dibayar"+no).val();
			totpi = $("#total_piutang"+no).val();
			jumr = $("#jumrow").val( )
			
			$("#dibayar"+no).val( totpi )
			toti = parseFloat(totpi) + parseFloat(tot);
			
			$("#tot").val( toti )
			
			jum = parseInt(jumr) + 1;
			$("#jumrow").val( jum )
			
		}else{
			tot = $("#tot").val();
			dibay = $("#dibayar"+no).val();
			totpi = $("#total_piutang"+no).val();
			jumr = $("#jumrow").val( )
			
			$("#dibayar"+no).val( 0 )
			toti = parseFloat(tot) - parseFloat(totpi);
			
			$("#tot").val( toti )
			
			jum = parseInt(jumr) - 1;
			$("#jumrow").val( jum )
		}
      
}	
	$("#tot").number( true , 0 );
</script>