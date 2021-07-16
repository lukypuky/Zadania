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
            <a href="graphOne.php" class="menu">Graph A</a>
            <a href="graphTwo.php" class="active">Graph B</a>
            <a href="graphThree.php" class="menu">Graph C</a>
            <a href="graphFour.php" class="menu">Graph D</a>
        </nav>
    </header>

    <body>
        <div class="heading">% of recovered cases from COVID-19 in each country</div>
        <div id='graphTwo'><!-- Plotly chart will be drawn inside this DIV --></div>
    </body>

    <?php
        include 'config.php';

        $countries = array();
        $recoveredPpl = array();

        $sql = "SELECT country, SUM(recovered) as recovered, SUM(confirmed) as confirmed
                FROM statistics 
                WHERE csv_date = '03-21-2020' AND confirmed != 0  GROUP BY country";
        $stm = $connect->query($sql);
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);


        foreach ($result as $coronaRow)
        {
            $temp = 0;
            //printf($coronaRow['country']." ".$coronaRow['confirmed']." ".$coronaRow['recovered']."<br>");

            if($coronaRow['recovered'] != 0)
            {
                $temp = round(($coronaRow['recovered'] * 100) / $coronaRow['confirmed'],2);
                array_push($countries, $coronaRow['country']);
                array_push($recoveredPpl, $temp);
            }
        }
    ?>

    <script type="text/javascript">
        var x = <?php echo json_encode($countries); ?>;
        var y = <?php echo json_encode($recoveredPpl); ?>;

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

        Plotly.newPlot('graphTwo', data);
    </script>
</html>