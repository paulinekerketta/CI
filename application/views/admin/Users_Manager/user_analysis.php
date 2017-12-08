
            <div class="main-content">                
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <a href="#">Users Manager</a>
                            </li>
                            <li class="active">Users</li>
                        </ul><!-- /.breadcrumb -->
                        <div class="nav-search" id="nav-search">
                            
                        </div><!-- /.nav-search -->
                    </div>
                     <div class="page-content">
                        <div class="page-header">
                            <h1>
                              Users Manager
                                <small>
                                    <i class="ace-icon fa fa-angle-double-right"></i> Users Analysis
                                </small>
                            </h1>
                        </div><!-- /.page-header -->
                        
                        <div class="row mkr">

                            <div class="col-xs-12">

                                <!-- PAGE CONTENT BEGINS -->

                                <div class="row">

                                    <div class="col-xs-12">
                                       <div id="fade_out">
                                        <?php if ($this->session->flashdata('message')) { ?>
                                            <div class="alert alert-success">
                                              <?php echo $this->session->flashdata('message'); ?>                                       
                                            </div>
                                        <?php   }  ?>
                                        <?php if ($this->session->flashdata('success')) { ?>
                                            <div class="alert alert-success">
                                              <?php echo $this->session->flashdata('success'); ?>                                       
                                            </div>
                                        <?php   }  ?>
                                        <?php if ($this->session->flashdata('error')) { ?>
                                            <div class="alert alert-danger">
                                              <?php echo $this->session->flashdata('error'); ?>                                     
                                            </div>
                                        <?php   }  ?>
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
                                                      <td><a class="green" href="<?php echo base_url().'AnalysisDetail/'.$Analysiss['category_id']; ?>"><button class="btn btn-primary">Detail</button></a></td>

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

                                    </div>

                                </div>

                                <!-- PAGE CONTENT ENDS -->

                            </div><!-- /.col -->

                        </div><!-- /.row -->

                    </div>  

                </div>

            </div>


<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

<script>
setTimeout(function(){ $(".alert").fadeOut(); }, 2000);
setTimeout(function(){ $("#fade_out").fadeOut(); }, 2000);
</script>

<style type="text/css">
    .dataRequired ,.error{
        color: red;
    }
</style>
<!-- style for pagignation -->
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

<script>
    function searchFilter(page_num) {
        page_num = page_num?page_num:0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/Users_Manager/ajaxPaginationData/'+page_num,
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
<script type="text/javascript">
    $(document).ready(function(){
        $(".productDescription").hide();
        $(".show_hide").show();
        $('.show_hide').click(function(){
        $(".productDescription").slideToggle();
        return false;
        });
    });
</script>
 

