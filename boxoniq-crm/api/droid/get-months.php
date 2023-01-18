<?php
session_start();
include('../../config.php');

$result = [];
$res = [];

// if (isset($_POST['account-id'])) {
// $user_id = $_POST['account-id'];
$sql = "SELECT * FROM subs_plan";
$query = mysqli_query($conn, $sql);
$count = mysqli_num_rows($query);
if ($count > 0) {
    while($row = mysqli_fetch_assoc($query)){
        $month = $row['months'].' / Times';
        array_push($res,  array('data' => $month));
    }    
} else {
    array_push($result,  array('response' => 'Not Found!'));
}
// } else {
//     array_push($result,  array('response' => 'Post var missing!'));
// }

if ($res != '') {
    echo json_encode($res);
} else {
    echo json_encode($result);
}
