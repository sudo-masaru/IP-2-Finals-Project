<?php

    $cookie = $_COOKIE['autolog'];
    if(isset($_COOKIE['autolog']))
    {
        if($cookie===true)
        {
            echo "user is active";
        }
        else
        {
            echo "";
        }
    }

?>