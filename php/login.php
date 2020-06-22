<?php
    require_once 'connection.php';
    $accaunt_name=$_POST["username"];
    $accaunt_pass=$_POST["password"];
    
    $conn = new mysqli($host, $user, $password, $def_dbname);
    if(!$conn){
        echo "Could not Connect MySql Server:". $conn->connect_error;
        echo "<br><a href='/MAINBootstrap.html'>Back Home</a><br>";

    }

    $sql = "SELECT * FROM users WHERE nickname ='".$accaunt_name."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if( $row["pass"] != $accaunt_pass){
            echo "Wrong Password";
            echo "<br><a href='/MAINBootstrap.html'>Back Home</a><br>";
        }
        else
        {  
            $curruser_json = file_get_contents('config.json',true);
            $curruserObject = json_decode($curruser_json);
            $curruserObject->currentuser->username=$accaunt_name;
            $curruserObject->currentuser->isadmin=$row["isadmin"];

            $fp = fopen('config.json', 'w');
            fwrite($fp, json_encode($curruserObject));
            fclose($fp);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

    }
    else
    {
        echo "Wrong Nickname";
        echo "<br><a href='/MAINBootstrap.html'>Back Home</a><br>";
        
    }
    $conn->close();
    
?>