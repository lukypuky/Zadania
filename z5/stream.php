<?php
    include 'config.php';
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header("Connection: keep-alive");
    header("Access-Control-Allow-Origin: *");

    $lastId = $_SERVER["HTTP_LAST_EVENT_ID"];
    if (isset($lastId) && !empty($lastId) && is_numeric($lastId))
    {
        $lastId = intval($lastId);
        $lastId++;
    }

    else
    {
        $lastId = 0;
    }

    while (true)
    {
        $sql = "SELECT * FROM a_parameter";
        $stm = $connect->query($sql);
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        if(!$result)
        {
            $a = 1;
        }

        else
        {
            foreach ($result as $row)
            {
                $a = $row['value'];
            }
        }

        $x = $lastId;
        $y1 = sin(deg2rad($x * $a));
        $y2 = cos(deg2rad($x * $a));
        $y3 = sin(deg2rad($x *$a)) * cos(deg2rad($x * $a));

        echo "id: $lastId" . PHP_EOL;
        echo "data: {". PHP_EOL;
        echo "data: \"x\": \"{$x}\", ". PHP_EOL;
        echo "data: \"a\": \"{$a}\", ". PHP_EOL;
        echo "data: \"y1\": \"{$y1}\", ". PHP_EOL;
        echo "data: \"y2\": \"{$y2}\", ". PHP_EOL;
        echo "data: \"y3\": \"{$y3}\" ". PHP_EOL;
        echo "data: }". PHP_EOL;
        echo PHP_EOL;

        $lastId++;
        ob_flush();
        flush();

        sleep(1);
    }
?>

