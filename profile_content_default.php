
<div style="display:flex;">

            <!--lista de prieteni-->
                <div style="min-height:400px;flex:1;">

                    <div class="bar_prieteni">

                        Utilizatori Urmăririți

                        <?php
                        
                        $user_class= new User();

                        $following = $user_class->get_following($user_data['userid'], "user");
                        if(is_array($following))
                        {
                            foreach($following as $follower)
                            {
                                $FRIEND_ROW = $user_class->get_user($follower['userid']);
                                include("user.php");
                            }
                        }
                        ?>
                            
                    </div>
                
                </div>

                    <!--zona de postari-->
                    <div style="min-height: 400px;flex: 2.5;padding: 25px;padding-right: 0px;">

                        <div style="border: solid thin #aaa; padding: 10px; background-color: white;border: groovy;border-radius:10px;">

                            <form method="post" enctype="multipart/form-data">

                            <textarea name="post" placeholder="Ultima drumeție?"></textarea>
                            <input type="file" name="file">
                            <input class="buton_postare" type="submit" value="Postează">
                            <br>
                            </form>
                        </div>
                        
                        <!--postari-->
                    <div class="bara_postare">
                            
                        <?php
                        
                        
                        if($posts)
                            {
                                foreach ($posts as $ROW)
                                {
                                    $user = new User();
                                    $ROW_USER = $user->get_user($ROW['userid']);

                                    include("Postare.php");
                                }
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>