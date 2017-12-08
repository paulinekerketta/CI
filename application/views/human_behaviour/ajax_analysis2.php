<table id="transaction-table" class="table table-striped table-bordered table-hover">
<thead>
  <tr>
    <th>Sr. No</th>
    <th>Category</th>                                   
    <th>Date</th>
    <th>Time</th>
  </tr>
</thead>

<tbody>
  <?php if(!empty($Analysis)){  $i=1;
    foreach($Analysis as $Analysiss){ ?>
      <tr>
          <td><?php echo $i++;?></td>
          <td><?php echo $Analysiss['category_name'];?></td>
          <td><?php echo date('d-M-Y ',strtotime($Analysiss['feeling_created']));?></td>
          <td><?php echo date('H:i:s ',strtotime($Analysiss['feeling_created']));?></td>
        </tr>
      <?php } ?>
    <?php }else{ ?>
        <tr>
          <td colspan="4"> No Data Found !</td>
        </tr>

  <?php  } ?>
</tbody>
 </table>
 <?php echo $this->ajax_pagination->create_links(); ?>