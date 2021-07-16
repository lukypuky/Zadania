var map;
var getIP = 'http://ip-api.com/json/';
$.getJSON(getIP).done(function(location)
{
    overenieIP(location['query']);
})

//createMarker(48.151702,17.072934);

function nacitatData()
{
    $.getJSON(getIP).done(function(location)
    {
        $("#IP").append(location['query']);
        $("#lat").append(location['lat']);
        $("#long").append(location['lon']);
        $("#position").append(location['city']);
        $("#country").append(location['country']);
        hlavnemesto(location['country']);
        vypis_krajiny(location);
        vytvor_tabulku();
        zisti_suradnice();
    })

    var openWeatherMap = 'http://api.openweathermap.org/data/2.5/weather'
    $.getJSON(getIP).done(function(location)
    {
        $("#ip").append(location['query']);
        $.getJSON(openWeatherMap, {
            lat: location.lat,
            lon: location.lon,
            units: 'metric',
            APPID: 'c45ba3be74c1291279ba6276fd238d93'
        }).done(function(weather)
        {
            $("#poloha").append(weather['name']);
            $("#teplota").append(weather['main']['temp'] +"°C");
            $("#maxteplota").append(weather['main']['temp_max'] +"°C");
            $("#minteplota").append(weather['main']['temp_min'] +"°C");
            $("#vlhkost").append(weather['main']['humidity']+" %");
            $("#tlak").append(weather['main']['pressure'] +" hPa");
            $("#oblacnost").append(weather['clouds']['all']+" %");
            var Vychod=new Date(Number(weather['sys']['sunrise'])*1000);
            var vych_slnka=Vychod.getHours()+":"+Vychod.getMinutes()+":"+Vychod.getSeconds();
            $("#vychod").append(vych_slnka);
            var Zapad=new Date(Number(weather['sys']['sunset'])*1000);
            var zap_slnka=Zapad.getHours()+":"+Zapad.getMinutes()+":"+Zapad.getSeconds();
            $("#zapad").append(zap_slnka);
            $("#rychlost").append(weather['wind']['speed']+" m/s");
            $("#orientacia").append(weather['wind']['deg']+"°");
        })
    })
}

function overenieIP(ipAdd)
{
    $.ajax
    ({
        url: "function.php",
        type: "POST",
        data: {"IP":ipAdd},
        success: function (response)
        {
            console.log(response);
            if (response == 0)
            {
                console.log("ip este nepotvrdena");
                console.log(ipAdd);

                if(confirm("Súhlasíte so spracovaním IP adresy a GPS súradníc ?"))
                {
                    console.log("potvrdil");
                    nacitatData();
                }

                else
                {
                    console.log("nepotvrdil");
                    document.getElementById("nepotvrdene").style.display = "block";
                }
            }

            else
            {
                console.log("ip je uz potvrdena");
                console.log(ipAdd);
                nacitatData();
            }
        },
        error: function()
        {
            console.log("Chyba");
        }
    });
}

function hlavnemesto(stat)
{
    $.ajax
    ({
        url: "https://restcountries.eu/rest/v2/name/"+stat,
        type: "GET",
        success: function (response)
        {
            $("#capital").append(response[0]['capital']);
        },
        error: function()
        {
            console.log("Chyba");
        }
    });
}

function vypis_krajiny(location)
{
    $.ajax
    ({
        url: "function.php",
        type: "POST",
        data: {"location":location},
        success: function (response)
        {
            console.log(response);
        },
        error: function()
        {
            console.log("Chyba");
        }
    });
}

function vytvor_tabulku()
{
    $.ajax
    ({
        url: "function.php",
        type: "POST",
        data: {"tabulka":"tabulka"},
        success: function (response)
        {
            $("#vypisTabulku").append(response);
        },
        error: function()
        {
            console.log("Chyba");
        }
    });
}

function vytvor_prehlad(country)
{
    $.ajax
    ({
        url: "function.php",
        type: "POST",
        data: {"country":country},
        success: function (response)
        {
            console.log(response);
            document.getElementById('id01').style.display='block';
            $("#prehlad").empty();
            $("#prehlad").append(response);
        },
        error: function()
        {
            console.log("Chyba");
        }
    });
}

function zisti_suradnice()
{
    $.ajax
    ({
        url: "function.php",
        type: "POST",
        data: {"mapa":"mapa"},
        success: function (response)
        {
            console.log(response);
            initMap(JSON.parse(response));
        },
        error: function()
        {
            console.log("Chyba");
        }
    });
}

function initMap(suradnice)
{
    var bratislava = { lat: 48.151702, lng: 17.072934};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 6,
        center: bratislava,
    });

    suradnice.forEach(function(object){
    createMarker(object[0],object[1]);
    })
}

function createMarker(lat,lon)
{
    var mojesuradnice={lat: Number(lat), lng: Number(lon)};
    console.log(mojesuradnice);

    var marker = new google.maps.Marker
    ({
        position: mojesuradnice,
        map:map
    });

    marker.setMap(map);
};
