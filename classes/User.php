<?php

/*class User
{
   private $email;
   private $userName;
   private $passWord;
   //private $profileImage = "http://earthharmonyfestival.org/view/modules/imgoing/img/editor/empty-profile.jpg";


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($p_email)
    {
        if (empty($p_email)) {
            //throw new Exception('Email kan niet leeg zijn!');
        }
        $this->email = $p_email;
        if (!filter_var($p_email, FILTER_VALIDATE_EMAIL)) {
            //throw new Exception('Email is incorrect!');
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




   /* public function changeProfilePicture() {

       $conn = db::getInstance();

            $update = $conn->prepare("UPDATE users SET profileImage = :profileImage WHERE email = :email");
            $update->bindValue(':profileImage', $this->profileImage);
            $update->bindValue(':email', $this->email);
            return $update->execute();
    }



}*/

class User{
    private $email;
    private $userName;
    private $passWord;
    private $confirm;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        if (empty($email)){
            throw new Exception('Email mag niet leeg zijn!');
        }
        $this->email = $email;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email is ongeldig!');
        }
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        if (empty($userName)){
            throw new Exception('Gebruikersnaam mag niet leeg zijn!');
        }
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getPassWord()
    {
        return $this->passWord;
    }

    /**
     * @param mixed $passWord
     */
    public function setPassWord($passWord)
    {
        if (strlen($passWord)<6) {
            throw new Exception('Wachtwoord moet langer dan 6 tekens zijn!');
        }
        $this->passWord = $passWord;
    }


    public function save()
    {
        $conn = Db::getInstance();

        $options = [
            'cost'=>12,
        ];

        $statementSave = $conn -> prepare("SELECT * FROM users WHERE email = :email;");
        $statementSave->bindValue(':email', $this->email);
        $statementSave->execute();
        $statementSave->fetch(PDO::FETCH_ASSOC);
        if ($statementSave->rowCount()!== 0){
            throw new Exception('Email is reeds genomen!');
        }

        $statementSave2 = $conn -> prepare("SELECT * FROM users WHERE username = :username;");
        $statementSave2->bindValue(':username', $this->userName);
        $statementSave2->execute();
        $statementSave2->fetch(PDO::FETCH_ASSOC);
        if ($statementSave2->rowCount()!== 0){
            throw new Exception('Gebruikersnaam is reeds genomen!');
        }

        $hashpassword = passWord_hash($this->getPassWord(), PASSWORD_DEFAULT, $options);

        $statement = $conn -> prepare("INSERT INTO users (username, password, email) VALUES (:userName, :passWord, :email)");

        $statement->bindValue(':userName', $this->userName);
        $statement->bindValue(':passWord', $hashpassword);
        $statement->bindValue(':email', $this->email);

        return $statement->execute();

    }

    public function login(){
        $conn = Db::getInstance();

        $statementLogin = $conn->prepare("SELECT * FROM users WHERE username = :userName;");
        $statementLogin->bindValue(':userName', $this->userName);
        $statementLogin-> execute();

        $res = $statementLogin->fetch();
        if(passWord_verify($this->getPassWord(), $res['password'])){
            session_start();
            $_SESSION['user']=$this->getUserName();
            header("Location: home.php");
        }
        else{
            throw new Exception('Onjuiste gegevens!');
        }
    }

    public function getProfile(){
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT * FROM users WHERE username = :userName;");
        $statement->bindValue(':userName', $this->userName);
        $statement->execute();
        return $result = $statement->fetch(PDO::FETCH_ASSOC);
    }


}