<?php

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

// $data = json_decode(file_get_contents('php://input'), true);
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];
// $landmark = $_POST['landmark'];
$phone = $_POST['phone'];
// $fax = $_POST['fax'];
$web = $_POST['web'];
$title = $_POST['title'];
$email2 = $_POST['email2'];
$contact = $_POST['contact'];
$company = $_POST['company'];
// $associate = $_POST['associate'];
$busstype = $_POST['busstype'];
$bussnature = $_POST['bussnature'];
$listproduct = $_POST['listproduct'];
$year = $_POST['year'];
// $numemp = $_POST['numemp'];
$fssai = $_POST['fssai'];
$pan = $_POST['pan'];
$gst = $_POST['gst'];
// $country = $_POST['country'];
// $turnover1 = $_POST['turnover1'];
// $turnover2 = $_POST['turnover2'];
// $turnover3 = $_POST['turnover3'];
// $profit1 = $_POST['profit1'];
// $profit2 = $_POST['profit2'];
// $profit3 = $_POST['profit3'];
// $cus1 = $_POST['cus1'];
// $cus2 = $_POST['cus2'];
// $cus3 = $_POST['cus3'];
// $cus4 = $_POST['cus4'];
// $cus5 = $_POST['cus5'];
// $value1 = $_POST['value1'];
// $value2 = $_POST['value2'];
// $value3 = $_POST['value3'];
// $value4 = $_POST['value4'];
// $value5 = $_POST['value5'];
// $year1 = $_POST['year1'];
// $year2 = $_POST['year2'];
// $year3 = $_POST['year3'];
// $year4 = $_POST['year4'];
// $year5 = $_POST['year5'];
// $goods1 = $_POST['goods1'];
// $goods2 = $_POST['goods2'];
// $goods3 = $_POST['goods3'];
// $goods4 = $_POST['goods4'];
// $goods5 = $_POST['goods5'];
// $ctr1 = $_POST['ctr1'];
// $ctr2 = $_POST['ctr2'];
// $ctr3 = $_POST['ctr3'];
// $ctr4 = $_POST['ctr4'];
// $ctr5 = $_POST['ctr5'];
// $comp1 = $_POST['comp1'];
// $comp2 = $_POST['comp2'];
// $comp3 = $_POST['comp3'];
// $cont1 = $_POST['cont1'];
// $cont2 = $_POST['cont2'];
// $cont3 = $_POST['cont3'];
// $pos1 = $_POST['pos1'];
// $pos2 = $_POST['pos2'];
// $pos3 = $_POST['pos3'];
// $contemail1 = $_POST['contemail1'];
// $contemail2 = $_POST['contemail2'];
// $contemail3 = $_POST['contemail3'];
// $contphone1 = $_POST['contphone1'];
// $contphone2 = $_POST['contphone2'];
// $contphone3 = $_POST['contphone3'];
// $description = $_POST['description'];

// print_r($_POST);
// exit();

$result = array();

if (true) {

try {
        $conn_P = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

        // set the PDO error mode to exception

        $conn_P->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         // prepare sql and bind parameters

        $stmt = $conn_P -> prepare("INSERT INTO vendor1 (email, address, city, state, pincode, phone, web, title, email2, contact, company, busstype, bussnature, listproduct, year, fssai, pan, gst) VALUES (:email, :address, :city, :state, :pincode, :phone, :web, :title, :email2, :contact, :company, :busstype, :bussnature, :listproduct, :year, :fssai, :pan, :gst)");

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':pincode', $pincode);
        // $stmt->bindParam(':landmark', $landmark);
        $stmt->bindParam(':phone', $phone);
        // $stmt->bindParam(':fax', $fax);
        $stmt->bindParam(':web', $web);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':email2', $email2);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':company', $company);
        // $stmt->bindParam(':associate', $associate);
        $stmt->bindParam(':busstype', $busstype);
        $stmt->bindParam(':bussnature', $bussnature);
        $stmt->bindParam(':listproduct', $listproduct);
        $stmt->bindParam(':year', $year);
        // $stmt->bindParam(':numemp', $numemp);
        $stmt->bindParam(':fssai', $fssai);
        $stmt->bindParam(':pan', $pan);
        $stmt->bindParam(':gst', $gst);
        // $stmt->bindParam(':country', $country);
        // $stmt->bindParam(':turnover1', $turnover1);
        // $stmt->bindParam(':turnover2', $turnover2);
        // $stmt->bindParam(':turnover3', $turnover3);
        // $stmt->bindParam(':profit1', $profit1);
        // $stmt->bindParam(':profit2', $profit2);
        // $stmt->bindParam(':profit3', $profit3);
        // $stmt->bindParam(':cus1', $cus1);
        // $stmt->bindParam(':cus2', $cus2);
        // $stmt->bindParam(':cus3', $cus3);
        // $stmt->bindParam(':cus4', $cus4);
        // $stmt->bindParam(':cus5', $cus5);
        // $stmt->bindParam(':value1', $value1);
        // $stmt->bindParam(':value2', $value2);
        // $stmt->bindParam(':value3', $value3);
        // $stmt->bindParam(':value4', $value4);
        // $stmt->bindParam(':value5', $value5);
        // $stmt->bindParam(':year1', $year1);
        // $stmt->bindParam(':year2', $year2);
        // $stmt->bindParam(':year3', $year3);
        // $stmt->bindParam(':year4', $year4);
        // $stmt->bindParam(':year5', $year5);
        // $stmt->bindParam(':goods1', $goods1);
        // $stmt->bindParam(':goods2', $goods2);
        // $stmt->bindParam(':goods3', $goods3);
        // $stmt->bindParam(':goods4', $goods4);
        // $stmt->bindParam(':goods5', $goods5);
        // $stmt->bindParam(':ctr1', $ctr1);
        // $stmt->bindParam(':ctr2', $ctr2);
        // $stmt->bindParam(':ctr3', $ctr3);
        // $stmt->bindParam(':ctr4', $ctr4);
        // $stmt->bindParam(':ctr5', $ctr5);
        // $stmt->bindParam(':comp1', $comp1);
        // $stmt->bindParam(':comp2', $comp2);
        // $stmt->bindParam(':comp3', $comp3);
        // $stmt->bindParam(':cont1', $cont1);
        // $stmt->bindParam(':cont2', $cont2);
        // $stmt->bindParam(':cont3', $cont3);
        // $stmt->bindParam(':pos1', $pos1);
        // $stmt->bindParam(':pos2', $pos2);
        // $stmt->bindParam(':pos3', $pos3);
        // $stmt->bindParam(':contemail1', $contemail1);
        // $stmt->bindParam(':contemail2', $contemail2);
        // $stmt->bindParam(':contemail3', $contemail3);
        // $stmt->bindParam(':contphone1', $contphone1);
        // $stmt->bindParam(':contphone2', $contphone2);
        // $stmt->bindParam(':contphone3', $contphone3);
        // $stmt->bindParam(':description', $description);

    /*Checking Stock then executing*/
    $flag = $stmt -> execute();

    if ($flag) { $result = array( 'response' => '1' ); }

    }

    catch(PDOException $e)

        {
        echo "Error: ".$e->getMessage();
        }

    $conn_P = null;
 

} else { $result = array( 'response' => '0' ); /* Post Vars Not Found */ } 

// exit();
echo json_encode($result);