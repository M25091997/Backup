<?php 
// session_start(); 

 //*************************************Create a new image from file *********************************

 include ('../../../config.php');

// **********Code to get super cat modal data*********************************

  if (isset($_POST['updateDelBoy'])) {
  
  $query = "SELECT * FROM delivery_boy WHERE id =' ".$_POST['del_id']."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);

  
}

// **********Code to get super cat modal data*********************************

  if (isset($_POST['sub_cat_id'])) {
  
  $query = "SELECT * FROM sub_category WHERE id =' ".$_POST['sub_cat_id']."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);

  
}

// **********Code to get super cat modal data*********************************

  if (isset($_POST['child_cat_id'])) {
  
  $query = "SELECT * FROM child_category WHERE id =' ".$_POST['child_cat_id']."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);

  
}

// **********Code to get super cat modal data*********************************

  if (isset($_POST['attr_id'])) {
  
  $query = "SELECT * FROM attr WHERE id =' ".$_POST['attr_id']."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);

  
}

// **********Code to get super cat modal data*********************************

  if (isset($_POST['attr_value_id'])) {
  
  $query = "SELECT * FROM attr_value WHERE id =' ".$_POST['attr_value_id']."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);

  
}

// **********Code to get super cat modal data*********************************

  if (isset($_POST['product_attr_id'])) {
  
  $query = "SELECT * FROM attributes WHERE id =' ".$_POST['product_attr_id']."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);

  
}

// **********Code to get super cat modal data*********************************

if (isset($_POST['fetchUserDetail'])) {
  $customer_id = $_POST['customer_id'];
  $query = "SELECT * FROM accounts WHERE id = '$customer_id'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);

  
}

// **********Code to get super cat modal data*********************************

if (isset($_POST['updateCatData'])) {
  $cat_edit_id = $_POST['cat_edit_id'];
  $query = "SELECT * FROM super_category WHERE id = '$cat_edit_id'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  $media_no = $row['media_number'];
  $banner_no = $row['banner_number'];

  $get_logo = $conn -> query("SELECT * FROM media WHERE media_number = '$media_no' ");
  $cat_logo = $site_url."/media/".mysqli_fetch_assoc($get_logo)['file_name'];
  $row['cat_logo'] = $cat_logo;

  $get_banner = $conn -> query("SELECT * FROM media WHERE media_number = '$banner_no' ");
  $banner = $site_url."/media/".mysqli_fetch_assoc($get_banner)['file_name'];
  $row['banner'] = $banner;

  echo json_encode($row);

  
}


// **********Code to get corporate cat modal data*********************************

if (isset($_POST['updateCorData'])) {
  $cat_edit_id = $_POST['cat_edit_id'];
  $query = "SELECT * FROM corporate_category WHERE id = '$cat_edit_id'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  $media_no = $row['media_number'];
  $banner_no = $row['banner_number'];

  $get_logo = $conn->query("SELECT * FROM media WHERE media_number = '$media_no' ");
  $cat_logo = $site_url . "/media/" . mysqli_fetch_assoc($get_logo)['file_name'];
  $row['cat_logo'] = $cat_logo;

  $get_banner = $conn->query("SELECT * FROM media WHERE media_number = '$banner_no' ");
  $banner = $site_url . "/media/" . mysqli_fetch_assoc($get_banner)['file_name'];
  $row['banner'] = $banner;

  echo json_encode($row);
}
