<?php

    function Input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function GetURL()
    {
        return "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }

    function Returns()
    {
        header("Location: {$_SERVER['HTTP_REFERER']}"); 
    }

    function Ints($num)
    {
        return (!filter_var($num, FILTER_VALIDATE_INT) === false)?true:false;
    }

    function Float($num)
    {
        return (!filter_var($num, FILTER_VALIDATE_FLOAT) === false)?true:false;
    }

    function Bool($num)
    {
        return (!filter_var($num, FILTER_VALIDATE_BOOLEAN) === false)?true:false;
    }

    function Email($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return (!filter_var($email, FILTER_SANITIZE_EMAIL) === false)?true:false;
    }

    function Url($url)
    {
        $email = filter_var($url, FILTER_SANITIZE_URL);
        return (!filter_var($url, FILTER_SANITIZE_EMAIL) === false)?true:false;
    }

    function IntRange($int,$min,$max)
    {
        return (filter_var($int, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max))) === false)?true:false;
    }
    
    function FloatRange($int,$min,$max)
    {
        return (filter_var($int, FILTER_VALIDATE_FLOAT, array("options" => array("min_range"=>$min, "max_range"=>$max))) === false)?true:false;
    }

    function GetPassword($size) 
    {
        $alphabet = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $size; $i++) 
        {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }


?>