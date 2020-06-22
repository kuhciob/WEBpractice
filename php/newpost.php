<?php

define ('SITE_ROOT', realpath(dirname(__DIR__)));
    

  
    try {
   
        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if (
            !isset($_FILES['image']['error']) ||
            is_array($_FILES['image']['error'])
        ) {
            throw new RuntimeException('Invalid parameters.');
        }
    
        // Check $_FILES['upfile']['error'] value.
        switch ($_FILES['image']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Exceeded filesize limit.');
            default:
                throw new RuntimeException('Unknown errors.');
        }
    
        // You should also check filesize here.
        if ($_FILES['image']['size'] > 100000000) {
            throw new RuntimeException('Exceeded filesize limit.');
        }
    
        // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
        // Check MIME Type by yourself.
        
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search(
            $finfo->file($_FILES['image']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),
            true
        )) {
            throw new RuntimeException('Invalid file format.');
        }
    
        // You should name it uniquely.
        // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
        // On this example, obtain safe unique name from its binary data.
       
        if (!move_uploaded_file(
            $_FILES['image']['tmp_name'],
            sprintf(SITE_ROOT.'\images\songsbands\%s',
            basename($_FILES["image"]["name"]),
                $ext
            )
        )) {
            throw new RuntimeException('Failed to move uploaded file.');
        }
    
        echo 'File is uploaded successfully.';
    
    } catch (RuntimeException $e) {
    
        echo $e->getMessage();
    
    }
    $target_dir = "/images/songsbands/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    $songimg=$target_file;
    $song_name=$_POST["songname"];
    $song_author=$_POST["songauthor"];
    $song_body=$_POST["songbody"];
    require_once 'connection.php';

    $conn = new mysqli($host, $user, $password, $def_dbname);
    if(!$conn){
        echo "Could not Connect MySql Server:". $conn->connect_error;
    }
  
    $sql= "INSERT INTO songs (songname,author,img,body)
        VALUES ('$song_name','$song_author','$songimg','$song_body'); ";

     if ($conn->query($sql) === TRUE) {
        echo "'New record has been added successfully !<br>";
        header( 'Location: /MAINBootstrap.html' ) ;
     } else {
        die("Error: ". $sql. ":-" . $conn->connect_error);
     }
     $conn->close();

?>