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

    if(isset($_SERVER['HTTP_REFERER'])){

        $return_to = $_SERVER['HTTP_REFERER'];
    }else{
        $return_to = "Profil.php";
    }

    if(isset($_GET['type']) && isset($_GET['id'])){

        if(is_numeric($_GET['id'])){
            $allowed[] = 'post';
            $allowed[] = 'user';
            $allowed[] = 'comment';

            if(in_array($_GET['type'], $allowed))
            {
                $post = new Post();
                $user_class = new User();
                $post->like_post($_GET['id'], $_GET['type'], $_SESSION['id_licenta']);
                
                
                if($_GET['type'] == "user")
                {
                    $user_class->follow_user($_GET['id'], $_GET['type'], $_SESSION['id_licenta']);
                }
            }
        }  
    }
    
    header("Location: ". $return_to);
    die;
?>