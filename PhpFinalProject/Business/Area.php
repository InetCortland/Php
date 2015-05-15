<?php

require_once '../Data/aDataAccess.php';

class Area
{

    private $m_AreaId;
    private $m_AreaName;
    private $m_AreaAlias;
    private $m_AreaDesc;
    private $m_AreaPos;


    private $m_Createdby;
    private $m_CreatedDate;
    private $m_Modifiedby;
    private $m_ModifiedDate;



    public function __construct()
    {


    }

    public function getID()
    {
        return ($this->m_AreaId);
    }
    
    public function getAreaName()
    {
        return ($this->m_AreaName);
    }

    public function getAreaAlias()
    {
        return ($this->m_AreaAlias);
    }

    public function getAreaDesc()
    {
        return ($this->m_AreaDesc);
    }

    public function getAreaPos()
    {
        return ($this->m_AreaPos);
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


    // This can be copied on each one.
    public function setCreatedby($input){

        $this->m_Createdby=$input;
    }

    public function setModifiedby($input){

        $this->m_Modifiedby=$input;
    }

    public function setAreaid($input){

        $this->m_AreaId=$input;
    }

    public function setAreaName($input){

        $this->m_AreaName=$input;
    }

    public function setAreaAlias($input){

        $this->m_AreaAlias=$input;
    }

    public function setAreaDesc($input){

        $this->m_AreaDesc=$input;
    }

    public function setAreaPos($input){

        $this->m_AreaPos=$input;
    }



     public static function retrieveArea()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectallAreas();

        while($row = $myDataAccess->fetchAreas())
        {
            $currentArea = new self();

            $currentArea->m_AreaId = $myDataAccess->fetchAreaID($row);
            $currentArea->m_AreaName = $myDataAccess->fetchAreaName($row);
            $currentArea->m_AreaAlias = $myDataAccess->fetchAreaAlias($row);
            $currentArea->m_AreaDesc = $myDataAccess->fetchAreaDesc($row);
            $currentArea->m_AreaPos = $myDataAccess->fetchAreaPos($row);


            $arrayofAreaObjects[] = $currentArea;
        }

        $myDataAccess->closeDB();

        return $arrayofAreaObjects;
 }





/*
    public function updateArea()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        return $myDataAccess->updateArea(
            $this->getID(),
            $this->getAreaName(),
            $this->getAreaAlias(),
            $this->getAreaDesc(),
            $this->getAreaPos(),
            $this->getModifiedby()

        );
    }*/

    //inserts a new article into the database
    public function insertArea()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->insertArea($this->m_AreaName,$this->m_AreaAlias,$this->m_AreaDesc, $this->m_AreaPos,$this->m_Createdby);

        return "$recordsAffected row(s) affected!";
    }

    //deletes self from database
    public function delete()//must also go through db and check articles to remove any references to self
    {

        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->deleteArea($this->m_AreaId);

    	return "$recordsAffected row(s) affected!";
    }

    //updates self in database
    public function update()
    {

        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

    	$recordsAffected = $myDataAccess->updateArea($this->m_AreaId,$this->m_AreaName,$this->m_AreaAlias,$this->m_AreaDesc, $this->m_AreaPos,$this->m_Modifiedby);

    	return "$recordsAffected row(s) affected!";
    }


}

?>
