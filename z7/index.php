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
            <h1 class="heading">Počasie v <p id="position"> </p></h1>
        </nav>
    </header>

    <body>
        <div id="nepotvrdene" style="display: none">
            <p>Bohužiaľ, pre sprístupnenie stránky je potrebné potvrdiť spracovanie IP adresy a GPS súradníc.</p>
        </div>

        <div class="container">
            <div class="pocasie">
                <table class="table myTable">
                    <thead class="thead-dark">
                        <th>Teplota: </th>
                        <td id="teplota"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Max. teplota: </th>
                        <td id="maxteplota"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Min. teplota: </th>
                        <td id="minteplota"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Vlhkosť: </th>
                        <td id="vlhkost"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Tlak: </th>
                        <td id="tlak"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Oblačnosť: </th>
                        <td id="oblacnost"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Východ slnka: </th>
                        <td id="vychod"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Západ slnka: </th>
                        <td id="zapad"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Rýchlosť vetra: </th>
                        <td id="rychlost"></td>
                    </thead>
                    <thead class="thead-dark">
                        <th>Orientácia vetra: </th>
                        <td id="orientacia"></td>
                    </thead>
                </table>
            </div>
        </div>

        <script src="script.js"></script>

        <?php
            require 'config.php';

            $sql = "INSERT INTO webvisits (type) VALUES ('weather')";
            $stm = $connect->query($sql);
        ?>
    </body>

    <footer>
        <div class="right">
            © Lukáš Bača
        </div>
    </footer>
</html>