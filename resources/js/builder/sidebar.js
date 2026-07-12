const slugify = (value) =>
    value
        .toString()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .replace(/ı/g, "i")
        .replace(/İ/g, "i")
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9]+/g, "-")
        .replace(/^-+|-+$/g, "");

const csrfToken = () =>
    document.querySelector('meta[name="csrf-token"]')?.content ?? "";

const replaceBuilderFragments = (payload) => {
    const sidebar = document.querySelector("[data-builder-sidebar]");
    const preview = document.querySelector(".builder-preview");
    const settings = document.querySelector("[data-builder-settings]");

    if (sidebar && payload.sidebar) {
        sidebar.outerHTML = payload.sidebar;
    }

    if (preview && payload.preview) {
        preview.outerHTML = payload.preview;
    }

    if (settings && payload.settings) {
        settings.outerHTML = payload.settings;
    }

    if (payload.currentPage?.slug) {
        refreshPreviewFrame(payload.currentPage.slug);
    }

    bindPreviewFrameActions();
};

const refreshPreviewFrame = (pageSlug) => {
    const frame = document.querySelector("[data-builder-preview-frame]");
    const address = document.querySelector("[data-preview-address]");

    if (!frame || !pageSlug) {
        return;
    }

    const previewUrl = `/company/builder/preview?page=${encodeURIComponent(pageSlug)}&v=${Date.now()}`;
    bindPreviewFrameActions();
    frame.src = previewUrl;

    if (address) {
        address.textContent = previewUrl;
    }
};

const modal = () => document.querySelector("[data-builder-modal]");

const openNewPageModal = () => {
    const currentModal = modal();

    if (!currentModal) {
        return;
    }

    currentModal.classList.add("is-open");
    currentModal.setAttribute("aria-hidden", "false");
    currentModal.querySelector("[data-page-title-input]")?.focus();
};

const closeNewPageModal = () => {
    const currentModal = modal();

    if (!currentModal) {
        return;
    }

    currentModal.classList.remove("is-open");
    currentModal.setAttribute("aria-hidden", "true");
    currentModal.querySelector("[data-new-page-form]")?.reset();
    currentModal
        .querySelector("[data-new-page-error]")
        ?.setAttribute("hidden", "hidden");
};

const refreshPositionOptions = () => {
    const select = document.querySelector("[data-page-position-select]");

    if (!select) {
        return;
    }

    const pages = [...document.querySelectorAll("[data-page-link]")];
    const selected = select.value || "end";

    select.innerHTML = "";
    select.append(new Option("Listenin Basina", "start"));

    pages.forEach((page) => {
        select.append(
            new Option(
                `${page.dataset.pageTitle}'dan Sonra`,
                `after:${page.dataset.pageId}`,
            ),
        );
    });

    select.append(new Option("Listenin Sonuna", "end"));
    select.value = [...select.options].some(
        (option) => option.value === selected,
    )
        ? selected
        : "end";
};

const setError = (message) => {
    const error = document.querySelector("[data-new-page-error]");

    if (!error) {
        return;
    }

    error.textContent = message;
    error.removeAttribute("hidden");
};

const showBuilderNotice = (message, type = "success") => {
    let notice = document.querySelector("[data-builder-notice]");

    if (!notice) {
        notice = document.createElement("div");
        notice.dataset.builderNotice = "";
        notice.className = "builder-notice";
        document.body.appendChild(notice);
    }

    notice.textContent = message;
    notice.dataset.type = type;
    notice.classList.add("is-visible");

    window.clearTimeout(showBuilderNotice.timeout);
    showBuilderNotice.timeout = window.setTimeout(() => {
        notice.classList.remove("is-visible");
    }, 3200);
};

const requestJson = async (url, options = {}) => {
    const response = await fetch(url, {
        headers: {
            "X-CSRF-TOKEN": csrfToken(),
            "X-Requested-With": "XMLHttpRequest",
            Accept: "application/json",
            ...(options.headers || {}),
        },
        ...options,
    });

    const payload = await response.json();

    if (!response.ok || payload.success === false) {
        throw new Error(payload.message || "Islem tamamlanamadi.");
    }

    return payload;
};

const activePageLink = () =>
    document.querySelector("[data-page-link].active") ??
    document.querySelector(".page-item.active [data-page-link]");

const addModuleToCurrentPage = async (button) => {
    const pageLink = activePageLink();

    if (!pageLink) {
        showBuilderNotice("Once bir sayfa secin.", "error");
        return;
    }

    button.disabled = true;

    try {
        const payload = await requestJson("/company/page-builder/add-module", {
            method: "POST",
            body: new URLSearchParams({
                page_id: pageLink.dataset.pageId,
                theme_page_module_id: button.dataset.moduleId,
            }),
        });

        replaceBuilderFragments(payload);
        showBuilderNotice(payload.message || "Modul eklendi.", "success");
    } catch (error) {
        showBuilderNotice(error.message || "Modul eklenemedi.", "error");
    } finally {
        button.disabled = false;
    }
};

const deleteCurrentPage = async (button) => {
    if (!window.confirm("Bu sayfa ve modulleri silinsin mi?")) {
        return;
    }

    button.disabled = true;

    try {
        const payload = await requestJson(
            `/company/builder/pages/${button.dataset.pageId}`,
            {
                method: "DELETE",
            },
        );

        replaceBuilderFragments(payload);
        showBuilderNotice(payload.message || "Sayfa silindi.", "success");

        if (payload.currentPage?.slug) {
            window.history.pushState(
                {},
                "",
                `/company/builder?page=${payload.currentPage.slug}`,
            );
        } else {
            window.history.pushState({}, "", "/company/builder");
        }
    } catch (error) {
        showBuilderNotice(error.message || "Sayfa silinemedi.", "error");
    } finally {
        button.disabled = false;
    }
};

document.addEventListener("click", async (event) => {
    const openButton = event.target.closest("[data-open-new-page-modal]");
    const closeButton = event.target.closest("[data-close-new-page-modal]");
    const pageLink = event.target.closest("[data-page-link]");
    const previewButton = event.target.closest("[data-live-preview-url]");
    const saveButton = event.target.closest("[data-builder-save]");
    const deviceButton = event.target.closest("[data-preview-device]");
    const addModuleButton = event.target.closest("[data-add-module]");
    const deletePageButton = event.target.closest("[data-delete-page]");

    if (deviceButton) {
        setPreviewDevice(deviceButton);
        return;
    }

    if (addModuleButton) {
        await addModuleToCurrentPage(addModuleButton);
        return;
    }

    if (deletePageButton) {
        await deleteCurrentPage(deletePageButton);
        return;
    }

    if (previewButton) {
        window.open(previewButton.dataset.livePreviewUrl, "_blank", "noopener");
        return;
    }

    if (saveButton) {
        await saveBuilderChanges(saveButton);
        return;
    }

    if (openButton) {
        refreshPositionOptions();
        openNewPageModal();
        return;
    }

    if (closeButton) {
        closeNewPageModal();
        return;
    }

    if (pageLink) {
        event.preventDefault();

        const response = await fetch(pageLink.href, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                Accept: "application/json",
            },
        });

        if (!response.ok) {
            window.location.href = pageLink.href;
            return;
        }

        const payload = await response.json();

        replaceBuilderFragments(payload);
        window.history.pushState({}, "", pageLink.href);
    }
});

const setPreviewDevice = (button) => {
    const canvas = document.querySelector("[data-preview-canvas]");

    if (!canvas) {
        return;
    }

    document
        .querySelectorAll("[data-preview-device]")
        .forEach((item) => item.classList.toggle("active", item === button));

    canvas.dataset.previewDevice = button.dataset.previewDevice;
};

const bindPreviewFrameActions = () => {
    const frame = document.querySelector("[data-builder-preview-frame]");

    if (!frame) {
        return;
    }

    if (frame.dataset.actionsBound) {
        return;
    }

    frame.dataset.actionsBound = "true";

    frame.addEventListener("load", () => {
        try {
            frame.contentDocument?.addEventListener("click", async (event) => {
                const navigationLink = event.target.closest("[data-page-slug]");
                const deleteButton = event.target.closest(
                    "[data-delete-page-module]",
                );

                if (navigationLink) {
                    event.preventDefault();

                    const pageSlug = navigationLink.dataset.pageSlug;
                    const response = await fetch(
                        `/company/builder?page=${encodeURIComponent(pageSlug)}`,
                        {
                            headers: {
                                "X-Requested-With": "XMLHttpRequest",
                                Accept: "application/json",
                            },
                        },
                    );

                    if (!response.ok) {
                        frame.src = navigationLink.href;
                        return;
                    }

                    const payload = await response.json();
                    replaceBuilderFragments(payload);
                    window.history.pushState(
                        {},
                        "",
                        `/company/builder?page=${pageSlug}`,
                    );
                    return;
                }

                if (!deleteButton) {
                    return;
                }

                event.preventDefault();
                deleteButton.disabled = true;

                try {
                    const payload = await requestJson(
                        `/company/page-builder/modules/${deleteButton.dataset.deletePageModule}`,
                        { method: "DELETE" },
                    );

                    replaceBuilderFragments(payload);
                    showBuilderNotice(
                        payload.message || "Modul silindi.",
                        "success",
                    );
                } catch (error) {
                    showBuilderNotice(
                        error.message || "Modul silinemedi.",
                        "error",
                    );
                    deleteButton.disabled = false;
                }
            });
        } catch (error) {
            showBuilderNotice("Preview islemleri baglanamadi.", "error");
        }
    });
};

const collectModuleContents = () => {
    const grouped = new Map();

    document
        .querySelectorAll("[data-page-module-id][data-field-key]")
        .forEach((field) => {
            const pageModuleId = field.dataset.pageModuleId;
            const fieldKey = field.dataset.fieldKey;

            if (!pageModuleId || !fieldKey) {
                return;
            }

            if (!grouped.has(pageModuleId)) {
                grouped.set(pageModuleId, {
                    page_module_id: Number(pageModuleId),
                    fields: {},
                });
            }

            grouped.get(pageModuleId).fields[fieldKey] =
                field.type === "checkbox" ? field.checked : field.value;
        });

    return [...grouped.values()];
};

const saveBuilderChanges = async (button) => {
    button.disabled = true;

    try {
        const response = await fetch("/company/builder/save", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken(),
                "X-Requested-With": "XMLHttpRequest",
                Accept: "application/json",
            },
            body: JSON.stringify({
                page: activePageLink()?.dataset.pageSlug,
                contents: collectModuleContents(),
            }),
        });

        const payload = await response.json();

        if (!response.ok || !payload.success) {
            showBuilderNotice(
                payload.message || "Degisiklikler kaydedilemedi.",
                "error",
            );
            throw new Error("Save failed");
        }

        showBuilderNotice(
            payload.message || "Degisiklikler basariyla kaydedildi.",
            "success",
        );

        const activePage = document.querySelector("[data-page-link].active");
        refreshPreviewFrame(activePage?.dataset.pageSlug);
    } catch (error) {
        showBuilderNotice("Degisiklikler kaydedilemedi.", "error");
    } finally {
        button.disabled = false;
    }
};

document.addEventListener("input", (event) => {
    const titleInput = event.target.closest("[data-page-title-input]");
    const slugInput = document.querySelector("[data-page-slug-input]");
    const searchInput = event.target.closest("[data-page-search]");

    if (titleInput && slugInput && !slugInput.dataset.touched) {
        slugInput.value = slugify(titleInput.value);
    }

    if (event.target.matches("[data-page-slug-input]")) {
        event.target.dataset.touched = "true";
        event.target.value = slugify(event.target.value);
    }

    if (searchInput) {
        const term = searchInput.value.toLowerCase().trim();

        document.querySelectorAll("[data-page-link]").forEach((page) => {
            page.hidden =
                term && !page.dataset.pageTitle.toLowerCase().includes(term);
        });
    }
});

document.addEventListener("submit", async (event) => {
    const form = event.target.closest("[data-new-page-form]");

    if (!form) {
        return;
    }

    event.preventDefault();

    const submitButton = form.querySelector("#createPageBtn");
    const formData = new FormData(form);

    submitButton.disabled = true;

    try {
        const response = await fetch("/company/builder/pages", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken(),
                "X-Requested-With": "XMLHttpRequest",
                Accept: "application/json",
            },
            body: formData,
        });

        const payload = await response.json();

        if (!response.ok || !payload.success) {
            setError(payload.message || "Sayfa olusturulamadi.");
            return;
        }

        replaceBuilderFragments(payload);
        closeNewPageModal();

        if (payload.page?.slug) {
            window.history.pushState(
                {},
                "",
                `/company/builder?page=${payload.page.slug}`,
            );
        }
    } catch (error) {
        setError("Beklenmeyen bir hata olustu.");
    } finally {
        submitButton.disabled = false;
    }
});
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[data-sidebar-toggle]").forEach((button) => {
        const panel = button.closest(".sidebar-panel");

        // İlk açılışta açık gelsin
        panel.classList.add("open");

        button.addEventListener("click", () => {
            panel.classList.toggle("open");
        });
    });
});

bindPreviewFrameActions();
