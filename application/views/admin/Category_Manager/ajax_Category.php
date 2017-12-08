	<table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>S. No</th>
                    <th>Category Name</th>
                    <th>Category Words</th>
                    <th>Created Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($Category_list)){
                  $i=1;
                  foreach ($Category_list as $Category_list) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $Category_list['category_name'] ;?> </td>
                    <td><?php echo trim($Category_list['search_word'],","); ?></td>                    
                    <td><?php  echo date('d-M-Y',strtotime($Category_list['created_date']) ) ; ?></td>
                    <td>
                        <a class="green" href="<?php echo base_url().'edit_Category/'.$Category_list['category_id']; ?>"><i class="ace-icon fa fa-pencil bigger-130"></i></a>&nbsp
                        <a class="red" href="#" onclick="myfunction2('category_id',<?php echo $Category_list['category_id']; ?>,'Category')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                    </td>
                </tr>

            <?php  } }else{ ?>
                <tr>
                    <td colspan="10"><center><strong>No Data Found for this Request</strong></center></td>
               </tr>

                <?php } ?>

            </tbody>

        </table>
    <?php echo $this->ajax_pagination->create_links(); ?>	