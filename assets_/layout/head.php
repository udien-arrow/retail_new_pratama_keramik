<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href=""><img src="logo/<?php echo"$_SESSION[LOGO]";?> " alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-help"> Help</i>
						<span class="visible-xs-inline-block position-right">Messages</span>
						<span class="badge bg-warning-400"></span>
					</a>
					<div class="dropdown-menu dropdown-content width-150">
					
						<ul class="media-list dropdown-content-body">
							<li class="media">
								<div class="media-left"><i class="icon-book2"></i></div>
								<div class="media-body">
									<a href="index.php?x=buku" class="media-heading">
										<span class="text-semibold">Buku Manual</span>
									</a>
								</div>
							</li>

							<li class="media">
								<div class="media-left"><i class="icon-clapboard-play"></i></div>
								<div class="media-body">
									<a href="index.php?x=video" class="media-heading">
										<span class="text-semibold">Video Tutorial</span>
										
									</a>
								</div>
							</li>
						</ul>

						
					</div>
				</li>
               <?php
               if(($_SESSION['ID_JABATAN']==1 || $_SESSION['ID_JABATAN']==3) && $_GET['x']!=''){
			   ?>
                <li class="dropdown dropdown-user"><a class="dropdown-toggle" data-toggle="dropdown">
                
               <form action="<?=$_SERVER['PHP_SELF']?>?x=<?=$_GET['x']?>" method="post" name="frmh" id="frmh">
							<select class="select" name="gudang" id="gudang" onChange="pindahan(gudang.value)">
                                      <option value="0">---Pilih Gudang----</option>
                                      	<?php
											$query22=$db->select("m_gudang","*","id_cabang='$_SESSION[ID_CABANG]'");
											foreach($query22 as $sel222){
			                            ?>
                                        	<option value="<?=$sel222['id_gudang']?>" <?php if($sel222['id_gudang']==$_SESSION['ID_GUDANG']){echo "selected";}?>><?=$sel222['nama_gudang']?></option> <?php } ?>
							</select>
							<input type="hidden" name="jenisgudang" id="jenisgudang" value="">
				</form>	</a>	
                  </li>      
                  <?php 
			   }
				  ?>
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/images/placeholder.jpg" alt="">
						<span><?php echo $_SESSION['NAMA_PEG']?></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="index.php?x=edituser"><i class="icon-user-plus"></i> My profile</a></li>
						<li class="divider"></li>
						<li><a href="logout.php"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
<script>
	function pindahan(gud){
		$("#jenisgudang").val('1');
		javascript: document.getElementById('frmh').submit();
			
	}

</script>
<?php
if($_POST['jenisgudang']=='1'){
		
	$_SESSION['ID_GUDANG']=$_POST['gudang'];
	echo "<script>location.href='index.php?x=$_GET[x]'</script>";	
}

?>
 
 
 
    
    