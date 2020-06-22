<?php
    require_once 'connection.php';

    $conn = new mysqli($host, $user, $password, $def_dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT songname, author,img FROM songs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        $song_info=$row["author"]." - " .$row["songname"] ;
        $song_name=$row["songname"];
        $songimg=$row["img"];
        echo "<tr><th style=\"width: min-content;\"><img class=\"songimg\" src=\"". $songimg ."\" style=\"height: 20em; width: 20em;\"></th><th style=\"width: max-content;\"><h2 style=\"text-align: left;\"><div class=\"nav-link\"><a class=\"song_name\" onclick='ShowPost(\"". $song_name ."\")' target=\"_blank\" style=\"cursor: pointer;vertical-align: middle; margin-left: 10%; width: max-content; \">". $song_info ."</a></div></h2></th></tr>";

    }
    } else {
    echo "0 results";
    }
    $conn->close();

?>