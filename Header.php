<?php 

$corner_image = "imagini/poza1.jpg";

if(isset($USER) && file_exists($USER['profile_image'])){

        $image_class = new Image();
        $corner_image = $image_class->get_thumb_profile($USER['profile_image']);

    }
?>

<style>
    .bar_mov{
        height: 40px;
        background-color: rgb(141, 73, 204);
        color: rgb(255, 255, 255);
        width:100%;
        padding: 4px;
        border-style: groove;
        position:fixed;
        top:0;
    }
        #search_box {
        width: 400px;
        height: 20px;
        border-radius: 5px;
        border: none;
        padding: 4px;
        font-size: 14px;
        background-image: url(imagini/poza2.png);
        background-repeat: no-repeat;
        background-position-x: right;
    }
        
</style>
<div class="bar_mov">
    <form method="get" action="search.php"> 
            <div style="width: 800px; margin:auto; font-size: 30px">

                <a href="Timeline.php" style="color: white;font-size: 25px;text-decoration: none;padding-top:0px">MountainTrails</a>
                
                &nbsp &nbsp &nbsp <input type="text" id="search_box" name="find" placeholder="Caută persoane" >
                
                
                </input>
                <a href="Profil.php">
                <img src="<?php echo $corner_image?>" style="width: 40px;height:40px;border-radius:50%;float: right;">
                </a>
                <a href="Index.php">
                <span style="font-size: 15px;float: right;margin:10px;color:white">Delogare</span>
                </a>
            </div>
        </form>
    </div>