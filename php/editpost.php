<?php
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
    $old_song_name=$_POST["postname"];
    $song_name=$_POST["songname"];
    $song_author=$_POST["songauthor"];
    $song_body=$_POST["songbody"];
    require_once 'connection.php';

    $conn = new mysqli($host, $user, $password, $def_dbname);
    if(!$conn){
        echo "Could not Connect MySql Server:". $conn->connect_error;
    }

    $sql= "UPDATE songs
         SET songname=$song_name,author=$song_author,img=$songimg,body=$song_body
         WHERE songname=$old_song_name;";


    if($conn->query($sql) === TRUE) {
        echo "'New record has been added successfully !<br>";
        header( 'Location: /MAINBootstrap.html' ) ;
     } else {
        die("Error: ". $sql. ":-" . $conn->connect_error);
     }
     $conn->close();
     
?>
 <head>
    <title>GTRDN</title>
    <meta charset="utf-8" /> 


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <link id="stylelink" rel="stylesheet" href="../styles/nightnewstyle.css">
    <link id="stylelink" rel="stylesheet" href="../styles/aplication_style.css">
    
    <link rel="icon" href="../images/LOGO.png" type="image/x-icon">
    <link id="stylelink" rel="stylesheet" href="/styles/toggle.css">
    <script src="../engine.js" ></script>    
</head>
 

  <body>
        <div id="background">   </div>
        
        <div class="top_bar">
            <div id="intro" class="intro">
                <header style="text-align: center;">
                    <h1 id="main_head" class="display-3" ><a href="../MAINBootstrap.html">Guitarist's den</a></h1>
                </header>
            </div>
            <div id="navigation" class="navigation"  >
                
                <nav class="container-fluid">
<div class="row">
    <div class="col-4 justify-content-start" style="text-align: start;">
        <div class="p-2 navitem" >
            <small id="visitors">Visitors </small>
        </div>
    </div>

    <div class="col-4 justify-content-center">
        <div class="navitem " >
            <h6><a  class="nav-link" href='../MAINBootstrap.html' style="color: rgb(214, 214, 214);" style="padding-left:0;padding-right:0;">Back Home</a></h6>
      </div>
                        

    </div>
            <div class="col-4 justify-content-end">
                    


                    <div class="navitem">
                    <h6 class="nav-link" style="padding-left:0;">Dark theme</h6>
                    </div>
                    <div class="navitem">
                        <div id="theme_changer" class="switch_box box_3">
                            <div class="toggle_switch">
                                <input type="checkbox" class="switch_3">
                                <svg class="checkbox" xmlns="http://www.w3.org/2000/svg" style="isolation:isolate" viewBox="0 0 168 80">
                                <path class="outer-ring" d="M41.534 9h88.932c17.51 0 31.724 13.658 31.724 30.482 0 16.823-14.215 30.48-31.724 30.48H41.534c-17.51 0-31.724-13.657-31.724-30.48C9.81 22.658 24.025 9 41.534 9z" fill="none" stroke="#233043" stroke-width="3" stroke-linecap="square" stroke-miterlimit="3"/>
                                <path class="is_checked" d="M17 39.482c0-12.694 10.306-23 23-23s23 10.306 23 23-10.306 23-23 23-23-10.306-23-23z"/>
                                    <path class="is_unchecked" d="M132.77 22.348c7.705 10.695 5.286 25.617-5.417 33.327-2.567 1.85-5.38 3.116-8.288 3.812 7.977 5.03 18.54 5.024 26.668-.83 10.695-7.706 13.122-22.634 5.418-33.33-5.855-8.127-15.88-11.474-25.04-9.23 2.538 1.582 4.806 3.676 6.66 6.25z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
            </div>
                    <script>
                        var theme=1;
                        var link = document.getElementById('stylelink');
                        
                        document.getElementById('theme_changer').addEventListener('click',()=>ChangeTheme());
                        function ChangeTheme(){ 
                            if(theme==2){
                                link.setAttribute('href','../styles/nightnewstyle.css');
                                theme=1;
                            }else
                            if(theme==1){
                                link.setAttribute("href", '../styles/daynewstyle.css');
                                theme=2;  
                            }
                        }
                        </script>
    </div> 
                </nav>

                
            </div>
        </div>
        

        <div id="base" class="row container-fluid base" >
      
            <div class="col-2 ">
            <div class="row container ">
                <div id="SignInBlock" class="container-fluid float_panel">
                    
                    <form id="SignInForm"  onsubmit="validateLoginForm(event)" method="POST" action="../php/login.php" >
                        <div class="form-group">
                            <label>Log-in</label>
                            <input type="text" class="form-control" id="username" placeholder="Username" name="username" onkeypress='validateLogin(event,"SignInForm",name)'>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="password" name="password" placeholder="Password" onkeypress='validatePassword(event,"SignInForm","password")'>
                        </div>

                        <div class="form-group">
                            <input id="sbutton" type="submit" class="form-control btn btn-secondary w-50" style="font-size:1em; align-self:center;" value="sign in" >
                        </div>

                    </form>

                    <p ><a id="regiatration"  href="/layouts/Registration.html" style="font-size: 0.7em; cursor: pointer;"  >Registration</a></p>
                </div>
                <div id="CurrentUserBlock" class="container-fluid float_panel">
                    <h3 id="currusername"></h3>
                    <form action="../php/signout.php">
                        <button type="submit" class="form-control btn btn-secondary" >Sign out</button>
                    </form>
                </div>
            </div>

            <div class="row container ">
                <div id="contacts" class="container-fluid float_panel">
                    <p>Contacts</p>
                    <img id="sun2" src="../images/LOGOonlySunlights.png"  style="width:15em; height:15em;" title="click!" style="cursor: help;" onclick="SunClick()">
                    <img id="sun" src="../images/LOGOonlySUN.png" style="width:15em; height:15em;" title="click!" style="cursor: help;">
                    <script>
                    //style="width:15em; height:15em;"
                    let anim=20;
                    function SunClick(){
                        if(anim>1){
                            --anim;
                        }else{
                            if(anim>0.2){
                                anim-=0.1;
                            }else
                            if(anim>0.02){
                                anim-=0.01;
                            }else anim=20;
                        }
                        const sunlight=document.getElementById('sun2');
                        sunlight.style="animation:spin " + anim + "s linear infinite;width:15em; height:15em;";
                    }
                    </script>
                    <div>
                        Boichuk Ivan
                    </div>
                    <div>
                        
                            <img class="inst" src="../images/inst2.png" width="20" height="20" alt="inst">
                        
                        <a id="clickit" class="inst" href="https://www.instagram.com/lvasuk/" target="_blank"  style="color: rgb(214, 214, 214);">@lvasuk</a>
                    </div>
                </div>
            </div>
                
               
            </div>
                                     
            <!-- <div id="main" class="main"> -->  
             <div class="col-8 main d-flex-row  justify-content-center">
                 <h2>New Post</h2>
                 <br>
                 <div class="d-flex justify-content-center">
                    <form id="PostForm" class="w-100" style="margin: 0;" action="/php/editpost.php" method="POST" enctype="multipart/form-data" >
                        <div class="form-group">
                          <label >Song Name</label>
                          <input type="text" class="form-control form-control" value="<?php $song_name ?>" id="songname"  name="songname" placeholder="Enter Song Name" required>
                        </div>
                        <div class="form-group">
                            <label >Song Author</label>
                            <input type="text" class="form-control form-control" id="songauthor"  value="<?php $song_author ?>"name="songauthor" placeholder="Enter Song Author" required>
                          </div>
                        <div class="form-group"></div>
                            <label >Song Cover</label>
                            <div class="custom-file ">
                                <input name="image" type="file" class="custom-file-input" value="<?php $songimg ?>"id="customFile" required>
                                <label class="custom-file-label" for="customFile">Choose Image</label>
                            </div> 
                        </div>
                          <div class="form-group">
                            <fieldset style="height: 100%">
                                <legend id="GuessLegent">Body</legend>
                                <textarea  id="songbody" class="form-control" name="songbody" value="<?php $song_body ?>" rows="40" required></textarea>
                            </fieldset>
                            <br>
                            
                            <br>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-secondary w-50" type="submit">Update</button>
                              </div>

                              <div class="invalid-feedback">
                                Field can`t be empty
                              </div>
                        </div>
                    </form>
                 </div>
                
            <br>
            <script>
                // Add the following code if you want the name of the file appear on select
                $(".custom-file-input").on("change", function() {
                  var fileName = $(this).val();
                  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                  console.log(fileName);
                });
                </script>
            <div id="footer">

                <footer>IVASUK | <del>VALERY</del> | 2020</footer>
            </div>
        
            </div>
           
            <div class="col-2">
    </div>
     

    
    
    <script>

        $(".base").css("margin-top",$(".top_bar").height())
        $("#background").css("margin-top", ($(".top_bar").outerHeight()-1)  )

        $(document).ready(function(){
            SetConfig()
                    $.ajax({
                        url: '../php/countusers.php',
                        success: function(response)
                        {
                            console.log(response)
                            document.getElementById("visitors").innerHTML="Visitors : "+response;
                        }
                    });
        });
        
    </script>
   
  </body>