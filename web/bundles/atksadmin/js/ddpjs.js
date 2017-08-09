$(document).ready(
        function() {
            if (!localStorage.rayon) {
                localStorage.setItem('rayon', 25);
            }
            if (!localStorage.latitude) {
                localStorage.setItem('latitude', '');
            }
            if (!localStorage.longitude) {
                localStorage.setItem('longitude', '');
            }
            if (!localStorage.altitude) {
                localStorage.setItem('altitude', '');
            }
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(affichePosition, erreurGeo);
            } else {
                console.log("Non");
            }
            $("#input-rayon").attr('value', localStorage.getItem('rayon'));
            $("#input-lon").attr('value', localStorage.getItem('longitude'));
            $("#input-lat").attr('value', localStorage.getItem('latitude'));

            $("#rating_2").rating({
                static: false,
                score: 0,
                stars: 5,
                showHint: true,
                showScore: false,
                hints: ['Très mauvais', 'Mauvais', 'Moyen', 'Bon', 'Très bon'],
                click: function(value, rating) {
                    alert(value);
                    rating.rate(value);
                }
            });
        });

function affichePosition(position) {
    localStorage.setItem('latitude', position.coords.latitude);
    localStorage.setItem('longitude', position.coords.longitude);
    localStorage.setItem('altitude', position.coords.altitude);
    console.log("precision = " + position.coords.accuracy + " m");
    var queryAll = document.querySelectorAll('.element-link');
    for (var i = 0; i < queryAll.length; i++) {
        queryAll[i].setAttribute('href', queryAll[i].getAttribute('href') + "?lat=" + position.coords.latitude + "&lon=" + position.coords.longitude + "&rayon=" + localStorage.getItem("rayon"));
    }
}

function erreurGeo(error) {
    var caption = "Erreur lors de la géolocalisation : ";
    switch (error.code) {
        case error.TIMEOUT:
            var info = "Le temps imparti est écoulé sans qu’une position ne soit obtenue";
            $.Notify({style: {background: 'red', color: 'white'}, caption: caption, content: info, timeout: 5000});
            break;
        case error.PERMISSION_DENIED:
            var info = " La localisation a échoué car le navigateur n\'a pas obtenu votre permission ";
            $.Notify({style: {background: 'red', color: 'white'}, caption: caption, content: info, timeout: 5000});
            break;
        case error.POSITION_UNAVAILABLE:
            var info = "La position n’a pu être déterminée";
            $.Notify({style: {background: 'red', color: 'white'}, caption: caption, content: info, timeout: 5000});
            break;
        case error.UNKNOWN_ERROR:
            var info = "Erreur inconnue";
            $.Notify({style: {background: 'red', color: 'white'}, caption: caption, content: info, timeout: 5000});
            break;
    }
}

function setRayonRecherche() {
    var r = document.getElementById("input-rayon-setting");
    alert(cleanRayonNumber(r.value));
//    if (cleanRayonNumber(r.value) !== "no") {
//        localStorage.setItem('rayon', cleanRayonNumber(r.value));
//    }else{
//        $.Notify({style: {background: 'red', color: 'white'}, caption: "Erreur : ", content: "Le rayon doit être numérique", timeout: 5000});
//    }
}

function cleanRayonNumber(rayon) {
    var cleanRayonNumber = "";
    for (var i = 0; i < rayon.length; i++) {
        var character = rayon.charAt(i);
        if (IsDigit(character)) {
            cleanRayonNumber += character;
        } else {
            return "no";
        }
    }
    return cleanRayonNumber;
}

function IsDigit(ch) {
    if (ch < '0' || ch > '9') {
        return false;
    } else {

        return true;
    }
}

function autoLoadCoords() {
    $("#atks_adminbundle_hopitaluser_longitude").attr('value', localStorage.getItem('longitude'));
    $("#atks_adminbundle_hopitaluser_latitude").attr('value', localStorage.getItem('latitude'));
    $("#atks_adminbundle_hopitaluser_altitude").attr('value', localStorage.getItem('altitude'));
}
function autoLoadPharmacieCoords() {
    $("#atks_adminbundle_pharmacieuser_longitude").attr('value', localStorage.getItem('longitude'));
    $("#atks_adminbundle_pharmacieuser_latitude").attr('value', localStorage.getItem('latitude'));
}