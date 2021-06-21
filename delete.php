<?php
  
    include("clase/autoload.php");
       
    $login = new Login();
    $user_data = $login->verifica_login($_SESSION['id_licenta']);
    $USER = $user_data;

    $Post = new Post();
    $ERROR = "";

    if(isset($_GET['id']))
    {
        $ROW = $Post->get_one_post($_GET['id']);
        
       if(!$ROW)
        {
            $ERROR = "Nu s-a găsit postarea";
        }
        else
        {   
            if($ROW['userid'] != $_SESSION['id_licenta']);
            {
                $ERROR = "Acces restricționat!";
            }
        }
    }

    $_SESSION['return_to'] = "Profil.php";
    if(isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "edit.php")){

        $_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];
    }
    
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $Post->delete_post($_POST['postid']);
        header("Location: Profil.php");
        die;
    }
?>

<!DOCTYPE html>
    
<head>
    <title>MT | Șterge</title>
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
        #buton_postare {

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
    
</style>
<header>
        <!--top bar-->
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

                <div style="border: groovy;border-radius:10px; padding: 10px; background-color: white;">
                <br/>
                    Ești sigur că vrei să ștergi postarea?
                    <br/><br/><br/>
                    <form method="post">
                            <?php             
                                               
                                    $user = new User();
                                    $ROW_USER = $user->get_user($ROW['userid']);
                                    include("Postare_delete.php");
                                
                            echo "<input type='hidden' name='postid' value='$ROW[postid]'>";
                            echo "<input id='buton_postare' type='submit' value='Șterge'>";
                            ?>

                    </form>
                    <br/>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>