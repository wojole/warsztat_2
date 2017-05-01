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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addTweet'])) {
        $addTweet = trim($_POST['addTweet']);
        $id = $_SESSION['id'];

        $tweet1 = new Tweet();
        $tweet1->setUserId($id);
        $tweet1->setText($addTweet);
        $tweet1->setCreationDate();
        $tweet1->saveToDB($conn);
    }
}

$tweet1 = Tweet::loadAllTweets($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Strona główna</title>


    <!-- the below three lines are a fix to get HTML5 semantic elements working in old versions of Internet Explorer-->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>

<?php
echo "Udane logowanie! - Witaj {$_SESSION["username"]}!";
?>
<header>
    <h1>Strona główna</h1>
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
        <h2>Dodaj nowy wpis:</h2>
        <form action="main.php" method="post">
            <input type="text" name="addTweet">
            <input type="submit" value="Dodaj wpis!">
        </form>
    </section>
    <section>
        <h2>Wszystkie wpisy:</h2>
        <?php
        for ($i = 0; $i < count($tweet1); $i++) {

            $creationDate = $tweet1[$i]->getCreationDate();
            $userId = $tweet1[$i]->getUserId();
            $text = $tweet1[$i]->getText();
            $user1 = User::loadUserById($conn, $userId);
            $username = $user1->getUsername(); //podstawia nazwę użytkownika pod jego nr
            $tweetId=$tweet1[$i]->getId();
            $comments=Comment::loadAllCommentsByPostId($conn,$tweetId);

            echo "<article> <p>$creationDate, $username: <br> $text</p> </article>";
            echo "<a href=\"messagedetails.php?id=$tweetId\">Szczegóły</a><br>";
            echo "Komentarze: <br>";
            for ($j=0; $j <count($comments); $j++){

                $commentUserId=$comments[$j]->getUserId();
                $creation_date=$comments[$j]->getCreation_date();
                $commentText=$comments[$j]->getText();
                $user2 = User::loadUserById($conn, $commentUserId);
                $commentUsername = $user2->getUsername();


                echo "<article><p>$creation_date, $commentUsername skomentował: <br> $commentText</p> </article>";
            }

            //tutaj dodać fora iterującego po wczytanych wcześniej $comment1=Comment::loadAllCommentsByPostId($conn,1); i generującego echo article p z info o komentarzach
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