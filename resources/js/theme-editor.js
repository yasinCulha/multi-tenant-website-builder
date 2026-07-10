const changedFields = {};

document.addEventListener("DOMContentLoaded", () => {
    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    */

    const menuItems = document.querySelectorAll(".menu-item");
    const panels = document.querySelectorAll(".editor-panel");

    function showPanel(panelName) {
        panels.forEach((panel) => {
            panel.classList.remove("active-panel");
        });

        menuItems.forEach((item) => {
            item.classList.remove("active");
        });

        const panel = document.getElementById(panelName + "-panel");

        if (panel) {
            panel.classList.add("active-panel");
        }

        const activeButton = document.querySelector(
            `[data-panel="${panelName}"]`,
        );

        if (activeButton) {
            activeButton.classList.add("active");
        }
    }

    showPanel("general");

    menuItems.forEach((item) => {
        item.addEventListener("click", () => {
            showPanel(item.dataset.panel);
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Live Preview
    |--------------------------------------------------------------------------
    */

    const iframe = document.getElementById("previewFrame");

    if (!iframe) {
        console.warn("Preview iframe bulunamadı.");
        return;
    }

    iframe.addEventListener("load", () => {
        console.log("Preview hazır.");
        console.log("Iframe yüklendi");

        const iframeDocument =
            iframe.contentDocument || iframe.contentWindow.document;

        document.querySelectorAll(".editor-field").forEach((field) => {
            const updateField = function () {
                const path = this.dataset.path;
                const value = this.value;

                setNestedValue(changedFields, path, value);

                const elements = iframeDocument.querySelectorAll(
                    `[data-bind="${path}"]`,
                );

                elements.forEach((element) => {
                    if (element.hasAttribute("data-bind-style")) {
                        const property =
                            element.getAttribute("data-bind-style");

                        element.style[property] = value;

                        return;
                    }

                    if (element.hasAttribute("data-bind-attr")) {
                        const attr = element.getAttribute("data-bind-attr");

                        element.setAttribute(attr, value);

                        return;
                    }
                    if (path.startsWith("modules.")) {
                        iframe.contentWindow.location.reload();
                        return;
                    }

                    element.textContent = value;
                });
            };

            field.addEventListener("input", updateField);

            field.addEventListener("change", updateField);
        });
    });
});
// ------------------------------------------------------------------------------------------------------------------------
// Theme Save Button
// ------------------------------------------------------------------------------------------------------------------------
const saveButton = document.getElementById("saveThemeButton");

if (saveButton) {
    saveButton.addEventListener("click", function () {
        console.log(changedFields);
        fetch("/company/theme/save", {
            method: "POST",

            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
            },

            body: JSON.stringify({
                settings: changedFields,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);

                if (data.success) {
                    alert("Tema başarıyla kaydedildi.");
                } else {
                    alert("Kaydetme başarısız.");
                }
            })
            .catch((error) => {
                console.error(error);
                alert("❌ Bir hata oluştu.");
            });
    });
}
function setNestedValue(obj, path, value) {
    const keys = path.split(".");

    let current = obj;

    keys.forEach((key, index) => {
        if (index === keys.length - 1) {
            current[key] = value;
        } else {
            current[key] = current[key] || {};

            current = current[key];
        }
    });
}
// --------------------------------------------------------------------------------------------------
// Responsive View Controller
// --------------------------------------------------------------------------------------------------

const deviceButtons = document.querySelectorAll(".device-btn");

const browserFrame = document.getElementById("browserFrame");

deviceButtons.forEach((button) => {
    button.addEventListener("click", () => {
        deviceButtons.forEach((btn) => {
            btn.classList.remove("active");
        });

        button.classList.add("active");

        browserFrame.classList.remove("desktop", "tablet", "mobile");

        browserFrame.classList.add(button.dataset.device);
    });
});
