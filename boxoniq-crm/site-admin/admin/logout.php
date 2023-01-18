<?php

session_start();



unset($_SESSION['username']);



echo '<script type="text/javascript">window.location.href="index.php"; </script>';



?>