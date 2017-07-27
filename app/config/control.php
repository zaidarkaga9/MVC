<?php

include_once "app/config/view.php";

require_once "app/config/Functions.php";


function __autoload($class)
{
    if (strpos($class, 'M_') !== FALSE) 
    {
        $classname = str_replace("M_","",$class);
        if(file_exists("app/models/".$classname.".php"))
        {
        require("app/models/".$classname.".php");  
        }
    }

    if (strpos($class, 'L_') !== FALSE) 
    {
        $classname = str_replace("L_","",$class);
        if(file_exists("app/lib/".$classname.".php"))
        {
        require("app/lib/".$classname.".php");  
        }
    }
}


class control
{

    public function __construct($Language,$Controller,$Action,$Parameters="")
    {
        if(file_exists("app/controllers/".$Controller.".php"))
        {
            include  "app/controllers/".$Controller.".php";
            if(!file_exists("app/languages/".$Language.".php"))
            {
                echo Error;
                exit;
            }
            $obj = new $Controller($Language);
            if(method_exists($obj,$Action))
            {
                $obj->$Action($Parameters);
            }
            else
            {
                echo Error;
                exit;
            }
        }
        else
        {
            echo Error;
            exit;
        }
    }
    
}
?>