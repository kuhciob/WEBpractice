<?php
    $curruser_json = file_get_contents('config.json',true);
    $curruserObject = json_decode($curruser_json);
    $curruserObject->currentuser->username="";

    $fp = fopen('config.json', 'w');
    fwrite($fp, json_encode($curruserObject));
    fclose($fp);
    header( 'Location: /MAINBootstrap.html' ) ;
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
?>