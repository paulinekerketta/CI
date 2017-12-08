<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Human Behaviour </title>
  <meta name="description" content="bitcoin">
  <meta name="keywords" content="bitcoin">
  <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">

  <style type="text/css">
    .loggedIN{
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border-color: white;
      margin-right: 20px;
    }
  </style>
</head><body>

<!-- **************************************************************** -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php base_url() ?>">Human Behaviour</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" style="">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
      </li>
      <li class="nav-item">
        <!-- <a class="nav-link" href="#">Features</a> -->
      </li>
      <li class="nav-item">
        <!-- <a class="nav-link" href="#">Pricing</a> -->
      </li>
      <li class="nav-item">
        <!-- <a class="nav-link" href="#">About</a> -->
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <?php if (!$this->session->userdata('is_human_user_login')) { ?>
          <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="Login">Login <!-- <span class="sr-only">(current)</span> --></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Signup">Sigup</a>
              </li>      
          </ul>
        
      <?php } else { ?>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">                 
              <img width="50px" height="50px" class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="<?php echo base_url().'assets/images/logo_new_2.png'; ?>" />                    
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="#">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Analysis</a>
            </li>   
            <li class="nav-item">
                <a class="nav-link" href="Logout">Logout</a>
            </li>
            
        </ul>
      <?php } ?>
    </form>

  </div>
</nav>
<!-- **************************************************************** -->
<div class="fade_out">
  <?php if($this->session->flashdata('success')){?>
  <div class="alert alert-success">
     <?php echo $this->session->flashdata('success'); ?>
  </div>
  <?php }if($this->session->flashdata('error')){?>
  <div class="alert alert-danger">
     <?php echo $this->session->flashdata('error'); ?>
  </div>
  <?php  } ?>
</div>
<!-- **************************************************************** -->
<div class="gcse-container" id="gcse_container">
		<gcse:search enableAutoComplete="true"></gcse:search>
</div>


</body>
</html>



<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
(function($, window) {
  var elementName = '';
  var initGCSEInputField = function() {
    $( '.gcse-container form.gsc-search-box input.gsc-input' )
      .on( "keyup", function( e ) {
      if( e.which == 13 ) { // 13 = enter
        var searchTerm = $.trim( this.value );
        if( searchTerm != '' ) {
          // console.log( "Enter detected for search term: " + searchTerm );
          // execute your custom CODE for Keyboard Enter HERE
          mySearch(searchTerm);
        }
      }
    });
    $( '.gcse-container form.gsc-search-box input.gsc-search-button' )
      .on( "click", function( e ) {
      var searchTerm = $.trim( $( '.gcse-container form.gsc-search-box input.gsc-input' ).val() );
      if( searchTerm != '' ) {
        // console.log( "Search Button Click detected for search term: " + searchTerm );
        // execute your custom CODE for Search Button Click HERE
        mySearch(searchTerm);
      }
    });
  };
  
  var GCSERender = function() {
  	google.search.cse.element.render({
        div: 'gcse_container',
        tag: 'search'
      });
      initGCSEInputField();
  };
  
  var GCSECallBack = function() {
    if (document.readyState == 'complete') {
      GCSERender();
    }
    else {
      google.setOnLoadCallback(function() {
        GCSERender();
      }, true );
    }
  };
  
  window.__gcse = {
  	parsetags: 'explicit',
    callback: GCSECallBack
  };
})(jQuery, window);

(function() {
  var cx = '017643444788069204610:4gvhea_mvga'; // Insert your own Custom Search engine ID here
  var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
  gcse.src = 'https://www.google.com/cse/cse.js?cx=' + cx;
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
})();
</script>
<script type="text/javascript">


	function mySearch(argument) {
		$.ajax({
      url: '<?php echo 'http://activegrowthinc.com/careApp';  ?>/save_feeling.php',
      data: ({argument: argument}),
      dataType: 'text', 
      type: "post",
      success: function(data){  
              //alert(data);
          } 
    });
		
	}   
 setTimeout(function(){ $(".alert").fadeOut(); }, 2000);
</script>