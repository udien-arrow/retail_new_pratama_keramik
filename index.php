<?php
error_reporting(0);
session_start();
require_once "webclass.php";
$db = new kelas();
if(empty($_SESSION['ID_LOGIN'])){
    include"login.php";	
} else {
    include"assets/layout/page.php";
	
	/*if($_GET['x']!=''){
		$ceki=$db->select("r_main_menu a left join  r_hak_menu b on a.ID=b.ID_MENU and b.ID_USER='$_SESSION[ID_LOGIN]'","a.ID,b.ID_MENU","a.slug='$_GET[x]'");
		foreach($ceki as $cekiv){} 
		if($cekiv['ID']!=$cekiv['ID_MENU']){
			echo "<script>window.location='index.php?x='</script>";	
		}
	} */ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Retail </title>

	<!-- Global stylesheets -->
	<!--<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">-->
	
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/core.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/components.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/colors.min.css" rel="stylesheet" type="text/css">
    <!--<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>-->
    <!-- /global stylesheets -->
	<!-- Core JS files -->
	
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/drilldown.js"></script>
    
	<script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
	<!-- /core JS files -->
	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/scroller.min.js"></script>

	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/pages/form_select2.js"></script>
	<!-- Theme JS files -->

	<script type="text/javascript" src="assets/js/plugins/uploaders/fileinput.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery_ui/datepicker.min.js"></script>

    <script type="text/javascript" src="assets/js/pages/datatables_extension_scroller.js"></script>
	
   
	<!--<script type="text/javascript" src="assets/js/core/libraries/jquery_ui/effects.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/anytime.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/legacy.js"></script>-->
	

<script type="text/javascript" src="assets/js/js/jquery.number.js"></script>

    
    
</head>

<body>

	<!-- Main navbar -->
	<?php 
    if($_SESSION['ANDROID']!=1){
    include "assets/layout/head.php";
	}else{include "assets/layout/_head.php";}?>
	
	<!-- /main navbar -->
    <!-- Second navbar -->
	
    <?php
	if($_SESSION['ANDROID']!=1){
	include "assets/layout/menu.php";
	}else{include "assets/layout/_menu.php";}
	?>
	
	<!-- /second navbar -->

	<!-- Page container -->
	<div class="page-container" id="isi">
		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">
				<!-- Dashboard content -->
				<div class="row">
					<?php  include $modul;?>
				</div>
				<!-- /dashboard content -->
			</div>
			<!-- /main content -->
		</div>
        <?php include $cont; ?>
		<!-- /page content -->
	<!-- Footer -->
		<!--<div class="footer text-muted">
			&copy; 2016. <a href="#">Waru Abadi</a> by <a href="http://medianusamandiri.com" target="_blank">Media Nusa Mandiri</a>
		</div>-->
		<!-- /footer -->

	</div>
	<!-- /page container -->

</body>
</html>

<script>
// Basic example
    $('.file-input').fileinput({
        browseLabel: '',
        browseClass: 'btn btn-primary btn-icon',
        removeLabel: '',
        uploadLabel: '',
        uploadClass: 'btn btn-default btn-icon',
        browseIcon: '<i class="icon-plus22"></i> ',
        uploadIcon: '<i class="icon-file-upload"></i> ',
        removeClass: 'btn btn-danger btn-icon',
        removeIcon: '<i class="icon-cancel-square"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        initialCaption: "No file selected"
    });
	
	 $(".datepicker").datepicker();
	 // Month and year menu
     $(".datepicker-menus").datepicker({
        changeMonth: true,
        changeYear: true
     });
	 $(".datepicker1").datepicker({
		changeMonth: true,
        changeYear: true,
		dateFormat: "yy-mm-dd", 
		 });
	 //no past date
	$(".datepicker2").datepicker({
		minDate: 0,
		changeMonth: true,
        changeYear: true,
		dateFormat: "yy-mm-dd", 
		 });	 
	// Show week number
	 // Basic scroller demo
	 
    setTimeout(function() {
        $('.datatable-scroller').DataTable();
    }, 100);
</script>

<?php
  
}
?>

