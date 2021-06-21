<?php

    class Profile 
    {
        function get_profile($id)
        {
            $DB = new Database();
            $query = "select * from users where id = $id limit 1";
            return $DB->read($query);
        }
    }
    
?>