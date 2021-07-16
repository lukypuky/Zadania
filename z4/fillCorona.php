<?php
    include 'config.php';

    $today="2020-01-22";
    $breakDate = "03-01-2020";

    $sql = "SELECT * FROM statistics";
    $stm = $connect->query($sql);
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    if(!$result)
    {
        for($x=0; $x < 60; $x++)
        {
            $nextday=strftime("%m-%d-%Y", strtotime("$today +$x day"));

            $url = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_daily_reports/$nextday.csv";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);

            $curl = (curl_exec($ch));

            if(!curl_errno($ch))
            {
                echo "<pre>";
                $lines = array_filter(explode(PHP_EOL, $curl));
                $headers = array();
                $output = array();
                foreach ($lines as $key => $value)
                {
                    if($key == 0)
                    {
                        $headers = str_getcsv($value);
                    }

                    else
                    {
                        $object = new stdClass();
                        foreach (str_getcsv($value) as $i => $v)
                        {
                            $object->{$headers[$i]} = $v;
                        }

                        array_push($output, $object);
                    }
                }

                foreach ($output as $key => $row)
                {
                    $line = array();
                    foreach ($row as $keyTwo => $value)
                    {
                        if (strpos($value, "'") !== false)
                        {
                            $value = str_replace("'","\'",$value);
                        }

                        array_push($line, $value);
                    }

                    if ($nextday >= $breakDate)
                    {
                        $sql2 = "INSERT INTO statistics (province, country, last_update, confirmed, deaths, recovered, latitude, longitude, csv_date)
                                    VALUES ('$line[0]', '$line[1]', '$line[2]', '$line[3]','$line[4]','$line[5]', '$line[6]', '$line[7]', '$nextday')";
                        $stm2 = $connect->query($sql2);
                        //echo $line[0].", ".$line[1].", ".$line[2].", ".$line[3].", ".$line[4].", ".$line[5].", ".$line[6].", ".$line[7]. ", ".$nextday."<br>";
                    }

                    else
                    {
                        $sql2 = "INSERT INTO statistics (province, country, last_update, confirmed, deaths, recovered, csv_date)
                                    VALUES ('$line[0]', '$line[1]', '$line[2]', '$line[3]','$line[4]','$line[5]','$nextday')";
                        $stm2 = $connect->query($sql2);
                        //echo $line[0].", ".$line[1].", ".$line[2].", ".$line[3].", ".$line[4].", ".$line[5]. ", ".$nextday."<br>";
                    }
                    unset($line);

                }
            }
        }

        header('location: updateData.php');
    }
?>