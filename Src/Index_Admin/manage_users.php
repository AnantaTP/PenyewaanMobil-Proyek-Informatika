<?php include 'header.php';
if(isset($_REQUEST['deleteid']) && $_REQUEST['deleteid'] != NULL) {
    $delete_user_id = $_REQUEST['deleteid'];
    $delete_user_query = "DELETE FROM user_details WHERE id = $delete_user_id";
    $fetch_image = "select image from user_details where id = $delete_user_id";
    $result = $conn->query($fetch_image);
    $user_image = '';   
    while($row = $result->fetch_assoc()){
      $user_image = $row['image'];
    }
    $result = $conn->query($delete_user_query);
    if($result === TRUE){
        if($user_image != NULL){
            unlink($user_image);
        }
      ?>
      <script>
      window.location = 'users.php';
      </script>
      <?php
    }
    exit;
  }
?>
