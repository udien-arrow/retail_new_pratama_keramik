
	<div class="navbar navbar-default" id="navbar-second">
		<ul class="nav navbar-nav no-border visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
		</ul>
		<div class="navbar-collapse collapse" id="navbar-second-toggle">
        	<?php
                   $main_m=$db->select("r_main_menu","*","PARENT=0 AND STATUS=1 AND ID IN($akses_menu)");
                   foreach($main_m as $main_me){ 
 	     	  ?><ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
						<i class="<?php echo $main_me['ICON'];?>"></i> <?php echo $main_me['NAMA'];?> <span class="caret"></span>
					</a><ul class="dropdown-menu width-250">
						<?php 
								$main_men=$db->select("r_main_menu","*","(PARENT='$main_me[ID]' and PARENT_SUB='') AND STATUS=1 AND ID IN($akses_menu)");
								foreach($main_men as $main_menu){
									$cl="";
									if($main_menu['SLUG']==''){$cl="dropdown-submenu";}
						?><li class="<?=$cl?>">
                        <?php if($cl!=''){?>
                        <a href="javascript:void(0)"><i class="<?php echo $main_menu['ICON'];?>"></i><?php echo $main_menu['NAMA'];?></a>
                        <?php }else{?>
                         <a href="index.php?x=<?php echo $main_menu['SLUG'];?>"><i class="<?php echo $main_menu['ICON'];?>"></i><?php echo $main_menu['NAMA'];?></a>
                        <?php }?>
                        	<ul class="dropdown-menu">
                            	<li class="dropdown-header highlight">Options</li>
								<?php 
								$main_men_sub=$db->select("r_main_menu","*","PARENT_SUB='$main_menu[ID]' AND STATUS=1 AND ID IN($akses_menu)");
								foreach($main_men_sub as $main_menu_sub){
								?>
                                <li><a href="index.php?x=<?php echo $main_menu_sub['SLUG'];?>"><?php echo $main_menu_sub['NAMA'];?></a></li>
                                <?php } ?>
							</ul>
                        </li><?php } ?>
					</ul>
                   </li>
			</ul><?php
        				}
        	?>
            <ul class="nav navbar-nav">
                <li><a href="index.php">
                        <i class="icon-display4 position-left"></i>Dashboard
                    </a>
                </li>
           	</ul>
            </div>
	</div>
	