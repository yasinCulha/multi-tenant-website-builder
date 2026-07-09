function canliFormuGonder(event) {
    event.preventDefault();

    const form = document.getElementById("canliIletisimFormu");
    const postUrl = form.getAttribute("action");

    const formData = {
        name: document.getElementById("cName").value,
        email: document.getElementById("cEmail").value,
        subject: document.getElementById("cSubject").value,
        message: document.getElementById("cMessage").value,
    };

    const token = document.querySelector('input[name="_token"]').value;

    fetch(postUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-TOKEN": token,
        },
        body: JSON.stringify(formData),
    })
        .then((response) => {
            if (!response.ok) {
                return response.json().then((err) => {
                    throw err;
                });
            }
            return response.json();
        })
        .then((data) => {
            Swal.fire({
                icon: "success",
                title: "Başarılı!",
                text: data.message,
                confirmButtonColor: "#0f52ba",
            });
            form.reset();
        })
        .catch((error) => {
            console.error(error);

            let hataListesi = "";
            if (error.errors) {
                hataListesi = Object.values(error.errors).flat().join("<br>");
            } else {
                hataListesi =
                    error.message ||
                    "Sistemsel bir bağlantı hatası oluştu knk.";
            }

            Swal.fire({
                icon: "error",
                title: "Eksik veya Hatalı Giriş!",
                html: `<div class="text-start text-danger" style="font-size:14px; font-weight:500;">${hataListesi}</div>`,
                confirmButtonColor: "#0f52ba",
            });
        });
}
