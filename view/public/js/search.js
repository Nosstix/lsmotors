(function () {
    const input = document.getElementById("navSearchInput");
    const dropdown = document.getElementById("navSearchDropdown");
    if (!input || !dropdown) return;

    let timer = null;
    let lastQuery = "";

    function hideDropdown() {
        dropdown.classList.add("d-none");
        dropdown.innerHTML = "";
    }

    function showDropdown(items, query, idCategorie) {
        if (!items.length) {
            hideDropdown();
            return;
        }

        dropdown.innerHTML = items
            .map((it) => {
                const url = new URL(window.location.origin + window.location.pathname);
                url.searchParams.set("page", "listeVehicules");
                url.searchParams.set("q", query);
                if (idCategorie) url.searchParams.set("id_categorie", idCategorie);

                return `
          <a class="search-item" href="${url.toString()}">
            ${escapeHtml(it.label)}
          </a>
        `;
            })
            .join("");

        dropdown.classList.remove("d-none");
    }

    function escapeHtml(str) {
        return String(str)
            .replaceAll("&", "&amp;")
            .replaceAll("<", "&lt;")
            .replaceAll(">", "&gt;")
            .replaceAll('"', "&quot;")
            .replaceAll("'", "&#039;");
    }

    async function fetchSuggest(query) {
        const params = new URLSearchParams(window.location.search);
        const idCategorie = params.get("id_categorie") || "";

        const url = new URL(window.location.origin + window.location.pathname);
        url.searchParams.set("page", "search_suggest");
        url.searchParams.set("q", query);
        if (idCategorie) url.searchParams.set("id_categorie", idCategorie);

        const res = await fetch(url.toString(), { headers: { "Accept": "application/json" } });
        if (!res.ok) return [];
        return { items: await res.json(), idCategorie };
    }

    input.addEventListener("input", () => {
        const q = input.value.trim();
        if (q.length < 2) {
            hideDropdown();
            return;
        }

        // anti spam serveur (debounce)
        clearTimeout(timer);
        timer = setTimeout(async () => {
            if (q === lastQuery) return;
            lastQuery = q;

            const { items, idCategorie } = await fetchSuggest(q);
            showDropdown(items, q, idCategorie);
        }, 200);
    });

    // fermer si on clique ailleurs
    document.addEventListener("click", (e) => {
        if (!dropdown.contains(e.target) && e.target !== input) hideDropdown();
    });

    // fermer si escape
    input.addEventListener("keydown", (e) => {
        if (e.key === "Escape") hideDropdown();
    });
})();
