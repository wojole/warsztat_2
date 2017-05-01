<?php

//dodanie nowego użytkownika

//$user1=new User();
//$user1->setUsername('Pan Andrzej');
//$user1->setPassword('fdsfsdaads');
//$user1->setEmail('panan@placki.pl');
//$user1->saveToDB($conn);

//modyfikacja informacji o użytkowniku

//user1=User::loadUserById($conn, 6); //wczytuje z bazy użytkownika nr. 1 potem za pomocą seterów zmienia jego dane
//$user1->setUsername('NowyZiomeczek'); 
//$user1->setPassword('fdsfsdaadssw');
//$user1->setEmail('ziomeczek@gmail.com');
//$user1->saveToDB($conn); //zapisuje do bazy użytkownika nr. 1

//usunięcie użytkownika

//$user1=User::loadUserById($conn, 5); //wczytuje z bazy użytkownika nr. 6
//$user1->delete($conn);

//wczytanie użytkownika po emailu:

//$user1=User::loadUserByEmail($conn, $email); //funkcojnalność użyta przy weryfikacji logowania

//TWEET:
//
//dodanie nowego tweeta:
//$tweet1=new Tweet();
//$tweet1->setUserId('1');
//$tweet1->setText('mecz byl super do przerwy');
//$tweet1->setCreationDate();
//$tweet1->saveToDB($conn);
//
//
//Ładuje tweet wg Id:
//$tweet1=Tweet::loadTweetById($conn, 1); //statyczna metoda 


//modyfikacja Tweeta:

//$tweet1=Tweet::loadTweetById($conn,2); //czytuje tweet o podanym id
//$tweet1->setText('Mam na imie Andrzej!'); //ustawia potrzebne setery
//$tweet1->setCreationDate(); //aktualizuje datę
//$tweet1->saveToDB($conn); //aktualizuje wpis w bazie danych 

//Ładuje tweet wg Id:
//$tweet1=Tweet::loadTweetById($conn, 1); //statyczna metoda 

//Ładuje wszystkie tweety danego usera i wyświetla treść
//$tweet1=Tweet::loadAllTweetsByUserId($conn, 1); 
//foreach ($tweet1 as $value) { //wyświetlenie wszystkich wiad znajdujących się u danego użytkownika poprzez iterację tablicy z obiektami za pomoca foreach
//    echo $value->getText();
//    echo '<br>';
//}

//Ładuje i wyświetla wszytkie tweety znajdujące się w bazie
//$tweet1=Tweet::loadAllTweets($conn); 
//foreach ($tweet1 as $value) { 
//    echo $value->getText();
//    echo '<br>';
//}


//Comment.php
//
//Ładuje komentarz na podstawie jego Id:
//$comment1=Comment::loadCommentById($conn,1);
//
//Ładuje wszystkie komentarza dotyczące danego posta:
//$comment1=Comment::loadAllCommentsByPostId($conn,1);
//
//wczytuje dany id, modyfikuje jego element i zapisuje do bazy danych
//$comment1=Comment::loadCommentById($conn,1);
//$comment1->setText("hłehłehłe");
//$comment1->saveToDB($conn);