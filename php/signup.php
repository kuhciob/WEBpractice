<?php
    require_once 'connection.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $username = $data->username;
    $pass = $data->password;
    

    $conn = new mysqli($host, $user, $password, $def_dbname);
    if(!$conn){
        echo "<script>alert('Could not Connect MySql Server:". $conn->connect_error."')</script> ";
    }

    $sql = "SELECT * FROM users WHERE nickname ='".$username."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        echo "001";   
    }
    else{
        $sql= "INSERT INTO users (nickname,pass)
        VALUES ('$username','$pass'); ";

    if ($conn->query($sql) === TRUE) {
        $curruser_json = file_get_contents('config.json',true);
        $curruserObject = json_decode($curruser_json);
        $curruserObject->currentuser->username=$username;
        $curruserObject->currentuser->isadmin="0";


        $fp = fopen('config.json', 'w');
        fwrite($fp, json_encode($curruserObject));
        fclose($fp);
        echo "200";
    } else {
        echo "002";
    }
    $conn->close();
    }

?>