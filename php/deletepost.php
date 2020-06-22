<?php
    $songname= $_GET["postname"];
    DeletePost($songname);
    function DeletePost($songname){
        echo "alert('i am in')";
        $host = 'localhost'; // адрес сервера 
        $database = 'dendatabase'; // имя базы данных
        $user = 'root'; // имя пользователя
        $password = 'strong2008password1999'; // пароль

    $def_dbname="dendatabase";
        $conn = new mysqli($host, $user, $password, $def_dbname);
        if(!$conn){
            echo "Could not Connect MySql Server:". $conn->connect_error;

        }
        $sql = "DELETE FROM songs WHERE songname='".$songname."'";
        
        if ($conn->query($sql) == TRUE) {
            echo "Post was deleted";
        }
        else
        {
            echo "HMmm...Somesing wrong. Post was NOT deleted";   
        }
        $conn->close();
    }

?>