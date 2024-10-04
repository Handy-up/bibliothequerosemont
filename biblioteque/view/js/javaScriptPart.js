// Notification et demandes

let switchebtn = document.getElementById("flexSwitchCheckDefault");
let labelVal = document.getElementById("labelNotif");
let titreBalise = document.getElementById("titre");
let boxNotifs = document.getElementById("my_notifs");
let boxDemande = document.getElementById("my_demande");

switchebtn.addEventListener("change", function () {
    if (this.checked) {
        labelVal.innerText = "Afficher les notifications";
        titreBalise.innerText = "Demandes";
        boxNotifs.classList.add("d-none");
        boxDemande.classList.remove("d-none")
    } else {
        boxDemande.classList.add("d-none")
        boxNotifs.classList.remove("d-none");
        labelVal.innerText = "Afficher les demandes";
        titreBalise.innerText = "Notifications";
    }
});

