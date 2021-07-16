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

    <?php
        include 'config.php';

        $countries = array();

        $sql2 = "SELECT DISTINCT country 
                FROM statistics 
                ORDER BY country ASC";
        $stm2 = $connect->query($sql2);
        $result2 = $stm2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result2 as $row)
        {
           array_push($countries, $row['country']);
        }
    ?>
    <header>
        <nav>
            <a href="index.php" class="menu">Corona Stats</a>
            <a href="population.php" class="menu">World Population</a>
            <a href="graphOne.php" class="menu">Graph A</a>
            <a href="graphTwo.php" class="menu">Graph B</a>
            <a href="graphThree.php" class="menu">Graph C</a>
            <a href="graphFour.php" class="active">Graph D</a>

            <div>
                <form method="post">
                    <select name="countriesList" id="countriesList">
                        <option>Country</option>
                        <?php
                        foreach ($countries as $country)
                        {
                            ?>
                            <option value="<?php echo $country ?>"><?php echo $country ?></option>
                        <?php }?>
                    </select>

                    <button type="submit" name="submit" class="buttons" id="choose">Choose</button>
                </form>
            </div>
        </nav>
    </header>

    <body>
        <div class="heading">New Confirmed, Deaths and Recovered cases by date in <?php $selectedCountry = $_POST['countriesList']; echo $selectedCountry ?></div>
        <div id='graphFour'><!-- Plotly chart will be drawn inside this DIV --></div>
    </body>

    <?php
        include 'config.php';

        $today="2020-01-22";
        //$breakDate = "03-01-2020";

        $confirmed = array();
        $deathPpl = array();
        $recoveredPpl = array();
        $dates = array();

        $selectedCountry = $_POST['countriesList'];

        for($x=0; $x < 60; $x++)
        {
            $nextday = strftime("%m-%d-%Y", strtotime("$today +$x day"));

            $sql = "SELECT country, SUM(confirmed) as confirmed, SUM(deaths) as deaths, SUM(recovered) as recovered
                    FROM statistics 
                    WHERE csv_date = '$nextday' AND country = '$selectedCountry' GROUP BY country";
            $stm = $connect->query($sql);
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $coronaRow)
            {
                array_push($confirmed, $coronaRow['confirmed']);
                array_push($deathPpl, $coronaRow['deaths']);
                array_push($recoveredPpl, $coronaRow['recovered']);
                //printf($nextday." ".$coronaRow['country']." ".$coronaRow['confirmed']." ".$coronaRow['deaths']." ".$coronaRow['recovered']."<br>");

                $a = $coronaRow['confirmed'];
                $b = $coronaRow['deaths'];
                $c = $coronaRow['recovered'];
            }

            array_push($dates, $nextday);
        }
    ?>
    <div class="stats">
        <h3 class="xxx">Country: <?php echo $selectedCountry; ?></h3>
        <p class="confirm">Confirmed: <?php echo $a; ?></p>
        <p class="dead">Deaths: <?php echo $b; ?></p>
        <p class="recover">Recovered: <?php echo $c; ?></p>
    </div>

    <script type="text/javascript">

        var w = <?php echo json_encode($dates); ?>;
        var x = <?php echo json_encode($confirmed); ?>;
        var y = <?php echo json_encode($deathPpl); ?>;
        var z = <?php echo json_encode($recoveredPpl); ?>;

        wData = [];
        xData = [];
        yData = [];
        zData = [];

        for(var i = 0; i < w.length; i++)
        {
            wData.push(w[i]);
            console.log(wData.length);
        }

        for(var i = 0; i < x.length; i++)
        {
            xData.push(x[i]);
            yData.push(y[i]);
            zData.push(z[i]);
        }

        var trace1 =
            {
            x: wData,
            y: xData,
            name: 'Confirmed',
            type: 'scatter'
        };

        var trace2 = {
            x: wData,
            y: yData,
            name: 'Deaths',
            type: 'scatter'
        };

        var trace3 = {
            x: wData,
            y: zData,
            name: 'Recovered',
            type: 'scatter'
        };

        var data = [trace1, trace2, trace3];

        var layout = {barmode: 'group'};

        Plotly.newPlot('graphFour', data, layout);
    </script>
</html>