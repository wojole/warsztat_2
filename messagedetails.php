<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['messageId'])) {
        $messageId = $_POST['messageId'];
    }

}
include_once 'src/connect.php';
include_once 'src/Tweet.php';
include_once 'src/User.php';
include_once 'src/Message.php';

$message1 = Message::loadMessageById($conn, $messageId);
$receiver = $message1->getReceiverId();

if ($receiver === $_SESSION['id']) {

    $message1->setReaded(1);
    $message1->saveToDB($conn);
}

$sender = $message1->getSenderId();
$date = $message1->getDatetime();
$text = $message1->getText();

$user1 = User::loadUserById($conn, $sender);
$senderName = $user1->getEmail();

$user2 = User::loadUserById($conn, $receiver);
$receiverName = $user2->getEmail();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Szczegóły wiadomości</title>


    <!-- the below three lines are a fix to get HTML5 semantic elements working in old versions of Internet Explorer-->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
<!-- Here is our main header that is used accross all the pages of our website -->

<header>
    <h1>Szczegóły wiadomości</h1>
</header>

<nav>
    <ul>
        <li><a href="main.php">Strona główna</a></li>
        <li><a href="userdetails.php">Moje konto</a></li>
        <li><a href="messages.php">Wiadomości</a></li>
        <li><a href="logout.php">Wyloguj</a></li>
    </ul>
</nav>

<main>

    <!-- It contains an article -->
    <section>
        <h2>Nadawca:</h2>
        <?php
        echo $senderName;
        ?>
        <h2>Odbiorca:</h2>
        <?php
        echo $receiverName;
        ?>
        <h2>Dnia:</h2>
        <?php
        echo $date;
        ?>
        <h2>Treść:</h2>
        <?php
        echo $text;
        ?>

    </section>


</main>

<!-- And here is our main footer that is used across all the pages of our website -->

<footer>
    <p>©Copyright 2017 by nobody. All rights reversed.</p>
</footer>

</body>
</html>