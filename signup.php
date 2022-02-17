<?php
    print_r($_POST);

    function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }

    $conn = new mysqli('localhost', 'root', '', 'robot');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    $email = $_POST['email'];
    $password = htmlspecialchars($_POST['password']);
    $passwordcheck = htmlspecialchars($_POST['passwordcheck']);

    if (isset($_POST['submit'])) {
        if ($password == '' || $passwordcheck == '' || $email == '') {
            echo "wrong";
        } else {
            $get = "SELECT * FROM accounts where email= '".$_POST['email']."'";
            $result = mysqli_query($conn, $get);
            if (!mysqli_num_rows($result)) {
                if ($password == $passwordcheck) {
                    echo "password is correct";
                    $query = "INSERT INTO accounts (email, password, vote) VALUES ('$email', '$password', '0')";
                    mysqli_query($conn, $query);
                    redirect("index.php");
                } else {
                    echo "passwords are not the same";
                }
            } else {
                echo "error";
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
    <link rel="stylesheet" href="css/styles.css">
    <title>Signup</title>
</head>
<body>
    <main class="mainpage center">
        <div class="loginscreen">
            <div class="logintext center">
                <h3 class="legofont">Signup</h3>
            </div>
            <form action="" method="POST">
                <div class="formspleksignup">
                    <div class="infoplek width100 flexwarp">
                        <div class="allinfoplek center">
                            <label class="legofont fontsize12" for="email">Email</label>
                            <input class="invulpleksignup" name="email" id="email" type="text">
                        </div>
                        <div class="allinfoplek center">
                            <label class="legofont fontsize12" for="password">Passw</label>
                            <input class="invulpleksignup" name="password" id="password" type="password">
                        </div>
                        <div class="allinfoplek center">
                            <label class="legofont fontsize12" for="password">Passw</label>
                            <input class="invulpleksignup" name="passwordcheck" id="password" type="password">
                        </div>
                        <div class="center aanmeldplek marginbuttom">
                            <input class="aanmeldbutton legofont" type="submit" name="submit" value="Signup">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>