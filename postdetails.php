<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
    exit();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = trim($_GET['id']);

        include_once 'src/connect.php';
        include_once 'src/Tweet.php';
        include_once 'src/User.php';
        include_once 'src/Comment.php';
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
        $text = $tweet1->getText();
        $creationDate = $tweet1->getCreationDate();
        $authorId = $tweet1->getUserId();
        $user1 = User::loadUserById($conn, $authorId);
        $authorName = $user1->getUsername();

        echo "<article>
                    <h2>Szczegóły wpisu:</h2>


                 <h3>Autor</h3>

                    <p>$authorName</p>


                 <h3>Treść</h3>

                    <p>$text</p>
                 <h3>Data stworzenia lub modyfikacji</h3>
                    <p>$creationDate</p>"
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

        ?>
        </article>

    </section>
</main>


<footer>
    <p>©Copyright 2017 by nobody. All rights reversed.</p>
</footer>

</body>
</html>