$(document).ready(function()
{
	$("#send1").click(function()
    {
        var den=$('#input1').val();
        var day = den.substr(8,2);
        var month = den.substr(5,2);
        den = month.concat(day);

        $.ajax
        ({
            url: "index2.php/den/"+den,
            type: "GET",

            success: function (response)
            {
                $('#result').empty();
                $('#result').append(response);
            },
            error: function()
            {
                console.log("Chyba");
            }
        });
	});


	$('#send2').click(function()
    {
		var meno=$('#input2').val();
		var stat=$('#input3').val();
		var url="index2.php/meno/"+meno+"/stat/"+stat;
		console.log(url);
		$.ajax
        ({
            url: url,
            type: "GET",

                success: function (response)
            {
                $('#result').empty();
                $('#result').append(response);
            },
            error: function()
            {
                console.log("Chyba");
            }
	    });
	});

	$("#send3").click(function()
    {
        var sviatok=$('#input4').val();
        $.ajax
        ({
            url: "index2.php/sviatok/"+sviatok,
            type: "GET",
            success: function (response)
            {
                $('#result').empty();
                $('#result').append(response);
            },
            error: function()
            {
                console.log("Chyba");
            }
        });
	});


	$("#send4").click(function()
    {
        var name=$('#input5').val();
        var den=$('#input6').val();
        var day = den.substr(8,2);
        var month = den.substr(5,2);
        den = month.concat(day);

        var url="index2.php/name/"+name+"/day/"+den;
        $.ajax
        ({
            url: url,
            type: "POST",
            success: function (response)
            {
                console.log(response);
            },
            error: function()
            {
                console.log("Chyba");
            }

        });
	});
});







