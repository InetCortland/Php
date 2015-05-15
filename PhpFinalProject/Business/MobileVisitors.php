<?php
require_once '../Data/aDataAccess.php';


class MobileVisitors
{

    private $m_HomePageMobileVisits;
    private $m_AboutusPageMobileVisits;
    private $m_ArticlesPageMobileVisits;
    private $m_PortalMobileVisits;



    public function __construct()
    {
    }

    public function getHome()
    {
        return ($this->m_HomePageMobileVisits);
    }

    public function getAboutus()
    {
        return ($this->m_AboutusPageMobileVisits);
    }

    public function getArticles()
    {
        return ($this->m_ArticlesPageMobileVisits);
    }

    public function getPortal()
    {
        return ($this->m_PortalMobileVisits);
    }

    public function setHome($input){

        $this->m_HomePageMobileVisits=$input;
    }

    public function setAboutus($input){

        $this->m_AboutusPageMobileVisits=$input;
    }

    public function setArticles($input){

        $this->m_ArticlesPageMobileVisits=$input;
    }


    public static function retrieveallPageData()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectMobileClicks();

        $row = $myDataAccess-> fetchMobileVisits();



        $currentMobileVisits = new self();
        $currentMobileVisits->m_HomePageMobileVisits = $myDataAccess->fetchHomepageMobileVisits($row);
        $currentMobileVisits->m_AboutusPageMobileVisits = $myDataAccess->fetchAboutusMobileVisits($row);
        $currentMobileVisits->m_ArticlesPageMobileVisits = $myDataAccess->fetchArticlesMobileVisits($row);
        $currentMobileVisits->m_PortalMobileVisits = $myDataAccess->fetchMportalMobileVisits($row);


        $myDataAccess->closeDB();

        return $currentMobileVisits;



    }



    //inserts a new article into the database
    public function insertArea()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->insertArea($this->m_AreaName,$this->m_AreaAlias,$this->m_AreaDesc, $this->m_AreaPos,$this->m_Createdby);

        return "$recordsAffected row(s) affected!";
    }



}