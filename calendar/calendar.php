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

    
    
    /* important: month, year, weekdays, tasks. */ 
        /* 
            Custom calendar:

            Step 1:
            Zeller’s Congruence - algorithm 
            learn how to get the day of the week for any date.

            Step 2:
            Calculate number of dats in a month
            learn the logic to handle months and leap years manually.

            step 3:
            leap year rule.
            if (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) {
                // leap year
            }

            step 4:
            display a calendar, show in a grid with 7 columns.

            Step 5:
            navigation - previous and next month

        */ 



        /*
            step 1:
            mathematical formula to determine the day of the week wthout using built in date()

            formula for gregorian calendar:
            h = ( q + ⌊(13(m + 1)/5)⌋ + K + ⌊K/4⌋ + ⌊J/4⌋ + 5J ) mod 7

            --
            h	Day of the week (0 = Saturday, 1 = Sunday, ..., 6 = Friday)
            q	Day of the month (1–31)
            m	Month (3 = March, 4 = April, ..., 14 = February)
            K	Year of the century (i.e., year % 100)
            J	Zero-based century (i.e., year / 100)

            --
            important!
             -Jan is treated as 13
             -Feb is treated as 14
             of the previous year

             ->implement zellers conrguence
                -turn your manual calculations into code that automatically gives you the weekday for any date.
                -This will be the core function you’ll use to place days correctly in your calendar grid.


                #TASK
                1. Write a PHP function that takes a date (day, month, year) as input.

                2. Adjust January and February to months 13 and 14 of the previous year (per Zeller’s rule).

                3. Calculate K and J from the year.

                4. Apply the formula.

                5. Return the day of the week as a number (0=Saturday, 1=Sunday, ..., 6=Friday).

                6. Optionally, map that number to a weekday name.
        */ 

        function zellersCongruence($day, $month, $year) 
        {
            if ($month < 3) {
                $month += 12;
                $year -= 1;
            }
            $K = $year % 100;
            $J = intdiv($year, 100);
            
            $h = ($day + floor((13 * ($month + 1)) / 5) + $K + floor($K / 4) + floor($J / 4) + 5 * $J) % 7;
            
            $weekdays = ["Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
    
            return $weekdays[$h];
        }
        echo zellersCongruence(17, 5, 2025); 

?>