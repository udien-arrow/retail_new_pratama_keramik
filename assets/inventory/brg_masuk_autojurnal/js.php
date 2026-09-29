<script>

 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,

            targets: [ 2,3,4,5,6,7]
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
<?php if($_GET[spb]!=''){?>	
	 $('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/brg_masuk/data.php?spb=<?=$_GET[spb]?>&jenis=<?=$_GET[jenis]?>&supp=<?=$_GET[supp]?>",
				"dataType": "jsonp"
				}
	 });
<?php }elseif($_GET[spj]!=''){?>
	$('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/brg_masuk/data2.php?spj=<?=$_GET[spj]?>&jenis=<?=$_GET[jenis]?>&supp=<?=$_GET[supp]?>",
				"dataType": "jsonp"
				}
	});
<?php }elseif($_GET[spm]!=''){?>
	$('#example4').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/inventory/brg_masuk/data3.php?spm=<?=$_GET[spm]?>&jenis=<?=$_GET[jenis]?>&supp=<?=$_GET[supp]?>",
				"dataType": "jsonp"
				}
	});
<?php }?>
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
	function pindahData(spb){
		window.location="index.php?x=brg_masuk&jenis="+spb+"&spb=";
	}
	function pindahData2(jen,spb){
		window.location="index.php?x=brg_masuk&jenis="+jen+"&spb="+spb;
	}
	function pindahData22(jen,spj){
		if(spj=='all'){
			$("#allspj").show();
			$("#allspj2").show();
		}else{
			$("#allspj").hide();
			$("#allspj2").show();
			window.location="index.php?x=brg_masuk&jenis="+jen+"&spj="+spj;
		}
	}
	function pindahData222(jen,spm){
			window.location="index.php?x=brg_masuk&jenis="+jen+"&spm="+spm;
	}
	function pindahData3(jen,spb,supp){
		window.location="index.php?x=brg_masuk&jenis="+jen+"&spb="+spb+"&supp="+supp;
	}
	function save(spj)
			{   
			if(spj!=''){
				if($('#spj').val()==''){ alert("Pilih SPJ");} else {
					if (confirm("SPJ ini akan dikirim ke BM dan PO Pusat, lanjutkan?")) {
            			$.ajax({
							type:"post",
							url:"assets/inventory/brg_masuk/simpan3.php",
							data:"action=add&id="+spj,
							success:function(data){
								alert('Data terkirim!');
								window.location="index.php?x=brg_masuk";	 
							}
				    	});
        			}
        			return false;
					
				}
			}else{
				alert('Belum Pilih SPJ');	
			}	
		}
		
	function satuan(i,sat){
		
		$("#sat"+i).load("assets/inventory/brg_masuk/satuan.php?id="+i+"&jenis=<?=$_GET[jenis]?>&spb=<?=$_GET[spb]?>&supp=<?=$_GET[supp]?>&cd=b2");
	}
	function satuan2(i,sat){
		hg=$("#harga_asli"+i).val();
		
		explo=sat.split("_");
		
		harga=parseFloat(hg)*parseInt(explo[1]);
		
		$("#harga"+i).val(harga);
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



</script>