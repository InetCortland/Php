<?php

require_once '../Data/aDataAccess.php';

class Template
{
    // This is our template class, all functions and calls ,sets and gets will live in here.



    // This simply has all of the values in that table as vars inside of the template Object.
    private $m_TemplateId;
    private $m_TemplateName;
    private $m_Content;
    private $m_Active;
    private $m_Desc="";

    private $m_Createdby;
    private $m_CreatedDate;
    private $m_Modifiedby;
    private $m_ModifiedDate;



    public function __construct()
    {

    }

    public function getID()
    {
        return ($this->m_TemplateId);
    }
    
    public function getTemplateName()
    {
        return ($this->m_TemplateName);
    }

    public function getContent()
    {
        return ($this->m_Content);
    }

    public function getTemplateActive()
    {
        return ($this->m_Active);
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
    public function setTemplateId($input){

        $this->m_TemplateId=$input;
    }

    public function setTemplateName($input){

        $this->m_TemplateName=$input;
    }

    public function setContent($input){

        $this->m_Content=$input;
    }

    public function setDesc($input){

        $this->m_Desc=$input;
    }

    public function setActive($input){

        $this->m_Active=$input;
    }


/*
    public function updateTemplate()
    {

        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();
        return $myDataAccess->updateTemplate(
            $this->getID(),
            $this->getTemplateName(),
            $this->getContent(),
            $this->getTemplateActive(),
            $this->getModifiedby(),
            $this->getDesc()
        );
    }*/

    public function insertTemplate()
    {

        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->insertTemplate($this->m_TemplateName,$this->m_Desc, $this->m_Content,$this->m_Active,$this->m_Createdby);

        return "$recordsAffected row(s) affected!";
    }



    //deletes self from database
    public function delete()//must also go through db and check templates to remove any references to self
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->deleteTemplate($this->m_TemplateId);

    	return "$recordsAffected row(s) affected!";
    }

    //updates self in database
    public function updateTemplate()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();



    	$recordsAffected = $myDataAccess->updateTemplate($this->m_TemplateId,$this->m_TemplateName,$this->m_Desc,$this->m_Content,$this->m_Active,$this->m_Modifiedby);

    	return "$recordsAffected row(s) affected!";
    }


    public function templateVisibleness()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();
        $recordsAffected = $myDataAccess->updatevisiblenessTemplate($this->m_TemplateId, $this->m_Active, $this->m_Modifiedby  );

        return "$recordsAffected row(s) affected!";
    }



















    public static function retrieveTemplate()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectgetTemplate();

        $row = $myDataAccess->fetchTemplate();

        {

            $currentTemplate = new self($myDataAccess->fetchTemplateName($row));

            $currentTemplate->m_TemplateId = $myDataAccess->fetchTemplateID($row);
            $currentTemplate->m_TemplateName = $myDataAccess->fetchTemplateName($row);
            $currentTemplate->m_Content = $myDataAccess->fetchTemplateContent($row);
            $currentTemplate->m_Active = $myDataAccess->fetchTemplateActive($row);
            $templateObject = $currentTemplate;
        }

        $myDataAccess->closeDB();


        //There should only be 1 page object to return.
        return $templateObject;
    }




}

?>
