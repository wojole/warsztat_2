<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
    exit();
} else {
    echo "Udane logowanie! - Witaj {$_SESSION["username"]}!";
}
include_once 'src/connect.php';
include_once 'src/Tweet.php';
include_once 'src/User.php';
$tweet1 = Tweet::loadAllTweets($conn);
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
            <h1>Header</h1>
        </header>

        <nav>
            <ul>
                <li><a href="main.php">Strona główna</a></li>
                <li><a href="userdetails.php">Moje konto</a></li>
                <li><a href="logout.php">Wyloguj</a></li>
            </ul>
        </nav>

        <main>

            <!-- It contains an article -->
            <section>
                <h2>Wszystkie wpisy:</h2>
<?php
for ($i = 0; $i < count($tweet1); $i++) {

    $creationDate = $tweet1[$i]->getCreationDate();
    $userId = $tweet1[$i]->getUserId();
    $text = $tweet1[$i]->getText();
    $user1 = User::loadUserById($conn, $userId);
    $username = $user1->getUsername(); //podstawia nazwę użytkownika pod jego nr

    echo "<article> <p>$creationDate, $username: <br> $text</p> </article>";
}
?>
            </section>
            <section>
                <h2>Dodaj nowy wpis:</h2>
                <form>
                    <input type="text" name="addTweet">
                    <input type="submit" value="Dodaj wpis!">
                </form>
            </section>


        </main>

        <!-- And here is our main footer that is used across all the pages of our website -->

        <footer>
            <p>©Copyright 2017 by nobody. All rights reversed.</p>
        </footer>

    </body>
</html>