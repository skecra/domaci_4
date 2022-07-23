new TomSelect("#select-klijent",{
    create: false,
    sortField: {
        field: "text",
        direction: "asc"
    }
});

new TomSelect("#proizvodjac",{
    create: false,
    sortField: {
        field: "text",
        direction: "asc"
    }
});


var baseUrl = "http://localhost/rentAcar/";

async function prikaziCijenu(){
    let vozilo_id = window.location.href.slice(-2);
    let datum_od = document.getElementById("datum_od").value;
    let datum_do = document.getElementById("datum_do").value;
    let response = await fetch("http://localhost/rentAcar/ukupnaCijena.php?vozilo_id="+vozilo_id+"&&datum_od="+datum_od+"&&datum_do="+datum_do);
    let rezultat = await response.json();

    document.getElementById("ukupnaCijena").value = rezultat[0];
}



