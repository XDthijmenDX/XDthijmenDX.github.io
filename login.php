<?php

    function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }

    print_r($_POST);

    $check = array("12345", "thijmen", "dsyau", "joran", "jochem");
    $random = rand(0, count($check) - 1);
    $string = $check[$random];

    $conn = new mysqli('localhost', 'root', '', 'robot');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    if (isset($_POST['submit'])) {
        if (!$_POST['checkbox'] == $string) {
            redirect("login.php");
        } else {
            $email = $_POST['email'];
            $password = htmlspecialchars($_POST['password']);
            $vote = 0;
            $get = "SELECT * FROM accounts where email= '".$email."' AND password='". $password. "' AND vote= '". $vote."' limit 1";
            $result = mysqli_query($conn, $get);

            if (mysqli_num_rows($result) ==  1) {
                echo $get;
                redirect("vote.php");
            } else {
                echo "hoi";
                redirect("login.php");
            }
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <title>Login</title>
</head>
<body>
    <main class="mainpage center">
        <div class="loginscreen center">
            <div class="logintext center">
                <h3 class="legofont">Login</h3>
            </div>
            <form action="" method="POST">
                <div class="formsplek">
                    <div class="infoplek width65 flexwarp">
                        <div class="allinfoplek center">
                            <label class="legofont fontsize12" for="email">Email</label>
                            <input class="invulplek" name="email" id="email" type="text">
                        </div>
                        <div class="allinfoplek center">
                            <label class="legofont fontsize12" for="password">Passw</label>
                            <input class="invulplek" name="password" id="password" type="password">
                        </div>
                    </div>
                    <div class="checkplek flexwarp">
                        <div class="allinfoplek center">
                            <input class="checktext" name="checkbox" id="" type="text">
                        </div>
                        <div class="allinfoplek center">
                            <h2 class="legofont fontsize12"> <?php
                                    echo $string;
                                ?></h2>
                        </div>
                    </div>
                </div>
                <div class="center aanmeldplek">
                    <input class="aanmeldbutton legofont" type="submit" name="submit" value="Login">
                </div>
            </form>
        </div>
    </main>
</body>
</html>