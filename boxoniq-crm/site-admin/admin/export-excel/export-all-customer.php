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
$fileName = "members-data_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('CUSTOMER ID', 'CUSTOMER NAME', 'MOBILE', 'EMAIL', 'ADDRESS', 'WALLET BALANCE', 'BABY NAME', 'BABY DOB', 'CREATED ON'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $conn->query("SELECT * FROM accounts ORDER BY id ASC"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($rowD = $query->fetch_assoc()){ 


          $customer_id = $rowD['id'];

          $name = $rowD['name'];
          $baby_name = $rowD['baby_name'];
          $baby_dob = $rowD['baby_dob'];

          $phone = $rowD['phone'];
          $email = $rowD['email'];
          $creation_date = $rowD['creation_date'];
          // $order_time = $rowD['creation_time']; 
    $get_address = $conn -> query("SELECT * FROM saved_address WHERE account_id = '$customer_id'");
    $row_address = mysqli_fetch_assoc($get_address);
    $address = $row_address['full_address'];
    // $pincode = $row_address['pincode'];
    // $state = $row_address['state'];

    // $new_add = $address;

    $get_balance = $conn -> query("SELECT * FROM wallet WHERE user_id = '$customer_id'");
    $row_balance = mysqli_fetch_assoc($get_balance);
    $wallet_balance = $row_balance['amount'];


        $status = ($row['status_id'] == 1)?'Active':'Inactive'; 
        $lineData = array($customer_id, $name, $phone, $email, $address, $wallet_balance, $baby_name, $baby_dob, $creation_date); 
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