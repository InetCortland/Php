<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'aDataAccess.php';




class DataAccessMySQLi extends aDataAccess
{



    // Simple Dataclass, It has ALL SQL and Functions for all classes.
    // It's very likely there might be a better alternative, but for right now this will do.


    private $dbConnection;
    private $result;

    // aDataAccess methods

    //Create a "leastprivilaged" user with schema privilages to SELECT,INSERT,UPDATE and CREATE
    //No Administrative Roles were given to "leastprivilaged"
    public function connectToDB()
    {
         $this->dbConnection = @new mysqli("localhost","root", "","CMS_Project");
         if (!$this->dbConnection)
         {
               die('Could not connect to the CMS Database: ' .
                        $this->dbConnection->connect_errno);
         }
    }

    public function closeDB()
    {
        $this->dbConnection->close();
    }


    // HERE IS WHERE ALL PAGE CLASS FUNCTIONS REST.


    public function selectsearchPages($search)
    {
        $searching=$search;
        $queryString="SELECT * FROM Pages WHERE PageName ='$searching' ";
        $this->result = @$this->dbConnection->query($queryString);

        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

    }


    public function fetchPage()
    {
       if(!$this->result)
       {
               die('No records in the result set: ' .
                       $this->dbConnection->error);
       }
       return $this->result->fetch_array();
    }

    public function fetchPageID($row)
    {
       return $row['PageId'];
    }

    public function fetchPageName($row)
    {
       return $row['PageName'];
    }

    public function fetchPageMenuName($row)
    {
       return $row['Menu_name'];
    }

    public function fetchPageVisible($row)
    {
        return $row['Visible'];
    }

    public function selectallPages()
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM Pages ORDER BY PageId ASC ");
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

    }

    public function selectVisiblePages()
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM Pages WHERE Visible ='1' ORDER BY PageId ASC ");
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

    }

    public function updatePage($m_Pageid,$m_PageName,$m_MenuName,$m_visible,$m_Modifiedby,$Desc)
    {
        // I like to make my strings long... as it makes it much more easy to read.. at least personally.
        $sqlStatement="Update Pages Set Menu_name='$m_MenuName', Visible='$m_visible', PageName= '$m_PageName', LastModifiedby='$m_Modifiedby', Description='$Desc'  WHERE PageId='$m_Pageid' ";

        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }

    public function insertPage($m_PageName,$m_MenuName,$m_visible,$m_Createdby, $Desc)
    {

        // INSERT INTO #TABLENAME# (#Column name# , #Column name#, #Column name# ) VALUES ('$inputvalues','$inputvalues','$inputvalues')
        $sqlStatement = "INSERT INTO Pages (Menu_name,Visible,Createdby,PageName,Description) VALUES ('$m_MenuName',$m_visible,'$m_Createdby','$m_PageName','$Desc');";


        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }

    public function deletePage($m_Pageid)
    {
        // I like to make my strings long... as it makes it much more easy to read.. at least personally.
        $sqlStatement="Delete FROM Pages WHERE PageId='$m_Pageid' ";

        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }


    //HERE IS WHERE ALL TEMPLATE CLASS FUNCTIONS REST


    public function selectgetTemplate()
    {
        $queryString="SELECT * FROM Templates WHERE Active ='1' ";
        $this->result = @$this->dbConnection->query($queryString);

        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

    }

    public function fetchTemplate()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();
    }

    public function fetchTemplateID($row)
    {
        return $row['TemplateId'];
    }

    public function fetchTemplateName($row)
    {
        return $row['Name'];
    }

    public function fetchTemplateContent($row)
    {
        return $row['Content'];
    }

    public function fetchTemplateActive($row)
    {
        return $row['Active'];
    }




    public function updateTemplate($m_TemplateId,$m_TemplateName,$desc,$m_Content,$m_Active,$m_Modifiedby)
    {
        $sqlStatement = "UPDATE Templates SET TemplateName='$m_TemplateName', Content = '$m_Content', Description = '$desc' ,Active= $m_Active, LastModifiedby = $m_Modifiedby WHERE TemplateId= '$m_TemplateId'";
        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }

    public function updatevisiblenessTemplate($m_TemplateId,$m_Active,$m_Modifiedby)
    {
        $sqlStatement = "UPDATE Templates SET Active= $m_Active, LastModifiedby = $m_Modifiedby WHERE TemplateId= $m_TemplateId ";
        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }




    public function insertTemplate($m_TemplateName, $m_Desc , $m_Content,$m_Active,$m_Createdby)
    {

        $sqlStatement = "INSERT INTO Templates ( Templatename,Description,Content,Active,Createdby )   VALUES ('$m_TemplateName','$m_Desc','$m_Content', $m_Active, $m_Createdby);";


        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }


    public function deleteTemplate($m_TemplateId)
    {
        // I like to make my strings long... as it makes it much more easy to read.. at least personally.
        $sqlStatement="Delete FROM Templates WHERE TemplateId='$m_TemplateId' ";

        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }


    // Here is where all of our Area Class Functions Rest

    public function selectallAreas()
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM Area ORDER BY Position ASC ");
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

    }

    public function fetchAreas()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();
    }

    public function fetchAreaID($row)
    {
        return $row['AreaId'];
    }

    public function fetchAreaName($row)
    {
        return $row['Name'];
    }

    public function fetchAreaAlias($row)
    {
        return $row['Alias'];
    }

    public function fetchAreaDesc($row)
    {
        return $row['Description'];
    }

    public function fetchAreaPos($row)
    {
        return $row['Position'];
    }




    public function updateArea($m_AreaId,$m_AreaName,$m_AreaAlias,$m_AreaDesc, $m_AreaPos,$m_Modifiedby)
    {
        $sqlStatement = "UPDATE Area SET AreaName='$m_AreaName', Description= '$m_AreaDesc', Position= '$m_AreaPos' , Alias= '$m_AreaAlias', LastModifiedby = '$m_Modifiedby' WHERE AreaId= '$m_AreaId' ";
        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }

    public function insertArea($m_AreaName,$m_AreaAlias,$m_AreaDesc, $m_AreaPos,$m_Createdby)
    {
        $sqlStatement = "INSERT INTO Area (AreaName,Alias,Description, Position, Createdby)
        VALUES ('$m_AreaName', '$m_AreaAlias', '$m_AreaDesc', '$m_AreaPos', '$m_Createdby' )";


        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }

    public function deleteArea($m_AreaId)
    {
        // I like to make my strings long... as it makes it much more easy to read.. at least personally.
        $sqlStatement="Delete FROM Area WHERE AreaId= $m_AreaId ";

        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }



    //Here is where all our Article Class Functions Rest

    public function selectArticles($areaId, $pageId)
    {

        $this->result = @$this->dbConnection->query("SELECT * FROM Articles WHERE AreaId = '$areaId' AND (PageId= '$pageId' OR Allpages='1') ORDER BY CreatedDate DESC ");
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

    }
    public function fetchArticles()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();
    }
    public function fetchArticleId($row)
    {
        return $row['ArticleId'];
    }
    public function fetchArticleName($row)
    {
        return $row['Name'];
    }
    public function fetchArticleTitle($row)
    {
        return $row['Title'];
    }
    public function fetchArticleDesc($row)
    {
        return $row['Description'];
    }
    public function fetchArticlePageId($row)
    {
        return $row['PageId'];
    }
    public function fetchArticleAreaId($row)
    {
        return $row['AreaId'];
    }
    public function fetchArticleContent($row)
    {
        return $row['Content'];
    }
    public function fetchArticleallPages($row)
    {
        return $row['Allpages'];
    }



    public function insertArticle($m_ArticleName,$m_ArticleTitle,$m_ArticleDesc,$m_PageId,$m_AreaId,$m_ArticleContent,$m_ArticleAllpages,$m_Createdby)
    {
        $sqlStatement = "INSERT INTO Articles (Name,Title,Description,PageId,AreaId,Content,Allpages,Createdby)
        VALUES ('$m_ArticleName', '$m_ArticleTitle', '$m_ArticleDesc',  '$m_PageId' ,  '$m_AreaId' , '$m_ArticleContent', '$m_ArticleAllpages', '$m_Createdby' )";


        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }
    public function updateArticle($m_ArticleId, $m_ArticleName,$m_ArticleTitle,$m_ArticleDesc,$m_PageId,$m_AreaId,$m_ArticleContent,$m_ArticleAllpages,$m_Modifiedby)
    {
        $sqlStatement = "UPDATE Articles SET Name='$m_ArticleName', Title= '$m_ArticleTitle', Description= '$m_ArticleDesc', PageId= '$m_PageId' , AreaId= '$m_AreaId', Content= '$m_ArticleContent',Allpages= $m_ArticleAllpages, LastModifiedby= '$m_Modifiedby' WHERE ArticleId= '$m_ArticleId' ";

        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }
    public function deleteArticle($m_ArticleId)
    {
        // I like to make my strings long... as it makes it much more easy to read.. at least personally.
        $sqlStatement="UPDATE Articles SET  PageId= null  WHERE ArticleId= '$m_ArticleId' ";

        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }


    //Here is where all our User Class Functions Rest

    // This is a select using userID if we have it

    public function selectUserbyId($ID)
    {

        $this->result = @$this->dbConnection->query("SELECT * FROM Users WHERE UserId = '$ID' ");
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

    }
    public function selectUser($username)
    {
            //WHERE User_name = '$username' "
        $this->result = @$this->dbConnection->query("SELECT * FROM Users WHERE User_name = '$username' ");
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

    }
    public function selectValidUser($username,$HashedPassword)
    {


        $this->result = @$this->dbConnection->query("SELECT * FROM Users WHERE User_name = '$username'AND Hashed_password= '$HashedPassword' ");


        $count=mysqli_num_rows($this->result);


         if($count !=1){


             return false;
         }


        else{
            return true;
        }



        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

    }
    // this is a select using UserName and Password Login
    public function selectUserbyName($username){

        $this->result = @$this->dbConnection->query("SELECT * FROM Users WHERE User_name = '$username' ");
        if(!$this->result)
        {
        die('Could not retrieve records from the CMS Database: ' .
        $this->dbConnection->error);
        }

        }
    public function fetchValid($row)
    {
        if($row['UserId'] == null){

            return true;

        }
        else{
            return false;
        }
    }
    public function fetchUser()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();
    }
    public function fetchUserID($row)
    {
        return $row['UserId'];
    }
    public function fetchUserName($row)
    {
        return $row['User_name'];
    }
    public function fetchUserFirstname($row)
    {
        return $row['FirstName'];
    }
    public function fetchUserLastname($row)
    {
        return $row['LastName'];
    }
    public function fetchUserpassword($row)
    {
        return $row['Hashed_password'];
    }
    public function fetchUserCreatedby($row)
    {
        return $row['Createdby'];
    }
    public function fetchUserCreateddate($row)
    {
        return $row['CreatedDate'];
    }
    public function fetchUserModifiedby($row)
    {
        return $row['LastModifiedby'];
    }
    public function fetchUserModifiedDate($row)
    {
        return $row['ModifiedDate'];
    }
    public function fetchUserSalt($row)
    {
        return $row['Salt'];
    }


    public function insertUser($UserName,$Firstname,$Lastname,$HashedPassword,$Salt,$Createdby)
    {
        $this->result = @$this->dbConnection->query("INSERT INTO Users (User_name, Hashed_password, Createdby,LastModifiedby, FirstName, LastName,Salt)
        VALUES ('$UserName','$HashedPassword','$Createdby','$Createdby','$Firstname','$Lastname','$Salt');");
        return $this->dbConnection->affected_rows;

    }


    public function updateUser($Userid,$UserName,$Firstname,$Lastname,$HashedPassword,$salt,$Modifiedby)
    {

        $this->result = @$this->dbConnection->query("Update Users Set User_name='$UserName', Hashed_password='$HashedPassword', FirstName = '$Firstname',LastName='$Lastname', salt= '$salt', LastModifiedby='$Modifiedby'   WHERE Userid='$Userid';");

        return $this->dbConnection->affected_rows;


    }


    // Permission Class Functions



    public function selectPermissions($UserId)
    {

        $this->result = @$this->dbConnection->query("SELECT * FROM User_Privileges WHERE UserId = '$UserId' ORDER BY LookupId ASC ");
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

    }
    public function selectcheckPermissions($UserId,$lookupid)
    {

        $this->result = @$this->dbConnection->query("SELECT * FROM User_Privileges WHERE UserId = '$UserId' AND  LookupId='$lookupid' ");
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

    }
    public function fetchPermissions()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();
    }
    public function fetchUserPermissions($row)
    {
        return $row['UserId'];
    }
    public function fetchNamePermissions($row)
    {
        return $row['LookupId'];
    }

    public function insertPermissions($Userid,$lookupid)
    {
        $this->result = @$this->dbConnection->query("INSERT INTO User_Privileges (Userid, LookupId)
        VALUES ('$Userid','$lookupid');");
        return $this->dbConnection->affected_rows;

    }

    public function updatePermissions($Userid,$lookupid)
    {

        $this->result = @$this->dbConnection->query("Update User_Privieges Set    WHERE Userid='$Userid';");

        return $this->dbConnection->affected_rows;


    }

    public function deletePermissions($Userid,$lookupid)
    {

        $this->result = @$this->dbConnection->query("DELETE FROM User_Privileges WHERE Userid='$Userid' AND Lookupid='$lookupid'    ");

        return $this->dbConnection->affected_rows;


    }


// PAGE VIEWS FOR ASSIGNMENT 2 CORTLANDS CHART

    public function fetchClicks()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();
    }

    public function fetchHomepageclicks($row)
    {
        return $row['Homepage'];
    }

    public function fetchAboutusclicks($row)
    {
        return $row['Aboutus'];
    }

    public function fetchArticlesclicks($row)
    {
        return $row['Articles'];
    }

    public function fetchMportalclicks($row)
    {
        return $row['ManagementPortal'];
    }

    public function selectClicks()
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM PageClickStats;");
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

    }

    public function updateClicks($home,$About,$Article,$Portal)
    {
        // I like to make my strings long... as it makes it much more easy to read.. at least personally.
        $sqlStatement="Update PageClickStats Set Homepage= $home , boutus= $About, Articles= $Article, ManagementPortal= $Portal WHERE idPageClickStats = 1";

        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }


// MobileVisitors FOR ASSIGNMENT 2 ArghavanS CHART

    public function fetchMobileVisits()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();
    }

    public function fetchHomepageMobileVisits($row)
    {
        return $row['Homepage'];
    }

    public function fetchAboutusMobileVisits($row)
    {
        return $row['Aboutus'];
    }

    public function fetchArticlesMobileVisits($row)
    {
        return $row['Articles'];
    }

    public function fetchMportalMobileVisits($row)
    {
        return $row['ManagementPortal'];
    }

    public function selectMobileClicks()
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM MobileVisitsStats;");
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

    }

    public function updateMobileVisits($home,$About,$Article,$Portal)
    {
        // I like to make my strings long... as it makes it much more easy to read.. at least personally.
        $sqlStatement="Update MobileVisitsStats Set Homepage= $home , Aboutus= $About, Articles= $Article, ManagementPortal= $Portal WHERE idMobileVisitsStats = 1";

        $this->result = @$this->dbConnection->query($sqlStatement);
        if(!$this->result)
        {
            die('Could not retrieve records from the CMS Database: ' .
                $this->dbConnection->error);
        }

        return $this->dbConnection->affected_rows;
    }




}

?>
