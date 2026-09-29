<script>
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100%',
            targets: [ 2,3,4,5,6,7,8 ]
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
				"url": "assets/inventory/prp/data.php?spb=<?=$_GET[spb]?>&jenis=<?=$_GET[jenis]?>&supp=<?=$_GET[supp]?>&nopp=<?=$_GET[nopp]?>",
				"dataType": "jsonp"
				}
	} );
	<?php }?>
	function caridata(id,supp){
		explo=id.split("_");
		$("#id_daerah"+supp).val(explo[0]);
		$("#gudang"+supp).val(explo[1]);
		$("#shipto_code"+supp).load("assets/inventory/order/carishipto.php?id="+id);	
	}
	function tambah(id){
		//alert(id);
		$('#tambah_in').val('ijen');
		$('#id').val(id);
		$('#qty_in').val($('#qty'+id).val());
		$('#sat_in').val($('#sat'+id).val());
		$('#harga_in').val($('#harga'+id).val());
		$('#bonus_in').val($('#bonus'+id).val());
		$('#disc_in').val($('#disc'+id).val());
		$('#tgl_kirim_in').val($('#qty_minta'+id).val());
		//alert('a');
		jenbar=$('#jenis_barang').val();
		if(jenbar==''){
			$('#jenis_barang').val($('#jen_bar'+id).val())	
			jenbar=$('#jenis_barang').val();
		}
		//alert(jenbar);
		if(jenbar==1){
			if( $('#harga_in').val()==0 || $('#harga_in').val()=='' || $('#qty').val()=='0' ){
				alert('Data tidak lengkap');	
			}else{
				javascript: document.getElementById('form_index').submit();
			}
		}else if(jenbar==3){
			if( $('#supp').val()=='' || $('#qty').val()=='0'){
				alert('Data tidak lengkap');	
			}else{
				javascript: document.getElementById('form_index').submit();
			}
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
	function batal(supp){
		$('#aksi').val('batal');
		$('#supp2').val(supp);
		javascript: document.getElementById('formku').submit();
		
	}
	function pindahData8(jenis,nopp,jenisnya){
		window.location="index.php?x=prp&jenisnya="+jenisnya+"&jenis="+jenis+"&nopp="+nopp;
		
	}
	function pindahData7(jenisnya,jenis){
		window.location="index.php?x=prp&jenisnya="+jenisnya+"&jenis="+jenis;
		
	}
	function pindahData(spb){
		window.location="index.php?x=prp&jenis="+spb+"&spb=";
		
	}
	function pindahData2(jen,spb,jenisnya){
		window.location="index.php?x=prp&jenis="+jen+"&spb="+spb+"&jenisnya="+jenisnya;
		
	}
	function pindahData3(jen,spb,supp,jenisnya){
		window.location="index.php?x=prp&jenis="+jen+"&spb="+spb+"&supp="+supp+"&jenisnya="+jenisnya;
		
	}

	function satuan(i,sat){
		$("#sat"+i).load("assets/inventory/prp/satuan.php?id="+i+"&jenis=<?=$_GET[jenis]?>&spb=<?=$_GET[spb]?>&supp=<?=$_GET[supp]?>&cd=b2");
	}
	function satuann(i,sat){
		$("#sat"+i).load("assets/inventory/prp/satuan2.php?id="+i+"&jenis=<?=$_GET[jenis]?>&spb=<?=$_GET[spb]?>&supp=<?=$_GET[supp]?>&cd=b2");
	}
	function satuan2(i,sat){
		<?php if($_GET['jenis']==2){?>
		hg=$("#harga_asli"+i).val();
		qt=$("#qty_asli"+i).val();
		explo=sat.split("_");
		qty=qt/explo[1];
		harga=parseFloat(hg)*parseInt(explo[1]);
		$("#harga"+i).val(harga);
		$("#qty"+i).val(qty);
		<?php }?>
		<?php if($_GET['jenis']==3){?>
		hg=$("#harga_asli"+i).val();
		explo=sat.split("_");
		harga=parseFloat(hg)*parseInt(explo[1]);
		$("#harga"+i).val(harga);
		<?php }?>
		
	}
	function hitung(idsupp){
		if($("#dg_persen"+idsupp).val()==''){
			$("#grant"+idsupp).val($("#grant2"+idsupp).val());
			$("#dg_rupiah"+idsupp).val('');
		}else{
			disc_jumlah=parseInt($("#grant2"+idsupp).val()*($("#dg_persen"+idsupp).val()/100));
			subt=parseInt($("#grant2"+idsupp).val()-disc_jumlah );
			$("#grant"+idsupp).val(subt);
			$("#dg_rupiah"+idsupp).val(disc_jumlah);
		}
	}
	function hitung2(idsupp){
			disc_jumlah=parseInt($("#grant2"+idsupp).val() - $("#dg_rupiah"+idsupp).val());
			
			total=parseInt(disc_jumlah);
			discper=($("#dg_rupiah"+idsupp).val()*100)/$("#grant2"+idsupp).val();
			$("#dg_persen"+idsupp).val(discper.toFixed(2));
			$("#grant"+idsupp).val(total);
		
	}
	function forma(){
		$(".hargab").number( true , 0 );
	}
		
		$( "#qty_minta" ).attr("class","datepicker" );

</script>