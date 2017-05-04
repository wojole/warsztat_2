<?php

class User {

    private $id;
    private $username;
    private $hashPass;
    private $email;

    function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->hashPass = "";
        $this->email = "";
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getHashPass() {
        return $this->hashPass;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($newPass) {

        $newHashedPassword = password_hash($newPass, PASSWORD_BCRYPT);
        $this->hashPass = $newHashedPassword;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function saveToDB(PDO $conn) {
        if ($this->id == -1) {
            $stmt = $conn->prepare(
                    'INSERT INTO Users(username, email, hash_pass) VALUES (:username, :email, :pass)'
            );
            $result = $stmt->execute(
                    ['username' => $this->username, 'email' => $this->email, 'pass' => $this->hashPass]
            );
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }else echo "Błąd!";
        } else {//jeżeli id już istnieje, zaktualizuj rekord
            $stmt = $conn->prepare(
                    'UPDATE Users SET username=:username, email=:email, hash_pass=:hash_pass WHERE id=:id'
            );
            $result = $stmt->execute(
                    ['username' => $this->username, 'email' => $this->email, 'hash_pass' => $this->hashPass, 'id' => $this->id]
            );
            if ($result === true) {
                return true;
            }
        }

        return false;
    }

//metoda wczytująca użytkownika po id:
    static public function loadUserById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM Users WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPass = $row['hash_pass'];
            $loadedUser->email = $row['email'];

            return $loadedUser; //zwracany jest obiekt
        }
        return null;
    }

//metoda wczytująca wszystkich użytkowników z bazy danych
    static public function loadAllUsers(PDO $conn) {
        $sql = "SELECT * FROM Users";
        $ret = [];

        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashPass = $row['hash_pass'];
                $loadedUser->email = $row['email'];

                $ret[] = $loadedUser;
            }
        }
        return $ret; //metoda zwraca tablicę z obiektami
    }

    public function delete(PDO $conn) {
        if ($this->id != -1) {
            $stmt = $conn->prepare('DELETE FROM Users WHERE id=:id');
            $result = $stmt->execute(['id' => $this->id]);

            if ($result === true) {
                $this->id = -1;

                return true;
            }
            return false;
        }
        return true;
    }
    
    static public function loadUserByEmail(PDO $conn, $email) {
        $stmt = $conn->prepare('SELECT * FROM Users WHERE email=:email');
        $result = $stmt->execute(['email' => $email]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPass = $row['hash_pass'];
            $loadedUser->email = $row['email'];

            return $loadedUser; //zwracany jest obiekt
        }
        return null;
    }

}
