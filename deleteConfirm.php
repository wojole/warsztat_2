<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
    exit();
}
include_once 'src/connect.php';
include_once 'src/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   if(isset($_POST['delete'])){
       if($_POST['delete']=== 'yes'){

$user1 = User::loadUserById($conn, $_SESSION['id']);
           $user1->delete($conn);
           header('Location:logout.php');
           exit();
       }
       else{
           echo "Dziękujemy za pozostanie z nami!";
       }
   }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>My page title</title>
    <!-- the below three lines are a fix to get HTML5 semantic elements working in old versions of Internet Explorer-->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
</html>
<body>
<header>
    <h1><?php
        echo "{$_SESSION["email"]}:";
        ?> Potwierdź usunięcie konta.</h1>

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
    <section>

        <form method="post" action="deleteConfirm.php">
            Czy na pewno chcesz usunąć swoje konto?
            <button value="yes" name="delete">Tak</button>
            <button value="no" name="delete">Nie</button>
        </form>
    </section>
</main>
</body>
