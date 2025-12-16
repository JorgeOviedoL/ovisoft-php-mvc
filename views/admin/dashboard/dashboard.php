<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <?php getAdminTemplate('header', $data); ?>
</head>

<body>
    <!-- 
        ============================================================
        MÓDULO: BARRA LATERAL (SIDEBAR)
        ============================================================
        Función: Navegación principal del dashboard
        
        Características:
        - Navegación vertical con iconos y etiquetas
        - Colapsable en escritorio (guarda estado en localStorage)
        - Se convierte en offcanvas en móviles
        - Soporta submenús desplegables
        - Indicador visual de página activa
        - Transiciones suaves al colapsar/expandir
        
        Comportamiento responsivo:
        - Desktop (≥1200px): Expandida por defecto
        - Tablet (992px-1199px): Colapsada a solo iconos
        - Mobile (<992px): Oculta, accesible vía offcanvas
    -->
    <?php getAdminTemplate('nav', $data); ?>



    <!-- 
        ============================================================
        MÓDULO: MENÚ MÓVIL OFFCANVAS
        ============================================================
        Función: Versión móvil de la barra lateral
        
        Características:
        - Se activa solo en pantallas pequeñas (<992px)
        - Desliza desde la izquierda
        - Contiene la misma navegación que el sidebar
        - Se cierra al hacer clic fuera o en el botón X
        - Accesible mediante el botón hamburguesa en el topbar
    -->
    <?php getAdminTemplate('nav_mobile', $data); ?>

    <!-- 
        ============================================================
        MÓDULO: CONTENEDOR PRINCIPAL (MAIN WRAPPER)
        ============================================================
        Función: Envuelve todo el contenido excepto el sidebar
        
        Características:
        - Margen izquierdo dinámico según estado del sidebar
        - Contiene el topbar y el contenido principal
        - Se ajusta automáticamente al colapsar/expandir sidebar
    -->
    <div id="main-wrapper" class="main-wrapper">
        <!-- 
            ============================================================
            MÓDULO: BARRA SUPERIOR (TOPBAR)
            ============================================================
            Función: Navegación secundaria y controles de usuario
            
            Componentes:
            - Botón toggle del sidebar
            - Barra de búsqueda
            - Selector de idioma (con bandera)
            - Toggle de modo oscuro
            - Notificaciones (con badge de contador)
            - Mensajes (con badge de contador)
            - Menú de usuario con avatar y dropdown
            
            Características:
            - Sticky (se mantiene fijo al hacer scroll)
            - Responsivo (oculta elementos en móviles)
            - Dropdowns con Bootstrap 5
        -->
        <?php getAdminTemplate('top_bar', $data); ?>

        <!-- 
            ============================================================
            MÓDULO: ÁREA DE CONTENIDO PRINCIPAL
            ============================================================
            Función: Contiene todo el contenido del dashboard
            
            Secciones:
            - Hero Banner: Banner de bienvenida con gradiente azul
            - Dashboard Content: Métricas, gráficos y widgets
        -->
        <main class="main-content" role="main">
            <section class="hero-banner">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1 class="hero-title"><?php echo $data['title_page']; ?></h1>
                        <p class="hero-subtitle"><?php echo $data['subtitle_page']; ?></p>
                    </div>
                    <nav class="breadcrumb-hero" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <i class="fas fa-home me-2"></i>
                                <a href="<?php echo base_url(); ?>dashboard">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
                <!-- Formas SVG de Fondo - Decoración del banner -->
                <svg class="hero-shape" viewBox="0 0 1200 300" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="none">
                    <path d="M0,100 Q300,50 600,100 T1200,100 L1200,300 L0,300 Z" fill="rgba(255,255,255,0.1)" />
                </svg>
            </section>

            <!-- 
                ============================================================
                MÓDULO: CONTENIDO DEL DASHBOARD
                ============================================================
                Función: Contiene las tarjetas de métricas y gráficos
                
                Componentes:
                - Fila de tarjetas de métricas (3 tarjetas)
                - Fila de gráfico y tarjeta de crédito
            -->
            <div class="page-content">
                <!-- 
                    ============================================================
                    MÓDULO: FILA DE TARJETAS DE MÉTRICAS
                    ============================================================
                    Función: Muestra 3 métricas principales del negocio
                    
                    Métricas:
                    1. Total Sales (Ventas Totales) - $560K
                    2. Total Profit (Ganancias Totales) - $185K
                    3. Total Cost (Costos Totales) - $375K
                    
                    Cada tarjeta incluye:
                    - Gráfico circular SVG con progreso
                    - Icono de tendencia (↗ ↘ ↓)
                    - Etiqueta y valor monetario
                    - Efecto hover con elevación
                -->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="metric-card">
                            <div class="metric-icon-wrapper">
                                <svg class="metric-circle" width="60" height="60" viewBox="0 0 60 60">
                                    <circle cx="30" cy="30" r="25" fill="none" stroke="#e9ecef" stroke-width="6" />
                                    <circle cx="30" cy="30" r="25" fill="none" stroke="#4c6fff" stroke-width="6"
                                        stroke-dasharray="157" stroke-dashoffset="40" transform="rotate(-90 30 30)"
                                        stroke-linecap="round" />
                                    <text x="30" y="35" text-anchor="middle" font-size="16" fill="#4c6fff"
                                        font-weight="600">
                                        <tspan>↗</tspan>
                                    </text>
                                </svg>
                            </div>
                            <div class="metric-content">
                                <h6 class="metric-label">Total Sales</h6>
                                <h2 class="metric-value">$560K</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="metric-card">
                            <div class="metric-icon-wrapper">
                                <svg class="metric-circle" width="60" height="60" viewBox="0 0 60 60">
                                    <circle cx="30" cy="30" r="25" fill="none" stroke="#e9ecef" stroke-width="6" />
                                    <circle cx="30" cy="30" r="25" fill="none" stroke="#00d4aa" stroke-width="6"
                                        stroke-dasharray="157" stroke-dashoffset="60" transform="rotate(-90 30 30)"
                                        stroke-linecap="round" />
                                    <text x="30" y="35" text-anchor="middle" font-size="16" fill="#00d4aa"
                                        font-weight="600">
                                        <tspan>↘</tspan>
                                    </text>
                                </svg>
                            </div>
                            <div class="metric-content">
                                <h6 class="metric-label">Total Profit</h6>
                                <h2 class="metric-value">$185K</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="metric-card">
                            <div class="metric-icon-wrapper">
                                <svg class="metric-circle" width="60" height="60" viewBox="0 0 60 60">
                                    <circle cx="30" cy="30" r="25" fill="none" stroke="#e9ecef" stroke-width="6" />
                                    <circle cx="30" cy="30" r="25" fill="none" stroke="#6c5dd3" stroke-width="6"
                                        stroke-dasharray="157" stroke-dashoffset="50" transform="rotate(-90 30 30)"
                                        stroke-linecap="round" />
                                    <text x="30" y="35" text-anchor="middle" font-size="16" fill="#6c5dd3"
                                        font-weight="600">
                                        <tspan>↓</tspan>
                                    </text>
                                </svg>
                            </div>
                            <div class="metric-content">
                                <h6 class="metric-label">Total Cost</h6>
                                <h2 class="metric-value">$375K</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 
                    ============================================================
                    MÓDULO: FILA DE GRÁFICO Y TARJETA DE CRÉDITO
                    ============================================================
                    Función: Visualización de datos y widget de tarjeta
                    
                    Componentes:
                    - Gráfico de líneas (Chart.js) - 8 columnas
                    - Widget de tarjeta de crédito - 4 columnas
                -->
                <div class="row g-4">
                    <!-- 
                        ============================================================
                        MÓDULO: TARJETA DE GRÁFICO
                        ============================================================
                        Función: Muestra gráfico de líneas con ventas y costos
                        
                        Características:
                        - Gráfico de líneas con Chart.js
                        - Dos datasets: Sales (azul) y Cost (verde)
                        - Selector de período (Esta Semana / Este Mes)
                        - Leyenda personalizada
                        - Tooltips interactivos
                        - Gradientes bajo las líneas
                        - Spinner de carga
                        - Responsivo y adaptable al tema oscuro
                    -->
                    <div class="col-12 col-xl-8">
                        <div class="card chart-card">
                            <div class="card-header">
                                <div class="chart-header-left">
                                    <h3 class="chart-title">$855.8K</h3>
                                    <p class="chart-subtitle">Gross Sales</p>
                                    <div class="chart-legend">
                                        <span class="legend-item">
                                            <span class="legend-dot" style="background-color: #4c6fff;"></span>
                                            Sales
                                        </span>
                                        <span class="legend-item">
                                            <span class="legend-dot" style="background-color: #00d4aa;"></span>
                                            Cost
                                        </span>
                                    </div>
                                </div>
                                <div class="chart-header-right">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                            id="chartPeriodDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span id="currentPeriod">This Week</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="chartPeriodDropdown">
                                            <li><a class="dropdown-item period-option" href="#" data-period="week">This
                                                    Week</a></li>
                                            <li><a class="dropdown-item period-option" href="#" data-period="month">This
                                                    Month</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container" role="img" aria-label="Sales and Cost chart">
                                    <canvas id="salesChart"></canvas>
                                </div>
                                <div class="chart-loading" id="chartLoading">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading chart...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 
                        ============================================================
                        MÓDULO: WIDGET DE TARJETA DE CRÉDITO
                        ============================================================
                        Función: Muestra información de tarjeta de crédito
                        
                        Características:
                        - Diseño estilo tarjeta VISA
                        - Gradiente morado de fondo
                        - Chip de tarjeta decorativo
                        - Número de tarjeta enmascarado
                        - Nombre del titular
                        - Botón de descarga verde
                        - Círculos decorativos de fondo
                        - Solo informativo (no funcional)
                    -->
                    <div class="col-12 col-xl-4">
                        <div class="card credit-card-widget">
                            <div class="card-body">
                                <div class="credit-card">
                                    <div class="credit-card-header">
                                        <span class="card-type">VISA</span>
                                        <span class="card-tier">PREMIUM ACCOUNT</span>
                                    </div>
                                    <div class="credit-card-chip">
                                        <div class="chip-design"></div>
                                    </div>
                                    <div class="credit-card-number">
                                        5789 **** **** 2847
                                    </div>
                                    <div class="credit-card-footer">
                                        <div class="card-holder">
                                            <span class="card-label">Card holder</span>
                                            <span class="card-name">Edith Smith</span>
                                        </div>
                                    </div>
                                    <!-- Círculos decorativos de fondo -->
                                    <div class="card-decoration card-decoration-1"></div>
                                    <div class="card-decoration card-decoration-2"></div>
                                </div>
                                <button class="btn btn-success btn-download w-100 mt-3">
                                    <i class="fas fa-download me-2"></i>
                                    Download
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- 
            ============================================================
            MÓDULO: FOOTER
            ============================================================
            Función: Pie de página con información del sistema
            
            Contenido:
            - Versión del sistema
            - Enlace a Ovisoft
            - Copyright con año actual
        -->
        <?php getAdminTemplate('footer', $data); ?>
    </div>

    <!-- 
        ============================================================
        SCRIPTS
        ============================================================
        Orden de carga:
        1. Bootstrap 5 JS Bundle - Componentes interactivos (dropdowns, offcanvas, etc.)
        2. Chart.js - Biblioteca de gráficos
        3. main.js - JavaScript personalizado (sidebar, dark mode, etc.)
        4. charts.js - Configuración e inicialización de gráficos
    -->
    <?php getAdminTemplate('scripts', $data); ?>

</body>

</html>