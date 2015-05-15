<?php

require_once '../Data/aDataAccess.php';


class Article
{

    private $m_ArticleId;
    private $m_ArticleName;
    private $m_ArticleTitle;
    private $m_ArticleDesc;
    private $m_PageId;
    private $m_AreaId;
    private $m_ArticleContent;
    private $m_ArticleAllpages;



    private $m_Createdby;
    private $m_CreatedDate;
    private $m_Modifiedby;
    private $m_ModifiedDate;



    public function __construct()
    {

    }

    public function getID()
    {
        return ($this->m_ArticleId);
    }

    public function getArticleName()
    {
        return ($this->m_ArticleName);
    }

    public function getArticleTitle()
    {
        return ($this->m_ArticleTitle);
    }

    public function getArticleDesc()
    {
        return ($this->m_ArticleDesc);
    }

    public function getArticlePageID()
    {
        return ($this->m_PageId);
    }

    public function getArticleAreaID()
    {
        return ($this->m_AreaId);
    }

    public function getArticleContent()
    {
        return ($this->m_ArticleContent);
    }

    public function getArticleallPages()
    {
        return ($this->m_ArticleAllpages);
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

    public function setArticleId($input){

        $this->m_ArticleId=$input;
    }

    public function setArticleName($input){

        $this->m_ArticleName=$input;
    }

    public function setArticleTitle($input){

        $this->m_ArticleTitle=$input;
    }

    public function setArticleDesc($input){

        $this->m_ArticleDesc=$input;
    }

    public function setPageId($input){

        $this->m_PageId=$input;
    }
    public function setAreaId($input){

        $this->m_AreaId=$input;
    }

    public function setArticleContent($input){

        $this->m_ArticleContent=$input;
    }

    public function setArticleAllpages($input){

        $this->m_ArticleAllpages=$input;
    }


    public static function retrieveAreaArticles($areaId,$pageId)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectArticles($areaId,$pageId);

        while($row = $myDataAccess->fetchArticles())
        {
            $currentArticle = new self();

            $currentArticle->m_ArticleId = $myDataAccess->fetchArticleID($row);
            $currentArticle->m_ArticleName = $myDataAccess->fetchArticleName($row);
            $currentArticle->m_ArticleTitle = $myDataAccess->fetchArticleTitle($row);
            $currentArticle->m_ArticleDesc = $myDataAccess->fetchArticleDesc($row);
            $currentArticle->m_PageId = $myDataAccess->fetchArticlePageId($row);
            $currentArticle->m_AreaId = $myDataAccess->fetchArticleAreaId($row);
            $currentArticle->m_ArticleContent = $myDataAccess->fetchArticleContent($row);
            $currentArticle->m_ArticleAllpages = $myDataAccess->fetchArticleallPages($row);



            $arrayofArticleObjects[] = $currentArticle;
        }

        $myDataAccess->closeDB();

        if(isset($arrayofArticleObjects)){

            return $arrayofArticleObjects;

        }

        else {

            return null;
        }



    }

    //inserts a new article into the database
    public function insertArticle()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->insertArticle($this->m_ArticleName,$this->m_ArticleTitle,$this->m_ArticleDesc,$this->m_PageId,$this->m_AreaId,$this->m_ArticleContent,$this->m_ArticleAllpages,$this->m_Createdby);

        return "$recordsAffected row(s) affected!";
    }



    //deletes self from database
    public function delete()//must also go through db and check articles to remove any references to self
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

    	$recordsAffected =  $myDataAccess->deleteArticle($this->m_ArticleId);

    	return "$recordsAffected row(s) affected!";
    }

    //updates self in database
    public function updateArticle()
    {

        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

    	$recordsAffected = $myDataAccess->updateArticle($this->m_ArticleId, $this->m_ArticleName,$this->m_ArticleTitle,$this->m_ArticleDesc,$this->m_PageId,$this->m_AreaId,$this->m_ArticleContent,$this->m_ArticleAllpages,$this->m_Modifiedby);

    	return "$recordsAffected row(s) affected!";
    }



}



?>
