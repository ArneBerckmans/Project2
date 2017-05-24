<?php

class post{

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

    public function postMood(){
        $conn = db::getInstance();

        $statementPost = $conn->prepare("INSERT INTO postsmoodi (userID, moodID) VALUES ('', :userID, :moodID)");
        $statementPost ->bindValue(':userID', $this->userID);
        $statementPost->bindValue(':moodID', $this->moodID);
        return $statementPost->execute();
    }


}