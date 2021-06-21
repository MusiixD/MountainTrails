<?php

session_start();

if(isset($_SESSION['id_licenta']))
    {
        $_SESSION['id_licenta'] = NULL;
        unset($_SESSION['id_licenta']);
    }

header("Location: Login.php");
die;