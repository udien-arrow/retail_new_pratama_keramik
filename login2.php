<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> </title>

	<!-- Global stylesheets -->
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/core.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/components.min.css" rel="stylesheet" type="text/css">
	<!--<link href="assets/css/minified/colors.min.css" rel="stylesheet" type="text/css">-->
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<!--<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>-->
	<!--<script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>-->
	<script type="text/javascript" src="assets/js/plugins/ui/drilldown.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="assets/js/pages/form_select2.js"></script>
	<!-- /core JS files -->


	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<!-- /theme JS files -->

</head>
<?php

if(empty($_SESSION['ID_JABATAN'])){
session_start();
}

include("webclass.php");
$db=new kelas;
//echo $_SESSION['ID_CABANG'];
?>
<body>
	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#">
						<i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
					</a>
				</li>

				<li>
					<a href="#">
						<i class="icon-user-tie"></i> <span class="visible-xs-inline-block position-right"> Contact admin</span>
					</a>
				</li>

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cog3"></i>
						<span class="visible-xs-inline-block position-right"> Options</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->
	<!-- Page container -->
	<div class="page-container login-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Simple login form -->
				<form action="cek_login2.php" method="post"><br><br><br><br><br><br><br><br><br><br><br>
					<div class="panel panel-body login-form">
						<div class="form-group has-feedback has-feedback-left">
							<select class="select has-feedback has-feedback-left" name="gudang" id="gudang">
                                      	<?php

											$query=$db->select("m_gudang","*","id_cabang='$_SESSION[ID_CABANG]'");
											foreach($query as $sel){
			                            ?>
                                        	<option value="<?=$sel['id_gudang']?>"><?=$sel['nama_gudang']?></option> <?php } ?>
							</select>
							
						</div>
						
						<div class="form-group">
							<button style="height:38px;" type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
						</div>

						
					</div>
				</form>
				<!-- /simple login form -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>

<!--<script>
	function cekjab(id){
		$.get('assets/inventory/appjual/bibong.php?cust='+cust+'&bar='+bar+'&qty='+qty, function(data) {
			
		});
	}
</script>-->
