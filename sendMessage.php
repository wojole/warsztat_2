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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = trim($_GET['id']);
        $sessionId = $_SESSION['id'];

        $user1 = User::loadUserById($conn, $id); //nazwę użytkownika po id
        $username = $user1->getUsername();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['message']) && isset($_POST['toWhom'])) {
        $message = trim($_POST['message']);
        $id = $_POST['toWhom'];
        $sessionId = $_SESSION['id'];
        if ($id !==$sessionId ) {


            $message1 = new Message();
            $message1->setDatetime();
            $message1->setReaded(0);
            $message1->setSenderId($sessionId);
            $message1->setReceiverId($id);
            $message1->setText($message);
            $message1->saveToDB($conn);

            $user1 = User::loadUserById($conn, $id); //nazwę użytkownika po id
            $username = $user1->getUsername();

            echo "Wiadomość została wysłana!";
        }else{
            echo "Nie możesz wysłać wiadomości do siebie.";
            die;
        }

    }

}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <title>Wyślij wiadomość</title>
</head>
<body>
<header>
    <h1>Wyślij wiadomość</h1>
</header>

<nav>
    <ul>
        <li><a href="main.php">Strona główna</a></li>
        <li><a href="userdetails.php">Moje konto</a></li>
        <li><a href="logout.php">Wyloguj</a></li>
    </ul>

    <main>
        <section>
            <h2>Wyślij wiadomość do <?php echo "$username"; ?></h2>
            <form action="sendMessage.php" method="post">
                <textarea name="message" rows="10" cols="80"></textarea>
                <?php echo "<button name=\"toWhom\" value=\"$id\" >Wyślij wiadomość</button>"; ?>
            </form>
        </section>
    </main>
</nav>
</body>
</html>
