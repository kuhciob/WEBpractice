<?php
    require_once 'connection.php';
    $dbname=$_GET["dbname"];
    $conn = new mysqli ($host, $user, $password);

    $sql="CREATE DATABASE IF NOT EXISTS ". $dbname." CHARACTER SET utf8";
    $conn->query($sql);
    $conn->close();  



    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed:". $conn->connect_error);
    }else{
        echo "Connected to ". $dbname ." successfully <br>";
    }

    $sql = "CREATE TABLE IF NOT EXISTS users(".
      "ID INT(5) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,".
      "nickname VARCHAR(25) NOT NULL,".
      "pass VARCHAR(25) NOT NULL,".
      "isadmin BOOLEAN NOT NULL DEFAULT 0,".
      "UNIQUE KEY unique_nickname (nickname)".
      ") CHARACTER SET utf8";  

      if ($conn->query($sql) === TRUE) {
        echo "Table users created successfully <br>";
      } else {
        echo "Error creating table: " . $conn->error;
      }
  
      $sql = "CREATE TABLE IF NOT EXISTS songs(".
      "ID INT(5) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,".
      "songname VARCHAR(255) NOT NULL,".
      "author VARCHAR(255) NOT NULL,".
      "img TEXT NOT NULL,".
      "body LONGTEXT NOT NULL".
      "UNIQUE KEY unique_songname (songname)".
      ") CHARACTER SET utf8";  

      if ($conn->query($sql) === TRUE) {
        echo "Table users created successfully <br>";
      } else {
        echo "Error creating table: " . $conn->error;
      }
$conn->close();  

// створення стандартного адміна
    $username="lvasuk";
    $pass="11112001";
    $conn = new mysqli($host, $user, $password, $dbname);
    if(!$conn){
        die("Could not Connect MySql Server:". $conn->connect_error);
    }
 
    $sql= "INSERT INTO users (nickname,pass,isadmin)
        VALUES ('$username','$pass','1'); ";

     if ($conn->query($sql) === TRUE) {
        echo "'New record has been added successfully !<br>";
     } else {
        die("Error: ". $sql. ":-" . $conn->connect_error);
     }
     $conn->close();  

     //header('Location: ' . $_SERVER['HTTP_REFERER']);
     

?>