<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Zadanie6 - Lukáš Bača</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Spirax" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="textArea">
                <div>
                    <h5>Zadaj dátum</h5>
                    <form action="#" method="GET"><br>
                        <input type="date" id="input1" name="datum" class="inputFields" required>
                    </form>

                    <button id="send1" class="buttons">Send</button>
                </div>

                <div class="borders">
                    <h5>Zadaj meno a štát</h5>
                    <form action="#" method="GET"><br>
                        <select name="state" id="input3" class="droptd">
                            <option value="SK" selected>SK</option>
                            <option value="CZ">CZ</option>
                            <option value="HU">HU</option>
                            <option value="PL">PL</option>
                            <option value="AT">AT</option>
                        </select>
                        <input type="text" id="input2" name="name" placeholder="Meno" class="inputFields" required>
                    </form>

                    <button id="send2" class="buttons">Send</button>
                </div>

                <div class="borders">
                    <h5 id="xxx">Vyber krajinu</h5>
                    <form action="#" method="GET">
                        <select name="sviatky" id="input4" class="droptd">
                            <option value="SKsviatky" selected>SK sviatky</option>
                            <option value="CZsviatky">CZ sviatky</option>
                            <option value="SKdni">SK dni</option>
                        </select>
                    </form>

                    <button id="send3" class="buttons">Send</button>
                </div>

                <div class="borders">
                    <h5>Zadaj meno a deň, ktoré chceš insertnúť</h5>
                    <form action="#" method="POST"><br>
                        <input type="text" name="meno" id="input5" placeholder="Meno" class="inputFields" required>
                        <input type="date" name="den" id="input6" class="inputFields" required>
                    </form>

                    <button id="send4" class="buttons">Insert</button>
                </div>
            </div>

            <div id="result" class="show"></div>
        </div>

        <div id="id01" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>

                    <h2 id="modalHeader">API</h2>

                    <div class="task">
                        <h3 class="taskHeader">Úloha a) - meniny podľa zadaného dátumu</h3>
                        <p>Metóda: GET</p>
                        <p>Metóda vráti všetky mená v jednotlivých krajinách, ktoré vyhovujú pre zadaný dátum. <br> Parametrom metódy je dátum.</p>
                        <p>Príklad: <a href="https://wt177.fei.stuba.sk:4577/zadanie6/index2.php/den/1018" class="taskLink">URL: https://wt177.fei.stuba.sk:4577/zadanie6/index2.php/den/1018</a></p>
                    </div>

                    <div class="task">
                        <h3 class="taskHeader">Úloha b) - dátum podľa zadaného mena a štátu</h3>
                        <p>Metóda: GET</p>
                        <p>Metóda vráti dátum, v ktorý ma zadané meno v zadanej krajine meniny. Meno sa musí písať s veľkým začiatočným písmenom a diakritikou. <br> Parametrom metódy je dátum a štát.</p>
                        <p>Príklad: <a href="https://wt177.fei.stuba.sk:4577/zadanie6/index2.php/meno/Luk%C3%A1%C5%A1/stat/SK" class="taskLink">URL: https://wt177.fei.stuba.sk:4577/zadanie6/index2.php/meno/Luk%C3%A1%C5%A1/stat/SK</a></p>
                    </div>

                    <div class="task">
                        <h3 class="taskHeader">Úlohy c), d), e) - sviatky a pamätné dni</h3>
                        <p>Metóda: GET</p>
                        <p>Metóda vráti sviatky podľa zvoleného štátu (SK, CZ), alebo pamätné dni na SK. Sviatky a pamätné dni sa zobrazia spolu s dátumom, na ktorý pripadajú. <br> Parametrom metódy je štát.</p>
                        <p>Príklad: <a href="https://wt177.fei.stuba.sk:4577/zadanie6/index2.php/sviatok/SKsviatky" class="taskLink">URL: https://wt177.fei.stuba.sk:4577/zadanie6/index2.php/sviatok/SKsviatky</a></p>
                    </div>

                    <div class="task">
                        <h3 class="taskHeader">Úlohy f) - vloženie mena do kalendára</h3>
                        <p>Metóda: POST</p>
                        <p>Metóda zapíše do XML dokumentu zadané meno. Meno sa zapíše do elementu <SKd> v deň, ktorý sa taktiež zadal. <br> Parametrom metódy je meno a dátum.</p>
                        <p>Príklad: <a href="https://wt177.fei.stuba.sk:4577/zadanie6/index2.php/name/AndrejDanko/day/0202" class="taskLink">URL: https://wt177.fei.stuba.sk:4577/zadanie6/index2.php/name/AndrejDanko/day/0202</a></p>
                    </div>
                </div>
            </div>
        </div>
        <script src="script.js"></script>
    </body>

    <footer>
        <div class="left">
            <a href="#" onclick="document.getElementById('id01').style.display='block'" id="leftButton">popis API</a>
        </div>

        <div class="right">
            © Lukáš Bača
        </div>
    </footer>
</html>