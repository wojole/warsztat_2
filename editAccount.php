<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
    exit();
}
include_once 'src/connect.php';
include_once 'src/Tweet.php';
include_once 'src/User.php';
include_once 'src/Message.php';

$id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['about'])) {

        $about = trim($_POST['about']);

        $user1 = User::loadUserById($conn, $id);
        $user1->setUsername($about);
        $user1->saveToDB($conn);

        echo "Zmieniono informacje o sobie";
    } elseif (isset($_POST['password']) && isset($_POST['password2'])) {

        $password = trim($_POST['password']);
        $password2 = trim($_POST['password2']);

        if ($password === $password2) {//walidacja hasła

            $user1 = User::loadUserById($conn, $id);
            $user1->setPassword($password);
            $user1->saveToDB($conn);
            echo "Hasło zostało zmienione";
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

    <title>Edycja konta</title>


    <!-- the below three lines are a fix to get HTML5 semantic elements working in old versions of Internet Explorer-->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
<!-- Here is our main header that is used accross all the pages of our website -->

<header>
    <h1><?php echo "{$_SESSION["email"]}:"; ?> Moje konto</h1>

</header>

<nav>
    <ul>
        <li><a href="main.php">Strona główna</a></li>
        <li><a href="userdetails.php">Moje konto</a></li>
        <li><a href="messages.php">Wiadomości</a></li>
        <li><a href="editAccount.php">Edytuj konto</a></li>
        <li><a href="deleteConfirm.php">Usuń konto</a></li>
        <li><a href="logout.php">Wyloguj</a></li>
    </ul>
</nav>
<?php

?>
<main>

    <!-- It contains an article -->
    <section>
        <h2>Zmień informację o sobie:</h2>

        <form action="editAccount.php" method="post">
            <textarea name="about"></textarea><br/>
            <button>Edytuj</button>


        </form>

    </section>
    <section>
        <h2>Zmień hasło:</h2>
        <form action="editAccount.php" method="post">


            Podaj nowe hasło: <br/> <input type="password" name="password"/> <br/>
            Powtórz nowe hasło: <br/> <input type="password" name="password2"/> <br/><br/>
            <input type="submit" value="Zmień hasło"/>
        </form>
    </section>

</main>

<!-- And here is our main footer that is used across all the pages of our website -->

<footer>
    <p>©Copyright 2017 by nobody. All rights reversed.</p>
</footer>

</body>
</html>