<?php

class User
{
   private $email;
   private $userName;
   private $passWord;
   private $profileImage = "http://earthharmonyfestival.org/view/modules/imgoing/img/editor/empty-profile.jpg";


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($p_email){
        if(empty($p_email)){
            throw new Exception('Vul uw email in!');
        }
        $this->email = $p_email;
        if(!filter_var($p_email, FILTER_VALIDATE_EMAIL)){
            throw new Exception('Ongeldige email!');
        }
    }

    public function getUserName()
    {
        return $this -> userName;
    }

    public function setUserName($p_userName)
    {
        if (empty($p_userName))
        {
            throw new Exception('Vul uw gebruikersnaam in!');
        }
        $this->userName = $p_userName;
    }

    public function getPassWord()
    {
        return $this -> passWord;
    }

    public function setpassWord($p_passWord)
    {
        if (empty($p_passWord))
        {
            throw new Exception('Vul uw paswoord in!');
        }
        $this->passWord = $p_passWord;
    }


    public function save ()
    {
       $conn = db::getInstance();

        $options = [
            'cost'=>12,
        ];

        $check = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $check->bindValue(':email', $this->email);
        $check->execute();
        $check->fetch(PDO::FETCH_ASSOC);
        if ($check->rowCount() !== 0){
            throw new Exception('Email al genomen');
        }

        $check = $conn->prepare("SELECT * FROM users WHERE userName = :userName");
        $check->bindValue(':userName', $this->userName);
        $check->execute();
        $check->fetch(PDO::FETCH_ASSOC);
        if ($check->rowCount() !== 0){
            throw new Exception('Gebruikers naam is al gekozen');
        }

        $hashpassword = passWord_hash($this->getPassWord(),PASSWORD_DEFAULT,$options);

        $statement = $conn->prepare("INSERT INTO users (email, userName, passWord) VALUES (:email, :userName, :passWord)");

        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':userName', $this->userName);
        $statement->bindValue(':passWord', $hashpassword);
        return $statement->execute();
    }

    public function login()
    {
        $conn = db::getInstance();

        $statement = $conn->prepare("SELECT * FROM users WHERE userName = :username");
        $statement->bindValue(':username', $this->userName);
        $statement->execute();

        $res = $statement->fetch();
        if(password_verify($this->getPassWord(), $res['password'])){
            session_start();
            $_SESSION['user'] = $this->getEmail();
            header("Location: index.php");
            $_SESSION['login'] = true;
        }else{
            throw new Exception('Ongeldige gegevens');
        }

    }

    public function getProfile(){

        $conn = db::getInstance();

        $statement = $conn->prepare("SELECT * FROM users WHERE email = :email;");
        $statement->bindValue(':email', $this->email);
        $statement->execute();
        return $result = $statement->fetch(PDO::FETCH_ASSOC);
    }



    /*public function changeProfilePicture() {

        $conn = db::getInstance();

        $sql = $conn -> prepare("INSERT INTO users (profileImage) VALUES (:profileImage)");
        $sql ->bindValue(":profileImage", $this->profileImage);
        return $sql -> execute();
    }*/



}