(function () {
  // Hover dropdowns (desktop) without forcing click, while keeping Bootstrap behaviour for mobile.
  const items = document.querySelectorAll('.navbar .dropdown-hover');

  items.forEach((li) => {
    const toggle = li.querySelector('[data-bs-toggle="dropdown"]');
    const menu = li.querySelector('.dropdown-menu');
    if (!toggle || !menu) return;

    let hideTimer = null;

    function show() {
      if (hideTimer) { clearTimeout(hideTimer); hideTimer = null; }
      li.classList.add('show');
      toggle.classList.add('show');
      menu.classList.add('show');
      toggle.setAttribute('aria-expanded', 'true');
    }

    function hide() {
      hideTimer = window.setTimeout(() => {
        li.classList.remove('show');
        toggle.classList.remove('show');
        menu.classList.remove('show');
        toggle.setAttribute('aria-expanded', 'false');
      }, 120);
    }

    li.addEventListener('mouseenter', show);
    li.addEventListener('mouseleave', hide);

    // If user clicks elsewhere, close any open hover dropdowns
    document.addEventListener('click', (e) => {
      if (li.contains(e.target)) return;
      li.classList.remove('show');
      toggle.classList.remove('show');
      menu.classList.remove('show');
      toggle.setAttribute('aria-expanded', 'false');
    });
  });
})();