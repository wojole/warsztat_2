<?php
session_start();
include_once 'src/connect.php';
include_once 'src/Tweet.php';
include_once 'src/User.php';
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
            <h1>Moje konto</h1>
        </header>

        <nav>
            <ul>
                <li><a href="main.php">Strona główna</a></li>
                <li><a href="userdetails.php">Moje konto</a></li>
                <li><a href="logout">Wyloguj</a></li>
            </ul>
        </nav>

        <main>

            <!-- It contains an article -->
             <section>
                <h2>Wszystkie wpisy:</h2>
                <?php
                $id=$_SESSION['id'];
                $username=$_SESSION['username'];
                $tweet1=Tweet::loadAllTweetsByUserId($conn, $id); 
                
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


        </main>

        <!-- And here is our main footer that is used across all the pages of our website -->

        <footer>
            <p>©Copyright 2017 by nobody. All rights reversed.</p>
        </footer>

    </body>
</html>