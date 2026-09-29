<div class="panel-heading">


<h5 class="panel-title">List Piutang Customer</h5>
</div>
<div class="dataTables_wrapper"></div>
<div class="table-responsive">
      <table class="table text-nowrap" border="0">
          <thead>
              <tr>
                  <th width="50%">Customer </th>
                  <th class="center" colspan="2">Limit</th>
                  <th>Piutang</th>
              </tr>
          </thead>
          <tbody>
          <?php 
		  
		  $info=$db->select("m_customer","id_cus,nama_usaha","status=1");
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
                  <td rowspan="3">
                      <div class="media-left media-middle">
                          <a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
                              <span class="letter-icon"><?=strtoupper(substr($infoval['nama_usaha'],0,1))?></span>
                          </a>
                      </div>

                      <div class="media-body">
                          <div class="media-heading">
                              <a href="#" class="letter-icon-title"><?=$ent." ".$infoval['nama_usaha']?></a>
                          </div>

                         <!-- <div class="text-muted text-size-small"><i class="icon-checkmark3 text-size-mini position-left"></i> New order</div>!-->
                      </div>
                  </td>
                  <td align="right">Semen</td>
                  <td align="right">
				  <?php
				  $limval['limit_plafon']=0;
                  foreach($lim=$db->select("m_customer_plafon","*","jenis_plafon=1 and id_cus='$infoval[id_cus]'") as $limval);{
				  echo number_format($limval['limit_plafon']);
				  }
				  ?>
                  </td>
                  <td align="right">0</td>
              </tr>
              <tr>
                <td align="right">Non</td>
                <td align="right">
				<?php
				 $limval['limit_plafon']=0;
                  foreach($lim=$db->select("m_customer_plafon","*","jenis_plafon=2 and id_cus='$infoval[id_cus]'") as $limval);{
				  echo number_format($limval['limit_plafon']);
				  }
				  ?></td>
                <td align="right">0</td>
              </tr>
              <tr>
                <td align="right">Expd</td>
                <td align="right">
                <?php
				 $limval['limit_plafon']=0;
                  foreach($lim=$db->select("m_customer_plafon","*","jenis_plafon=3 and id_cus='$infoval[id_cus]'") as $limval);{
				  echo number_format($limval['limit_plafon']);
				  }
				  ?>
                </td>
                <td align="right">0</td>
              </tr>
              <?php }?>
              
          </tbody>
      </table>
</div>
</div>