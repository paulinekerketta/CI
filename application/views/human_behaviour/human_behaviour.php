<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Human Behaviour </title>
  <meta name="description" content="bitcoin">
  <meta name="keywords" content="bitcoin">
  <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
</head><body>

<!-- **************************************************************** -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Search</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" style="">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
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
              alert(data);
          } 
    });
		
	}   

</script>