<?php 
  
  $argument=$_POST['argument'];
  if ($argument=="") {
    return 0;
  }else{
    
    $dataArray=explode(" ", $argument);

   echo $user_id=$_POST['user_id'];

    include('connection.php');

    $cat_ids=array();
    foreach ($dataArray as $key => $value) {
        
        if ($value!="") {
          $value= ",".$value.",";
          $cat_id= matchWord($value);
          if ($cat_id!="" && !in_array($cat_id, $cat_ids)) {

              array_push($cat_ids, $cat_id);
          }
        }
    }

    $res=insertCat($user_id,$cat_ids);

    echo $res;
  }

  function insertCat($user_id,$cat_ids)
  {
      include('connection.php');

      $sql = "";

      foreach ($cat_ids as $key => $cat_id) {

          $sql .= "INSERT INTO hb_user_feelings (user_id, caregory_id) VALUES ('$user_id', '$cat_id');";
          
      }

      if ($conn->multi_query($sql) === TRUE) {
          return 1;
      } else {
          return 0;
      }
  }



  function matchWord($word)
  {

   
      include('connection.php');
      
      $sql = "SELECT * FROM hb_category where search_word like '%$word%'";
      $result = $conn->query($sql);
      $cat_id="";

      if ($result->num_rows > 0) {        
            $row = $result->fetch_assoc();
              $cat_id = $row['category_id'];
         
      }
      return $cat_id;
  }




?>