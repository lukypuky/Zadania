<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Zadanie5 - Lukáš Bača</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src='https://cdn.plot.ly/plotly-latest.min.js'></script>
    </head>

    <body>
        <iframe name="content" style="display: none">
        </iframe>

        <div class="container">
            <form method="post" target="content">
                <div class="input-group">
                    <input type="text" name="a_value" class="in" placeholder="'a' parameter">
                </div>
                <div class="input-group">
                    <button type="submit" name="set_parameter" class="btn">Set parameter</button>
                </div>
            </form>

            <form>
                <div class="inline">
                    <input type="checkbox" id="trace1" name="trace1" checked>
                    <label for="trace1">Show sin(ax)</label><br>
                </div>
                <div class="inline">
                    <input type="checkbox" id="trace2" name="trace2" checked>
                    <label for="trace2">Show cos(ax)</label><br>
                </div>
                <div class="inline">
                    <input type="checkbox" id="trace3" name="trace3" checked>
                    <label for="trace3">Show sin(ax)cos(ax)</label><br>
                </div>
            </form>
        </div>

        <?php
            include "config.php";

            $sql = "SELECT * FROM a_parameter";
            $stm = $connect->query($sql);
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);

            if($result)
            {
                $sql2 = "TRUNCATE TABLE a_parameter";
                $stm2 = $connect->query($sql2);
            }

            if(isset($_POST['set_parameter']))
            {
                $parameter = $_POST['a_value'];
                $sql3 = "INSERT INTO a_parameter (value) 
                             VALUES ('$parameter')";

                $stm3 = $connect->query($sql3);
            }
        ?>

        <div id="result" style="display:none;"></div>

        <div id="chart"></div>

        <div class="stats">
            <h4 id="xStat"></h4>
            <h4 id="y1Stat"></h4>
            <h4 id="y2Stat"></h4>
            <h4 id="y3Stat"></h4>
            <h4 id="aStat"></h4>
        </div>

        <script type="text/javascript">
            var graphX = [];
            var graphY1 = [];
            var graphY2 = [];
            var graphY3 = [];
            var graphData = [];

            if(typeof(EventSource) !== "undefined")
            {
                var source = new EventSource("stream.php");

                source.addEventListener("message", function(e)
                {
                    var data = JSON.parse(e.data);
                    document.getElementById("result").innerHTML = e.data;

                    //console.log(data);

                    graphX.push(data.x);
                    graphY1.push(data.y1);
                    graphY2.push(data.y2);
                    graphY3.push(data.y3);

                    var trace1 =
                        {
                            x: graphX,
                            y: graphY1,
                            name: 'sin(ax)',
                            type: 'scatter'
                        };

                    var trace2 =
                        {
                            x: graphX,
                            y: graphY2,
                            name: 'cos(ax)',
                            type: 'scatter'
                        };

                    var trace3 =
                        {
                            x: graphX,
                            y: graphY3,
                            name: 'sin(ax)cos(ax)',
                            type: 'scatter'
                        };

                    if(document.getElementById('trace1').checked)
                    {
                        graphData.push(trace1);
                        document.getElementById('y1Stat').innerHTML = "Y1:" + data.y1;
                    }

                    else
                    {
                        document.getElementById('y1Stat').innerHTML = "Y1:";
                    }

                    if(document.getElementById('trace2').checked)
                    {
                        graphData.push(trace2);
                        document.getElementById('y2Stat').innerHTML = "Y2:" + data.y2;
                    }

                    else
                    {
                        document.getElementById('y2Stat').innerHTML = "Y2:";
                    }

                    if(document.getElementById('trace3').checked)
                    {
                        graphData.push(trace3);
                        document.getElementById('y3Stat').innerHTML = "Y3:" + data.y3;
                    }

                    else
                    {
                        document.getElementById('y3Stat').innerHTML = "Y3:";
                    }

                    Plotly.newPlot('chart', graphData);
                    graphData = [];
                    document.getElementById('xStat').innerHTML = "X:" + data.x;
                    document.getElementById('aStat').innerHTML = "A:" + data.a;

                }, false);
            }

            else
            {
                document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
            }
        </script>
    </body>
</html>