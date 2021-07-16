<?php
    $xml=simplexml_load_file("meniny.xml") or die("Error: Cannot create object");

    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

    $prvy = array_shift($request);
    $druhy= array_shift($request);
    $treti=array_shift($request);
    $stvrty=array_shift($request);

    if ($method=="GET")
    {
        if($prvy=='den')
        {
            $result=$xml->xpath("//zaznam[den=".$druhy."]");

            echo "Na Slovensku: ".$result[0]->SK."<br><br>";
            echo "Na Slovensku SKd: ".$result[0]->SKd."<br><br>";
            echo "V Česku: ".$result[0]->CZ."<br><br>";
            echo "V Maďarsku: ".$result[0]->HU."<br><br>";
            echo "V Poľsku: ".$result[0]->PL."<br><br>";
            echo "V Rakúsku: ".$result[0]->AT."<br>";
        }

        if ($prvy=='meno')
        {
            $url="//zaznam[".$stvrty."[contains(text(),'".$druhy."')]]";
            $result=$xml->xpath($url);

            $string= $result[0]->den;
            $dot = '.';

            echo "Na ".$stvrty." má meniny ".$druhy." v deň ".substr_replace($string,$dot,2, 0);
        }

        if($prvy=='sviatok')
        {
            $url="//zaznam[".$druhy."]";
            $result=$xml->xpath($url);

            $string;
            $dot = '.';

            foreach ($result as $value)
            {
                $string= $value[0]->den;
                echo "V deň: ". substr_replace($string,$dot,2, 0)." je sviatok: ".$value->$druhy."<br><br>";
            }
        }
    }

    if ($method=="POST")
    {
        if ($prvy=='name')
        {
            $result=$xml->xpath("//zaznam[den=".$stvrty."]");
            $tmp=$result[0]->SKd;

            $tmp=$tmp.", ".$druhy;
            $result[0]->SKd=$tmp;

            $xml->asXML("meniny.xml");
        }
    }
?>