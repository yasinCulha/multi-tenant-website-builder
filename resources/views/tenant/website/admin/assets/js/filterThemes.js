function filterThemes() {
    const aramaInput = document.getElementById("temaAramaInput");

    if (!aramaInput) return;

    const aramaMetni = aramaInput.value.toLowerCase();

    const temaKartlari = document.querySelectorAll(".row-cols-lg-4 > .col");

    temaKartlari.forEach((kart) => {
        const temaAdiEtiketi = kart.querySelector(".card-title");

        if (!temaAdiEtiketi) return;

        const temaAdi = temaAdiEtiketi.textContent.toLowerCase();

        if (temaAdi.includes(aramaMetni)) {
            kart.style.removeProperty("display");
        } else {
            kart.style.display = "none";
        }
    });
}

window.filterThemes = filterThemes;
