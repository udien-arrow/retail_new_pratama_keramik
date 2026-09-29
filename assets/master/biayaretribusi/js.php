<script>
<?php if($_GET['slug']==''){?>
		var a='4';
		var d='data';
		var f='1,2,3';
<?php } if($_GET['slug']==1){?>
		var a='5';
		var d='data_sub';
		var f='2';
<?php }?>
	
 $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            targets: [ ''+f ]
        }],
		<?php if($_GET['slug']==''){?>
        dom: '<"datatable-header"f><"datatable-scroll"t><"datatable-footer"ip>',
		<?php } if($_GET['slug']==1){?>
		dom: '<"datatable-scroll"t><"datatable-footer">',
		<?php }?>
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
	 $('#example'+a).DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "assets/master/biayaretribusi/"+d+".php?slug=<?=$_GET['slug']?>&id=<?=$_GET['id']?>&tgl=<?=$_GET['tgl']?>",
				"dataType": "jsonp"
				}
	} );
	function edit(id){
		$('#id').val(id);
		javascript: document.getElementById('form_index').submit();
		
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
	function hapus(id){
		$('#id').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('form_index').submit();
		
	}
	function datashipto(i){
		$("#shipto").load("assets/master/biayaretribusi/shipto.php?id="+i);
	}
	function pindah(id,slug,tgl){
		window.location="index.php?x=biayaretribusi&slug="+slug+"&id="+id+"&tgl="+tgl;
	}
	function validate_frm()
		{
			
		try{
			x = document.formku;
			if (x.nama.value.length == 0)
			{
				alert('Nama tidak boleh kosong!');
				x.nama.focus();
				return(false);
			}
			return(true);
			}catch(e){
				alert('Error '+ e.description);
			}
		}

</script>