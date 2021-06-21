<?php

class Login
{
    private $error = "";

    public function evaluate($data)
    {
        $email = addslashes($data['email']);
        $password = addslashes($data['password']);


        $query = "select * from users where email = '$email' limit 1 ";


        $DB = new Database();
        $result = $DB->read($query);
        
        if($result)
        {
            $row = $result[0];

            if($this->hashed_text($password) == $row['password'])
            {
                //creeaza o sesiune
                $_SESSION['id_licenta'] = $row['id'];

            }else
                {
                    $this->error .= "Parola este greșită!<br>";
                }
        }else
            {
                $this->error .= "Adresă de email neînregistrată!<br>";
            }
            return $this->error;

            
    }

    private function hashed_text($text)
    {
        $text =hash("sha1", $text);
        return $text;
    }

    public function verifica_login($id)
    {
        if(is_numeric($id))
        {
            $query = "select * from users where id = $id limit 1 ";

            $DB = new Database();
            $result = $DB->read($query);
            $query_userid = "update `users` set userid = $id where id = $id";
            $DB->save($query_userid);

            if($result)
            {
                $user_data = $result[0];
                return $user_data;
            }else
            {
                header("Location: Login.php");
                die;
            }
            
        }else
        {
            header("Location: Login.php");
            die;
        }
        
    }         
}
 ?>   