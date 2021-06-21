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
            header("Location: Timeline.php");
            die;
        }else
        {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:red;border-radius:10px'>";
            echo "Verificati informatiile introduse<br><br>";
            echo $result;
            echo "</div>";
        }
    }

?>

<!DOCTYPE html>
    
<head>
    <title>MT | Acasă</title>
</head>

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

        }
        .postare {
            
            padding-top:10px;
            border-style: groove;
            border-radius:10px;
            background-color: #white;
        }
    
</style>
<header>
<?php include("Header.php");?>
</header>
<body style="font-family: tahoma; background-color: #d0d8e4">
    <br><br>
    <!--zona de coperta-->
    <div style="width: 800px; margin: auto; min-height: 400px;">


        <!--sub coperta-->
        <div style="display:flex;">

                <!--zona de postari-->
                <div style="min-height: 400px;flex: 2.5;padding: 25px;padding-right: 0px;">

                        <div style="border: solid thin #aaa; padding: 10px; background-color: white;border: groovy;border-radius:10px;">

                            <form method="post" enctype="multipart/form-data">

                            <textarea name="post" placeholder="Ultima drumeție?"></textarea>
                            <input type="file" name="file"><br>
                            <input class="buton_postare" type="submit" value="Postează">
                            <br>
                            </form>
                        </div>
                    
                    <!--postari-->
                    <div id="bara_postare">

                    <?php
                        
                        $DB = new Database();
                        $user_class = new User();
                        $image_class = new Image();
                        $posts = "";

                        if($_SESSION['id_licenta'] == 4)
                        {
                            $sql = "select * from posts where 1 and parent = 0 order by id desc";
                            $posts =$DB->read($sql);

                            foreach ($posts as $ROW)
                                {
                                    $user = new User();
                                    $ROW_USER = $user->get_user($ROW['userid']);

                                    include("Postare.php");                               
                                }
                        }else
                        {

                            $follower_ids = false;
                            $followers = $user_class->get_following($_SESSION['id_licenta'],"user");

                            if(is_array($followers))
                            {
                                $follower_ids = array_column($followers, "userid");
                                $follower_ids = implode("','", $follower_ids);

                            }

                                $myuserid = $_SESSION['id_licenta'];
                                $query = "select * from posts where parent = 0 and userid = '$myuserid' || userid in('". $follower_ids ."') and parent = 0 order by id desc limit 30";
                                $posts =$DB->read($query);
                            
                            
                            if(isset($posts) && $posts)
                                {
                                    foreach ($posts as $ROW)
                                    {
                                        $user = new User();
                                        $ROW_USER = $user->get_user($ROW['userid']);

                                        include("Postare.php");
                                    }
                                }else
                                    {
                                        echo "Nu există postări";
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