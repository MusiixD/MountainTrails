<br>
<div style="min-height: 400px;width:100%;background-color:white;text-align: center;border: groovy;border-radius:10px;">
<div style="padding: 20px;">
    <?php

        $images_class = new Image();
        $post_class= new Post();
        $user_class= new User();

        $following = $user_class->get_following($user_data['userid'], "user");
        if(is_array($following))
        {
            foreach($following as $follower)
            {
                $FRIEND_ROW = $user_class->get_user($follower['userid']);
                include("user.php");
            }
            
        }else   
            {
                echo "Acest utilizator nu urmărește nicio persoană!";
            }
    ?>
</div>
</div>