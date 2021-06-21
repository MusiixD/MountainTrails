
<div class="postare">
<div>
        <?php

            if(file_exists($ROW_USER['profile_image']))
            {
                $corner_image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
            }
            
        ?>
        <img src="<?php echo $corner_image ?> " style="width: 100px;margin-right: 4px; height: 100px; border-radius: 50%; float:left">
    </div>
    <div style="width:100%; height:auto">
        <div style="font-weight: bold; color: #8d49cc;">
        <?php 
            echo $user_data['nume'] . " " . $user_data['prenume'];
        ?>
        </div>
        <br/><br/> 
        <div style="float:left; padding-left:10px">
            <?php echo $ROW['post'] ?>
        </div>
        

        <br/><br/>

        <?php
            if(file_exists($ROW['image']))
            {
               ?>
              <img src="<?php echo$ROW['image'] ?>" style="width:50%; margin-left:170px">
              <?php
            }
            
        ?>

        <br/><br/>

            <span style="color: #999;">

            <?php echo $ROW['date'] ?>

            </span>
    </div>
</div>