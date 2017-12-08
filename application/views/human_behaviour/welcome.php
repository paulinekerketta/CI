
<div class="main-content container jp-main-content">   

         
	<div class="main-content-inner">			     
            
		<div class="row mkr">

			<div class="col-xs-12 jp-search-content">
              <div class="col-xs-12 jp-search-heading">
                <h3>
                  <span class="first-lett">H</span>
                  <span class="second-word">u</span>
                  <span class="second-lett">m</span>
                  <span class="second-word">a</span>
                  <span class="third-lett">n</span> &nbsp;
                  <span class="first-lett">B</span>
                  <span class="second-word">eh</span>
                  <span class="second-lett">a</span>
                  <span class="second-word">vio</span>
                  <span class="third-lett">ur</span>
                </h3>
              </div>
                <!-- **************************************************************** -->
                <div class="gcse-container jp-search-input" id="gcse_container">
                        <gcse:search enableAutoComplete="true"></gcse:search>
                </div>

			</div>

     	</div>	

    </div>

</div>

<?php if ($this->session->userdata('is_human_user_login')) { ?>
        <input type="hidden" id="check_session" value="1">
        <input type="hidden" id="user_id" value="<?php echo $this->session->userdata('my_user_id') ?>">
<?php }else{ ?>
        <input type="hidden" id="check_session" value="0">
<?php } ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
(function($, window) {
  var elementName = '';
  var initGCSEInputField = function() {
    $( '.gcse-container form.gsc-search-box input.gsc-input' )
      .on( "keyup", function( e ) {

        var check_session=$('#check_session').val();
        if (check_session=="1") {
          
        }else{
          window.location.href = "<?php echo base_url();  ?>Login";
        }

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
      var check_session=$('#check_session').val();
      if (check_session=="1") {
        var user_id=$('#user_id').val();        
        $.ajax({
          url: '<?php echo base_url();  ?>human_behaviour/save_feeling.php',
          data: ({argument: argument,user_id: user_id}),
          dataType: 'text', 
          type: "post",
          success: function(data){  
                  //alert(data);
              } 
        });
      }else{
        window.location.href = "<?php echo base_url();  ?>Login";
      }
    }   
 setTimeout(function(){ $(".alert").fadeOut(); }, 2000);

 $(document).on('focus','.jp-search-content .jp-search-input .gsc-input',function(){
   $('.jp-main-content').css({'margin-top':'5px'});
 });

</script>
<!-- .jp-main-content {
    margin-left: auto ! important;
    position: relative;
    margin-top: 150px;
} -->
