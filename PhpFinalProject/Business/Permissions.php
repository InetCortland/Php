<?php

require_once '../Data/aDataAccess.php';

class Permissions
{

    private $m_Userid;
    private $m_LookupId;


    /*
    private $m_Createdby;
    private $m_CreatedDate;
    private $m_Modifiedby;
    private $m_ModifiedDate;
    */


    public function __construct()
    {

    }


    // GET FUNCTIONS

    public function getUserID()
    {
        return ($this->m_Userid);
    }

    public function getLookupId()
    {
        return ($this->m_LookupId);
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


    //SET FUNCTIONS

     public function setUserId($input){

        $this->m_Userid=$input;
    }

    public function setLookupId($input){

        $this->m_LookupId=$input;
    }

    // This can be copied on each one.
    /*
    public function setCreatedby($input){

        $this->m_Userpassword=$input;
    }

    public function setModifiedby($input){

        $this->m_setModifieddate=$input;
    }*/



    public function insertpermissions(){


        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->insertPermissions($this->m_Userid,$this->m_LookupId);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";


    }


    public function updatepermissions(){


        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->updatePermissions($this->m_Userid,$this->m_LookupId);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";


    }



    public function checkPermission(){

        $ThisUserpermission = new Permissions();


        $ThisUserpermission=$ThisUserpermission->retrievePermissionscheck($this->m_Userid ,$this->m_LookupId);

        $check=$ThisUserpermission->getLookupId();


        if(isset($check)){

            return true;
        }
        else{

            return false;

        }

    }

    public function deletePermission(){


        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->deletePermissions($this->m_Userid,$this->m_LookupId);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";


    }




    public static function retrievePermissions($userID)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectPermissions($userID);

        ;

        while($row = $myDataAccess->fetchPermissions())


        {
            $currentUserPermissions = new self();

           $currentUserPermissions->m_Userid = $myDataAccess->fetchUserPermissions($row);
           $currentUserPermissions->m_LookupId = $myDataAccess->fetchNamePermissions($row);


           $arrayofPermissionObjects[] = $currentUserPermissions;
        }

        $myDataAccess->closeDB();

        return $arrayofPermissionObjects;
    }

    public static function retrievePermissionscheck($userID,$permisson)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectcheckPermissions($userID,$permisson);

        $row = $myDataAccess->fetchPermissions();

            $currentUserPermissions = new self();

            $currentUserPermissions->m_Userid = $myDataAccess->fetchUserPermissions($row);
            $currentUserPermissions->m_LookupId = $myDataAccess->fetchNamePermissions($row);


            $permissionobject = $currentUserPermissions;


        $myDataAccess->closeDB();

        return $permissionobject;
    }




}

?>
