<br>
<div style="min-height: 400px;width:100%;background-color:white;text-align: center;border: groovy;border-radius:10px;">
<div style="padding: 20px;max-width:450px;display: inline-block;">
    <form method="post" enctype="multipart/form-data">

    
        <?php

            $settings_class = new Settings();
            $settings = $settings_class->get_settings($_SESSION['id_licenta']);

            if(is_array($settings))
            {
            echo "<input type='text' id='textbox' name='nume' value='$settings[nume]' placeholder='Nume'/>";
                echo "<input type='text' id='textbox' name='prenume' value='$settings[prenume]' placeholder='Prenume'/>";

                

                echo "<select type='text' id='textbox' name='email' style='height:30px;>

                    <option>value='$settings[gen]'</option>
                    <option>Masculin</option>
                    <option>Feminin</option>
                    <option>Altul</option>
                    </select>";

                echo "<input id='textbox' name='email' value='$settings[email]'/>";    
                echo "<input type='password' id='textbox' name='password' value='$settings[password]' placeholder='Parolă'/>"; 
                echo "<input type='password' id='textbox' name='password2' value='$settings[password]' placeholder='Parolă'/>"; 

                echo "Despre mine:<br>
                    <textarea  id='textbox' style='height:200px; border: solid_thin_gray;' name='about'>$settings[about]</textarea>
                ";

                echo '<input class="buton_postare" type="submit" value="Salvează">';
                
                if(isset($_POST['delete']))
                    {
                        $query = "delete from users where userid = $id limit 1";
                        $DB = new Database();
                        $result = $DB->save($query);
                        if($result)
                        {
                            echo '<meta http-equiv="refresh" content="1; URL=index.php" />';
                        }
                    }
                    echo '<input class="buton_stergere" name = "delete" type="submit" value="Ștergere cont">';


            }
        
    ?>
    </form>
</div>
</div>