<?php
session_start();
include_once 'src/connect.php';
include_once 'src/User.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $user1 = User::loadUserByEmail($conn, $email); //wczytuje uzytkownika na pdst maila

        $hashFromDb = $user1->getHashPass();
        if (password_verify($password, $hashFromDb)) {//sprawdza poprawnosc hasla
            $_SESSION["id"] = $user1->getId();
            $_SESSION["username"] = $user1->getUsername();
            header('Location:main.php');
            
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <title>My page title</title>

        <!-- the below three lines are a fix to get HTML5 semantic elements working in old versions of Internet Explorer-->
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        <!-- Here is our main header that is used accross all the pages of our website -->

        <header>
            <h1>Logowanie</h1>
        </header>
        <nav>
            <ul>
                <li><a href="register.php">Nie masz konta? Zarejestruj się!</a></li>
            </ul>
        </nav>
        <main>

            <form action="login.php" method="post">

                Podaj swój email: <br /> <input type="text" name="email"/> <br/>
                Podaj hasło: <br /> <input type="password" name="password"/> <br/><br/>
                <input type="submit" value="Zaloguj się" />
            </form>

        </main>

        <!-- And here is our main footer that is used across all the pages of our website -->

        <footer>
            <p>©Copyright 2017 by nobody. All rights reversed.</p>
        </footer>

    </body>
</html>