/**
 * Hope UI Admin Dashboard - JavaScript Principal
 * 
 * ============================================================
 * INTEGRACIÓN MVC:
 * ============================================================
 * - Incluir este archivo en el pie de página del layout: <script src="<?= base_url('assets/js/main.js') ?>"></script>
 * - Maneja el toggle del sidebar, modo oscuro, dropdowns y persistencia en localStorage
 * - JavaScript vanilla puro (sin dependencia de jQuery)
 * 
 * ============================================================
 * FUNCIONALIDADES PRINCIPALES:
 * ============================================================
 * 1. Toggle del Sidebar - Colapsar/expandir con persistencia
 * 2. Modo Oscuro - Cambio de tema con detección del sistema
 * 3. Selector de Idioma - Visual solamente (personalizable)
 * 4. Notificaciones Toast - Sistema de alertas temporales
 * 5. Atajos de Teclado - Ctrl+B (sidebar), Ctrl+D (dark mode)
 * 6. Búsqueda - Con debouncing para optimización
 * 7. Comportamiento Responsivo - Adaptación automática
 */

(function () {
    'use strict';

    // ========================================
    // ELEMENTOS DEL DOM
    // ========================================
    // Selección de elementos principales que se utilizarán en todo el script
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const darkModeToggle = document.getElementById('darkModeToggle');
    const html = document.documentElement;
    const mainWrapper = document.getElementById('main-wrapper');

    // ========================================
    // FUNCIONALIDAD DEL SIDEBAR
    // ========================================

    /**
     * Inicializar el estado del sidebar desde localStorage
     * 
     * Función: Restaura el estado colapsado/expandido del sidebar
     * cuando el usuario regresa a la página
     */
    function initSidebar() {
        const sidebarState = localStorage.getItem('sidebarCollapsed');

        if (sidebarState === 'true') {
            sidebar?.classList.add('collapsed');
        }
    }

    /**
     * Alternar el estado colapsado del sidebar
     * 
     * Función: Colapsa o expande el sidebar y guarda el estado
     * Emite un evento personalizado para que otros componentes reaccionen
     */
    function toggleSidebar() {
        if (!sidebar) return;

        sidebar.classList.toggle('collapsed');
        const isCollapsed = sidebar.classList.contains('collapsed');

        // Guardar estado en localStorage para persistencia
        localStorage.setItem('sidebarCollapsed', isCollapsed);

        // Emitir evento personalizado para otros componentes (ej: redimensionar gráficos)
        window.dispatchEvent(new CustomEvent('sidebarToggle', {
            detail: { collapsed: isCollapsed }
        }));
    }

    // Adjuntar event listener al botón de toggle del sidebar
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', toggleSidebar);
    }

    // ========================================
    // MODO OSCURO
    // ========================================

    /**
     * Inicializar el tema desde localStorage o preferencia del sistema
     * 
     * Función: Detecta si el usuario tiene un tema guardado o usa
     * la preferencia del sistema operativo (prefers-color-scheme)
     */
    function initTheme() {
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        let theme = savedTheme || (systemPrefersDark ? 'dark' : 'light');
        setTheme(theme);
    }

    /**
     * Establecer el tema y actualizar la interfaz
     * 
     * @param {string} theme - 'light' o 'dark'
     * 
     * Función: Aplica el tema seleccionado, actualiza el icono del botón
     * y emite un evento para que otros componentes se actualicen
     */
    function setTheme(theme) {
        html.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);

        // Actualizar icono del botón de modo oscuro (luna/sol)
        if (darkModeToggle) {
            const icon = darkModeToggle.querySelector('i');
            if (icon) {
                icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            }
        }

        // Emitir evento personalizado para actualizar gráficos y otros componentes
        window.dispatchEvent(new CustomEvent('themeChange', {
            detail: { theme }
        }));
    }

    /**
     * Alternar entre temas claro y oscuro
     * 
     * Función: Cambia del tema actual al opuesto
     */
    function toggleTheme() {
        const currentTheme = html.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
    }

    // Adjuntar event listener al botón de modo oscuro
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', toggleTheme);
    }

    // Escuchar cambios en la preferencia del sistema
    // Si el usuario cambia el tema del sistema, actualizar automáticamente
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (!localStorage.getItem('theme')) {
            setTheme(e.matches ? 'dark' : 'light');
        }
    });

    // ========================================
    // MEJORAS DE DROPDOWNS
    // ========================================

    /**
     * Cerrar dropdowns al hacer clic fuera
     * 
     * Función: Mejora la UX cerrando automáticamente los dropdowns
     * cuando el usuario hace clic fuera de ellos
     */
    document.addEventListener('click', function (event) {
        const dropdowns = document.querySelectorAll('.dropdown-menu.show');

        dropdowns.forEach(dropdown => {
            const toggle = dropdown.previousElementSibling;
            if (toggle && !toggle.contains(event.target) && !dropdown.contains(event.target)) {
                const bsDropdown = bootstrap.Dropdown.getInstance(toggle);
                if (bsDropdown) {
                    bsDropdown.hide();
                }
            }
        });
    });

    // ========================================
    // SELECTOR DE IDIOMA (SOLO VISUAL)
    // ========================================

    /**
     * Manejar la selección de idioma (solo retroalimentación visual)
     * 
     * Función: En una aplicación MVC real, esto activaría un cambio
     * de idioma en el servidor. Aquí solo muestra feedback visual.
     * 
     * Para implementar cambio real de idioma:
     * 1. Enviar petición AJAX al servidor con el idioma seleccionado
     * 2. El servidor actualiza la sesión del usuario
     * 3. Recargar la página o actualizar contenido dinámicamente
     */
    function initLanguageSelector() {
        const languageItems = document.querySelectorAll('#languageDropdown + .dropdown-menu .dropdown-item');
        const languageButton = document.getElementById('languageDropdown');

        languageItems.forEach(item => {
            item.addEventListener('click', function (e) {
                e.preventDefault();

                // Actualizar icono del botón (en una app real, esto sería más sofisticado)
                const selectedLang = this.textContent.trim();
                console.log('Idioma seleccionado:', selectedLang);

                // Guardar en localStorage y enviar al servidor
                localStorage.setItem('selectedLanguage', selectedLang);

                // Retroalimentación visual
                showToast(`Idioma cambiado a ${selectedLang}`);
            });
        });
    }

    // ========================================
    // TOGGLE DE SUBMENÚS
    // ========================================

    /**
     * Manejar colapso/expansión de submenús
     * 
     * Función: Si el sidebar está colapsado y el usuario intenta
     * abrir un submenú, expande automáticamente el sidebar
     */
    function initSubmenuToggles() {
        const submenuToggles = document.querySelectorAll('[data-bs-toggle="collapse"]');

        submenuToggles.forEach(toggle => {
            toggle.addEventListener('click', function (e) {
                // Solo prevenir default si estamos en modo sidebar colapsado
                if (sidebar?.classList.contains('collapsed')) {
                    e.preventDefault();
                    // Expandir sidebar temporalmente o mostrar tooltip
                    sidebar.classList.remove('collapsed');
                    localStorage.setItem('sidebarCollapsed', 'false');
                }
            });
        });
    }

    // ========================================
    // ANIMACIÓN DE BADGES DE NOTIFICACIÓN
    // ========================================

    /**
     * Animar badges de notificación cuando llegan nuevas notificaciones
     * 
     * @param {HTMLElement} badgeElement - Elemento del badge a animar
     * 
     * Función: Aplica una animación de pulso al badge para llamar
     * la atención del usuario sobre nuevas notificaciones
     * 
     * Uso: HopeUI.animateNotificationBadge(document.querySelector('.badge'))
     */
    function animateNotificationBadge(badgeElement) {
        if (!badgeElement) return;

        badgeElement.style.animation = 'none';
        setTimeout(() => {
            badgeElement.style.animation = 'pulse 0.5s ease-in-out';
        }, 10);
    }

    // ========================================
    // NOTIFICACIONES TOAST
    // ========================================

    /**
     * Mostrar una notificación toast simple
     * 
     * @param {string} message - Mensaje a mostrar
     * @param {string} type - Tipo de alerta: 'success', 'error', 'info', 'warning'
     * 
     * Función: Crea y muestra una notificación temporal en la esquina
     * superior derecha que se auto-elimina después de 3 segundos
     * 
     * Uso: HopeUI.showToast('Operación exitosa', 'success')
     */
    function showToast(message, type = 'info') {
        // Crear contenedor de toasts si no existe
        let toastContainer = document.getElementById('toastContainer');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toastContainer';
            toastContainer.style.cssText = `
                position: fixed;
                top: 90px;
                right: 20px;
                z-index: 9999;
                display: flex;
                flex-direction: column;
                gap: 10px;
            `;
            document.body.appendChild(toastContainer);
        }

        // Crear elemento toast
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} alert-dismissible fade show`;
        toast.style.cssText = `
            min-width: 250px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: slideInRight 0.3s ease-out;
        `;
        toast.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        `;

        toastContainer.appendChild(toast);

        // Auto-eliminar después de 3 segundos
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Agregar keyframes de animación al documento
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
        }
    `;
    document.head.appendChild(style);

    // ========================================
    // COMPORTAMIENTO RESPONSIVO
    // ========================================

    /**
     * Manejar comportamiento responsivo del sidebar
     * 
     * Función: Ajusta automáticamente el estado del sidebar según
     * el tamaño de la pantalla:
     * - Móvil (<992px): Sidebar oculto
     * - Tablet (992-1199px): Sidebar colapsado por defecto
     * - Desktop (≥1200px): Sidebar expandido (según preferencia guardada)
     */
    function handleResize() {
        const width = window.innerWidth;

        // En móvil, siempre ocultar sidebar (se accede vía offcanvas)
        if (width < 992) {
            sidebar?.classList.remove('collapsed');
        }
        // En tablet, colapsar por defecto
        else if (width < 1200) {
            const savedState = localStorage.getItem('sidebarCollapsed');
            if (savedState === null) {
                sidebar?.classList.add('collapsed');
            }
        }
    }

    // Debounce del manejador de resize para optimizar rendimiento
    let resizeTimeout;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(handleResize, 150);
    });

    // ========================================
    // ATAJOS DE TECLADO
    // ========================================

    /**
     * Manejar atajos de teclado
     * 
     * Función: Proporciona accesos rápidos mediante teclado:
     * - Ctrl/Cmd + B: Alternar sidebar
     * - Ctrl/Cmd + D: Alternar modo oscuro
     * - Escape: Cerrar todos los dropdowns abiertos
     */
    function initKeyboardShortcuts() {
        document.addEventListener('keydown', function (e) {
            // Ctrl/Cmd + B: Alternar sidebar
            if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
                e.preventDefault();
                toggleSidebar();
            }

            // Ctrl/Cmd + D: Alternar modo oscuro
            if ((e.ctrlKey || e.metaKey) && e.key === 'd') {
                e.preventDefault();
                toggleTheme();
            }

            // Escape: Cerrar todos los dropdowns
            if (e.key === 'Escape') {
                const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
                openDropdowns.forEach(dropdown => {
                    const toggle = dropdown.previousElementSibling;
                    const bsDropdown = bootstrap.Dropdown.getInstance(toggle);
                    if (bsDropdown) {
                        bsDropdown.hide();
                    }
                });
            }
        });
    }

    // ========================================
    // FUNCIONALIDAD DE BÚSQUEDA
    // ========================================

    /**
     * Inicializar búsqueda con debouncing
     * 
     * Función: Implementa búsqueda con retraso (debouncing) para
     * evitar hacer peticiones en cada tecla presionada.
     * 
     * En una aplicación real:
     * 1. Hacer petición AJAX al servidor con el término de búsqueda
     * 2. Mostrar resultados en un dropdown
     * 3. Permitir navegación con teclado
     */
    function initSearch() {
        const searchInput = document.querySelector('.topbar-search input');
        if (!searchInput) return;

        let searchTimeout;
        searchInput.addEventListener('input', function (e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const query = e.target.value.trim();
                if (query.length > 2) {
                    console.log('Buscando:', query);
                    // En una app real, esto activaría una búsqueda AJAX
                    // performSearch(query);
                }
            }, 300);
        });
    }

    // ========================================
    // RESALTADO DE ENLACE ACTIVO
    // ========================================

    /**
     * Resaltar enlace de navegación activo según la URL actual
     * 
     * Función: Marca automáticamente como activo el enlace del menú
     * que corresponde a la página actual
     */
    function highlightActiveLink() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.sidebar-nav .nav-link');

        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && href !== '#' && currentPath.includes(href)) {
                link.classList.add('active');
            }
        });
    }

    // ========================================
    // INICIALIZACIÓN
    // ========================================

    /**
     * Inicializar todos los componentes cuando el DOM esté listo
     * 
     * Función: Punto de entrada principal que inicializa todos
     * los módulos del dashboard en el orden correcto
     */
    function init() {
        initSidebar();
        initTheme();
        initLanguageSelector();
        initSubmenuToggles();
        initKeyboardShortcuts();
        initSearch();
        highlightActiveLink();
        handleResize();

        console.log('Hope UI Dashboard inicializado correctamente');
    }

    // Ejecutar inicialización cuando el DOM esté completamente cargado
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // ========================================
    // API PÚBLICA (exponer funciones útiles)
    // ========================================

    /**
     * API pública de Hope UI
     * 
     * Uso desde la consola o scripts externos:
     * - HopeUI.toggleSidebar() - Alternar sidebar
     * - HopeUI.toggleTheme() - Alternar tema
     * - HopeUI.setTheme('dark') - Establecer tema específico
     * - HopeUI.showToast('Mensaje', 'success') - Mostrar notificación
     * - HopeUI.animateNotificationBadge(element) - Animar badge
     */
    window.HopeUI = {
        toggleSidebar,
        toggleTheme,
        setTheme,
        showToast,
        animateNotificationBadge
    };

    // ========================================
    // ACTUALIZAR AÑO EN FOOTER
    // ========================================

    /**
     * Actualizar año actual en el footer
     * 
     * Función: Actualiza automáticamente el año en el copyright del footer
     */
    function updateFooterYear() {
        const yearElement = document.getElementById('currentYear');
        if (yearElement) {
            const currentYear = new Date().getFullYear();
            yearElement.textContent = currentYear;
        }
    }

    // Actualizar año al cargar
    updateFooterYear();

})();
