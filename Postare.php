<br>

<div style="padding:10px;
            border-style: groove;
            border-radius:10px;
            min-height:145px;
            background-color: white;">

    <div>
        <?php
            $corner_image = "imagini/poza1.jpg";
            if(file_exists($ROW_USER['profile_image']))
            {
                $corner_image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
            }
            
        ?>
        <img src="<?php echo $corner_image ?> " style="width: 100px;padding-right: 10px;padding-left: 10px height: 100px; border-radius: 50%; float:left;">
    </div>
    <div style="width:100%">
        <div style="font-weight: bold; color: #8d49cc;">
        <a href="Profil.php?id=<?php echo $ROW_USER['id'] ?>"style="text-decoration:none; color: black;"> 
        <?php 
            if($ROW_USER['id'] == 4)
            {
                echo $ROW_USER['nume'] . " " . $ROW_USER['prenume'] . "<div style='font-weight: bold; color: red;'> ~Administrator~</div>";
            }else
                {
                    echo $ROW_USER['nume'] . " " . $ROW_USER['prenume'] . "<div style='font-weight: bold; color: white;'> ~Administrator~</div>";
                    if($ROW['is_profile_image'])
                    {
                        echo"<span style='font-weight:normal;color: #aaa;'> si-a schimbat poza de profil!</span>";
                    }
                    if($ROW['is_cover_image'])
                    {
                        echo"<span style='font-weight:normal;color: #aaa;'> si-a schimbat poza de coperta!</span>";
                    }                               
                }
                ?>
        </a>    
        </div>

           <span> 
            <?php 
                $yourTextWithLinks = $ROW['post'];
                $text = strip_tags($yourTextWithLinks);
                                  
                $text = displayTextWithLinks($text);
                echo $text;
            ?>
           </span>
           
        <br/><br/>

        <?php
            if(file_exists($ROW['image']))
            {
                $post_image = $image_class->get_thumb_post($ROW['image']);

                echo "<img src='$post_image' style='width:100%' />";
            }
            
        ?>

        <br/><br/>
            <?php
            $likes = "";

            $likes = ($ROW['likes'] > 0) ? "(" . $ROW['likes'] . ")" : "" ;

            ?>
            <a style="text-decoration:none;padding-left:20px" href="like.php?type=post&id=<?php echo $ROW['postid'] ?>">Apreciere<?php echo $likes ?></a> 
            | 
             <a style="text-decoration:none;" href="single_post.php?id=<?php echo $ROW['postid']?>">Comentarii</a>
            <span style="color: #999;">

            <?php 
            echo $ROW['date']; 
            ?>


            </span>

            <span style="color: #999;float:right;">

            <?php 
            $post = new Post();

            if($_SESSION['id_licenta'] == 4)
            {
                ?>
                    <a style="text-decoration:none;" href='edit.php?id=<?php echo $ROW["postid"] ?>'>
                    Editează
                    <a/>
                    |
                    <a style="text-decoration:none;padding-right:10px;" href='delete.php?id=<?php echo $ROW["postid"] ?>' >
                    Șterge
                    <a/>
               <?php     
            }
            if($post->i_own_post($ROW['postid'], $_SESSION['id_licenta']) && $_SESSION['id_licenta'] != 4)
            {
                ?>
                    <a style="text-decoration:none;" href='edit.php?id=<?php echo $ROW["postid"] ?>'>
                    Editează
                    <a/>
                    |
                    <a style="text-decoration:none;padding-right:10px;" href='delete.php?id=<?php echo $ROW["postid"] ?>' >
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
                    $sql = "select likes from likes where type = 'post' && contentid = '$ROW[postid]' limit 1";
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

                if($ROW['likes'] > 0)
                {
                    echo "</br>";
                    echo "<a href ='Likes.php?type=post&id=$ROW[postid]' style='' >";
                    if($ROW['likes'] == 1)
                    {
                        if($i_liked == false)
                        {
                            echo "<div style='text-align=left;'>Tu apreciezi această postare.</div>";
                        }else
                            {
                                echo "<div style='text-align=left;'> O persoană apreciază postarea ta </div>";
                            }
                    }else
                        {
                            if($i_liked == false)
                            {
                                $text = "persoane";
                                if(($ROW['likes'] -1 == 1))
                                {
                                    $text = "persoana";
                                }
                                echo "<div style='text-align=left;'> Tu și încă " . ($ROW['likes'] -1) . " ". $text ." apreciază postarea ta </div>";
                            }else
                                {
                                    echo "<div style='text-align=left;'>" . $ROW['likes'] . " "."persoane apreciază postarea ta </div>";
                                }
                            
                        }
                       echo"</a>";
                }
            ?>
    </div>
</div>
</a>