<?php 

    include("clase/autoload.php");

	$login = new Login();
	$user_data = $login->verifica_login($_SESSION['id_licenta']);
 
	//posting starts here
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
 
		if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
		{
 
			if(1>0)
			{

				$allowed_size = (1024 * 1024) * 7;
				if($_FILES['file']['size'] < $allowed_size)
				{
					//everything is fine
					$folder = "uploads/" . $user_data['id'] . "/";

					//create folder
					if(!file_exists($folder))
					{

						mkdir($folder,0777,true);
					}

					$image = new Image();

					$filename = $folder . $image->generate_filename(15) . ".jpeg";
					move_uploaded_file($_FILES['file']['tmp_name'], $filename);

					$change = "profile";

						//check for mode
						if(isset($_GET['change']))
						{

							$change = $_GET['change'];
						}
			
					if($change == "cover")
					{
						if(file_exists($user_data['cover_image']))
						{
							unlink($user_data['cover_image']);
						}
					}else
					{
						if(file_exists($user_data['profile_image']))
						{
							unlink($user_data['profile_image']);
						}

					}

					if(file_exists($filename))
					{

						$id = $user_data['id'];

						if($change == "cover")
						{
							$query = "update users set cover_image = '$filename' where id = '$id' limit 1";
							$_POST['is_cover_image'] = 1;

						}else
						{
							$query = "update users set profile_image = '$filename' where id = '$id' limit 1";
							$_POST['is_profile_image'] = 1;

						}

						$DB = new Database();
						$DB->save($query);


						//create a post
						$post = new Post();

						$post->create_post($id, $_POST,$filename);

						header(("Location: Profil.php"));
						die;
					}


				}else
				{

					echo "<div style='text-align:center;font-size:12px;color:white;background-color:red;border-radius:10px;height:40px;'>";
            		echo "Verificati informatiile introduse<br><br>";

				}
			}else
			{

				echo "<div style='text-align:center;font-size:12px;color:white;background-color:red;border-radius:10px;height:40px;'>";
           		echo "Verificati informatiile introduse<br><br>";

			}

		}else
		{
			echo "<div style='text-align:center;font-size:12px;color:white;background-color:red;border-radius:10px;height:40px;'>";
            echo "Verificati informatiile introduse<br><br>";
		}
		
	}

?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Schimba poza | MT</title>
	</head>
<br><br>
	<style type="text/css">
    .poza_profil{
        width: 150px;
        margin-top: -200px;
        border-radius: 50%;
        border: solid 2px white;
    }
    .btn_meniu {
        width: 100px;
        display: inline-block;
        margin: 2px;

    }
    .friends_img {
        
        width: 75px;
        float: left;
        margin: 8px;

    }

    .bar_prieteni{

        background-color: white;
        min-height: 400px;
        margin-top: 20px;
        color: #aaa;
        padding: 8px;
    }

    .prieteni {

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
        .bara_postare {

            margin-top: 20px;
            background-color: white;
            padding: 10px;
        }
        .postare {
            
            padding: 4px;
            font-size: 13px;
            display: flex;
            margin-bottom: 20px;
        }
    
</style>

	<body style="font-family: tahoma; background-color: #d0d8e4;">
	
		<?php include("header.php"); ?>

		<!--cover area-->
		<div style="width: 800px;margin:auto;min-height: 400px;">
			
			 
			<!--below cover area-->
			<div style="display: flex; min-height: 500px;">	

				 
				<!--posts area-->
 				<div style="height: 600px;flex:2.5;padding: 20px;padding-right: 0px;">
 					
 					
	 				<div style="min-height:620px; border:groovy;border-radius:10px; padding: 10px;background-color: white;">
                    
                        <form method="post" enctype="multipart/form-data";">
	 						<input type="file" name="file"><br>
	 						
	 						<br>
							<div style="text-align: center;">
								<br><br>
							<?php

 								//check for mode
								if(isset($_GET['Schimbă poza']) && $_GET['Schimbă poza'] == "cover")
								{

									$change = "cover";
 	 								echo "<img src='$user_data[cover_image]' style='max-width:500px;' >";
								}else
								{
									echo "<img src='$user_data[profile_image]' style='max-width:500px;' >";
								}


	 						?>
							</div>
                            <input class="buton_postare" type="submit" value="Schimbă poza" style="float:right; width: 100px;">
	 					</div>
  					</form>

 				</div>
			</div>

		</div>

	</body>
</html>