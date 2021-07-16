<?php
    include 'config.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    libxml_use_internal_errors(true);
    libxml_clear_errors();

    $sql = "SELECT * FROM world_population";
    $stm = $connect->query($sql);
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    if(!$result)
    {
        $htmlContent = file_get_contents("https://www.worldometers.info/world-population/population-by-country/");

        $DOM = new DOMDocument();
        $DOM->loadHTML($htmlContent);

        $Header = $DOM->getElementsByTagName('th');
        $Detail = $DOM->getElementsByTagName('td');

        //#Get header name of the table
        foreach ($Header as $NodeHeader)
        {
            $aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
        }

        //#Get row data/detail table without header name as key
        $i = 0;
        $j = 0;
        foreach ($Detail as $sNodeDetail)
        {
            $aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
            $i = $i + 1;
            $j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;
        }

        for ($x = 0; $x < count($aDataTableDetailHTML); $x++)
        {
            $line = array();
            for ($y = 0; $y < 3; $y++)
            {
                if (strpos($aDataTableDetailHTML[$x][$y], "'") !== false)
                {
                    $aDataTableDetailHTML[$x][$y] = str_replace("'", "\'", $aDataTableDetailHTML[$x][$y]);
                }

                array_push($line, $aDataTableDetailHTML[$x][$y]);
            }

            $sql2 = "INSERT INTO world_population (id, country_name, population)
                             VALUES ('$line[0]', '$line[1]', '$line[2]')";
            $stm2 = $connect->query($sql2);
            unset($line);
        }
    }

    header('location: population.php');
?>