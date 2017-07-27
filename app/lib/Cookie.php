<?php

class L_Cookie
{
    public function Set($key,$value,$time=(86400 * 30))
    {
        setcookie($key, encode($value), time()+$time);
    }
    
    public function Get($key)
    {
        return (isset($_COOKIE[$key]) ? decode($_COOKIE[$key]) : '');
    }

    public function Delete($key,$time=(86400 * 30))
    {
        if(isset($_COOKIE[$key]))
        {
            setcookie($key, '', time() - $time);
            unset($_COOKIE[$key]);
        }
    }
}

?>