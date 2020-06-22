<?php
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data);

    function cmp($a, $b) {
        return strcmp($a->song_name, $b->song_name);
    }

    usort($data, fn($a, $b) => strcmp($a->song_name, $b->song_name));

   for ( $i = 0 ; $i < count($data) ; $i++ ){
       //echo "<tr class=\"songitem\"><th><img class=\"songimg\" src=\" " . $data[$i]->songimg . "\" style=\"height: 100px; width: 100px;\"></th><th style=\"width: max-content;\"><a class=\"song_name\" href=\" " . $data[$i]->link . "\" target=\"_blank\" style=\"margin-left: 10%;\">" . $data[$i]->song_name . "</a></th></tr>";
        echo "<tr><th style=\"width: min-content;\"><img class=\"songimg\" src=\"". $data[$i]->songimg ."\" style=\"height: 20em; width: 20em;\"></th><th style=\"width: max-content;\"><h2 style=\"text-align: left;\"><a class=\"song_name\" href=\"". $data[$i]->link ."\" target=\"_blank\" style=\"vertical-align: middle; margin-left: 10%; width: max-content;\">". $data[$i]->song_name ."</a></h2></th></tr>";
    }
?>