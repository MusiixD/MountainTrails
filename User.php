
<div id="prieteni" style="display: inline-block; width: 230px;background-color: #eee;padding:10px; overflow:hidden;">
	<?php 

		$image = "imagini/poza1.jpg";
		
		if(file_exists($FRIEND_ROW['profile_image']))
		{
			$image = $image_class->get_thumb_profile($FRIEND_ROW['profile_image']);
		}
 

	?>
<a href="Profil.php?id=<?php echo $FRIEND_ROW['id']; ?>">
<img id="friends_img" src="<?php echo $image ?>" style="width:70px;height:70px; border-radius:50%;float:left;">
<br>
    <div style="position:relative; padding-left: 80px;font-size: 130%;">
        <?php 
				echo $FRIEND_ROW['nume'] . " " . $FRIEND_ROW['prenume']; 
				if($FRIEND_ROW['id'] == 4 )
				{
					echo "<br><div style='font-weight: bold; font-size: 16px; color: red; text-decoration: none;'> ~Administrator~</div>";
				}
			
		?>
    </div>
    
</a>
</div>