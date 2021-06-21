<?php

session_start();

    include("clase/connect.php");
    include("clase/Login.php");

        $email = "";
        $password = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $login = new Login();
        $result = $login->evaluate($_POST);
        
        if($result != "")
        {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:red;border-radius:10px'>";
            echo "Verificati informatiile introduse<br><br>";
            echo $result;
            echo "</div>";
        }else
        {
            header("Location: Profil.php");
            die;
        }

        $email = $_POST['email'];
        $password= $_POST['password'];
    }


   
?>

<html>
<style>
    #bar {
        height: 100px;
        background-color: rgb(141, 73, 204);
        color: rgb(255, 255, 255);
        padding: 4px;
        border-radius:10px;
        border-style: groove;
    }
    
    #btn_signup {
        background-color: #42b72a;
        width: 300px;
        height: 40px;
        border-radius: 4px;
        font-weight: bold;
        border: none;
        color: white;
        cursor: pointer;
    }
    
    #bar_login {
        background-color: white;
        width: 800px;
        height: 400px;
        margin: auto;
        margin-top: 75px;
        padding: 10px;
        padding-top: 70px;
        text-align: center;
        font-weight: bold;
        border: groovy;border-radius:10px;
    }
    
    #text_login {
        height: 40px;
        width: 300px;
        border-radius: 4px;
        border: solid 1px #ccc;
        padding: 4px;
        font-size: 14px;
        font-weight: bold;
    }
    
    #btn_login {
        width: 300px;
        height: 40px;
        border-radius: 4px;
        font-weight: bold;
        border: none;
        background-color: rgb(141, 73, 204);
        color: white;
        cursor: pointer;
        hover:
    }
</style>

<head>
    <title>ML | Login</title>
</head>

<body include("clase/Login.php") style="font-family: tahoma; background-color: #e9ebee;">
    <div id="bar">
        <div style=" font-size: 40px; font-weight: bold;">MountainTrails</div>
    </div>

    <div id="bar_login">
    
    <form method="post">
        <div style="font-size: 40px;text-shadow: 4px 3px rgb(141, 73, 204);color:#f2e6ff">Loghează-te pe MountainTrails</div> <br><br><br>

        <input name="email" value="<?php echo $email ?>" type="text" id="text_login" placeholder="Email"><br><br>
        <input name="password" type="password" id="text_login" placeholder="Parolă"><br><br>

        <input type="submit" id="btn_login" value="Logare"><br><br>
    </form>
    <button id="btn_signup" onclick="myFunction()">Înregistrează-te</button>
            <script>
                    function myFunction() {
                    location.replace("Signup.php")
                    }
            </script>
    </div>

</body>

</html>