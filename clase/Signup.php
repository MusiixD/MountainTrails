<?php

class Signup 
{
    private $error = "";

    public function evaluate($data)
    {
        foreach ($data as $key => $value)
        {
            
            if(empty($value))
            {
                $this->error = $this->error . $key . " câmp obligatoriu!<br>";
            }

            if($key == "email")
            {
                    if (!preg_match("/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$value))
                    {
                        $this->error = $this->error . $key . " adresă de email invalidă!<br>";
                    }
                
            }

            if($key == "nume")
            {
                    if (is_numeric($value))
                    {
                        $this->error = $this->error . $key . " nu poate fi un număr!<br>";
                    }
                    if (strstr($value, " "))
                    {
                        $this->error = $this->error . $key . " nu poate avea spații libere!<br>";
                    }
                
            }

            if($key == "prenume")
            {
                    if (is_numeric($value))
                    {
                        $this->error = $this->error . $key . " nu poate fi un număr!<br>";

                    }
                    if (strstr($value, " "))
                    {
                        $this->error = $this->error . $key . " nu poate avea spații libere!<br>";
                    }
                
            }
        }
        if($this->error == "")
        {
            //no error
            $this->create_user($data);
            return;
        }

            return $this->error;
        
    }

    public function create_userid($data)
        {
            $length = rand(4,19);
            $number = "";
            for ($i=0; $i < $length; $i++) { 

                $new_rand = rand(0,9);

                $number = $number . $new_rand;
            }

            return $number;
        
        }

    public function create_user($data)
    {
        $userid =
        $nume = ucfirst($data['nume']);
        $prenume = ucfirst($data['prenume']);
        $gen = $data['gen'];
        $email = $data['email'];
        $password = $data['password'];

        $password = hash("sha1", $password);
        //creaza astea
        $url_address = strtolower($nume) . "." . strtolower($prenume);
        $query = "insert into users 
        (nume,prenume,gen,email,password,url_address) 
        values
        ('$nume','$prenume','$gen','$email','$password','$url_address')";

        $DB = new Database();
        $DB->save($query);
    }
    
   
    
}