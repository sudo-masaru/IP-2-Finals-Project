<?php

    /*
        unix timestamp : time() - function
        Returns the current number of seconds since January 1, 1970 (Unix Epoch).
    */
        // $currentTime = time();
        // echo "Time: " . $currentTime;



    /*
        Converting a Unix Timestamp to a Readable Date with Date()
        The date() function takes a format string and a timestamp (number of seconds) and returns a human-readable date/time.
    */ 
        $now = time(); // current timestamp
        // echo date("Y-m-d H:i:s", $now);
    /*
        Y = full year (e.g., 2025)

        m = month (01 to 12)

        d = day of the month (01 to 31)

        H = hour in 24h format (00 to 23)

        i = minutes (00 to 59)

        s = seconds (00 to 59)
    */ 
        //echo date("d/m/Y", $now);   // day/month/year  
        //echo date("l, F j, Y", $now); // full weekday name, full month name, day, year
    /*
        l : full name of the weekday
        f : full name of the month
        j : day of the month(no leading zeroes)
        y : four digit year
    */ 

?>