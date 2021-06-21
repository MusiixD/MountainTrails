<?php
    
    include("clase/connect.php");
    include("clase/signup.php");

        $nume = "";
        $prenume = "";
        $gen = "";
        $email= "";
        $userid= "";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $signup = new Signup();
        $result = $signup->evaluate($_POST);
        
        
        if($result != "")
        {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:red;border-radius:10px'>";
            echo "Verificati informatiile introduse:<br><br>";
            echo $result;
            echo "</div>";
        }else
        {
            header("Location: Index.php");
            die;
        }

        $nume = $_POST['nume'];
        $prenume = $_POST['prenume'];
        $gen = $_POST['gen'];
        $email= $_POST['email'];
        

        
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
    }
    
    #bar_register {
        background-color: white;
        width: 800px;
        height: 660px;
        margin: auto;
        margin-top: 75px;
        padding: 10px;
        padding-top: 100px;
        text-align: center;
        font-weight: bold;
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
    }
</style>

<head>
    <title>MT | Înregistrare</title>
</head>

<body style="font-family: tahoma; background-color: #e9ebee;">
    <div id="bar">
        <div style=" font-size: 40px; font-weight: bold;">MountainTrails</div>
    </div>

    <div id="bar_register">
    <div style="font-size: 40px;text-shadow: 4px 3px rgb(141, 73, 204);color:#f2e6ff">Înregistrează-te pe MountainTrails</div> <br><br><br>

        <form method="post" action=" ">
        
        <input value="<?php echo $nume ?>" name="nume" type="text" id="text_login" placeholder="Nume"><br><br>
        <input value="<?php echo $prenume ?>" name="prenume" type="text" id="text_login" placeholder="Prenume"><br><br>

        <span  style="font-weight: normal;">Gen</span>
        <br>
        <select name="gen"id="text_login">
            <option> <?php echo $gen ?> </option>
            <option>Masculin</option>
            <option>Feminin</option>
            <option>Altul</option>
        </select>
        <br><br>
        <input value="<?php echo $email ?>" name="email" type="text" id="text_login" placeholder="Email"><br><br>
        <input name="password" type="password" id="text_login" placeholder="Parolă"><br><br>
        <input name="password2" type="password" id="text_login" placeholder="Rescrie Parola"><br><br>

        <input type="submit" id="btn_signup" value="Înregistrare"><br><br>
        <input type="submit" id="btn_login" value = "Logare">
        </form>
    </div>
    <br><br><br>
</body>

</html>