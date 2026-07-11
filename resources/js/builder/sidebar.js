const slugify = (value) => value
    .toString()
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .replace(/ı/g, "i")
    .replace(/İ/g, "i")
    .toLowerCase()
    .trim()
    .replace(/[^a-z0-9]+/g, "-")
    .replace(/^-+|-+$/g, "");

const csrfToken = () => document.querySelector('meta[name="csrf-token"]')?.content ?? "";

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
    currentModal.querySelector("[data-new-page-error]")?.setAttribute("hidden", "hidden");
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
        select.append(new Option(`${page.dataset.pageTitle}'dan Sonra`, `after:${page.dataset.pageId}`));
    });

    select.append(new Option("Listenin Sonuna", "end"));
    select.value = [...select.options].some((option) => option.value === selected) ? selected : "end";
};

const setError = (message) => {
    const error = document.querySelector("[data-new-page-error]");

    if (!error) {
        return;
    }

    error.textContent = message;
    error.removeAttribute("hidden");
};

document.addEventListener("click", async (event) => {
    const openButton = event.target.closest("[data-open-new-page-modal]");
    const closeButton = event.target.closest("[data-close-new-page-modal]");
    const pageLink = event.target.closest("[data-page-link]");

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
                "Accept": "application/json",
            },
        });

        if (!response.ok) {
            window.location.href = pageLink.href;
            return;
        }

        replaceBuilderFragments(await response.json());
        window.history.pushState({}, "", pageLink.href);
    }
});

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
            page.hidden = term && !page.dataset.pageTitle.toLowerCase().includes(term);
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
                "Accept": "application/json",
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
            window.history.pushState({}, "", `/company/builder?page=${payload.page.slug}`);
        }
    } catch (error) {
        setError("Beklenmeyen bir hata olustu.");
    } finally {
        submitButton.disabled = false;
    }
});
