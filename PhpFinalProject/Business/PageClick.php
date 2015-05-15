<?php
require_once '../Data/aDataAccess.php';


class PageClick
{




    private $m_HomePageclicks;
    private $m_AboutusPageClicks;
    private $m_ArticlesPageClicks;
    private $m_PortalClicks;



    public function __construct()
    {
    }





    public function getHome()
    {
        return ($this->m_HomePageclicks);
    }

    public function getAboutus()
    {
        return ($this->m_AboutusPageClicks);
    }

    public function getArticles()
    {
        return ($this->m_ArticlesPageClicks);
    }

    public function getPortal()
    {
        return ($this->m_PortalClicks);
    }

    public function setHome($input){

        $this->m_HomePageclicks=$input;
    }

    public function setAboutus($input){

        $this->m_AboutusPageClicks=$input;
    }

    public function setArticles($input){

        $this->m_ArticlesPageClicks=$input;
    }


    public static function retrieveallPageData()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectClicks();

        $row = $myDataAccess-> fetchClicks();



            $currentClicks = new self();
            $currentClicks->m_HomePageclicks = $myDataAccess->fetchHomepageclicks($row);
            $currentClicks->m_AboutusPageClicks = $myDataAccess->fetchAboutusclicks($row);
            $currentClicks->m_ArticlesPageClicks = $myDataAccess->fetchArticlesclicks($row);
            $currentClicks->m_PortalClicks = $myDataAccess->fetchMportalclicks($row);


        $myDataAccess->closeDB();

        return $currentClicks;



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