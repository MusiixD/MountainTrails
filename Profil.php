<?php

    include("clase/autoload.php");

    $login = new Login();
    $user_data = $login->verifica_login($_SESSION['id_licenta']);
    $USER = $user_data;

    if(isset($_GET['id']))
    {
        $profile = new Profile();
        $profile_data = $profile->get_profile($_GET['id']); 
        
        if(is_array($profile_data))
        {
            $user_data = $profile_data[0];
        }
    }

    
    //postarile incep de aici
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if(isset($_POST['nume']))
        {
            $settings_class = new Settings();
            $settings_class->save_settings($_POST, $_SESSION['id_licenta']);
        }else
            {
            $post = new Post();
            $id= $_SESSION['id_licenta'];
            $result = $post->create_post($id, $_POST, $_FILES);

            if($result == "")
            {
                header("Location: Profil.php");
                die;
            }else
            {
                echo "<div style='text-align:center;font-size:12px;color:white;background-color:red;border-radius:10px'>";
                echo "Verificati informatiile introduse<br><br>";
                echo $result;
                echo "</div>";
        }
            }
        
    }

    //colecteaza postarile
    $post = new Post();
    $id= $user_data['id'];

    $posts = $post->get_posts($id);
    
    //colecteaza prietenii
    $user = new User();

    $friends = $user->get_friends($id);

    $image_class = new Image();
?>

<!DOCTYPE html>
    
<head>
    <title>MT | Profil</title>
</head>
<header>
    <?php include("Header.php");?>
</header>
<style type="text/css">
   .search_box {
        width: 400px;
        height: 20px;
        border-radius: 5px;
        border: none;
        padding: 4px;
        font-size: 14px;
        background-image: url(poza2.png);
        background-repeat: no-repeat;
        background-position-x: right;
    }
    #textbox {
        width: 100%;
        height: 20px;
        border-radius: 5px;
        border: solid_thin_gray;
        padding: 4px;
        font-size: 14px;
        margin: 10px;
        
    }
    .poza_profil{
        width: 150px;
        margin-top: -200px;
        border-radius: 50%;
        border: solid 2px white;
    }
    .btn_meniu {
        width: 100px;
        display: inline-block;
        margin: 2px;

    }
    .friends_img {
        
        width: 75px;
        float: left;
        margin: 8px;

    }

    .bar_prieteni{

        background-color: white;
        min-height: 400px;
        margin-top: 20px;
        width: 250px;
        color: #aaa;
        padding: 8px;
        overflow: hidden;
        border: groovy;
        border-radius:10px;
    }

    .prieteni {

            clear: both;
            font-size: 12px;
            font-weight: bold;
            width:200px;
            color: rgb(141, 73, 204);
        }

        textarea {

                width: 100%;
                border: none;
                font-family: tahoma;
                font-size: 14px;
                height: 70px;

        }
        .buton_postare {

                float: right;
                background-color: #8d49cc;
                color: white;
                border: none;
                padding: 4px;
                font-size: 14px;
                border-radius: 2px;
                width: 70px;
                cursor: pointer;
        }
        .buton_stergere {

                float: center;
                background-color: red;
                color: white;
                border: none;
                padding: 4px;
                font-size: 14px;
                border-radius: 2px;
                width: 100px;
                cursor: pointer;
        }
        .buton_follow {

                position: inherit;
                background-color: #8d49cc;
                color: white;
                border: none;
                padding: 4px;
                text-align:centre;
                font-size: 17px;
                font-weight: 730;
                border-radius: 5%;
                min-width: 110px;
                height: 40px;
                cursor: pointer;
        }
        .postare {
            padding:10px;
            border-style: groove;
            border-radius:10px;
            background-color: white;
        }
    
</style>

<body style="font-family: tahoma; background-color: #d0d8e4;">
<br><br>
    <!--zona de coperta-->
    <div style="width: 800px; margin: auto; min-height: 400px;">

        <div style="background-color: white;text-align:center;color: #405d9b; min-height: 520px;border: groovy;border-radius:10px;">

                <?php
                    $image = "imagini/mountain.jpg";
                    if(file_exists($user_data['cover_image']))
                        {
                            $image = $user_data['cover_image'];
                        }
                ?>
            <img src="<?php echo $image ?>" style="width: 100%;">
            <span style="font-size: 12px">
                <?php
                    $image = "imagini/poza1.jpg";
                    if(file_exists($user_data['profile_image']))
                        {
                            $image = $user_data['profile_image'];
                        }
                ?>

            <img class="poza_profil" src="<?php echo $image ?>"><br>
                <?php
                if($_SESSION['id_licenta'] == $user_data['id'])
                {
                    echo '<a style="text-decoration: none; color: red" href="Poza_profil.php?change=profile">Schimbă poza de profil</a> |
                          <a style="text-decoration: none; color: red" href="Poza_profil.php?change=cover">Schimbă poza de copertă</a>';
                }
               ?>
               
            </span>

            <div style="font-size: 20px; color:black;padding-top:15px;">
            <a href="Profil.php?id=<?php echo $user_data['userid'] ?>"style="text-decoration:none;"> 
            <?php 
            if($user_data['id'] == 4)
            {
                echo $user_data['nume'] . " " . $user_data['prenume'] . "<div style='font-weight: bold; color: red;'> ~Administrator~</div>";
            }else
            {
                echo $user_data['nume'] . " " . $user_data['prenume'];
            }
            ?>
            </div>
            <br>
            <span>
            <?php
                $mylikes = $user_data['likes'];

                if($user_data['likes'] == 1)
                {
                    $mylikes = "" . $user_data['likes'] . " Urmăritor" . "";
                }else
                    {
                        $mylikes = $user_data['likes'] . " Urmăritori";
                    }
                    
            ?>
            <a href="like.php?type=user&id=<?php echo $user_data['id']?>">
            <input class="buton_follow" type="button" value="Urmărește"">
            <div style="text-decoration: overline underline 2px;padding-top:20px;text-align:centre;">
            </a>
            <?php echo $mylikes?>
            </div>
            
            </span>
            <br>
            
            <a href="Timeline.php"><div class="btn_meniu">Acasă</div></a>
            |
            <a href="Profil.php?section=about&id=<?php echo $user_data['id']?>"><div class="btn_meniu">Despre</div></a>
            |
            <a href="Profil.php?section=following&id=<?php echo $user_data['id']?>"><div class="btn_meniu">Urmăriri</div></a>
            |
            <a href="Profil.php?section=followers&id=<?php echo $user_data['id']?>"><div class="btn_meniu">Urmăritori</div></a>
            |
            <a href="Profil.php?section=photos&id=<?php echo $user_data['id']?>"><div class="btn_meniu">Poze</div></a>
            |
            <?php
            if($user_data['id'] == $_SESSION['id_licenta'])
            echo '<a href="Profil.php?section=settings&id='.$user_data['id'].'"><div class="btn_meniu">Setări</div></a>';
            ?>
        </div>

        <!--sub coperta-->
        <?php
        $section = "default";
        if(isset($_GET['section']))
        {
            $section = $_GET['section'];
        }
        if($section == "default")
        {
            include("profile_content_default.php");    
        }
        elseif($section == "photos")
            {
                    include("profile_content_photos.php"); 
            }
        elseif($section == "followers")
            {
                include("profile_content_followers.php");
            }
        elseif($section == "following")
            {
                include("profile_content_following.php");
            }
        elseif($section == "about")
            {
                include("profile_content_about.php");
            }
        elseif($section == "settings")
            {
                include("profile_content_settings.php");
            }
        ?>
    </body>

</html>