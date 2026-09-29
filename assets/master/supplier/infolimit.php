<div class="panel-heading">


<h5 class="panel-title">List Hutang Supplier</h5>
</div>
<div class="dataTables_wrapper"></div>
<div class="table-responsive">
      <table class="table" border="0">
          <thead>
              <tr>
                  <th colspan="3">Supplier</th>
              </tr>
          </thead>
          <tbody>
          <?php
		  $info=$db->select("m_supplier","entitas_usaha,id_supp,nama_usaha,limit_plafon","status=1");
		  $no=1;
		  foreach($info as $infoval){
			  if($infoval['entitas_usaha']==1){
				$ent="PT";
			  }
			  if($infoval['entitas_usaha']==2){
				$ent="CV";
			  }
			  if($infoval['entitas_usaha']==3){
				$ent="Firma";
			  }
			  if($infoval['entitas_usaha']==4){
				$ent="PO";
			  }
			  
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
                    	  <td align="center">Limit</td>
                    	  <td align="center">Hutang</td>
                  	  </tr>
                      <?php
					}
					  
					
					  ?>
                    	
                    	<tr>
                       	    <td align="right"><?=number_format($infoval['limit_plafon'])?></td>
                        	<td align="right">0</td>
                        </tr>
                     
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