<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileOffcanvas" aria-labelledby="mobileOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileOffcanvasLabel">
            <img src="<?php echo media('image/ovisoft.png'); ?>" alt="Ovisoft" style="max-height: 30px;">
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body p-0">
        <!-- Misma navegación que el sidebar principal -->
        <nav class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="index.html" class="nav-link active">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-th-large"></i>
                        <span class="nav-text">Opciones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#menuStyleSubmenuMobile">
                        <i class="fas fa-bars"></i>
                        <span class="nav-text">Menu Style</span>
                        <i class="fas fa-chevron-right ms-auto submenu-arrow"></i>
                    </a>
                    <div class="collapse" id="menuStyleSubmenuMobile">
                        <ul class="submenu">
                            <li><a href="#"><i class="fas fa-sort-amount-up-alt me-2"></i>Horizontal</a></li>
                            <li><a href="#"><i class="fas fa-sort-amount-up-alt me-2"></i>Vertical</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-palette"></i>
                        <span class="nav-text">Design System</span>
                        <span class="badge bg-success ms-auto">UI</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-section-title">
                <span class="nav-text">Pages</span>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#specialPagesSubmenu">
                        <i class="fas fa-file-alt"></i>
                        <span class="nav-text">Special Pages</span>
                        <i class="fas fa-chevron-right ms-auto submenu-arrow"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#authSubmenu">
                        <i class="fas fa-lock"></i>
                        <span class="nav-text">Authentication</span>
                        <i class="fas fa-chevron-right ms-auto submenu-arrow"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-tools"></i>
                        <span class="nav-text">Utilities</span>
                        <i class="fas fa-chevron-right ms-auto submenu-arrow"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#usersSubmenuMobile">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Users</span>
                        <i class="fas fa-chevron-right ms-auto submenu-arrow"></i>
                    </a>
                    <div class="collapse" id="usersSubmenuMobile">
                        <ul class="submenu">
                            <li><a href="profile.html"><i class="fas fa-sort-amount-up-alt me-2"></i>Perfil</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#menuAdminPages">
                        <i class="fas fa-user-shield"></i>
                        <span class="nav-text">Admin</span>
                        <i class="fas fa-chevron-right ms-auto submenu-arrow"></i>
                    </a>
                    <div class="collapse" id="menuAdminPages">
                        <ul class="submenu">
                            <li><a href="login.html"><i class="fas fa-sort-amount-up-alt me-2"></i>Login Page</a>
                            </li>
                            <li><a href="register.html"><i class="fas fa-sort-amount-up-alt me-2"></i>Register
                                    Page</a>
                            </li>
                            <li><a href="lock_screen.html"><i class="fas fa-sort-amount-up-alt me-2"></i>Lock
                                    Screen</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <div class="sidebar-section-title">
                <span class="nav-text">Elements</span>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="datatables.html" class="nav-link">
                        <i class="fas fa-table"></i>
                        <span class="nav-text">DataTables</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="buttons.html" class="nav-link">
                        <i class="fas fa-hand-pointer"></i>
                        <span class="nav-text">Botones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="lists_tabs.html" class="nav-link">
                        <i class="fas fa-toggle-on"></i>
                        <span class="nav-text">Listas y Pestañas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="radios_selectors.html" class="nav-link">
                        <i class="fas fa-check-circle"></i>
                        <span class="nav-text">Radios y Selectores</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="text_editor.html" class="nav-link">
                        <i class="fas fa-text-width"></i>
                        <span class="nav-text">Editor de Texto</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="modals.html" class="nav-link">
                        <i class="fas fa-window-restore"></i>
                        <span class="nav-text">Modales</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="selectors.html" class="nav-link">
                        <i class="fas fa-search-minus"></i>
                        <span class="nav-text">Selectores Buscadores</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>