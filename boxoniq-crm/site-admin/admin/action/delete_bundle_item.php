<?php 

include ("../../../config.php");

if (isset($_POST['deleteBundleItem'])) {
  $item_id = $_POST['del_id'];

  $get_items = $conn -> query("SELECT * FROM bundle_creator");
  $row_items = mysqli_fetch_assoc($get_items);
  $item_ids = $row_items['item_ids'];
  $id_arr = explode(',', $item_ids);

  if (($key = array_search($item_id, $id_arr)) !== false) {
    unset($id_arr[$key]);
}
// echo json_encode($id_arr);
$items = implode(',', $id_arr);
  
  // exit();
    
  $query = "UPDATE bundle_creator SET item_ids = '$items'";
  $result = mysqli_query($conn, $query);
  if($result){
    $res = array('response' => 1);
    echo json_encode($res);
  }
}

?>