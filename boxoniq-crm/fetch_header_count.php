<?php 
 include ('../../../config.php');


if (isset($_POST['fetchAstroDetail'])) {
  
  $query = "SELECT email,languages,expertize,pan,adhar,astro_desc FROM astrologer WHERE id =' ".$_POST['astro_id']."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);
  
}

if (isset($_POST['fetchUserDetail'])) {
  
  $query = "SELECT dob,tob,place,f_name,phone,email,profile_img FROM user WHERE id =' ".$_POST['user_id']."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);
  
}

if (isset($_POST['fetchAstroPrice'])) {
  
  $query = "SELECT id,video_price,audio_price,visit_price,analysis_price FROM astrologer WHERE id =' ".$_POST['astro_id']."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);

  
}

// Code to fetch medium info

if (isset($_POST['fetchAudioPrice'])) {
  
  $query = "SELECT id,audio_price FROM astrologer WHERE id =' ".$_POST['audio_id']."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);

  
}
if (isset($_POST['fetchVideoPrice'])) {
  
  $query = "SELECT id, video_price FROM astrologer WHERE id =' ".$_POST['video_id']."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);

  
}if (isset($_POST['fetchVisitPrice'])) {
  
  $query = "SELECT id,visit_price FROM astrologer WHERE id =' ".$_POST['visit_id']."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);

  
}if (isset($_POST['fetchHoroPrice'])) {
  
  $query = "SELECT id,analysis_price FROM astrologer WHERE id =' ".$_POST['horo_id']."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);

  
}

?>