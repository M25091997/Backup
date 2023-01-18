<?php
include('config.php');
$result = array();

function thumbnailUploader($source, $destination, $quality) { 
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

    $uploadPath = "../../../img/user/"; 

   if(!empty($_FILES["thumbnail"]["name"])) { 
        // File info 
        $user_id = $_POST['user_id'];
        $fileName = date("mjYHis")."_".basename($_FILES["thumbnail"]["name"]); 
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif', 'webp'); 

        
            if(in_array($fileType, $allowTypes)){ 
            // Image temp source 
            $imageTemp = $_FILES["thumbnail"]["tmp_name"]; 
             
            // Compress size and upload image 
            $thumbnailUploader = thumbnailUploader($imageTemp, $imageUploadPath, 75); 

                if($thumbnailUploader){

                    $update_profile_img = $conn -> query("UPDATE accounts SET profile_img ='$fileName' WHERE id = '$user_id'");

                    $result = array('response'=> 1, 'msg'=> 'Successfully uploaded', 'img'=> $fileName );
                }else{
                    $result = array('response'=> 0, 'msg'=> 'Unable to upload' );

                }
                
            } else{
                $result = array('response'=> 0, 'msg'=> 'inappropriate type' );

            }
        

        
        }  else{
                $result = array('response'=> 0, 'msg'=> 'File not supported' );

        } 
    
    $conn_pdo = null; 

echo json_encode($result);

?>