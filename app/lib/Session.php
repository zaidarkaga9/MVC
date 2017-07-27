<?php

    session_start();

    class L_Session
    {
        public function Set($key,$value)
        {
            if(!isset($_SESSION[$key])) {
                $_SESSION[$key] = $value;
            }
        }

        public function Get($key)
        {
            return (isset($_SESSION[$key]) ? $_SESSION[$key] : null);
        }

        public function Delete($key)
        {
            if(isset($_SESSION[$key]))
            {
                unset($_SESSION[$key]);
            }
        }
    }

?>