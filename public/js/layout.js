(function () {
  const app = document.querySelector('.app');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');

  // ===== Sidebar collapse (desktop) =====
  const collapsedKey = 'kkdw_sidebar_collapsed';

  function setCollapsed(isCollapsed) {
    sidebar.classList.toggle('collapsed', isCollapsed);
    app?.classList.toggle('sidebar-collapsed', isCollapsed);
    localStorage.setItem(collapsedKey, isCollapsed ? '1' : '0');
  }
  setCollapsed(localStorage.getItem(collapsedKey) === '1');

  // ===== Submenu smooth toggle + auto-open if active child =====
  const menu1Toggle = document.getElementById('menu1Toggle');
  const menu1Sub = document.getElementById('menu1Sub');

  function setSubmenu(open) {
    if (!menu1Toggle || !menu1Sub) return;
    menu1Sub.classList.toggle('open', open);
    menu1Toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    menu1Toggle.classList.toggle('active', open || menu1Toggle.dataset.hasActiveChild === '1');
  }

  // Auto-open submenu if server set "data-has-active-child=1"
  if (menu1Toggle?.dataset.hasActiveChild === '1') {
    setSubmenu(true);
  } else {
    setSubmenu(menu1Toggle?.getAttribute('aria-expanded') === 'true');
  }

  menu1Toggle?.addEventListener('click', () => {
    setSubmenu(!menu1Sub.classList.contains('open'));
  });

  // ===== Mobile open/close =====
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');

  function openMobileMenu() {
    sidebar.classList.add('mobile-open');
    overlay.classList.add('open');
    overlay.setAttribute('aria-hidden', 'false');
  }
  function closeMobileMenu() {
    sidebar.classList.remove('mobile-open');
    overlay.classList.remove('open');
    overlay.setAttribute('aria-hidden', 'true');
  }

  mobileMenuBtn?.addEventListener('click', () => {
    const isMobile = window.matchMedia('(max-width: 1024px)').matches;
    if (isMobile) {
      const isOpen = sidebar.classList.contains('mobile-open');
      isOpen ? closeMobileMenu() : openMobileMenu();
      return;
    }

    setCollapsed(!sidebar.classList.contains('collapsed'));
  });

  overlay?.addEventListener('click', closeMobileMenu);

  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeMobileMenu();
  });

  window.addEventListener('resize', () => {
    const isMobile = window.matchMedia('(max-width: 1024px)').matches;
    if (!isMobile) {
      closeMobileMenu();
    }
  });

  // ===== Dark mode toggle =====
  const themeBtn = document.getElementById('themeBtn');
  const themeIcon = themeBtn?.querySelector('i');
  const themeKey = 'kkdw_theme';

  function setThemeIcon(mode) {
    if (!themeIcon) return;
    if (mode === 'dark') {
      themeIcon.classList.remove('fa-moon');
      themeIcon.classList.add('fa-sun');
    } else {
      themeIcon.classList.remove('fa-sun');
      themeIcon.classList.add('fa-moon');
    }
  }

  function applyTheme(mode) {
    document.body.classList.toggle('theme-dark', mode === 'dark');
    localStorage.setItem(themeKey, mode);
    setThemeIcon(mode);
    if (themeBtn) {
      themeBtn.setAttribute('aria-pressed', mode === 'dark' ? 'true' : 'false');
    }
  }

  const saved = localStorage.getItem(themeKey);
  applyTheme(saved === 'dark' ? 'dark' : 'light');

  themeBtn?.addEventListener('click', () => {
    const isDark = document.body.classList.contains('theme-dark');
    applyTheme(isDark ? 'light' : 'dark');
    document.body.animate(
      [{ filter: 'saturate(1) brightness(1)' }, { filter: 'saturate(1.08) brightness(1.03)' }, { filter: 'saturate(1) brightness(1)' }],
      { duration: 320, easing: 'ease-in-out' }
    );
  });

  // ===== Profile dropdown =====
  const profileDropdown = document.querySelector('.profile-dropdown');
  const profileBtn = profileDropdown?.querySelector('.profile-pill');
  const notificationDropdown = document.querySelector('.notification-dropdown');
  const notificationBtn = notificationDropdown?.querySelector('.icon-btn');

  function setProfileOpen(open) {
    if (!profileDropdown || !profileBtn) return;
    profileDropdown.classList.toggle('is-open', open);
    profileBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    if (open) {
      notificationDropdown?.classList.remove('is-open');
      notificationBtn?.setAttribute('aria-expanded', 'false');
    }
  }

  profileBtn?.addEventListener('click', (event) => {
    event.stopPropagation();
    setProfileOpen(!profileDropdown.classList.contains('is-open'));
  });

  document.addEventListener('click', (event) => {
    if (!profileDropdown || profileDropdown.contains(event.target)) return;
    setProfileOpen(false);
  });

  window.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      setProfileOpen(false);
      notificationDropdown?.classList.remove('is-open');
      notificationBtn?.setAttribute('aria-expanded', 'false');
    }
  });

  // ===== Notifications dropdown =====
  function setNotificationOpen(open) {
    if (!notificationDropdown || !notificationBtn) return;
    notificationDropdown.classList.toggle('is-open', open);
    notificationBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    if (open) {
      profileDropdown?.classList.remove('is-open');
      profileBtn?.setAttribute('aria-expanded', 'false');
    }
  }

  notificationBtn?.addEventListener('click', (event) => {
    event.stopPropagation();
    setNotificationOpen(!notificationDropdown.classList.contains('is-open'));
  });

  document.addEventListener('click', (event) => {
    if (!notificationDropdown || notificationDropdown.contains(event.target)) return;
    setNotificationOpen(false);
  });
})();
