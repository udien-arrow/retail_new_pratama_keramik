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
		$('#harga_in2').val($('#harga2'+id).val());
		$('#harga_inc2').val($('#harga_cetak2'+id).val());		
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
	function pindah(gud,persen,tok){
		window.location="index.php?x=pricel_jual&cab="+gud+"&gud="+tok;
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
	
function HapusKoma(num)
{
    return (num.replace(/,/g,''));  
}
TambahKoma = function(input){
  // If the regex doesn't match, `replace` returns the string unmodified
  return (input.toString()).replace(
    // Each parentheses group (or 'capture') in this regex becomes an argument 
    // to the function; in this case, every argument after 'match'
    /^([-+]?)(0?)(\d+)(.?)(\d+)$/g, function(match, sign, zeros, before, decimal, after) {

      // Less obtrusive than adding 'reverse' method on all strings
      var reverseString = function(string) { return string.split('').reverse().join(''); };

      // Insert commas every three characters from the right
      var insertCommas  = function(string) { 

        // Reverse, because it's easier to do things from the left
        var reversed           = reverseString(string);

        // Add commas every three characters
        var reversedWithCommas = reversed.match(/.{1,3}/g).join(',');

        // Reverse again (back to normal)
        return reverseString(reversedWithCommas);
      };

      // If there was no decimal, the last capture grabs the final digit, so
      // we have to put it back together with the 'before' substring
      return sign + (decimal ? insertCommas(before) + decimal + after : insertCommas(before + after));
    }
  );
};
		
	function hitung(i){
		patok =HapusKoma($('#hpp_h'+i).val());
		//alert('patok =' + patok);
		patok1=HapusKoma($('#harga_h'+i).val());
		//alert('patok1 =' + patok1);		
		patok2=HapusKoma($('#harga_h2'+i).val());
		//alert('patok2 =' + patok2);			
		patok3=HapusKoma($('#harga_cetak_h'+i).val());
		//alert('patok3 =' + patok3);		
		patok4=HapusKoma($('#harga_cetak_h2'+i).val());
		//alert('patok4 =' + patok4);		
		
		sat=$('#sat'+i).val();
		expl=sat.split("_");
		//alert('expl : ' + expl[1]);	
		harga=patok*expl[1];
		//alert('harga ' + harga);		
		$('#hpp'+i).val(harga);
		harga1=patok1*expl[1];
		$('#harga'+i).val(TambahKoma(harga1));
		//alert('harga1 ' + harga1);
		harga2=patok2*expl[1];
		$('#harga2'+i).val(TambahKoma(harga2));	
		//alert('harga2 ' + harga2);			
		harga3=patok3*expl[1];
		$('#harga_cetak'+i).val(TambahKoma(harga3));	
		//alert('harga3 ' + harga3);			
		harga4=patok4*expl[1];
		$('#harga_cetak2'+i).val(TambahKoma(harga4));	
		//alert('harga4 ' + harga4);			
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