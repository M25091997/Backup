<?php 

$mobile = '+918935822952';

if (strlen($mobile) == 13 && substr($mobile, 0, 3) == "+91")
{
    $mobile = substr($mobile, 3, 10);
}
echo $mobile;

?>