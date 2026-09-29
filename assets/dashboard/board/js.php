<script>
function pindahData(j,ty,b,t){
	location.href="index.php&ty="+ty;	
}

<?php if($_POST['tipe']==''){?>
hahah()
function hahah(){
	javascript: document.getElementById('formc').submit();
	 
}
<?php }?>
	setTimeout(function(){ window.parent.document.getElementById('mod').click(); }, 2000);
	
function pindahData1(j,ty,b,t){
	
	var jum = parseInt($("#nomer").val()) + 1;
	
	alert($("#nomer").val());
	if($("#nomer").val()==0){
		$("#datachart").load('assets/dashboard/board/chart_po.php?j='+j+'&b='+b+'&t='+t+'&num='+$("#nomer").val()+'&ty='+ty);
		$('#datachart').attr('id', 'datachart'+jum);
	}else{
		$("#datachart"+$("#nomer").val()).load('assets/dashboard/board/chart_po.php?j='+j+'&b='+b+'&t='+t+'&num='+$("#nomer").val()+'&ty='+ty);
		$('#datachart'+$("#nomer").val()).attr('id', 'datachart'+jum);
	}
	
	$("#nomer").val(parseInt($("#nomer").val())+1)	
	
}
function cekPel(){
		
		//$('#mod').click();
		$.get('assets/dashboard/board/plaf.php', function(data) {
				$('#hahaha').html(data);    
		});
	}
</script>