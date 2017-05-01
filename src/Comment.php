<?php

class Comment {

    private $id;
    private $userId;
    private $postId;
    private $creation_date;
    private $text;

    function __construct() {
        $this->id = -1;
        $this->userId = "";
        $this->postId = "";
        $this->creation_date = "";
        $this->text = "";
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getPostId() {
        return $this->postId;
    }

    public function getCreation_date() {
        return $this->creation_date;
    }

    public function getText() {
        return $this->text;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setPostId($postId) {
        $this->postId = $postId;
    }

    public function setCreation_date($creation_date) {
        $this->creation_date = $creation_date;
    }

    public function setText($text) {
        $this->text = $text;
    }

    static public function loadCommentById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM Comments WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedComment = new Comment();
            $loadedComment->id = $row['id'];
            $loadedComment->userId = $row['userId'];
            $loadedComment->postId = $row['postId'];
            $loadedComment->creation_date = $row['creation_date'];
            $loadedComment->text = $row['text'];

            return $loadedComment; //zwracany jest obiekt
        }
        return null;
    }

    static public function loadAllCommentsByPostId(PDO $conn, $postId) {
        $stmt = $conn->prepare('SELECT * FROM Comments WHERE postId=:postId ORDER BY creation_date DESC');
        $result = $stmt->execute(['postId' => $postId]);

        $ret = [];

        if ($result === true && $stmt->rowCount() > 0) {
//            $stmt->fetch(PDO::FETCH_ASSOC);
//zwraca tablicę z obiektami ale w sumie nie wiem czemu
            foreach ($stmt as $row) {
                $loadedComment = new Comment();
                $loadedComment->id = $row['id'];
                $loadedComment->userId = $row['userId'];
                $loadedComment->postId = $row['postId'];
                $loadedComment->creation_date = $row['creation_date'];
                $loadedComment->text = $row['text'];

                $ret[] = $loadedComment;
            }
        }
        return $ret;
    }

    public function saveToDB(PDO $conn) {
        if ($this->id == -1) {
            $stmt = $conn->prepare(
                    'INSERT INTO Comments(userId, postId, creation_date,text) VALUES (:userId, :postId, :creation_date, :text)'
            );
            $result = $stmt->execute(
                    ['userId' => $this->userId,
                        'postId' => $this->postId,
                        'creation_date' => $this->creation_date,
                        'text' => $this->text,
            ]);
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {//jeżeli id już istnieje, zaktualizuj rekord
            $stmt = $conn->prepare(
                    'UPDATE Comments SET userId=:userId, postId=:postId, creation_date=:creation_date, text=:text WHERE id=:id'
            );
            $result = $stmt->execute(
                    ['userId' => $this->userId,
                        'postId' => $this->postId,
                        'creation_date' => $this->creation_date,
                        'text' => $this->text,
                        'id' => $this->id,
            ]);
            if ($result === true) {
                return true;
            }
        }

        return false;
    }

}
