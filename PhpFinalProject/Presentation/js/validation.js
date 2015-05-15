

/*
function checkForm()
{
    var valid = true;
    var firstname = document.getElementById('firstname');
    var lastname = document.getElementById('lastname');
    var description = document.getElementById('description');


    document.getElementById('firstnameMSG').innerHTML = "";
    document.getElementById('lastnameMSG').innerHTML = "";
    document.getElementById('descriptionMSG').innerHTML = "";


    //textboxes
    if(firstname.value.length < 1)
    {
        document.getElementById('firstnameMSG').innerHTML = " Please Enter a First  Name ";
        valid = false;
    }
    if(lastname.value.length < 1)
    {
        document.getElementById('lastnameMSG').innerHTML = " Please Enter a Last Name ";
        valid = false;
    }

    if(description.value.length < 1)
    {
        document.getElementById('descriptionMSG').innerHTML = " Please Enter a Description ";
        valid = false;
    }


    return valid;
}
*/
/*
 function checkpageForm()
 {

 var valid = true;
 var pageid = document.getElementById('Username');
 var menuname = document.getElementById('FirstName');
 var pagename = document.getElementById('LastName');
 var description = document.getElementById('password');

 var passwordconf = document.getElementById('passwordconf');
 var passwordconf = document.getElementById('passwordconf');
 var passwordconf = document.getElementById('passwordconf');

 document.getElementById('userNameSpan').innerHTML = "";
 document.getElementById('firstNameSpan').innerHTML = "";
 document.getElementById('lastNameSpan').innerHTML = "";
 document.getElementById('passwordSpan').innerHTML = "";

 //textboxes
 if(username.value.length < 8)
 {
 document.getElementById('userNameSpan').innerHTML = "Please enter Username" ;
 valid = false;
 }
 if(firstname.value.length < 1)
 {
 document.getElementById('firstNameSpan').innerHTML = "Please enter First name";
 valid = false;
 }

 if(lastname.value.length < 1)
 {
 document.getElementById('lastNameSpan').innerHTML = "Please enter Last name";
 valid = false;
 }


 if(password.value.length < 1 || passwordconf.value.length <1)
 {
 document.getElementById('passwordSpan').innerHTML = "Please enter passwords";
 valid = false;
 }


 if(password.value != passwordconf.value )
 {
 document.getElementById('passwordSpan').innerHTML = "Passwords do not match";
 valid = false;
 }



 return valid;
 }*/






// User form insert update validate functions
function checkUserForm()
{
    var valid = true;
    var username = document.getElementById('Username');
    var firstname = document.getElementById('FirstName');
    var lastname = document.getElementById('LastName');
    var password = document.getElementById('password');
    var passwordconf = document.getElementById('passwordconf');


    document.getElementById('userNameSpan').innerHTML = "";
    document.getElementById('firstNameSpan').innerHTML = "";
    document.getElementById('lastNameSpan').innerHTML = "";
    document.getElementById('passwordSpan').innerHTML = "";

    //textboxes
    if(username.value.length <= 7)
    {
        document.getElementById('userNameSpan').innerHTML = "Please enter Larger Username" ;
        valid = false;
    }
    if(firstname.value.length < 1)
    {
        document.getElementById('firstNameSpan').innerHTML = "Please enter First name";
        valid = false;
    }

    if(lastname.value.length < 1)
    {
        document.getElementById('lastNameSpan').innerHTML = "Please enter Last name";
        valid = false;
    }


    if(password.value.length < 1 || passwordconf.value.length <1)
    {
        document.getElementById('passwordSpan').innerHTML = "Please enter passwords";
        valid = false;
    }


    if(password.value != passwordconf.value )
    {
        document.getElementById('passwordSpan').innerHTML = "Passwords do not match";
        valid = false;
    }



    return valid;
}
function checkUserUpdateForm()
{
    var valid = true;
    var userid = document.getElementById('UserIDUpdate');
    var username = document.getElementById('UserNameupdate');
    var firstname = document.getElementById('FirstNameUpdate');
    var lastname = document.getElementById('LastNameUpdate');
    var password = document.getElementById('passwordUpdate');
    var passwordconf = document.getElementById('password2Update');


    document.getElementById('userupdateID').innerHTML = "";
    document.getElementById('userupdateName').innerHTML = "";
    document.getElementById('userupdatefName').innerHTML = "";
    document.getElementById('userupdatelName').innerHTML = "";
    document.getElementById('userupdatepassword').innerHTML = "";


    //textboxes

    if(userid.value.length < 1)
    {
        document.getElementById('userupdateID').innerHTML = "Enter ID to update";
        valid = false;
    }


    if(username.value.length < 8)
    {
        document.getElementById('userupdateName').innerHTML = "Enter larger Username";
        valid = false;
    }
    if(firstname.value.length < 1)
    {
        document.getElementById('userupdatefName').innerHTML = "Enter First name";
        valid = false;
    }

    if(lastname.value.length < 1)
    {
        document.getElementById('userupdatelName').innerHTML = "Enter Last name";
        valid = false;
    }


    if(password.value.length < 1 || passwordconf.value.length <1)
    {
        document.getElementById('userupdatepassword').innerHTML = "Enter Password";
        valid = false;
    }


    if(password.value != passwordconf.value )
    {
        document.getElementById('userupdatepassword').innerHTML = "Passwords don't Match";
        valid = false;
    }



    return valid;
}





//pages onclick validate functions
function validpagesinsert()
{

    var valid = true;


    //var pageid = document.getElementById('pageid');
    var menuname = document.getElementById('menuname');
    var pagename = document.getElementById('pagename');
    //var description = document.getElementById('pageDesc');


    //document.getElementById('updateID').innerHTML = "";
    document.getElementById('menuupdate').innerHTML = "";
    document.getElementById('nameupdate').innerHTML = "";



    //textboxes

   /*
    if(pageid.value.length < 1)
    {
        document.getElementById('updateID').innerHTML = "Please enter Username";
        valid = false;
    }*/



     if(menuname.value.length < 1)
    {
        document.getElementById('menuupdate').innerHTML = "Please enter Username" ;
        valid = false;
    }
    if(pagename.value.length < 1)
    {
        document.getElementById('nameupdate').innerHTML = "Please enter Page name";
        valid = false;
    }

    if(pagename.value.match(/\s/g,''))

    {
        document.getElementById('nameupdate').innerHTML = "No Spaces in Page name";

        valid=false;
    }

   return valid;


}

function validpagesupdate()
{



    var valid = true;


    var pageid = document.getElementById('pageid');
    var menuname = document.getElementById('menuname');
    var pagename = document.getElementById('pagename');
    //var description = document.getElementById('pageDesc');


    //document.getElementById('updateID').innerHTML = "";
    document.getElementById('menuupdate').innerHTML = "";
    document.getElementById('nameupdate').innerHTML = "";



    //textboxes



     if(pageid.value.length < 1)
     {
     document.getElementById('updateID').innerHTML = "|||  Please enter ID Field";
     valid = false;
     }


    if(menuname.value.length < 1)
    {
        document.getElementById('menuupdate').innerHTML = "Please enter Username" ;
        valid = false;
    }
    if(pagename.value.length < 1)
    {
        document.getElementById('nameupdate').innerHTML = "Please enter Page name";
        valid = false;
    }

    if(pagename.value.match(/\s/g,''))

    {
        document.getElementById('nameupdate').innerHTML = "No Spaces in Page name";

        valid=false;
    }

    return valid;


}

function validpagesdelete()
{


    var valid = true;


    var pageid = document.getElementById('pageid');


    document.getElementById('updateID').innerHTML = "";
    //textboxes

    if(pageid.value.length < 1)
    {
        document.getElementById('updateID').innerHTML = "|||  Please enter ID Field to Delete";
        valid = false;
    }

    return valid;


}



// Area ONCLICK VALIDATE FUNCTIONS



function validareasinsert()
{

        var valid = true;



        var areaname = document.getElementById('AreaName');
        var areaalias = document.getElementById('AreaAlias');
        var areadesc = document.getElementById('AreaDesc');
        var areapos = document.getElementById('AreaPos');



        //document.getElementById('updateID').innerHTML = "";
        document.getElementById('nameupdate').innerHTML = "";
        document.getElementById('aliasupdate').innerHTML = "";
        document.getElementById('descupdate').innerHTML = "";
        document.getElementById('postionupdate').innerHTML="";




        if(menuname.value.length < 1)
        {
            document.getElementById('menuupdate').innerHTML = "Please enter Username" ;
            valid = false;
        }
        if(areaname.value.length < 1)
        {
            document.getElementById('nameupdate').innerHTML = "Please enter Area name";
            valid = false;
        }

        if(areaname.value.match(/\s/g))

        {
            document.getElementById('nameupdate').innerHTML = "No Spaces in Page name";

            valid=false;
        }

        return valid;

    }


function validareasupdate()
{
    var valid = true;


    var areaid = document.getElementById('AreaId');
    var areaname = document.getElementById('AreaName');
    var areaalias = document.getElementById('AreaAlias');
    var areadesc = document.getElementById('AreaDesc');
    var areapos = document.getElementById('AreaPos');

    //var description = document.getElementById('pageDesc');


    //document.getElementById('updateID').innerHTML = "";
    document.getElementById('nameupdate').innerHTML = "";
    document.getElementById('aliasupdate').innerHTML = "";
    document.getElementById('descupdate').innerHTML = "";
    document.getElementById('positionsupdate').innerHTML = "";



    //textboxes

    if(areaid.value.length < 1)
    {
        document.getElementById('updateID').innerHTML = "|||  Please enter ID Field";
        valid = false;
    }

    if(areadesc.value.length < 1)
    {
        document.getElementById('descupdate').innerHTML = "|||  Please enter Description Field";
        valid = false;
    }

    if(areapos.value.length < 1)
    {
        document.getElementById('positionupdate').innerHTML = "|||  Please enter Position Field";
        valid = false;
    }


    if(menuname.value.length < 1)
    {
        document.getElementById('menuupdate').innerHTML = "Please enter Username" ;
        valid = false;
    }
    if(areaname.value.length < 1)
    {
        document.getElementById('nameupdate').innerHTML = "Please enter Area name";
        valid = false;
    }

    if(areaname.value.match(/\s/g))

    {
        document.getElementById('nameupdate').innerHTML = "No Spaces in Area name";

        valid=false;
    }
    if(areaalias.value.length < 1)
{
    document.getElementById('aliasupdate').innerHTML = "Please enter Area Alias";
    valid = false;
}



    return valid;



}

function validareasdelete()
{
    var valid = true;
    var areaid = document.getElementById('AreaId');
    document.getElementById('updateID').innerHTML = "";
    //textboxes
    if(pageid.value.length < 1)
    {
        document.getElementById('updateID').innerHTML = "|||  Please enter ID Field to Delete";
        valid = false;
    }

    return valid;



}







// Articles ONCLICK VALIDATE FUNCTIONS

function validartsinsert()
{


    var valid = true;

    //var ArticleId = document.getElementById('ArticlePageId');



    var ArticleName = document.getElementById('Articlename');
    var ArticleTitle = document.getElementById('ArticleTitle');
    var PageId = document.getElementById('ArticlePageId');
    var AreaId = document.getElementById('ArticleAreaId');
    var ArticleContent = document.getElementById('ArticleContents');






    //document.getElementById('idspan').innerHTML = "";

    document.getElementById('PageID').innerHTML = "";
    document.getElementById('AreaIDspan').innerHTML = "";
    document.getElementById('Titlespan').innerHTML = "";
    document.getElementById('Namespan').innerHTML = "";
    document.getElementById('Contentspan').innerHTML = "";




    if(PageId.value.length < 1)
    {
        document.getElementById('PageID').innerHTML = "Please Enter PageID";
        valid = false;
    }
    if(AreaId.value.length < 1)

    {
        document.getElementById('AreaIDspan').innerHTML = "Please Enter AreaID";

        valid=false;
    }

    if(ArticleTitle.value.length < 1)
    {
        document.getElementById('Titlespan').innerHTML = "Please Enter Title";

        valid=false;
    }


    if(ArticleName.value.length < 1)
    {
        document.getElementById('Namespan').innerHTML = "Please enter Article Name";

        valid=false;
    }

    if(ArticleContent.value.length < 1)
    {
        document.getElementById('Contentspan').innerHTML = "Please Enter Content";

        valid=false;
    }




    return valid;



}

function validartsupdate()
{


    var valid = true;

     var ArticleId = document.getElementById('ArticlePageId');
     var ArticleName = document.getElementById('Articlename');
    var ArticleTitle = document.getElementById('ArticleTitle');
    var PageId = document.getElementById('ArticlePageId');
    var AreaId = document.getElementById('ArticleAreaId');
    var ArticleContent = document.getElementById('ArticleContents');







    document.getElementById('idspan').innerHTML = "";
    document.getElementById('PageID').innerHTML = "";
    document.getElementById('AreaIDspan').innerHTML = "";
    document.getElementById('Titlespan').innerHTML = "";
    document.getElementById('Namespan').innerHTML = "";
    document.getElementById('Contentspan').innerHTML = "" ;


    if(ArticleId.value.length < 1)
    {
        document.getElementById('idspan').innerHTML = "Please Enter Article Id to update.";
        valid = false;
    }

    if(PageId.value.length < 1)
    {
        document.getElementById('PageID').innerHTML = "Please Enter PageID";
        valid = false;
    }
    if(AreaId.value.length < 1)

    {
        document.getElementById('AreaIDspan').innerHTML = "Please Enter AreaID";

        valid=false;
    }

    if(ArticleTitle.value.length < 1)
    {
        document.getElementById('Titlespan').innerHTML = "Please Enter Title";

        valid=false;
    }


    if(ArticleName.value.length < 1)
    {
        document.getElementById('Namespan').innerHTML = "Please enter Article Name";

        valid=false;
    }

    if(ArticleContent.value.length < 1)
    {
        document.getElementById('Contentspan').innerHTML = "Please Enter Content";

        valid=false;
    }




    return valid;




}

function validartsdelete()
{

    var valid = true;



    var ArticleId = document.getElementById('ArticleId');



    document.getElementById('idspan').innerHTML = "";


    if(ArticleId.value.length < 1)
    {
        document.getElementById('idspan').innerHTML = "Please Enter Article ID to Delete";
        valid = false;
    }




    return valid;




}

//Articles Checkbox
function validartremove()
{
    var valid = true;
    var ArticleVisible = document.getElementById('ArticleVisible');
    var ArticleContents = document.getElement('ArticleContents');
    var Lookupid = document.getElementById('LookupId');

    if(Lookupid.value = 1)
    {
        if (ArticleVisible.checked = false)
        {
            ArticleContents = "";

        }
        return valid;

    }


}

//Validation for Add New Article Page.

//save btn aka update, a success message and user permissions
function validartsave()
{

    if(Lookupid.value = 1)
    {
        if(ArticleSave.click = true)
        {
            document.innerHTML ="Article successfully added";
        }
    }

}







// TEMPLATE ONCLICK VALIDATE FUNCTIONS

function validtempinsert()
{


    var valid = true;
    var templatename = document.getElementById('Templatename');
    var content = document.getElementById('TemplateContents');


    document.getElementById('templateNamespan').innerHTML = "";
    document.getElementById('templatecontentspan').innerHTML = "";


    if(templatename.value.length < 1)
    {
        document.getElementById('templateNamespan').innerHTML =  "Please enter Name" ;
        valid = false;
    }
    if(content.value.length < 1)

    {
        document.getElementById('templatecontentspan').innerHTML ="Enter Style content";

        valid=false;
    }



    return valid;



}

function validtempsupdate()
{


    var valid = true;
    var templateid = document.getElementById('Templateid');
    var templatename = document.getElementById('Templatename');
    var content = document.getElementById('TemplateContents');



    document.getElementById('IDspan').innerHTML = "";
    document.getElementById('templateNamespan').innerHTML = "";
    document.getElementById('templatecontentspan').innerHTML = "";



    if(templateid.value.length < 1)
    {
        document.getElementById('IDspan').innerHTML =  "Please enter ID for Update" ;
        valid = false;
    }

    if(templatename.value.length < 1)
    {
        document.getElementById('templateNamespan').innerHTML =  "Please enter Name" ;
        valid = false;
    }
    if(content.value.length < 1)

    {
        document.getElementById('templatecontentspan').innerHTML ="Enter Style content";

        valid=false;
    }

    valid=false;
    return false;
    //return valid;

}

function validtempsdelete()
{


    var valid = true;
    var templateid = document.getElementById('Templateid');

    document.getElementById('IDspan').innerHTML = "";
    document.getElementById('templateNamespan').innerHTML = "";
    document.getElementById('templatecontentspan').innerHTML = "";



    if(templateid.value.length < 1)
    {
        document.getElementById('IDspan').innerHTML =  "Please enter ID for Delete" ;
        valid = false;
    }



    return valid;

}


