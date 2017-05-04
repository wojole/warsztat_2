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

    <title>My page title</title>


    <!-- the below three lines are a fix to get HTML5 semantic elements working in old versions of Internet Explorer-->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
<!-- Here is our main header that is used accross all the pages of our website -->

<header>
    <h1><?php echo "{$_SESSION["email"]}:"; ?> Wiadomości</h1>

</header>

<nav>
    <ul>
        <li><a href="main.php">Strona główna</a></li>
        <li><a href="userdetails.php">Moje konto</a></li>
        <li><a href="editAccount.php">Edytuj konto</a></li>
        <li><a href="deleteConfirm.php">Usuń konto</a></li>
        <li><a href="logout.php">Wyloguj</a></li>
    </ul>
</nav>

<main>

    <!-- It contains an article -->
    <section>
        <h2>Wiadomości wysłane:</h2>
        <?php
        $id = $_SESSION['id'];
        $messagesSent = Message::loadAllMessagesBySenderId($conn, $id);
        function stringCut($string){
            if(strlen($string) > 30){
                $string=mb_substr($string,0,29);
                return $string.'...';
            }
            return $string;
        }

        for ($i = 0; $i < count($messagesSent); $i++) {

            $creationDate = $messagesSent[$i]->getDatetime();
            $toWhom = $messagesSent[$i]->getReceiverId();
            $text = $messagesSent[$i]->getText();
            $shortText=stringCut($text);
            $messageId = $messagesSent[$i]->getId();
            $user1 = User::loadUserById($conn, $toWhom);
            $whomUsername = $user1->getEmail(); //podstawia nazwę użytkownika pod jego nr


            echo "<article>Do: $whomUsername, Data wysłania: $creationDate<br> $shortText <br><form action=\"messagedetails.php\" method=\"post\">
    <button type=\"submit\" name=\"messageId\" value=\"$messageId\" >Szczegóły wiadomości</button>
    </form></article><br>";

        }
        ?>
        <h2>Wiadomości otrzymane:</h2>
        <?php
        $id = $_SESSION['id'];
        $messagesReceived = Message::loadAllMessagesByRecieverId($conn, $id);

        function isReceived($readed)
        {
            if ($readed == 0) {
                return "Nieodebrane";
            } else return "Odebrane";
        }

        for ($i = 0; $i < count($messagesReceived); $i++) {

            $creationDate = $messagesReceived[$i]->getDatetime();
            $toWhom = $messagesReceived[$i]->getSenderId();
            $text = $messagesReceived[$i]->getText();
            $shortText=stringCut($text);
            $messageId = $messagesReceived[$i]->getId();
            $readed = $messagesReceived[$i]->getReaded();
            $user1 = User::loadUserById($conn, $toWhom);
            $whomUsername = $user1->getEmail(); //podstawia nazwę użytkownika pod jego nr


            echo isReceived($readed) . "<article>Od: $whomUsername, Dnia: $creationDate <br> $shortText<br><form action=\"messagedetails.php\" method=\"post\">
    <button type=\"submit\" name=\"messageId\" value=\"$messageId\" >Szczegóły wiadomości</button>
    </form></article><br>";


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