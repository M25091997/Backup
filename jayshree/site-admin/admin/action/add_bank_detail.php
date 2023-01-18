<?php 
include ("../../../config.php");

function compressImage($source, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // *************************************Create a new image from file *********************************
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break;
            case 'image/webp': 
            $image = imagecreatefromwebp($source); 
            break;  
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
     
    // Save image 
    imagejpeg($image, $destination, $quality); 
     
    // Return compressed image 
    return $destination; 
}

if (isset($_POST["submit_bank_detail"])) {

    if(!empty($_FILES["qr_code"]["name"])) { 

        // print_r($_POST);
        // exit();

        // File info 

    $uploadPath = "../../../images/qrcode/"; 


        $fileName = basename($_FILES["qr_code"]["name"]); 

        $imageUploadPath = $uploadPath . $fileName; 

        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 


        // Allow certain file formats 

        $allowTypes = array('jpg','png','jpeg','gif', 'webp'); 

        if(in_array($fileType, $allowTypes)){ 

            // Image temp source 

            $imageTemp = $_FILES["qr_code"]["tmp_name"]; 

            // Compress size and upload image 

            $compressedImage = compressImage($imageTemp, $imageUploadPath, 75); 

    if($compressedImage){
    $bank_name = $_POST["bank_name"];
    $bank_acc_no = $_POST["bank_acc_no"];
    $bank_acc_holder_name = $_POST["bank_acc_holder_name"];
    $bank_phonepe = $_POST["bank_phonepe"];
    $bank_googlepe = $_POST["bank_googlepe"];
    $bank_ifsc = $_POST["bank_ifsc"];
    $process_id = $_POST["bank_pro_id"];
    $account_id = $_POST["bank_acc_id"];
    $pack_charge = $_POST["pack_charge"];
    $del_charge = $_POST["del_charge"];


    $qrcode = $fileName;

    try {

    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // prepare sql and bind parameters

    $stmt = $conn->prepare("INSERT INTO order_bank_detail (bank_name, acc_no, acc_name, ifsc, phonepe, googlepe, qrcode, process_id, del_charge, pack_charge) VALUES (:bank_name, :acc_no, :acc_name, :ifsc, :phonepe, :googlepe, :qrcode, :process_id, :del_charge, :pack_charge)");

    $stmt->bindParam(':acc_no', $bank_acc_no);
    $stmt->bindParam(':acc_name', $bank_acc_holder_name);
    $stmt->bindParam(':ifsc', $bank_ifsc);
    $stmt->bindParam(':phonepe', $bank_phonepe);
    $stmt->bindParam(':googlepe', $bank_googlepe);
    $stmt->bindParam(':process_id', $process_id);
    $stmt->bindParam(':qrcode', $qrcode);
    $stmt->bindParam(':bank_name', $bank_name);
    $stmt->bindParam(':del_charge', $del_charge);
    $stmt->bindParam(':pack_charge', $pack_charge);



		$flag = $stmt -> execute();

		if ( $flag ) { 
			// $result = array('response' => '1');
            header("Location: ../customer-order.php?account_id=$account_id&process_id=$process_id");
		}
		else {$result = array('response' => '0'); }

		}

catch(PDOException $e)

    {
    echo "Error: ".$e->getMessage();
    }

    $conn = null;

}
}
}

  }

  echo json_encode($result);

?>