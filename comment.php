<br>
<div id="comment">

    <div>
        <?php

                $profile = new Profile();
                $COMMENT_USER_A = $profile->get_profile($COMMENT['userid']);
                $COMMENT_USER = $COMMENT_USER_A[0]; 
            
                    if(file_exists($COMMENT_USER['profile_image']))
            {
                $corner_image = $image_class->get_thumb_profile($COMMENT_USER['profile_image']);
            }
            
        ?>
        <img src="<?php echo $corner_image ?> " style="width: 100px;margin-right: 4px; height: 100px; border-radius: 50%; float:left">
    </div>
    <div style="width:100%">
        <div style="font-weight: bold; color: #8d49cc;">
        <a href="Profil.php?id=<?php echo $COMMENT_USER['id'] ?>"style="text-decoration:none; color: black;">
        <?php      

        if($COMMENT_USER['id'] == 4)
        {
            echo $COMMENT_USER['nume'] . " " . $COMMENT_USER['prenume'] . "<div style='font-weight: bold; color: red;'> ~Administrator~</div>";
        }else
            {
            echo $COMMENT_USER['nume'] . " " . $COMMENT_USER['prenume'];
            
        }
        ?>
        </a>
        </div>
        

           <span> <?php echo $COMMENT['post'] ?></span>
        
        

        <br/><br/>

        <?php
            if(file_exists($COMMENT['image']))
            {
                $post_image = $image_class->get_thumb_post($COMMENT['image']);

                echo "<img src='$post_image' style='width:100%' />";
            }
            
        ?>

        <br/><br/>
            <?php
            $likes = "";

            $likes = ($COMMENT['likes'] > 0) ? "(" . $COMMENT['likes'] . ")" : "" ;

            ?>
            <a style="text-decoration:none;" href="like.php?type=post&id=<?php echo $COMMENT['postid'] ?>">Apreciere<?php echo $likes ?></a> 

            <span style="color: #999;">

            <?php echo $COMMENT['date'] ?>

            </span>

            <span style="color: #999;float:right;">

            <?php 
            $post = new Post();

            if($USER['id'] == 4)
        {
            ?>
            <a style="text-decoration:none;" href='edit.php?id=<?php echo $COMMENT["postid"] ?>'>
            Editează
            <a/>
            |
            <a style="text-decoration:none;" href='delete.php?id=<?php echo $COMMENT["postid"] ?>' >
            Șterge
            <a/>
       <?php 
        }elseif($post->i_own_post($COMMENT['postid'], $_SESSION['id_licenta']))
            {
                ?>
                    <a style="text-decoration:none;" href='edit.php?id=<?php echo $COMMENT["postid"] ?>'>
                    Editează
                    <a/>
                    |
                    <a style="text-decoration:none;" href='delete.php?id=<?php echo $COMMENT["postid"] ?>' >
                    Șterge
                    <a/>
               <?php     
            }
            ?>
            </span>
            <?php
                
                $i_liked = false;

                if(isset($_SESSION['id_licenta']))
                {
                    $DB = new Database();
                    $sql = "select likes from likes where type = 'post' && contentid = '$COMMENT[postid]' limit 1";
                    $result = $DB->read($sql);
        
                    if(is_array($result))
                    {
                        $likes = json_decode($result[0]['likes'],true);
        
                        $user_ids = array_column($likes, "userid");
        
                        if(!in_array($_SESSION['id_licenta'], $user_ids))
                        {
                            $i_liked = true;
                        }
                    }
                }    

                if($COMMENT['likes'] > 0)
                {
                    echo "</br>";
                    echo "<a href ='Likes.php?type=post&id=$COMMENT[postid]' style='' >";

                    if($COMMENT['likes'] == 1)
                    {
                        if($i_liked == false)
                        {
                            echo "<div style='text-align=left;'>Tu apreciezi aceast comentariu.</div>";
                        }else
                            {
                                echo "<div style='text-align=left;'> O persoană apreciază comentariul tău </div>";
                            }
                    }else
                        {
                            if($i_liked == false)
                            {
                                $text = "persoane";
                                if(($COMMENT['likes'] -1 == 1))
                                {
                                    $text = "persoana";
                                }
                                echo "<div style='text-align=left;'> Tu și încă " . ($COMMENT['likes'] -1) . " ". $text ." apreciază comentariul tău </div>";
                            }else
                                {
                                    echo "<div style='text-align=left;'>" . $COMMENT['likes'] . " "."persoane apreciază comentariul tău </div>";
                                }
                            
                        }
                       echo"</a>";
                }
            ?>
    </div>
</div>
<br>