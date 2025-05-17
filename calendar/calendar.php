<?php
    function zellersCongruence($day, $month, $year) {
        if ($month < 3) {
            $month += 12;
            $year -= 1;
        }
        $K = $year % 100;
        $J = intdiv($year, 100);
        $h = ($day + floor((13 * ($month + 1)) / 5) + $K + floor($K / 4) + floor($J / 4) + 5 * $J) % 7;
        return $h;
    }

    function daysInMonth($month, $year) {
        if ($month == 2) {
            return (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) ? 29 : 28;
        }
        return in_array($month, [1,3,5,7,8,10,12]) ? 31 : 30;
    }

    function getMonthName($month) {
        $months = [
            1=>"January", 2=>"February", 3=>"March", 4=>"April",
            5=>"May", 6=>"June", 7=>"July", 8=>"August",
            9=>"September", 10=>"October", 11=>"November", 12=>"December"
        ];
        return $months[$month];
    }

    function previousMonth($month, $year) {
        $month--;
        if ($month < 1) {
            $month = 12;
            $year--;
        }
        return [$month, $year];
    }

    function nextMonth($month, $year) {
        $month++;
        if ($month > 12) {
            $month = 1;
            $year++;
        }
        return [$month, $year];
    }

    $month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('n');
    $year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');

    $zellerDay = zellersCongruence(1, $month, $year);
    $startDay = ($zellerDay + 6) % 7;
    $totalDays = daysInMonth($month, $year);
    list($prevMonth, $prevYear) = previousMonth($month, $year);
    list($nextMonth, $nextYear) = nextMonth($month, $year);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP Custom Calendar</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { margin: 20px auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; width: 50px; height: 50px; }
        th { background-color: #f4f4f4; }
        .today { background-color: #d4edda; font-weight: bold; }
        a { text-decoration: none; margin: 0 10px; }
    </style>
</head>
<body>

<h2>
    <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>">&#8592;</a>
    <?= getMonthName($month) . " " . $year ?>
    <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>">&#8594;</a>
</h2>

<table>
    <tr>
        <th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th>
        <th>Thu</th><th>Fri</th><th>Sat</th>
    </tr>
    <tr>
        <?php
        $day = 1;
        $cellCount = 0;

        for ($i = 0; $i < $startDay; $i++) {
            echo "<td></td>";
            $cellCount++;
        }

        while ($day <= $totalDays) {
            $isToday = ($day == date('j') && $month == date('n') && $year == date('Y'));
            $class = $isToday ? 'today' : '';
            echo "<td class='$class'>$day</td>";
            $day++;
            $cellCount++;
            if ($cellCount % 7 == 0) {
                echo "</tr><tr>";
            }
        }

        while ($cellCount % 7 != 0) {
            echo "<td></td>";
            $cellCount++;
        }
        ?>
    </tr>
</table>

</body>
</html>
