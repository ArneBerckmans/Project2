<?php

class Post{

    private $userID;
    private $moodID;

    /**
     * @return mixed
     */
    public function getMoodID()
    {
        return $this->moodID;
    }

    /**
     * @param mixed $moodID
     */
    public function setMoodID($moodID)
    {
        $this->moodID = $moodID;
    }
    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }


    public function getMood($moodColor){
        $conn = db::getInstance();

        $statementMood = $conn->prepare("SELECT * FROM moods WHERE color = :cMood");
        $statementMood->bindParam(":cMood", $moodColor);
        $statementMood->execute();
        return $statementMood;
    }

    public function postMood($moodID, $userID){
        $conn = db::getInstance();

        $statementPost = $conn->prepare("INSERT INTO postsmoodi (userID, moodID) VALUES (:userID, :moodID)");
        $statementPost ->bindValue(':userID', $userID);
        $statementPost->bindValue(':moodID', $moodID);
        return $statementPost->execute();
    }

    public function getAll()
    {
        $conn = db::getInstance();

        //$statementFilter = $conn->prepare("SELECT * FROM postmoodi INNER JOIN moods ON postmoodi.moodID = moods.moodID INNER JOIN users ON postmoodi.userID = users.userID");
        $statementFilter = $conn->prepare("SELECT * FROM postsmoodi INNER JOIN moods ON postsmoodi.moodID = moods.moodID INNER JOIN users ON postsmoodi.userID = users.userID ORDER BY id DESC");
        $statementFilter->execute();
        //$users = $statementFilter->fetchAll();
        //$statementFilter->fetchAll();
        return $statementFilter;
    }

    public function getMoodi(){
        $conn = db::getInstance();

        $filter = $conn->prepare("SELECT * FROM postsmoodi INNER JOIN moods ON postsmoodi.moodID = moods.moodID INNER JOIN users ON postsmoodi.userID = users.userID ORDER BY id DESC");
        $filter->execute();
        return $filter;
    }
}