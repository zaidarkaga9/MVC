<?php


class view
{
    private  $arr = array();

    public function Show()
    {
        extract($this->arr);
        $Language = @trim(explode('/',trim($_SERVER['REQUEST_URI'],'/'))[1]);
        if(empty($Language) || $Language == ""){
            $Language = "en";
        }
        extract(array('lang'=>$Language));
        $cont = get_class($this);
        $fun = debug_backtrace()[1]['function'];
        if(!@extract(@require_once ("app/languages/".$Language.".php")))
        {
            echo Error;
            exit;
        }
        if(!@include_once "app/views/".$cont."/".$fun.".php")
        {
            echo Error;
            exit;
        }
    }

    public function Set($key,$value)
    {
        $this->arr[$key] = $value;
    }

    public function Go($page)
    {
         extract($this->arr);
        if(!@extract(@require_once ("app/languages/".trim(explode('/',trim($_SERVER['REQUEST_URI'],'/'))[1]).".php")))
        {
            echo Error;
            exit;
        }
        if(empty($Language) || $Language == ""){
            $Language = "en";
        }
        extract(array('lang'=>$Language));
       if(!@include_once "app/views/".$page.".php")
        {
            echo Error;
            exit;
        } 
    }
}

?>    
