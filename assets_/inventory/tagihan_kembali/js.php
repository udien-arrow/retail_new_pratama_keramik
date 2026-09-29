<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ 6 ]
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
	<?php 
	if($_GET['id']!=''){
	
	?>
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/tagihan_kembali/data.php?id=<?=$_GET['id']?>",
				"dataType": "jsonp"
				}
	} );
	<?php } ?>
	function com(id){
		
		
	}
	
	
	
	function tambah(id){
		$('#tambah_in').val('ijen');
		$('#id').val(id);
		$('#dibayarx').val($('#dibayar'+id).val());
		$('#totalpiutangx').val($('#totalpiutang'+id).val());
		$('#no_fjx').val($('#no_fj'+id).val());
		$('#nama_bankx').val($('#nama_bank'+id).val());
		$('#no_rekx').val($('#no_rek'+id).val());
		$('#no_spjx').val($('#no_spj'+id).val());
		$('#no_seribgx').val($('#no_seribg'+id).val());
		$('#id_cusx').val($('#id_cus'+id).val());
		$('#tempo_normalx').val($('#tempo_normal'+id).val());
		$('#tempo_tambahanx').val($('#tempo_tambahan'+id).val());
		$('#jatuh_tempox').val($('#jatuh_tempo'+id).val());
		//alert($('#dibayar'+id).val()+' - '+$('#totalpiutang'+id).val());
		if(parseFloat($('#dibayar'+id).val()) > parseFloat($('#totalpiutang'+id).val())){
			alert('Melebihi Hutang');	
		}else if(parseFloat($('#dibayar'+id).val()) > parseFloat($('#deposit'+id).val())){
			alert('Melebihi Deposit');	
		}else{
			javascript: document.getElementById('form_index').submit();
		}
	}
	function pindahData(id){
		window.location="index.php?x=tagkem&id="+id;
	}
	function pindahData2(id,spj){
		window.location="index.php?x=tagkem&id="+id+"&spj="+spj;
	}
	function pindahData3(id,jenis){
		window.location="index.php?x=tagkem&id="+id+"&jenispem="+jenis;
	}
	function pindahData4(id,jenis,jenisb){
		window.location="index.php?x=tagkem&id="+id+"&jenispem="+jenis+"&jenisb="+jenisb;
	}
	function hapus(id){
		$('#id2').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('formku').submit();
		
	}
	function cek(id){
		if(Number($('#dibayar'+id).val().replace(/,/g,"")) > Number($('#totalpiutang'+id).val().replace(/,/g,""))){
			alert('Melebihi Hutang');
				$('#dibayar'+id).val($('#totalpiutang'+id).val());
		}
		<?php
		if($_GET['jenispem']==5){
		?>
		if(Number($('#dibayar'+id).val().replace(/,/g,"")) > Number($('#deposit'+id).val().replace(/,/g,""))){
			alert('Melebihi Deposit');
				$('#dibayar'+id).val($('#deposit'+id).val());
		}
		<?php }?>
		
		
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

//function forma(){
		$(".dibayar").number( true , 0 );
		$(".dibayar2").number( true , 0 );
//	}
$('#select-all').click(function(event) {   
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
function aaa(cus,id){
	//for(i=1;i<$('#jumrow').val();i++){
		/*$('#app_'+cus+'_'+i).each(function() {
            this.checked = true;                        
        });*/
		var id= document.getElementById('app_'+cus+'_'+id);
		ak=$('#cek_'+cus).val();
		if(id.checked==true){
			jum=0
			for(i=1;i<=ak;i++){
				document.getElementById('app_'+cus+'_'+i).checked=true;
				nil=$('#nilaipiutang_'+cus+'_'+i).val();
				jum=parseFloat(jum)+parseFloat(nil);
			}
			$('#dibayar').val(jum);
			$('#dibayar2').val(jum);
			$('#cusi').val(cus);
			$('#jumsi').val(ak);
		}else{
			jum=0
			for(i=1;i<=ak;i++){
				document.getElementById('app_'+cus+'_'+i).checked=false;
    		}
			$('#dibayar').val('0');
			$('#dibayar2').val('0');			
			$('#cusi').val('');
			$('#jumsi').val('');
		}
	//}
}
function bbb(){
	cusi=$('#cusi').val();
	jumsi=$('#jumsi').val();
	$('#dibayar2').val($('#dibayar').val());
	dibayar=$('#dibayar2').val();
	sis=0;
	for(i=1;i<=jumsi;i++){
		nil=$('#nilaipiutang2_'+cusi+'_'+i).val();
		if(dibayar>=nil && dibayar>0){
			$('#nilaipiutang_'+cusi+'_'+i).val(nil);	
		}else if(nil>=dibayar  && dibayar>0){
			$('#nilaipiutang_'+cusi+'_'+i).val(dibayar);	
		}else if(dibayar<0){
			$('#nilaipiutang_'+cusi+'_'+i).val('0');	
		}else if($('#dibayar').val()<nil){
			$('#nilaipiutang_'+cusi+'_'+i).val($('#dibayar').val());		
		}
		dibayar=dibayar-nil;
	}
}
function ccc(cus,nom){
	jumsi=$('#jumsi').val();
	jum=0
	for(i=1;i<=jumsi;i++){
		nil=$('#nilaipiutang_'+cus+'_'+i).val();		
		jum=jum+parseFloat(nil);
	}
	$('#dibayar').val(jum);
	$('#dibayar2').val(jum);
}
</script>