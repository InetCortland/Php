<?php
require_once '../Data/aDataAccess.php';
class User
{
    private $m_Userid;
    private $m_UserName;
    private $m_UserFirstName;
    private $m_UserLastName;
    private $m_Userpassword;
    private $m_Userpassword2;
    private $m_Salt;
    private $m_Createdby;
    private $m_CreatedDate;
    private $m_Modifiedby;
    private $m_ModifiedDate;



    public function __construct()
    {
    }
// GET FUNCTIONS
    public function getID()
    {
        return ($this->m_Userid);
    }
    public function getUserName()
    {
        return ($this->m_UserName);
    }
    public function getUserFirstname()
    {
        return ($this->m_UserFirstName);
    }
    public function getUserLastname()
    {
        return ($this->m_UserLastName);
    }
    public function getUserpassword()
    {
        return ($this->m_Userpassword);
    }
// This can be copied for each one.
    public function getCreatedby()
    {
        return ($this->m_Createdby);
    }
    public function getCreateddate()
    {
        return ($this->m_CreatedDate);
    }
    public function getModifiedby()
    {
        return ($this->m_Modifiedby);
    }
    public function getModifieddate()
    {
        return ($this->m_ModifiedDate);
    }
    public function getSalt()
    {
        return ($this->m_Salt);
    }
//SET FUNCTIONS
    public function setUserName($input){
        $this->m_UserName=$input;
    }
    public function setFirstname($input){
        $this->m_UserFirstName=$input;
    }
    public function setLastname($input){
        $this->m_UserLastName=$input;
    }
    public function setpassword2($input){
        $this->m_Userpassword2=$input;
    }
    public function setid($input){
        $this->m_Userid=$input;
    }
    public function setPassword($input){
        $this->m_Userpassword=$input;
    }
// This can be copied on each one.
    public function setCreatedby($input){
        $this->m_Createdby=$input;
    }
    public function setModifiedby($input){
        $this->m_Modifiedby=$input;
    }
    public function insertUser(){
//SALTING AND HASHING PASSWORD
        $secondsSinceUnixEpoch = time();
// this is creating our salt Var
        $userSalt=$this->m_UserName.$secondsSinceUnixEpoch;
        $this->m_Salt=$userSalt; // set our Salt Var
        $cryptPrefix='$6$rounds=3778' . $userSalt .'$';
        $password=$this->m_Userpassword2;
        $passwordHashRaw = crypt($password,$cryptPrefix); // Created our Hashed Password Var
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();
        $recordsAffected = $myDataAccess->insertUser($this->m_UserName,$this->m_UserFirstName,$this->m_UserLastName,$passwordHashRaw,$this->m_Salt,$this->m_Createdby);
        $myDataAccess->closeDB();
        return "$recordsAffected row(s) affected!";
    }
    public function updateUser(){
//SALTING AND HASHING PASSWORD
        $secondsSinceUnixEpoch = time();
// this is creating our salt Var
        $userSalt=$this->m_UserName.$secondsSinceUnixEpoch;
        $this->m_Salt=$userSalt; // set our Salt Var
        $cryptPrefix='$6$rounds=3778' . $userSalt.'$';
        $passwordHashRaw=crypt($this->m_Userpassword2,$cryptPrefix); // Created our Hashed Password Var
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();
        $recordsAffected=$myDataAccess->updateUser($this->m_Userid,$this->m_UserName,$this->m_UserFirstName,$this->m_UserLastName,$passwordHashRaw,$this->m_Salt,$this->m_Modifiedby);
        $myDataAccess->closeDB();
        return "$recordsAffected row(s) affected! in User & Permission Table";
    }
    public static function retrieveUser($username)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();
        $myDataAccess->selectUser($username);
        $row = $myDataAccess->fetchUser();
        {
            $currentUser = new self();
            $currentUser->m_Userid = $myDataAccess->fetchUserID($row);
            $currentUser->m_UserName = $myDataAccess->fetchUserName($row);
            $currentUser->m_UserFirstName = $myDataAccess->fetchUserFirstname($row);
            $currentUser->m_UserLastName = $myDataAccess->fetchUserLastname($row);
            $currentUser->m_Userpassword = $myDataAccess->fetchUserpassword($row);
            $currentUser->m_Createdby = $myDataAccess->fetchUserCreatedby($row);
            $currentUser->m_CreatedDate = $myDataAccess->fetchUserCreateddate($row);
            $currentUser->m_Modifiedby = $myDataAccess->fetchUserModifiedby($row);
            $currentUser->m_ModifiedDate = $myDataAccess->fetchUserModifiedDate($row);
            $currentUser->m_Salt = $myDataAccess->fetchUserSalt($row);
            $UserObject = $currentUser;
        }
        $myDataAccess->closeDB();
//There should only be 1 page object to return.
        return $UserObject;
    }
    public static function retrieveValidUser($userName, $password,$type)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();
// WE NEED TO DO SALTING/CRYPTING HERE.
        $UserSalt= User::retrieveSaltfromUsername($userName);
        $saltvalue=$UserSalt->getSalt();
        if(isset($saltvalue)){
            $cryptPrefix='$6$rounds=3778' . $saltvalue .'$';
            $passwordHashRaw = crypt($password,$cryptPrefix); // Created our Hashed Password Var
        }
        else{
            return false;
        }
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();
        $check = $myDataAccess->selectValidUser($userName,$passwordHashRaw);
        if($check){
            $row = $myDataAccess->fetchUser();
            {
                $currentUser = new self();
                $currentUser->m_Userid = $myDataAccess->fetchUserID($row);
                $currentUser->m_UserName = $myDataAccess->fetchUserName($row);
                $currentUser->m_UserFirstName = $myDataAccess->fetchUserFirstname($row);
                $currentUser->m_UserLastName = $myDataAccess->fetchUserLastname($row);
                $currentUser->m_Userpassword = $myDataAccess->fetchUserpassword($row);
                $currentUser->m_Createdby = $myDataAccess->fetchUserCreatedby($row);
                $currentUser->m_CreatedDate = $myDataAccess->fetchUserCreateddate($row);
                $currentUser->m_Modifiedby = $myDataAccess->fetchUserModifiedby($row);
                $currentUser->m_ModifiedDate = $myDataAccess->fetchUserModifiedDate($row);
                $currentUser->m_Salt = $myDataAccess->fetchUserSalt($row);
                $UserObject = $currentUser;
            }
            $myDataAccess->closeDB();
//There should only be 1 page object to return.
            if($type==0){
                return true;
            }
            else{
                return $UserObject;
            }
        }
        else {
            return false;
        }
    }
    public static function retrieveUserbyId($userID)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();
        $myDataAccess->selectUserbyId($userID);
        $row = $myDataAccess->fetchUser();
        {
            $currentUser = new self();
            $currentUser->m_Userid = $myDataAccess->fetchUserID($row);
            $currentUser->m_UserName = $myDataAccess->fetchUserName($row);
            $currentUser->m_UserFirstName = $myDataAccess->fetchUserFirstname($row);
            $currentUser->m_UserLastName = $myDataAccess->fetchUserLastname($row);
            $currentUser->m_Userpassword = $myDataAccess->fetchUserpassword($row);
            $currentUser->m_Createdby = $myDataAccess->fetchUserCreatedby($row);
            $currentUser->m_CreatedDate = $myDataAccess->fetchUserCreateddate($row);
            $currentUser->m_Modifiedby = $myDataAccess->fetchUserModifiedby($row);
            $currentUser->m_ModifiedDate = $myDataAccess->fetchUserModifiedDate($row);
            $currentUser->m_Salt = $myDataAccess->fetchUserSalt($row);
            $UserObject = $currentUser;
        }
        $myDataAccess->closeDB();
//There should only be 1 page object to return.
        return $UserObject;
    }
    public static function retrieveSaltfromUsername($username){
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();
        $myDataAccess->selectUserbyName($username);
        $row = $myDataAccess->fetchUser();
        {
            $currentUser = new self();
            $currentUser->m_Salt = $myDataAccess->fetchUserSalt($row);
            $UserObject = $currentUser;
        }
        $myDataAccess->closeDB();
//There should only be 1 page object to return.
        return $UserObject;
    }
}
?>