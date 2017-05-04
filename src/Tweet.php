<?php

class Tweet {

    private $id;
    private $userId;
    private $text;
    private $creationDate;

    function __construct() {
        $this->id = -1;
        $this->userId = ""; //czy dobrze wyzerowany?
        $this->text = "";
        $this->creationDate = "";
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getText() {
        return $this->text;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setCreationDate() {
        $date1 = new DateTime();
        $this->creationDate = $date1->format('Y-m-d H:i:s');
    }

    //metoda wczytująca tweeta po id:
    static public function loadTweetById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM Tweet WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userId = $row['userId'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creationDate'];

            return $loadedTweet; //zwraca tweet jako obiekt
        }
        return null;
    }

    static public function loadAllTweetsByUserId(PDO $conn, $userId) {

        $stmt = $conn->prepare('SELECT * FROM Tweet WHERE userId=:userId');
        $result = $stmt->execute(['userId' => $userId]);
        $ret = [];

        if ($result === true && $stmt->rowCount() > 0) {
//            $stmt->fetch(PDO::FETCH_ASSOC);
//zwraca tablicę z obiektami ale w sumie nie wiem czemu
            foreach ($stmt as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];

                $ret[] = $loadedTweet;
            }
        }
        return $ret;
    }

    static public function loadAllTweets(PDO $conn) {
        $sql = 'SELECT * FROM Tweet';
        $ret = [];

        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];

                $ret[] = $loadedTweet;
            }
        }
        return $ret;
    }

    public function saveToDB(PDO $conn) {
        if ($this->id == -1) {
            $stmt = $conn->prepare('INSERT INTO Tweet(userId,text,creationDate) VALUES (:userId, :text, :creationDate)'
            );
            $result = $stmt->execute(
                    ['userId' => $this->userId,
                        'text' => $this->text,
                        'creationDate' => $this->creationDate
                    ]);
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {
            $stmt = $conn->prepare('UPDATE Tweet SET text=:text, creationDate=:creationDate WHERE id=:id'
            );
            $result = $stmt->execute(
                    [
                        'text' => $this->text, 'creationDate' => $this->creationDate, 'id' => $this->id
            ]);
            if ($result === true) {
                return true;
            }
        }
        return false;
    }

}
