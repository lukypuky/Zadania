<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Zadanie7 - Lukáš Bača</title>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAB1DxmfAu1o21iePrB6tTZ85REY17Htjw"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <header>
        <nav>
            <div class="buttons">
                <a href="index.php" class="menu">Počasie</a>
                <a href="userInfo.php" class="menu">Poloha</a>
                <a href="statistika.php" class="menu">Štatistika</a>
            </div>
            <h1 class="heading">Informácie o polohe používateľa</h1>
        </nav>
    </header>

    <body>
        <div id="nepotvrdene" style="display: none">
            <p>Bohužiaľ, pre sprístupnenie stránky je potrebné potvrdiť spracovanie IP adresy a GPS súradníc.</p>
        </div>

        <div class="container">
            <div class="informacie">
                <table class="table myTable">
                    <thead class="thead-dark">
                        <th>IP adresa: </th>
                        <td id="IP"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Mesto: </th>
                        <td id="position"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Krajina: </th>
                        <td id="country"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Hlavné mesto: </th>
                        <td id="capital"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Latitude: </th>
                        <td id="lat"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Longitude: </th>
                        <td id="long"></td>
                    </thead>
                </table>
            </div>
        </div>

        <script src="script.js"></script>

        <?php
            require 'config.php';

            $sql = "INSERT INTO webvisits (type) VALUES ('userInfo')";
            $stm = $connect->query($sql);
        ?>
    </body>

    <footer>
        <div class="right">
            © Lukáš Bača
        </div>
    </footer>
</html>