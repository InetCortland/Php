<!DOCTYPE html>
<html>
<head>
    <?php


    // FIND OUT WHAT PAGE WE ARE ON
    // obtain/receive the current page ($currentPage)
    // using GET from the nav or if none then default page

    // FIND OUT WHAT STYLE TEMPLATE WE ARE USING
    // obtain/receive the active style/template ($currentTemplate)
    require("../Business/Page.php");
    require("../Business/Template.php");
    require("../Business/Area.php");
    require("../Business/Articles.php");
    require("../Business/User.php");
    require("../Business/Permissions.php");
         ?>
    <link rel = "stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
        selector: "textarea",
        theme: "modern",
        plugins: ["code table" ]
        });
    </script>
    <script src="js/validation.js" type="text/javascript"></script>

    <?php
        session_start();

    // Check to see if user is trying to login. If they are, update session vars/Security
    if (isset($_POST['loginsubmit'])){

        // checking valid user for 0 (IF there is a valid user or not)


        $Validuser=User::retrieveValidUser($_POST['loginusername'],$_POST['loginpassword'],0);


         if ($Validuser)

        {
            // Clearly we have results that can yield values, so we then re-do the query but return an object instead of true or false

            $Validuser=User::retrieveValidUser($_POST['loginusername'],$_POST['loginpassword'],1);
            // clear our session
            SESSION_UNSET();
            SESSION_DESTROY();
            Session_START();

            // Need to do a get permissions fetch.
            $_SESSION['user']=$Validuser->getId();
            $arrayOfPermissions = Permissions::retrievePermissions($Validuser->getId());

            foreach ($arrayOfPermissions as $Permissions)
            {

                $_SESSION['Security'.$Permissions->getLookupId()]= $Permissions->getLookupId();

            }

            Header('Location: http://localhost:8080/index.php?page=Portalpage');
            echo "Hey, you're logged in";

        }

        else{


            Header('Location: http://localhost:8080/index.php?page=Loginpage');

            die();

        }

    }


    // Logout BTN and Manaagement Shortcut Button.If the User is Logged in.
    if(isset($_SESSION['user'])){


        if(isset($_SESSION['Security2']) || isset($_SESSION['Security3']) ) { ?>


            <form Action='index.php?page=Portalpage' id='usermgt' name='usermgt' method='post'>
                <input type='submit' style='position:absolute; top:5px; right:85px ' name='navportal' id='navportal' value='Management Portal'>
            </form>

            <form Action='index.php?page=Loginpage' id='logout' name='logout' method='post'>
                <input type='submit' style='position:absolute; top:5px; right:5px ' name='logoutbtn' id='logoutbtn' value='Logout'>
            </form>

        <?php
        } else {
            ?>

            <form Action='index.php?page=Loginpage' id='logout' name='logout' method='post'>
                <input type='submit' style='position:absolute; top:5px; right:5px ' name='logoutbtn' id='logoutbtn' value='Logout'>
            </form>

        <?php }  ?>


        <?php
        if(isset($_POST['logoutbtn'])){
            session_unset();
            session_destroy();
            session_write_close();
            header('Location:http://localhost:8080/index.php?page=Loginpage');
        }
    }

    else {
        ?>
        <form Action='index.php?page=Loginpage' id='btnlogin' name='btnlogin' method='post'>
            <input class="btn btn-primary"  type='submit' style='position:absolute; top:5px; right:5px ' name='btnlogin' id='btnlogin' value='Login'>
        </form>



    <?php

    }
    // Session Check for logged in or not. It also checks the security of each page, depending on the GET Value
    if(!empty($_GET)){

        if($_GET['page']=='Portalpage' OR $_GET['page']=='UserManagement' OR $_GET['page']=='TemplateManagement' OR $_GET['page']=='AreaManagement' OR $_GET['page']=='ArticlesManagement'  OR $_GET['page']=='PagesManagement' )//Need to put other secure parts of our webpage here as well.{

            if(isset($_SESSION['user'])){


                if($_GET['page']=='Portalpage' ){
                    if (isset($_SESSION['Security2'])){
                    }
                    else{
                        Header('Location: http://localhost:8080/index.php?page=HomePage');
                        die();
                    }
                }

                // Checks to make sure User has Security 3 clearance (Admin) for the User mangement page
                if($_GET['page']=='UserManagement' ){
                    if (isset($_SESSION['Security3'])){
                    }
                    elseif (isset($_SESSION['Security2'])) {
                        Header('Location: http://localhost:8080/index.php?page=Portalpage');
                        die();

                    }

                    else{
                        Header('Location: http://localhost:8080/index.php?page=Loginpage');
                        die();
                    }
                }

                // Checks to make sure User has Security 2 (Editor) for the template managemnt page
                elseif($_GET['page']=='TemplateManagement' ){

                    if (isset($_SESSION['Security2'])){
                    }

                    elseif (isset($_SESSION['Security3'])) {
                        Header('Location: http://localhost:8080/index.php?page=Portalpage');
                        die();

                    }

                    else{
                        Header('Location: http://localhost:8080/index.php?page=Loginpage');
                        die();
                    }

                }


                elseif($_GET['page']=='AreaManagement' ){
                    if (isset($_SESSION['Security2'])){
                    }
                    elseif (isset($_SESSION['Security3'])) {
                        Header('Location: http://localhost:8080/index.php?page=Portalpage');
                        die();

                    }

                    else{
                        Header('Location: http://localhost:8080/index.php?page=Loginpage');
                        die();
                    }
                }


                elseif($_GET['page']=='ArticlesManagement' ){
                    if (isset($_SESSION['Security2'])){
                    }
                    elseif (isset($_SESSION['Security3'])) {
                        Header('Location: http://localhost:8080/index.php?page=Portalpage');
                        die();

                    }

                    else{
                        Header('Location: http://localhost:8080/index.php?page=Loginpage');
                        die();
                    }
                }


                elseif($_GET['page']=='PagesManagement' ){
                    if (isset($_SESSION['Security2'])){
                    }
                    elseif (isset($_SESSION['Security3'])) {
                        Header('Location: http://localhost:8080/index.php?page=Portalpage');
                        die();

                    }

                    else{
                        Header('Location: http://localhost:8080/index.php?page=Loginpage');
                        die();
                    }
                }



            }

            else {
                Header('Location: http://localhost:8080/index.php?page=Loginpage');
                die();

            }
    }






    /*
     *
     * USERS IF CHECKS ARE HERE.
     *
     */

     // checking if we're submiting a new user. This will run all IF statements for user.
        if (isset($_POST['usernewsubmit'])){

            $usernew = new User();
            $ThisUserpermission = new Permissions();


            if(strlen($_POST['UserNamenew'])>8 AND strlen($_POST['FirstNamenew'])>0 AND strlen($_POST['LastNamenew'])>0 AND strlen($_POST['passwordnew'])>0 AND strlen($_POST['password2new'])>0){



                //AND strlen($_POST['FirstNamenew'])>0 AND strlen($_POST['LastNamenew'])>0 AND strlen($_POST['passwordnew']>0

            $usernew->setUserName($_POST['UserNamenew']);
            $usernew->setFirstname($_POST['FirstNamenew']);
            $usernew->setLastname($_POST['LastNamenew']);
            $usernew->setpassword2($_POST['passwordnew']);

                $usersID=$_SESSION["user"];
            $usernew->setCreatedby($usersID);
            $usernew->setModifiedby($usersID);
            $results=$usernew->insertUser();
                echo $results;

            $userpermissionsearch=User::retrieveUser($_POST['UserNamenew']);


                $ThisUserpermission->setUserId($userpermissionsearch->getID());

                 if(isset($_POST['isAuthornew'])){
                    $ThisUserpermission->setLookupId(1);
                    $ThisUserpermission->insertpermissions();
                }


                 if(isset($_POST['isEditornew'])){
                    $ThisUserpermission->setLookupId(2);
                    $ThisUserpermission->insertpermissions();
                }



                if(isset($_POST['isAdminnew'])) {
                    $ThisUserpermission->setLookupId(3);
                    $ThisUserpermission->insertpermissions();
                }



            }
            else {


               // alert("Invalid Submit, Ensure Data is Entered Correctly.");
                Header('Location: http://localhost:8080/index.php?page=UserManagement');
                die();

            }


        }
         if (isset($_POST['userupdatesubmit'])){
            $useridsearch=new User();
        $usernew = new User();
        $ThisUserpermission = new Permissions();


            if(strlen($_POST['UserIDUpdate']) >0){



            $useridsearch=$useridsearch->retrieveUserbyId($_POST['UserIDUpdate']);
            $searchresults=$useridsearch->getID();

           if (isset($searchresults))  {



            $usernew->setid($_POST['UserIDUpdate']);
            $usernew->setUserName($_POST['UserNameupdate']);
            $usernew->setFirstname($_POST['FirstNameUpdate']);
            $usernew->setLastname($_POST['LastNameUpdate']);
            $usernew->setpassword2($_POST['passwordUpdate']);

            $usersID=$_SESSION["user"];
            $usernew->setModifiedby($usersID);
            $results=$usernew->updateUser();
            echo $results;


               $ThisUserpermission->setUserId($_POST['UserIDUpdate']);

               if(isset($_POST['isAuthorUpdate'])){


                   $ThisUserpermission->setLookupId(1);
                   $checkresult= $ThisUserpermission->checkPermission();

                   if($checkresult==false){
                       $ThisUserpermission->setUserId($_POST['UserIDUpdate']);
                       $ThisUserpermission->setLookupId(1);
                   $ThisUserpermission->insertpermissions();

                   }
                   else {   // do nothing...
                   }

               }
               else{

                   $ThisUserpermission->setLookupId(1);
                   $ThisUserpermission->deletePermission();

               }



               if(isset($_POST['isEditorUpdate'])){

                   $ThisUserpermission->setLookupId(2);
                   $checkresult= $ThisUserpermission->checkPermission();

                   if($checkresult==false){
                       $ThisUserpermission->setUserId($_POST['UserIDUpdate']);
                       $ThisUserpermission->setLookupId(2);
                       $ThisUserpermission->insertpermissions();

                   }
                   else {   // do nothing...
                   }

               }
               else {

                   $ThisUserpermission->setLookupId(2);
                   $ThisUserpermission->deletePermission();

               }

               if(isset($_POST['isAdminUpdate'])) {
                   $ThisUserpermission->setUserId($_POST['UserIDUpdate']);
                   $ThisUserpermission->setLookupId(3);
                   $checkresult= $ThisUserpermission->checkPermission();

                   if($checkresult==false){
                       $ThisUserpermission->setLookupId(3);
                       $ThisUserpermission->insertpermissions();

                   }
                   else {   // do nothing...
                   }

               }

               else {

                   $ThisUserpermission->setLookupId(3);
                   $ThisUserpermission->deletePermission();

               }
            }


        }
        else {
            //alert("Ensure Data is correct");
            Header('Location: http://localhost:8080/index.php?page=UserManagement');
            die();

        }


    }

    /*
     *
     * Area IF CHECKS ARE HERE.
     *
     */
    // checking if we're submiting a new user. This will run all IF statements for user.
    if (isset($_POST['submitinsertArea'])){


        if(strlen($_POST['AreaName'])>0 AND strlen($_POST['AreaAlias'])>0){


                $newarea = new Area("","");

            $newarea->setAreaName($_POST['AreaName']);
            $newarea->setAreaAlias($_POST['AreaAlias']);
            $newarea->setAreaDesc($_POST['AreaDesc']);
            $newarea->setAreaPos($_POST['AreaPos']);




            $usersID=$_SESSION["user"];
            $newarea->setCreatedby($usersID);
            $newarea->setModifiedby($usersID);

            $results=$newarea->insertArea();
            echo$results;

        }
        else {
            Header('Location: http://localhost:8080/index.php?page=AreaManagement');
            die();
        }

    }
    // This will check if Update was selected for users. If It was it will run the update.
    if (isset($_POST['submitupdateArea'])){

       if(strlen($_POST['AreaName'])>0 AND strlen($_POST['AreaAlias'] AND strlen($_POST['AreaId']))>0 ){

            $newarea = new Area("","");

            $newarea->setAreaName($_POST['AreaName']);
            $newarea->setAreaAlias($_POST['AreaAlias']);
            $newarea->setAreaDesc($_POST['AreaDesc']);
            $newarea->setAreaPos($_POST['AreaPos']);
            $newarea->setAreaid($_POST['AreaId']);
            $usersID=$_SESSION["user"];
                   $newarea->setCreatedby($usersID);
            $newarea->setModifiedby($usersID);
            $results=$newarea->update();

            echo$results;

        }
        else {
            Header('Location: http://localhost:8080/index.php?page=AreaManagement');
            die();

        }


    }

    if (isset($_POST['submitdeletearea'])){


        if(strlen($_POST['AreaId'])>0 ){


            $newarea = new Area("","");

            $newarea->setAreaid($_POST['AreaId']);


            $results=$newarea->delete();



            echo$results;


        }


    }
    /*
     *
     * Templates IF CHECKS ARE HERE.
     *
     */

    if (isset($_POST['TemplateInsert'])){

    if(strlen($_POST['Templatename'])>0 AND strlen($_POST['TemplateContents'])>0 ){




                $newTemplate = new Template();

                $newTemplate->setTemplateName($_POST['Templatename']);
                $newTemplate->setDesc($_POST['TemplateDesc']);
                $newTemplate->setContent($_POST['TemplateContents']);

                $usersID=$_SESSION["user"];
                $newTemplate->setCreatedby($usersID);
                $newTemplate->setModifiedby($usersID);


                if(isset($_POST['TemplateVisible'])){
                    $newTemplate->setActive(1);

                }
                else {

                    $newTemplate->setActive(0);
                }


                $results=$newTemplate->insertTemplate();
                echo$results;

            }

            else {
                header('Location:http://localhost:8080/index.php?page=TemplateManagement');


            }



    }

    if (isset($_POST['templateUpdate'])){


        if(strlen($_POST['Templateid'])>0){
            $newTemplate = new Template();

            $newTemplate->setTemplateId($_POST['Templateid']);
            $newTemplate->setTemplateName($_POST['Templatename']);
            $newTemplate->setDesc($_POST['TemplateDesc']);
            $newTemplate->setContent($_POST['TemplateContents']);

            $usersID=$_SESSION["user"];
            $newTemplate->setCreatedby($usersID);
            $newTemplate->setModifiedby($usersID);


                if(isset($_POST['TemplateVisible'])){
                    $newTemplate->setActive(1);

                }
                else {

                    $newTemplate->setActive(0);
                }


            $results=$newTemplate->updateTemplate();
            echo$results;

        }

        else {
            header('Location:http://localhost:8080/index.php?page=TemplateManagement');

        }


    }

    if (isset($_POST['templateDelete'])){



        if(strlen($_POST['Templateid'])>0){
            $newTemplate = new Template();

            $newTemplate->setTemplateId($_POST['Templateid']);

            $results=$newTemplate->delete();
            echo$results;

        }

        else {
            header('Location:http://localhost:8080/index.php?page=TemplateManagement');


        }


    }

    if (isset($_POST['templateVisbileness'])){

        if(strlen($_POST['Templateid'])>0){
            $newTemplate = new Template();

            $newTemplate->setTemplateId($_POST['Templateid']);
            $usersID=$_SESSION["user"];
            $newTemplate->setModifiedby($usersID);


            if(isset($_POST['TemplateVisible'])){
                $newTemplate->setActive(1);

            }
            else {

                $newTemplate->setActive(0);
            }



            $results=$newTemplate->templateVisibleness();
            echo$results;

        }

        else {
            header('Location:http://localhost:8080/index.php?page=TemplateManagement');


        }


    }

    /*
     *
     * Article IF CHECKS ARE HERE.
     *
     */

    if (isset($_POST['ArticleInsert'])){
if(  strlen($_POST['ArticlePageId'])>0 AND strlen($_POST['ArticleAreaId'])>0 AND strlen($_POST['ArticleDesc'])>0 AND strlen($_POST['ArticleContents'])>0)  {


            $articlenew = new Article();


            $articlenew->setPageId($_POST['ArticlePageId']);
            $articlenew->setAreaId($_POST['ArticleAreaId']);
            $articlenew->setArticleTitle($_POST['ArticleTitle']);
            $articlenew->setArticleName($_POST['Articlename']);
            $articlenew->setArticleDesc($_POST['ArticleDesc']);
            $articlenew->setArticleContent($_POST['ArticleContents']);
            $userID=$_SESSION["user"]; // Takes Session Var (Userid) so we can put into class for CreatedBy and ModifiedBy
            $articlenew->setCreatedby($userID);
            $articlenew->setModifiedby($userID);
            // All Values should be set, time to run InsertArticle function.

            if(isset($_POST['ArticleVisible'])){
                $articlenew->setArticleAllpages(1);

            }
            else {

                $articlenew->setArticleAllpages(0);
            }


            $results=$articlenew->insertArticle();
            echo $results;

        }


        else {
            Header('Location: http://localhost:8080/index.php?page=ArticlesManagement');
            die();

        }

    }

    if (isset($_POST['ArticleUpdate'])){

        if(  strlen($_POST['ArticlePageId'])>0 AND strlen($_POST['ArticleAreaId'])>0 AND strlen($_POST['ArticleDesc'])>0 AND strlen($_POST['ArticleContents'])>0)  {

            $articlenew = new Article();


            $articlenew->setArticleId($_POST['ArticleId']);
            $articlenew->setPageId($_POST['ArticlePageId']);
            $articlenew->setAreaId($_POST['ArticleAreaId']);
            $articlenew->setArticleTitle($_POST['ArticleTitle']);
            $articlenew->setArticleName($_POST['Articlename']);
            $articlenew->setArticleDesc($_POST['ArticleDesc']);
            $articlenew->setArticleContent($_POST['ArticleContents']);
            $userID=$_SESSION["user"]; // Takes Session Var (Userid) so we can put into class for CreatedBy and ModifiedBy
            $articlenew->setCreatedby($userID);
            $articlenew->setModifiedby($userID);
            // All Values should be set, time to run InsertArticle function.

            if(isset($_POST['ArticleVisible'])){
                $articlenew->setArticleAllpages(1);

            }
            else {

                $articlenew->setArticleAllpages(0);
            }


            $results=$articlenew->updateArticle();
            echo $results;

        }


        else {
            Header('Location: http://localhost:8080/index.php?page=ArticlesManagement');
            die();

        }




    }

    if (isset($_POST['ArticleDelete'])){
        if(  strlen($_POST['ArticleId'])>0 )  {

            $articlenew = new Article();


            $articlenew->setArticleId($_POST['ArticleId']);

            $userID=$_SESSION["user"]; // Takes Session Var (Userid) so we can put into class for CreatedBy and ModifiedBy
            $articlenew->setCreatedby($userID);
            $articlenew->setModifiedby($userID);
            // All Values should be set, time to run InsertArticle function.

            $results=$articlenew->delete();
            echo $results;

        }


        else {
            Header('Location: http://localhost:8080/index.php?page=ArticlesManagement');
            die();

        }
    }
    /*
     *
     * Pages IF CHECKS ARE HERE.
     *
     */
    // checking if we're submiting a new user. This will run all IF statements for user.
    if (isset($_POST['submitinsertPage'])){

   if(strlen($_POST['menuname'])>0 AND strlen($_POST['pagename'])>0 ){


            $newpage = new Page("","");

            $newpage->setMenuName($_POST['menuname']);
            $newpage->setPageName($_POST['pagename']);
            $newpage->setDesc($_POST['pageDesc']);


            if(isset($_POST['isVisible'])){
               $newpage->setvisible(1);
            }
            else {
                $newpage->setvisible(0);
            }


            $usersID=$_SESSION["user"];
            $newpage->setCreatedby($usersID);
            $newpage->setModifiedby($usersID);

            $results=$newpage->insertPage();
            echo$results;

        }
        else {
            Header('Location: http://localhost:8080/index.php?page=PagesManagement');
            die();

        }


    }
    // This will check if Update was selected for users. If It was it will run the update.
    if (isset($_POST['submitupdatePage'])){
        if(strlen($_POST['menuname'])>0 AND strlen($_POST['pagename'] AND strlen($_POST['pageid']))>0 ){
        $newpage = new Page("","");

        $newpage->setMenuName($_POST['menuname']);
        $newpage->setPageName($_POST['pagename']);
         $newpage->setDesc($_POST['pageDesc']);


        if(isset($_POST['isVisible'])){
            $newpage->setvisible(1);
        }
        else {
            $newpage->setvisible(0);
        }


        $usersID=$_SESSION["user"];
        $newpage->setPageid($_POST['pageid']);
        $newpage->setCreatedby($usersID);
        $newpage->setModifiedby($usersID);
        $results=$newpage->updatePage();

        echo$results;

    }
    else {
            Header('Location: http://localhost:8080/index.php?page=PagesManagement');
            die();

        }


    }

    if (isset($_POST['submitdeletePage'])){


        if(strlen($_POST['pageid'])>0 ){


            $newpage = new Page("","");

            $newpage->setPageid($_POST['pageid']);


            $results=$newpage->delete();



            echo$results;


        }


    }
    /*
      *
      * ############### END OF CRUD CHECKS #####################
      *
      */





    //I decided adding more requirements into the constructors wasn't really what we needed at this time.

    $activeTemplate= Template::retrieveTemplate();
    $arrayOfAreas=Area::retrieveArea();
    $activePage= Page::retrievePage("Homepage");




    if(!empty($_GET)){

        $activePage= Page::retrievePage($_GET['page']);

            }
            else {

                $activePage= Page::retrievePage("Homepage");

            }


    ?>



    <title> <?php echo $activePage->getPageName(); ?></title>

    <style type="text/css">
        <?php echo $activeTemplate->getContent(); ?>
    </style>


</head>
<body>
    <header>
        <h1><?php echo $activePage->getPageName(); ?></h1>
    </header>

<nav>
    <ul>
        <?php


        // We need to load the Menu which has all of our Pages, Here we get a array of pages
        $arrayOfPages = Page::retrieveVisiblePages();
        // Now we loop through and display Pagemenu Name as well as the URL with the PageName
        // Within the loop, we use the $page object and get names/MenuNames

       // As per Michaels comments from above, I followed the exact sudo code.
        foreach($arrayOfPages as $Page):
            ?>
            <br/>
         <li>
         <a href='index.php?page=<?php echo $Page->getPageName();?>'> <?php echo $Page->getMenuName();?>   </a>
        </li>


        <?php
        endforeach;
            ?>
    </ul>
</nav>
<section>

    <?php
        // Roughly what were doing here is Cycling through ALL of the Areas
        // This allows us lots of customization with what areas we want populated and such.
        // Right now this is very basic, and we don't even get PageID which would be nice to reference when we check
        // Articles for matches, but for now we're just loading any Articles that match the areas.?>
        <?php
      foreach ($arrayOfAreas as $area)
    {


        // all of our content areas are DIVs with IDSs generated by the Area Alias
        //This will allow us to program against the IDS if we need to.

        ?>
        <div id= <?php echo $area->getAreaAlias(); ?> >

            <?php

        // obtain/receive all articles ($articleArray)
        // for the current page (or for all pages)
        // and for the current area
        // in REVERSE ORDER of creation date



            // As per the comments above, I get an array of articles based on the Area ID, at this point we might even want to reference a PageID
            // As this will allow us to focus our content based on where we are.
            // NOTE: I didnt edit the SQL Statement to do REVERSE ORDER of Creation date.
            // It can definately be fixed at a later date once we have more Data in our Database.

            $arrayOfArticles= Article::retrieveAreaArticles($area->getID(),$activePage->getID());

                if(isset ($arrayOfArticles)){

                foreach ($arrayOfArticles as $article)
                {
                    //Once we get the array of articles we post the content of it depending of the area it belongs in.
                    // For example:
                    /*   Areaid:1   is Header
                     *
                     *   We check our database for matches that have Articles that have a relationship with AreaId:1
                     *   If there is a match we post the content
                     *  NOTE:Articles I feel is kinda a bad Word to use,its more like Content, but we'll keep articles at this point.
                     */

                        ?>
                    <article id=<?php echo $article->getArticleTitle(); ?> >

                       <?php echo $article->getArticleContent(); ?>
                        <br>
                        <br>
                        <br>


                    </article>
                <?php

                }

                }
                ?>
       </div>
   <?php

     }  ?>

</section>
</body>
</html>