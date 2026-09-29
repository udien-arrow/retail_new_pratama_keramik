

  <table  border="0">
    <thead>
         
          <tr bgcolor="#28343a">
            <th width="8%" align="center"><font style="color:#FFF"><b>No Faktur</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Tgl BG</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>No Spj</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>No Seri</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Nama Bank BG</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Jatuh Tempo</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Nilai BG</b></font></th>
          </tr>
        </thead>
        <tbody>
          <?php 
			$sql=$db->select("tx_buku_bg","*","no_spj='$valsupp[no_spj]' and status='0'");
		  foreach($sql as $arr){  
		  ?>
          <tr bgcolor="#F0F0F0">
            <td align="left"><?php echo $arr['no_fj'];?></td>
            <td align="left" ><?php echo $arr['tgl_bg'];?></td>
            <td align="left" ><?php echo $arr['no_spj'];?></td>
            <td align="left" ><?php echo $arr['no_seribg'];?></td>
            <td align="left" ><?php echo $arr['id_bank'];?></td>
            <td align="left" ><?php echo date("d-m-Y",strtotime($arr['tgl_bg']));?></td>
            <td align="right" ><?php echo number_format($arr['nilai_bg']);?></td>
          </tr>
          <?php }?>
        </tbody>
      </table>
