<?php


require("../Business/MobileVisitors.php");
// This is just an example of reading server side data and sending it to the client.
// It reads a json formatted text file and outputs it.



$Page = new MobileVisitors();
$Page = MobileVisitors::retrieveallPageData();



$value1 = (string)$Page->getHome();
$value2 = (string)$Page->getAboutus();
$value3 = (string)$Page->getArticles();
$value4 = (string)$Page->getPortal();




//$value= $MobileVisitors->getPortal();


$string = '{
    "cols": [
        {"id":"","label":"Webpage","pattern":"","type":"string"},
        {"id":"","label":"Mobile Views","pattern":"","type":"number"}
    ],
    "rows": [
        {"c":[{"v":"Home Page","f":null},{"v":' . $value1  . ',"f":null}]},
        {"c":[{"v":"About us Page","f":null},{"v":' . $value2 . ',"f":null}]},
        {"c":[{"v":"Articles Page","f":null},{"v":' . $value3 . ',"f":null}]},
        {"c":[{"v":"Management Portal","f":null},{"v":' . $value4 . ',"f":null}]}

    ]
} ';

//$string = file_get_contents("sampleData.json");


echo $string;


?>