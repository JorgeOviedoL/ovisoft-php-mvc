<header class="topbar" role="banner">
    <div class="topbar-content">
        <!-- Botón Toggle Móvil - Solo visible en pantallas pequeñas -->
        <button class="btn btn-link sidebar-toggle d-lg-none" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#mobileOffcanvas" aria-label="Alternar navegación">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Botón Toggle Escritorio - Solo visible en pantallas grandes -->
        <button class="btn btn-link sidebar-toggle d-none d-lg-block" id="sidebarToggle"
            aria-label="Alternar barra lateral">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Iconos del Lado Derecho -->
        <div class="topbar-actions">

            <!-- Toggle Modo Oscuro - Cambia entre tema claro y oscuro -->
            <button class="btn btn-link topbar-icon" id="darkModeToggle" aria-label="Alternar modo oscuro">
                <i class="fas fa-moon"></i>
            </button>

            <!-- Notificaciones - Con badge contador -->
            <div class="dropdown">
                <button class="btn btn-link topbar-icon position-relative" type="button" id="notificationsDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notificaciones">
                    <i class="fas fa-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end notification-dropdown"
                    aria-labelledby="notificationsDropdown">
                    <li class="dropdown-header">Notificaciones</li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-info-circle me-2"></i> Nueva
                            actualización disponible</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Nuevo usuario
                            registrado</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-chart-line me-2"></i> Reporte de
                            ventas listo</a></li>
                </ul>
            </div>

            <!-- Mensajes - Con badge contador -->
            <div class="dropdown">
                <button class="btn btn-link topbar-icon position-relative" type="button" id="messagesDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false" aria-label="Mensajes">
                    <i class="fas fa-envelope"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                        5
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="messagesDropdown">
                    <li class="dropdown-header">Mensajes</li>
                    <li><a class="dropdown-item" href="#">Nuevo mensaje de John</a></li>
                    <li><a class="dropdown-item" href="#">Recordatorio de reunión</a></li>
                </ul>
            </div>

            <!-- Perfil de Usuario - Con avatar y dropdown -->
            <div class="dropdown">
                <button class="btn btn-link topbar-user" type="button" id="userDropdown" data-bs-toggle="dropdown"
                    aria-expanded="false" aria-label="Menú de usuario">
                    <img src="<?php echo media('image/avatar.svg'); ?>" alt="Admin" class="user-avatar">
                    <div class="user-info d-none d-md-block">
                        <span class="user-name">Admin</span>
                        <span class="user-role">Administrador</span>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Perfil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Configuración</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Cerrar
                            Sesión</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>