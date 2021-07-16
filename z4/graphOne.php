<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Zadanie4 - Lukáš Bača</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="script.js"></script>
        <script src='https://cdn.plot.ly/plotly-latest.min.js'></script>
    </head>

    <header>
        <nav>
            <a href="index.php" class="menu">Corona Stats</a>
            <a href="population.php" class="menu">World Population</a>
            <a href="graphOne.php" class="active">Graph A</a>
            <a href="graphTwo.php" class="menu">Graph B</a>
            <a href="graphThree.php" class="menu">Graph C</a>
            <a href="graphFour.php" class="menu">Graph D</a>
        </nav>
    </header>

    <body>
        <div class="heading">COVID-19 per 100 000 population in each country.</div>
        <div id='graphOne'><!-- Plotly chart will be drawn inside this DIV --></div>
    </body>

    <?php
        include 'config.php';

        $countries = array();
        $confirmed = array();

        $sql = "SELECT country, SUM(confirmed) as confirmed
                FROM statistics 
                WHERE csv_date = '03-21-2020' AND confirmed != 0 GROUP BY country";
        $stm = $connect->query($sql);
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $sql2 = "SELECT * FROM world_population";
        $stm2 = $connect->query($sql2);
        $result2 = $stm2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $coronaRow)
        {
            foreach ($result2 as $populationRow)
            {
                if($coronaRow['country'] == $populationRow['country_name'])
                {
                    $temp = 0;
                    //printf($coronaRow['country']." ".$coronaRow['confirmed']." ".$populationRow['population']."<br>");

                    $populationRow['population'] = str_replace(",","",$populationRow['population']);
                    $temp = round($coronaRow['confirmed'] / ($populationRow['population'] / 100000));

                    if($temp != 0)
                    {
                        array_push($countries, $coronaRow['country']);
                        array_push($confirmed, $temp);
                    }
                }
            }
        }
    ?>

    <script type="text/javascript">
        var x = <?php echo json_encode($countries); ?>;
        var y = <?php echo json_encode($confirmed); ?>;

        xData = [];
        yData = [];

        for(var i = 0; i < x.length; i++)
        {
            xData.push(x[i]);
            yData.push(y[i]);
        }

        var data = [
            {
                x: xData,
                y: yData,
                type: 'bar'
            }
        ];

        Plotly.newPlot('graphOne', data);
    </script>
</html>