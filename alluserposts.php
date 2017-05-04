<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
    exit();
}
if($_SERVER['REQUEST_METHOD']=== 'GET') {
    if(isset($_GET['id'])){
        $id=trim($_GET['id']);
        $sessionId=$_SESSION['id'];

    }
}
include_once 'src/connect.php';
include_once 'src/Tweet.php';
include_once 'src/User.php';
include_once 'src/Comment.php';

$user1 = User::loadUserById($conn, $id); //nazwę użytkownika po id
$email = $user1->getEmail();
$about = $user1->getUsername();
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
    <h1><?php echo $email;?></h1>
    <h2><?php echo "O sobie: $about";?></h2>
</header>

<nav>
    <ul>
        <li><a href="main.php">Strona główna</a></li>
        <li><a href="userdetails.php">Moje konto</a></li>
        <?php if ($sessionId!==$id){
            echo "<li><a href=\"sendMessage.php?id=$id\">Wyślij wiadomość do $email</a></li>";
        } ?>
        <li><a href="logout">Wyloguj</a></li>
    </ul>
</nav>

<main>

    <!-- It contains an article -->
    <section>
        <h2>Wszystkie wpisy:</h2>
        <?php

        $tweet1=Tweet::loadAllTweetsByUserId($conn, $id);

        for ($i = 0; $i < count($tweet1); $i++) {

            $creationDate = $tweet1[$i]->getCreationDate();
            $text = $tweet1[$i]->getText();
            $tweetId=$tweet1[$i]->getId();

            $comment=Comment::loadAllCommentsByPostId($conn,$tweetId);

            $numberOfComments=count($comment);

            echo "<article> <p>$creationDate, $email: <br> $text</p> </article>";
            echo "Ilość komentarzy: $numberOfComments";
            echo " <a href=\"postdetails.php?id=$tweetId\">Szczegóły</a><br>";
        }
        ?>
    </section>


</main>

<!-- And here is our main footer that is used across all the pages of our website -->

<footer>
    <p>©Copyright 2017 by nobody. All rights reversed.</p>
</footer>

</body>
</html>