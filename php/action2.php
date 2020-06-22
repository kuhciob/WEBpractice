<?php 
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    //print_r($data);
    //$res=
    if(is_numeric($data->number1) && is_numeric($data->number2))
    echo $data->number1 + $data->number2;
    else 
    echo $data->number1 ,$data->number2;

?>
