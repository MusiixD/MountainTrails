<br>
<div style="min-height: 400px;width:100%;background-color:white;text-align: center;">
<div style="padding: 20px;max-width:450px;display: inline-block;">
    <form method="post" enctype="multipart/form-data">

    
        <?php

            $settings_class = new Settings();
            $settings = $settings_class->get_settings($_GET['id']);

            if(is_array($settings))
            {
                echo "Despre mine:<br><br>
                    <div  id='textbox' style='height:200px; border: solid_thin_gray;text-size: 200%;'> $settings[about] </div>";
            }
    ?>
    </form>
</div>
</div>