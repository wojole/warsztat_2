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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>O mnie</title>


    <!-- the below three lines are a fix to get HTML5 semantic elements working in old versions of Internet Explorer-->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
<!-- Here is our main header that is used accross all the pages of our website -->

<header>
    <h1><?php echo "{$_SESSION["email"]}:";?> Moje konto</h1>

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

<main>

    <!-- It contains an article -->
    <section>
        <h2>O mnie:</h2>
     <?php $user1 = User::loadUserById($conn, $_SESSION['id']);
     echo $user1->getUsername(); ?>
    </section>

</main>

<!-- And here is our main footer that is used across all the pages of our website -->

<footer>
    <p>©Copyright 2017 by nobody. All rights reversed.</p>
</footer>

</body>
</html>