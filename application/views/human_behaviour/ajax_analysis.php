<table id="transaction-table" class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th>Sr. No</th>
      <th>Category</th>                                   
      <th>How Many Time</th>
      <th></th>
    </tr>
  </thead>

  <tbody>
    <?php if(!empty($Analysis)){  $i=1;
      foreach($Analysis as $Analysiss){ ?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><?php echo $Analysiss['category_name'];?></td>
            <td><?php echo $Analysiss['total'];?></td>
            <td><a class="green" href="<?php echo base_url().'Detail/'.$Analysiss['category_id']; ?>"><button class="btn btn-primary">Detail</button></a></td>

          </tr>
        <?php } ?>
      <?php }else{ ?>
          <tr>
            <td colspan="3"> No Data Found !</td>
          </tr>

    <?php  } ?>
  </tbody>
</table>
 <?php echo $this->ajax_pagination->create_links(); ?>