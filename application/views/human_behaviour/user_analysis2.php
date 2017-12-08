
<div class="main-content">                
	<div class="main-content-inner">			     
            
		<div class="row mkr">

			<div class="col-xs-12">

                <div id="Analysiss" class="tab-pane">
                              <div class="clearfix">
                              <div class="pull-right tableTools-container5"></div>
                            </div>
                            <div class="table-header">
                              User Anylysis
                            </div>
                            <div class="post-search-panel">
                                <div class="">
                                <input type="text"  id="keywords"  placeholder="Enter Key Words" onkeyup="searchFilter()"/>
                                <select id="sortBy"  onchange="searchFilter()">
                                  <option value="">Sort By</option>
                                  <option value="asc">Ascending</option>
                                  <option value="desc">Descending</option>
                                </select>
                              </div>
                            </div>
                            <div id="transaction_div">
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
                                          <td colspan="3"> No Data Found !</td>
                                        </tr>

                                  <?php  } ?>
                                </tbody>
                                 </table>
                                 <?php echo $this->ajax_pagination->create_links(); ?>
                              </div>
                        </div><!-- /#Analysiss -->

			</div>

     	</div>	

    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script>
    function searchFilter(page_num) {
        page_num = page_num?page_num:0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Welcome/ajaxPaginationData2/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
            beforeSend: function () {
                $('.loading').show();
            },
            success: function (html) {
                $('#transaction_div').html(html);
                $('.loading').fadeOut("slow");
            }
        });
    }
</script>

<style>
    .row{position: relative;}
    .post-list{ 
        margin-bottom:20px;
    }
    div.list-item {
        border-left: 4px solid #7ad03a;
        margin: 5px 15px 2px;
        padding: 1px 12px;
        background-color:#F1F1F1;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        height: 60px;
    }
    div.list-item p {
        margin: .5em 0;
        padding: 2px;
        font-size: 13px;
        line-height: 1.5;
    }
    .list-item a {
        text-decoration: none;
        padding-bottom: 2px;
        color: #0074a2;
        -webkit-transition-property: border,background,color;
        transition-property: border,background,color;-webkit-transition-duration: .05s;
        transition-duration: .05s;
        -webkit-transition-timing-function: ease-in-out;
        transition-timing-function: ease-in-out;
    }
    .list-item a:hover{text-decoration:underline;}
    .list-item h2{font-size:25px; font-weight:bold;text-align: left;}

    /* search & filter */
    .post-search-panel input[type="text"]{
        width: 220px;
        height: 28px;
        color: #333;
        font-size: 16px;
    }
    .post-search-panel select{
        height: 34px;
        color: #333;
        font-size: 16px;
    }

    /* Pagination */
    div.pagination {
        font-family: "Lucida Sans Unicode", "Lucida Grande", LucidaGrande, "Lucida Sans", Geneva, Verdana, sans-serif;
        padding:2px;
        margin: 20px 10px;
        float: right;
    }

    div.pagination a {
        margin: 2px;
        padding: 0.5em 0.64em 0.43em 0.64em;
        background-color: #FD1C5B;
        text-decoration: none; /* no underline */
        color: #fff;
    }
    div.pagination a:hover, div.pagination a:active {
        padding: 0.5em 0.64em 0.43em 0.64em;
        margin: 2px;
        background-color: #FD1C5B;
        color: #fff;
    }
    div.pagination span.current {
            padding: 0.5em 0.64em 0.43em 0.64em;
            margin: 2px;
            background-color: #f6efcc;
            color: #6d643c;
        }
    div.pagination span.disabled {
            display:none;
        }
    .pagination ul li{display: inline-block;}
    .pagination ul li a.active{opacity: .5;}

    /* loading */
    .loading{position: absolute;left: 0; top: 0; right: 0; bottom: 0;z-index: 2;background: rgba(255,255,255,0.7);}
    .loading .content {
        position: absolute;
        transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        top: 50%;
        left: 0;
        right: 0;
        text-align: center;
        color: #555;
    }
</style>