<?php


defined('root') ? null : define('root', 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/');
defined('Langs') ? null : define('Langs', root."app/languages/");
defined('CSS') ? null : define('CSS', root."public/css/");
defined('JS') ? null : define('JS', root."public/js/");
defined('Img') ? null : define('Img', root."public/img/");
defined('Error') ? null : define('Error','<br><br><h1 style="text-align: center; z-index: 100; text-shadow: .04em .04em 0 #000;white-space: nowrap;position: relative;letter-spacing: .1em;font-weight: 900;color: #337ab7;font-size:5.5em;">Page Not Found</h1>');


if(isset($_GET['url']) && !empty($_GET['url']))
{
    $URL = explode("/",trim(strtolower($_GET['url']),"/"));

    if(sizeof($URL)<=4)
    {
        isset($URL[0])? $Language = strtolower($URL[0]) : $Language = "en";
        isset($URL[1])? $Controller = ucfirst($URL[1]) : $Controller = "Home";
        isset($URL[2])? $Action = ucfirst($URL[2]) : $Action = "Index";
        isset($URL[3])? $Parameters = $URL[3] : $Parameters = "";
    }
    else
    {
        include header;
        echo Error;
        include footer;
        exit;
    }
}
else
{
    $Language = "en";
    $Controller = "Home";
    $Action = "Index";
    $Parameters = "";
}

include "app/config/control.php";



$control = new Control($Language,$Controller,$Action,$Parameters);

?>