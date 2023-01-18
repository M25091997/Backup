<?php 
include ("../../../config.php");

if (isset($_POST["addCartQuantity"])) {
    // print_r($_POST);
    // exit();
    
    $qty = $_POST["qty"];
    $item_id = $_POST["item_id"];
    $account_id = $_POST["account_id"];
    $process_id = $_POST["process_id"];

    $sel_item = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id'");
    $row_item = mysqli_fetch_assoc($sel_item);
    $item_price = $row_item['price'];
    $attribute_id = $row_item['id'];

    $sel_booking = $conn -> query("SELECT * FROM bookings WHERE process_id = '$process_id'");
    $row_book_item = mysqli_fetch_assoc($sel_booking);
    $book_total = $row_book_item['amount'];

    // $total = $qty * $item_price;


    // $settle_status = 1;

    try {

    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // prepare sql and bind parameters

    $stmt = $conn->prepare("INSERT INTO cart (item_id, attribute_id, account_id, date_creation, checkout, quantity, total_amount, mrp) 

    VALUES (:item_id, :attribute_id, :account_id, :date_creation, :checkout, :quantity, :total_amount, :mrp)");

    $stmt->bindParam(':item_id', $item_id);
    $stmt->bindParam(':attribute_id', $attribute_id);
    $stmt->bindParam(':account_id', $account_id);
    $stmt->bindParam(':date_creation', $date_creation);
    $stmt->bindParam(':checkout', $checkout);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':mrp', $item_price);
    $stmt->bindParam(':total_amount', $total_amount);


		
		$date_creation = date('Y-m-d');
		$checkout = 1;
		$quantity = $qty;
		$total_amount = $item_price * $qty;

		$flag = $stmt -> execute();

		if ( $flag ) { 
			$last_cart_id = $conn -> lastInsertId();

			$stmt_order = $conn->prepare("INSERT INTO orders (cart_id, process_id) 
    			VALUES (:cart_id, :process_id)");

			$stmt_order->bindParam(':cart_id', $last_cart_id);
    		$stmt_order->bindParam(':process_id', $process_id);

			$flag_order = $stmt_order -> execute();

			if($flag_order){

				$b_total_amount = $book_total + $total_amount;

			$update_book = $conn -> query("UPDATE bookings SET amount = '$b_total_amount' WHERE process_id = '$process_id' && account_id = '$account_id'");


					if($update_book){
						$result = array('response' => '1', 'last_cart_id' => $last_cart_id, 'total' => $book_total); 
					}


				

			}

		}
		else {$result = array('response' => '0'); }

		}

catch(PDOException $e)

    {
    echo "Error: ".$e->getMessage();
    }

$conn = null;

   

    // $insert_order = $conn -> query("INSERT INTO ORDER (cart_id, process_id) VALUES ('$last_cart_id', '$process_id')");

    // $sel_booking = $conn -> query("SELECT * FROM bookings WHERE process_id = '$process_id' && account_id = '$account_id' ");

    // $row_book = mysqli_fetch_assoc($sel_booking);
    // $book_total = $row_book['amount'];

    // $new_total = $book_total + $total;

    // $update_booking = $conn -> query("UPDATE bookings SET amount = '$book_total' WHERE process_id = '$process_id' && account_id = '$account_id' ");

    // if ($run_query) {
    //   echo "New Quantity Added Successfully..";
    // }else{
    // 	echo "Something went wrong";
    // }

  }

  echo json_encode($result);

?>