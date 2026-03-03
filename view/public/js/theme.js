(function () {
  const KEY = "lsmotors_theme";
  const body = document.body;
  const logo = document.getElementById("siteLogo");

  function apply(theme) {
    if (theme === "light") body.classList.add("theme-light");
    else body.classList.remove("theme-light");

    // Switch logo depending on theme (optional)
    if (logo) {
      const darkSrc = logo.getAttribute("data-logo-dark");
      const lightSrc = logo.getAttribute("data-logo-light");
      if (theme === "light" && lightSrc) logo.src = lightSrc;
      else if (darkSrc) logo.src = darkSrc;
    }
  }

  // init
  const saved = localStorage.getItem(KEY) || "dark";
  apply(saved);

  // bind buttons
  document.addEventListener("click", (e) => {
    const btn = e.target.closest("[data-theme]");
    if (!btn) return;
    const theme = btn.getAttribute("data-theme");
    localStorage.setItem(KEY, theme);
    apply(theme);
  });
})();
