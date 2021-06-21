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

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
            $post = new Post();
            $id= $_SESSION['id_licenta'];
            $result = $post->create_post($id, $_POST, $_FILES);

            if($result == "")
            {
                header("Location: single_post.php?id=$_GET[id]");
                die;
            }else
            {
                echo "<div style='text-align:center;font-size:12px;color:white;background-color:red;border-radius:10px'>";
                echo "Verificati informatiile introduse<br><br>";
                echo $result;
                echo "</div>";
            }
        
    }
    $Post = new Post();
    $ERROR = "";
    $ROW = false;
    if(isset($_GET['id']))
    {
        
       $ROW = $Post->get_one_post($_GET['id']);
    }else
    {   
            $ERROR = "Nu s-a găsit nicio postare!";
    }

        
?>

<!DOCTYPE html>
<head>
    <title>MountainTrails | Postare</title>
</head>
<header>

 <?php include("Header.php");?>
</header>

<style type="text/css">
    .bar_mov {
        height: 50px;
        background-color: #8d49cc;
        color: #d9dfeb;
        border-radius: 10px;
    }
    
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
    #poza_profil{
        width: 150px;
        border-radius: 50%;
        border: solid 2px white;
    }
    #btn_meniu {
        width: 100px;
        display: inline-block;
        margin: 2px;

    }
    #friends_img {
        
        width: 75px;
        float: left;
        margin: 8px;

    }

    #bar_prieteni{

        min-height: 400px;
        margin-top: 20px;
        color: #aaa;
        padding: 8px;
        text-align: center;
        font-size: 20px;
        color: #8d49cc;
    }

    #prieteni {

            clear: both;
            font-size: 12px;
            font-weight: bold;
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
        }
        #bara_postare {

            margin-top: 20px;
            background-color: white;
            padding: 10px;
        }
        #postare {
            
            padding: 4px;
            font-size: 13px;
            display: flex;
            margin-bottom: 20px;
        }
        #comment {
            padding:10px;
            border-style: groove;
            border-radius:10px;
            background-color: #eeeeee;
        }
    
</style>

<body style="font-family: tahoma; background-color: #d0d8e4">

    <!--top bar-->
    <?php include("Header.php");?>

    <!--zona de coperta-->
    <div style="width: 800px; margin: auto; min-height: 400px;">
    
        <!--sub coperta-->
        <div style="display:flex;">

            <!--zona de postari-->
            <div style="min-height: 400px;flex: 2.5;padding: 25px;padding-right: 0px;">

                <div style="padding: 30px; ; width:650px;">
                    <?php
                    $image_class = new Image();
                    $user = new User();
                        if(is_array($ROW))
                        {
                            $ROW_USER = $user->get_user($ROW['userid']);
                            include("Postare.php");
                        }
                    ?>
                    <br style="clear:both;">
                    <div style="border: solid thin #aaa; padding: 10px; background-color: white; border-radius:10px;">

                        <form method="post" enctype="multipart/form-data">

                            <textarea name="post" placeholder="Postează un comentariu"></textarea>
                            <input type="hidden" name="parent" value="<?php echo $ROW['postid']?>">
                            <input type="file" name="file">
                            <input class="buton_postare" type="submit" value="Postează">
                            <br>
                        </form>
                    </div>
                    
                    <?php
                        $comments = $Post->get_comments($ROW['postid']);

                        if(is_array($comments))
                        {
                            foreach ($comments as $COMMENT)
                            {
                                include("comment.php");
                            }
                        }
                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>