<?php
include_once 'src/connect.php';
include_once 'src/User.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2'])) {
        $login = trim($_POST['login']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $password2 = trim($_POST['password2']);

        if ($password === $password2) {//walidacja hasła
            $user1 = new User();
            $user1->setUsername($login);
            $user1->setPassword($password);
            $user1->setEmail($email);
            $user1->saveToDB($conn);

            echo "Dziękujemy za założenie konta.";
        } else {
           echo "Podane hasła nie są takie same.";
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
            <h1>Rejestracja</h1>
        </header>
        <nav>
            <ul>
                <li><a href="login.php">Przejdź do strony logowania</a></li>
            </ul>
        </nav>
        <main>

            <form action="register.php" method="post">
                Podaj nazwę użytkownika: <br /> <input type="text" name="login"/> <br/>
                Podaj swój email: <br /> <input type="text" name="email"/> <br/>
                Podaj hasło: <br /> <input type="password" name="password"/> <br/>
                Powtórz hasło: <br /> <input type="password" name="password2"/> <br/><br/>
                <input type="submit" value="Zarejestruj się!" />
            </form>

        </main>

        <!-- And here is our main footer that is used across all the pages of our website -->

        <footer>
            <p>©Copyright 2017 by nobody. All rights reversed.</p>
        </footer>

    </body>
</html>