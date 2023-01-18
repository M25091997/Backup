<?php
session_start();
include("../../config.php");
include("../../variables.php");
$media_number = rand() . time();

$id = $_POST['id'];
$Q = $conn->query("SELECT * FROM category WHERE super_category_id = '$id'");
while ($DROW = mysqli_fetch_array($Q)) { ?>
    <option value="<?php echo $DROW['id']; ?>"><?php echo $DROW['name'] ?></option>
<?php } ?>