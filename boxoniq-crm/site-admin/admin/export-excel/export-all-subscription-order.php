<?php 
// Load the database configuration file 
include_once '../../../config.php'; 
 
 

// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "subs-orders-data_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('ORDER ID', 'CUSTOMER NAME', 'MOBILE', 'EMAIL', 'ADDRESS', 'ORDERED ITEMS', 'AMOUNT', 'STATUS', 'DATE'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $conn->query("SELECT * FROM subs_booking ORDER BY id DESC"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($rowD = $query->fetch_assoc()){ 

        $order_items = "";

        $order_id = $rowD['id'];

          $account_id = $rowD['user_id'];
          $order_date = $rowD['date'];
          // $order_time = $rowD['creation_time']; 

          $status_id = $rowD['order_status']; 
          $amount = $rowD['total']; 
          // $payment_mode_id = $rowD['payment_mode']; 
          $TRANSACTION_ID = $rowD['TRANSACTION_ID']; 
          $creation_date = $rowD['date']; 
          // $creation_time = $rowD['creation_time'];
          $process_id = $rowD['process_id'];
          $address_id = $rowD['address_id'];

          $aQ = $conn -> query("SELECT * FROM accounts WHERE id = '$account_id'");
          while ($sD = mysqli_fetch_array($aQ)) {
            $account_name = $sD['name'];
            $account_email = $sD['email'];
            $account_phone = $sD['phone'];

          }

          $aQ1 = $conn -> query("SELECT * FROM saved_address WHERE id = '$address_id'");
          while ($sD1 = mysqli_fetch_array($aQ1)) {

            $address = $sD1['full_address'];
            $landmark = $sD1['landmark'];
            $pincode = $sD1['pincode'];

          }

          $pQ1 = $conn -> query("SELECT * FROM status_id WHERE id = '$status_id'");
          while ($sD = mysqli_fetch_array($pQ1)) {
            $status = $sD['name'];
          }

          // $pQ = $conn -> query("SELECT * FROM payment_method WHERE id = '$payment_mode_id'");
          // while ($sD = mysqli_fetch_array($pQ)) {
          //   $payment_mode = $sD['name'];
          // }

          $aQzz = $conn -> query("SELECT * FROM subs_order WHERE process_id = '$process_id'");
          while ($sD = mysqli_fetch_array($aQzz)) {
            $xamount = "";
            $cart_id = $sD['sub_cart_id'];

            $aQz = $conn -> query("SELECT * FROM subs_cart WHERE id = '$cart_id'");
          while ($sD = mysqli_fetch_array($aQz)) {
            $product_id = $sD['item_id'];
            $attribute_id = $sD['attr_id'];
            $quantity = $sD['item_qty'];
            $attr_price = $sD['attr_price'];

            $xamount = $quantity*$attr_price;

          $aQss = $conn -> query("SELECT * FROM attributes WHERE id = '$attribute_id'");
          while ($sD = mysqli_fetch_array($aQss)) {
            $attr = $sD['name'];

          }



             $aQssssss = $conn -> query("SELECT * FROM items WHERE id = '$product_id'");
          while ($sD = mysqli_fetch_array($aQssssss)) {
            $product_name = $sD['name'];

          }

        }

        $order_items.= $product_name."-".($attr)."x ".$quantity." = ".$xamount." |";
        

    }




          // $pQ_ = $conn -> query("SELECT * FROM payment_history WHERE process_id = '$process_id'");
          // while ($sD_ = mysqli_fetch_array($pQ_)) {
          //   $TRANSACTION_ID = $sD_['transaction_id'];
          // }

        $lineData = array($order_id, $account_name, $account_phone, $account_email, $address, $order_items, $amount, $status, $order_date); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;