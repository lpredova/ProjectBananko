$(document).ready(function () {

    $("#korime").focusout(function () {
        var url = "/WebDiP/2014_projekti/WebDiP2014x043/api/login.php "
        var korisnik = $("#korime").val()

        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'text',
            data: {
                'korisnik': korisnik,
                'korisnik_zauzet': "1"
            },
            success: function (data) {
                var json = $.parseJSON(data);
                console.log(json["zauzet"]);
                if (parseInt(json["zauzet"]) == 1) {
                    $("#zauzeto").text("Korisnicko ime je zauzeto!")
                }
                else {
                    $("#zauzeto").text("")
                }

            }
        })
    })
})
