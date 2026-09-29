<div class="panel-heading">


<h5 class="panel-title">List Piutang Customer</h5>
</div>
<div class="dataTables_wrapper"></div>
<div class="table-responsive">
      <table class="table" border="0">
          <thead>
              <tr>
                  <th colspan="3">Customer</th>
              </tr>
          </thead>
          <tbody>
          <?php 
		  
		  $info=$db->select("m_customer","id_cus,nama_usaha","status=1 and head=''");
		  $no=1;
		  foreach($info as $infoval){
			 
		  ?>
              <tr>
                  <td width="45%" >
                      <div class="media-left media-middle">
                          <a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
                              <span class="letter-icon"><?=strtoupper(substr($infoval['nama_usaha'],0,1))?></span>
                          </a>
                      </div>

                      <div class="media-body">
                          <div class="media-heading">
                              <a href="#" class="letter-icon-title"><?=$ent." ".$infoval['nama_usaha']?></a>
                          </div>

                          
                      </div>
                  </td>
                  <td colspan="2" align="right">
                  	<table width="100%" class="table text-nowrap">
                    <?php if($no==1){?>
                    	<tr>
                    	  <td colspan="2" align="center">Limit</td>
                    	  <td align="center">Piutang</td>
                  	  </tr>
                      <?php
					}
					  $limval['limit_plafon']=0;
					  $lim=$db->select("m_customer_plafon","*","id_cus='$infoval[id_cus]'");
					 foreach($lim as $limval)
					  {
					  ?>
                    	
                    	<tr>
                       	    <td width="1%" align="right"><?php
                            if($limval['urut']==1){
								echo "Semen";	
							}
							if($limval['urut']==2){
								echo "Non";	
							}
							if($limval['urut']==3){
								echo "Expd";	
							}
							?></td>
                        	<td align="right" width="10%"><?=number_format($limval['limit_plafon'])?></td>
                        	<td align="right">0</td>
                        </tr>
                     <?php }?>
                    </table>
                  
                  </td>
              </tr>
              <?php 
			  $no++;
			  }?>
              
          </tbody>
      </table>
</div>
</div>