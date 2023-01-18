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


if (isset($_POST["addDeliveryDetail"])) {

    if(!empty($_FILES["delivery_bill"]["name"])) { 

       $uploadPath = "../../../images/delivery_bill/"; 
         $fileName = basename($_FILES["delivery_bill"]["name"]); 
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
        $allowTypes = array('jpg','png','jpeg','gif', 'webp'); 
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source 
            $imageTemp = $_FILES["delivery_bill"]["tmp_name"]; 
            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 75); 

            if($compressedImage){
    
                $big_box = $_POST["big_box"];
                $medium_box = $_POST["medium_box"];
                $small_box = $_POST["small_box"];
                $delivery_date = $_POST["delivery_date"];
                // $del_charge = $_POST["delivery_charge"];
                // $pack_charge = $_POST["packing_charge"];
                $delivery_bill = $fileName;
                $description = $_POST["description"];

                $process_id = $_POST["process_id"];
                $account_id = $_POST["acc_del_id"];

                try {

                    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

                    // set the PDO error mode to exception

                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // prepare sql and bind parameters

                    $stmt = $conn->prepare("INSERT INTO order_delivery_detail (big_box, medium_box, small_box, process_id, delivery_date, delivery_bill, description) VALUES (:big_box, :medium_box, :small_box, :process_id , :delivery_date, :delivery_bill, :description)");

                    $stmt->bindParam(':big_box', $big_box);
                    $stmt->bindParam(':medium_box', $medium_box);
                    $stmt->bindParam(':small_box', $small_box);
                    $stmt->bindParam(':process_id', $process_id);
                    $stmt->bindParam(':delivery_date', $delivery_date);
                    
                    $stmt->bindParam(':delivery_bill', $delivery_bill);
                    $stmt->bindParam(':description', $description);



                    $flag = $stmt -> execute();

                    if ( $flag ) { 
                        // $result = array('response' => '1');
                        header("Location: ../customer-order.php?account_id=$account_id&process_id=$process_id");
                    }else {
                        $result = array('response' => '0'); 
                    }

                }catch(PDOException $e){
                    echo "Error: ".$e->getMessage();
                }

                $conn = null;
            }

        }
    }else{
            $fileName = "";
            $big_box = $_POST["big_box"];
            $medium_box = $_POST["medium_box"];
            $small_box = $_POST["small_box"];
            $delivery_date = $_POST["delivery_date"];
            // $del_charge = $_POST["delivery_charge"];
            // $pack_charge = $_POST["packing_charge"];
            $delivery_bill = $fileName;
            $description = $_POST["description"];

            $process_id = $_POST["process_id"];
            $account_id = $_POST["acc_del_id"];

            try {

                $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

                // set the PDO error mode to exception

                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // prepare sql and bind parameters

                $stmt = $conn->prepare("INSERT INTO order_delivery_detail (big_box, medium_box, small_box, process_id, delivery_date, delivery_bill, description) VALUES (:big_box, :medium_box, :small_box, :process_id , :delivery_date, :delivery_bill, :description)");

                $stmt->bindParam(':big_box', $big_box);
                $stmt->bindParam(':medium_box', $medium_box);
                $stmt->bindParam(':small_box', $small_box);
                $stmt->bindParam(':process_id', $process_id);
                $stmt->bindParam(':delivery_date', $delivery_date);

                $stmt->bindParam(':delivery_bill', $delivery_bill);
                $stmt->bindParam(':description', $description);



                $flag = $stmt->execute();

                if ($flag) {
                    // $result = array('response' => '1');
                    header("Location: ../customer-order.php?account_id=$account_id&process_id=$process_id");
                } else {
                    $result = array('response' => '0');
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            $conn = null;
        }
    
}   

  echo json_encode($result);
