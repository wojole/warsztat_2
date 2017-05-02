<?php

class Message
{
    private $id;
    private $sender_id;
    private $receiver_id;
    private $text;
    private $datetime;
    private $readed;


    public function __construct()
    {
        $this->id = -1;
        $this->sender_id = "";
        $this->receiver_id = "";
        $this->text = "";
        $this->datetime = "";
        $this->readed = "";

    }

    public function getId()
    {
        return $this->id;
    }


    public function getSenderId()
    {
        return $this->sender_id;
    }

    public function setSenderId($sender_id)
    {
        $this->sender_id = $sender_id;
    }

    public function getReceiverId()
    {
        return $this->receiver_id;
    }

    public function setReceiverId($receiver_id)
    {
        $this->receiver_id = $receiver_id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }

    public function setDatetime()
    {
        $date1 = new DateTime();
        $this->datetime = $date1->format('Y-m-d H:i:s');
    }

    public function getReaded()
    {
        return $this->readed;
    }

    public function setReaded($readed)
    {
        $this->readed = $readed;
    }

    static public function loadMessageById(PDO $conn, $id)
    {
        $stmt = $conn->prepare('SELECT * FROM Messages WHERE id=:id');
        $result = $stmt->execute([
            'id' => $id,
        ]);
        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedMessage = new Message();
            $loadedMessage->id = $row['id'];
            $loadedMessage->sender_id = $row['sender_id'];
            $loadedMessage->receiver_id = $row['receiver_id'];
            $loadedMessage->text = $row['text'];
            $loadedMessage->datetime = $row['datetime'];
            $loadedMessage->readed = $row['readed'];

            return $loadedMessage; //zwracany obiekt

        }
        return null;

    }

    static public function loadAllMessagesByRecieverId(PDO $conn, $receiver_id)
    {
        $stmt = $conn->prepare('SELECT * FROM Messages WHERE receiver_id=:receiver_id');
        $result = $stmt->execute([
            'receiver_id' => $receiver_id,
        ]);

        $ret = [];

        if ($result === true && $stmt->rowCount() > 0) {
            foreach ($stmt as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->sender_id = $row['sender_id'];
                $loadedMessage->receiver_id = $row['receiver_id'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->datetime = $row['datetime'];
                $loadedMessage->readed = $row['readed'];

                $ret[] = $loadedMessage;

            }
        }
        return $ret;
    }

    public function saveToDB(PDO $conn)
    {
        if ($this->id == -1) {
            $stmt = $conn->prepare(
                'INSERT INTO Messages (sender_id, receiver_id, text, datetime, readed) VALUES (:sender_id, :receiver_id, :text, :datetime, :readed)'
            );
            $result = $stmt->execute([
                'sender_id' => $this->sender_id,
                'receiver_id' => $this->receiver_id,
                'text' => $this->text,
                'datetime' => $this->datetime,
                'readed' => $this->readed,
            ]);
            if ($result!==false){
                $this->id=$conn->lastInsertId();
                return true;
            }
        }
        return false;
    }
}