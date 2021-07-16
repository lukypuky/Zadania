<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Zadanie4 - Lukáš Bača</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="script.js"></script>
    </head>

    <header>
        <nav>
            <a href="index.php" class="active">Corona Stats</a>
            <a href="population.php" class="menu">World Population</a>
            <a href="graphOne.php" class="menu">Graph A</a>
            <a href="graphTwo.php" class="menu">Graph B</a>
            <a href="graphThree.php" class="menu">Graph C</a>
            <a href="graphFour.php" class="menu">Graph D</a>

            <div class="buttons_box">
                <form action="fillCorona.php">
                    <button type="submit" name="fillCorona" class="buttons">Fill Rows</button>
                </form>
                <form action="deleteCorona.php">
                    <button type="submit" name="deleteCorona" class="buttons">Delete Rows</button>
                </form>
            </div>
        </nav>
    </header>

    <?php
        include 'config.php';

       echo"
            <table class=\"table myTable\">
                <thead class=\"thead-dark\">
                    <tr>
                        <th>ID</th>
                        <th>Province/State</th>
                        <th>Country/Region</th>
                        <th>Last Update</th>
                        <th>Confirmed</th>
                        <th>Deaths</th>
                        <th>Recovered</th> 
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>CSV Date</th>
                    </tr>
                </thead>
        ";

        $sql = "SELECT * FROM statistics";
        $stm = $connect->query($sql);

        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row)
        {
            printf("<tr><td>{$row['id']}</td><td>{$row['province']}</td><td>{$row['country']}</td><td>{$row['last_update']}</td><td>{$row['confirmed']}</td>
            <td>{$row['deaths']}</td><td>{$row['recovered']}</td><td>{$row['latitude']}</td><td>{$row['longitude']}</td><td>{$row['csv_date']}</td></tr>");
        }
        echo "</table>";
    ?>
</html>