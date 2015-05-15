<?php

require_once '../Data/aDataAccess.php';

class Page
{
    // This is our page class, all functions and calls ,sets and gets will live in here.



    // This simply has all of the values in that table as vars inside of the Page Object.
    private $m_Pageid;
    private $m_PageName;
    private $m_MenuName;
    private $m_Desc="";
    private $m_visible;
    private $m_Createdby;
    private $m_CreatedDate;
    private $m_Modifiedby;
    private $m_ModifiedDate;



        // Construct using the Pagename and Menuname of the page
    public function __construct($pageName,$MenuName)
    {
        $this->m_PageName= $pageName;
        $this->m_MenuName = $MenuName;

    }

    public function getID()
    {
        return ($this->m_Pageid);
    }

    public function getPageName()
    {
        return ($this->m_PageName);
    }

    public function getMenuName()
    {
        return ($this->m_MenuName);
    }

    public function getVisible()
    {
        return ($this->m_visible);
    }

    public function getDesc()
    {
        return ($this->m_Desc);
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
    public function setPageid($input){

        $this->m_Pageid=$input;
    }

    public function setPageName($input){

        $this->m_PageName=$input;
    }

    public function setMenuName($input){

        $this->m_MenuName=$input;
    }

    public function setvisible($input){

        $this->m_visible=$input;
    }

    public function setDesc($input){

        $this->m_Desc=$input;
    }




/*
    public function fetchPage()
    {
        return $this->m_DataAccess->updatePage(
            $this->getID(),
            $this->getPageName(),
            $this->getMenuName(),
            $this->getVisible(),
            $this->getCreatedby(),
            $this->getCreateddate(),
            $this->getModifiedby(),
            $this->getModifieddate()
        );
    }*/

    //inserts a new article into the database aa



    public function insertPage()
    {

        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->insertPage($this->m_PageName,$this->m_MenuName,$this->m_visible,$this->m_Createdby,$this->m_Modifiedby);
        return "$recordsAffected row(s) affected!";
    }

    //deletes self from database
    public function delete()
    {


        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();
        // I just made it cascade null when deleted ;)


    	$recordsAffected = $myDataAccess->deletePage($this->m_Pageid);

    	return "$recordsAffected row(s) affected!";
    }

    //updates self in database
    public function updatePage()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

    	$recordsAffected = $myDataAccess->updatePage($this->m_Pageid,$this->m_PageName,$this->m_MenuName, $this->m_visible, $this->m_Modifiedby, $this->m_Desc);

    	return "$recordsAffected row(s) affected!";
    }




    // With this we are searching the page table for what ever page was supplied for our search.
    public static function retrievePage($search)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectsearchPages($search);

        $row = $myDataAccess->fetchPage();

        {

            $currentPage = new self($myDataAccess->fetchPageName($row),$myDataAccess->fetchPageMenuName($row));

            $currentPage->m_Pageid = $myDataAccess->fetchPageID($row);
            $currentPage->m_visible = $myDataAccess->fetchPageVisible($row);

            $pageObject = $currentPage;
        }

        $myDataAccess->closeDB();


        //There should only be 1 page object to return.
        return $pageObject;
    }

    public static function retrievePages()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();



        $myDataAccess->selectallPages();

        while($row = $myDataAccess->fetchPage())
        {
            $currentPage = new self($myDataAccess->fetchPageName($row),$myDataAccess->fetchPageMenuName($row));

            $currentPage->m_Pageid = $myDataAccess->fetchPageID($row);
            $currentPage->m_visible = $myDataAccess->fetchPageVisible($row);

            $arrayOfPageObjects[] = $currentPage;
        }

        $myDataAccess->closeDB();

        return $arrayOfPageObjects;
    }

    public static function retrieveVisiblePages()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();



        $myDataAccess->selectVisiblePages();

        while($row = $myDataAccess->fetchPage())
        {
            $currentPage = new self($myDataAccess->fetchPageName($row),$myDataAccess->fetchPageMenuName($row));

            $currentPage->m_Pageid = $myDataAccess->fetchPageID($row);
            $currentPage->m_visible = $myDataAccess->fetchPageVisible($row);

            $arrayOfPageObjects[] = $currentPage;
        }

        $myDataAccess->closeDB();

        return $arrayOfPageObjects;
    }


}

?>
