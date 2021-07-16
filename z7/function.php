<?php
    require 'config.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    libxml_use_internal_errors(true);
    libxml_clear_errors();

    if (isset($_POST['IP']))
    {
        $ipAdd = $_POST['IP'];

        $sql = "SELECT * FROM visitors WHERE visitors.ip='$ipAdd'";
        $stm = $connect->query($sql);
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        if (!$result)
        {
            echo "0";
        }

        else
        {
            echo "1";
        }
    }

    if (isset($_POST['location']))
    {
        $location=$_POST['location'];

        $sql = "SELECT * FROM visitors WHERE visitors.ip='".$location['query']."' AND date(visitors.timee)='".date("Y-m-d")."'";
        $stm = $connect->query($sql);
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        if (!$result)
        {
            $sql2="INSERT INTO visitors(ip,timee,city,country,countrycode,lang,lon) VALUES ('".$location['query']."','".date("Y-m-d H:i:s")."','".$location['city']."','".$location['country']."','".$location['countryCode']."','".$location['lat']."','".$location['lon']."')";
            $stm2 = $connect->query($sql2);
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if (isset($_POST['tabulka']))
    {
        echo "<table class= 'table myTable text-center'><thead class='thead-dark'><tr><th>Vlajka</th><th>Krajina</th><th>Počet návštev</th></tr></thead><tbody>";

        $sql3 = "SELECT countrycode, country, COUNT(*) AS Counter FROM visitors GROUP BY country, countrycode";
        $stm3 = $connect->query($sql3);
        $result3 = $stm3->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result3 as $row)
        {
            echo "<tr><td><img src='http://www.geonames.org/flags/m/" . strtolower($row['countrycode']) . ".png'></td><td> <a href='#' id=" . $row['countrycode'] . " onclick=\"vytvor_prehlad(this.id)\" " . $row['countrycode'] . "'>" . $row['country'] . "</a></td><td>" . $row['Counter'] . "</td></tr>";
        }

        echo "</tbody></table>";

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        echo "<table class= 'table myTable text-center'><thead class='thead-dark'><tr><th>Čas návštev</th><th>Počet návštev</th></tr></thead><tbody>";
        $temp = 0;
        $sql6 = "SELECT COUNT(*) AS pocet FROM visitors WHERE time(timee)>='06:00:00' AND time(timee)<'14:00:59'";
        $result6 = $connect->query($sql6);
        foreach ($result6 as $row)
        {
            $temp = $row['pocet'];
        }
        echo "<tr><td>6:00-14:00</td><td>$temp</td></tr>";

        $sql7 = "SELECT COUNT(*) AS pocet FROM visitors WHERE time(timee)>='14:01:00' AND time(timee)<'20:00:59'";
        $result7 = $connect->query($sql7);
        foreach ($result7 as $row)
        {
            $temp = $row['pocet'];
        }
        echo "<tr><td>14:00-20:00</td><td>$temp</td></tr>";

        $sql8 = "SELECT COUNT(*) AS pocet FROM visitors WHERE time(timee)>='20:01:00' AND time(timee)<'23:59:59'";
        $result8 = $connect->query($sql8);
        foreach ($result8 as $row)
        {
            $temp = $row['pocet'];
        }
        echo "<tr><td>20:00-24:00</td><td>$temp</td></tr>";

        $sql9 = "SELECT COUNT(*) AS pocet FROM visitors WHERE time(timee)>='00:00:00' AND time(timee)<'05:59:59'";
        $result9 = $connect->query($sql9);
        foreach ($result9 as $row)
        {
            $temp = $row['pocet'];
        }
        echo "<tr><td>24:00-6:00</td><td>$temp</td></tr>";
        echo "</tbody></table>";

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        echo "<table class= 'table myTable text-center'><thead class='thead-dark'><tr><th>Názov stránky</th><th>Počet návštev</th></tr></thead><tbody>";
        $sql10 = "SELECT COUNT(*) AS pocet FROM webvisits WHERE type = 'weather'";
        $result10 = $connect->query($sql10);
        foreach ($result10 as $row)
        {
            $temp = $row['pocet'];
        }
        echo "<tr><td>Počasie</td><td>$temp</td></tr>";

        $sql11 = "SELECT COUNT(*) AS pocet FROM webvisits WHERE type = 'userInfo'";
        $result11 = $connect->query($sql11);
        foreach ($result11 as $row)
        {
            $temp = $row['pocet'];
        }
        echo "<tr><td>Poloha</td><td>$temp</td></tr>";

        $sql12 = "SELECT COUNT(*) AS pocet FROM webvisits WHERE type = 'statistics'";
        $result12 = $connect->query($sql12);
        foreach ($result12 as $row)
        {
            $temp = $row['pocet'];
        }
        echo "<tr><td>Štatistika</td><td>$temp</td></tr>";
        echo "</tbody></table>";
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if (isset($_POST['country']))
    {
        $krajina = $_POST['country'];

        $sql4 = "SELECT city, count(city) AS pocet FROM visitors WHERE countrycode='" . $krajina . "' GROUP BY city";
        $result4 = $connect->query($sql4);

        echo "<table class='table myTable text-center'><thead class='thead-dark'><tr><th>Mesto</th><th>Počet návštev</th></tr></thead><tbody>";

        foreach ($result4 as $row)
        {
            echo "<tr><td>" . $row['city'] . "</td><td>" . $row['pocet'] . "</td></tr>";
        }

        echo "</tbody></table>";
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if (isset($_POST['mapa']))
    {
        $sql5 = "SELECT lang,lon FROM visitors";
        $result5 = $connect->query($sql5);

        $suradnice = array();

        foreach ($result5 as $row)
        {
            array_push($suradnice, [$row['lang'], $row['lon']]);
        }

        print_r(json_encode($suradnice));
    }
?>