<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
    exit();
}
include_once 'src/connect.php';
include_once 'src/Tweet.php';
include_once 'src/User.php';
include_once 'src/Comment.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = trim($_GET['id']);

    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//odbiera dane z formularza i dodaje jako komentarz

    if (isset($_POST['postId']) && isset($_POST['newComment'])) {

        $who = $_SESSION['id'];
        $newComment = $_POST['newComment'];
        $id = $_POST['postId'];

        $comment1 = new Comment();
        $comment1->setText($newComment);
        $comment1->setPostId($id);
        $comment1->setCreation_date();
        $comment1->setUserId($who);
        $comment1->saveToDB($conn);
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

<header>
    <h1>O wpisie:</h1>
</header>

<nav>
    <ul>
        <li><a href="main.php">Strona główna</a></li>
        <li><a href="userdetails.php">Moje konto</a></li>
        <li><a href="logout.php">Wyloguj</a></li>
    </ul>

</nav>

<main>
    <section>
        <?php
        $tweet1 = Tweet::loadTweetById($conn, $id);
        //        $tweetId= $tweet1->getId();
        $text = $tweet1->getText();
        $authorId = $tweet1->getUserId();
        $user1 = User::loadUserById($conn, $authorId);
        $authorName = $user1->getEmail();

        echo "<article>
                    <h2>Szczegóły wpisu:</h2>


                 <h3>Treść</h3>

                    <p>$text</p>


                 <h3>Autor</h3>

                    <p>$authorName</p>"
        ?>

        <h3>Komentarze</h3>
        <?php
        $comments = Comment::loadAllCommentsByPostId($conn, $id);
        for ($j = 0; $j < count($comments); $j++) {

            $commentUserId = $comments[$j]->getUserId();
            $creation_date = $comments[$j]->getCreation_date();
            $commentText = $comments[$j]->getText();
            $user2 = User::loadUserById($conn, $commentUserId);
            $commentUsername = $user2->getUsername();


            echo "<p>$creation_date, $commentUsername skomentował: <br> $commentText</p>";

        }
        echo "<form action=\"postdetails.php\" method=\"post\">
            Skomentuj:<br>
            <textarea name=\"newComment\" maxlength=\"60\"></textarea>
            <button name=\"postId\" value=\"$id\" type=\"submit\">Dodaj komentarz</button>
        </form>";

        ?>

        </article>

    </section>
</main>


<footer>
    <p>©Copyright 2017 by nobody. All rights reversed.</p>
</footer>

</body>
</html>