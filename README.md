# OviSoft PHP MVC Framework

![Versión](https://img.shields.io/badge/versión-1.3.0-blue)
![PHP](https://img.shields.io/badge/PHP-%3E%3D7.4-777BB4?logo=php&logoColor=white)
![Licencia](https://img.shields.io/badge/licencia-MIT-green)

Un framework MVC ligero y moderno para PHP con tipado estricto, diseñado para crear aplicaciones web de manera rápida y eficiente.

## 🚀 Características

- ✅ **Arquitectura MVC** - Separación clara de responsabilidades
- ✅ **Tipado Estricto** - Uso de `declare(strict_types=1)` en todos los archivos
- ✅ **Routing Amigable** - URLs limpias mediante `.htaccess`
- ✅ **Rutas Personalizadas** - Sistema de alias para URLs más amigables (v1.3.0)
- ✅ **Controladores en Subdirectorios** - Organiza tu código en subcarpetas (v1.3.0)
- ✅ **Autoloading** - Carga automática de clases del core
- ✅ **Sistema de Vistas Flexible** - Manejo automático de rutas de vistas
- ✅ **Template Admin** - Sistema de componentes reutilizables para áreas de administración (v1.3.0)
- ✅ **Manejo de Errores** - Sistema integrado de páginas de error
- ✅ **Estructura Modular** - Fácil de extender y mantener

## 📁 Estructura del Proyecto

```
ovisoft/
├── assets/              # Recursos estáticos
│   ├── css/             # Hojas de estilo
│   ├── js/              # Scripts JavaScript
│   ├── images/          # Imágenes
│   │   └── uploads/     # Imágenes subidas por usuarios
│   └── fonts/           # Fuentes tipográficas
├── config/              # Archivos de configuración
│   ├── config.php       # Configuración principal (no se sube a git)
│   └── config.example.php  # Ejemplo de configuración
├── controllers/         # Controladores de la aplicación
│   ├── home.controller.php
│   └── error.controller.php
├── helpers/             # Funciones auxiliares globales
│   └── helpers.php      # Funciones helper (base_url, media, formatMoney, etc.)
├── libraries/           # Librerías del framework
│   └── core/            # Núcleo del framework
│       ├── autoload.php      # Autoloader de clases
│       ├── connection.php    # Conexión a base de datos
│       ├── controllers.php   # Clase base de controladores
│       ├── load.php          # Cargador de controladores
│       ├── mysql.php         # Clase para operaciones CRUD
│       └── views.php         # Sistema de vistas
├── models/              # Modelos de datos
│   └── homeModel.php
├── views/               # Vistas de la aplicación
│   ├── home.php
│   └── error/
│       └── error.php
├── .gitignore           # Archivos ignorados por git
├── .htaccess            # Configuración de Apache
├── CHANGELOG.md         # Historial de cambios
├── CONTRIBUTING.md      # Guía de contribución
├── LICENSE              # Licencia MIT
├── README.md            # Documentación principal
└── index.php            # Punto de entrada
```

## ⚙️ Requisitos

- PHP 7.4 o superior
- Apache con `mod_rewrite` habilitado
- Servidor web (XAMPP, WAMP, LAMP, etc.)

## 🔧 Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/JorgeOviedoL/ovisoft.git
   cd ovisoft
   ```

2. **Configurar el servidor**
   - Coloca el proyecto en la carpeta de tu servidor web (ej: `htdocs` para XAMPP)
   - Asegúrate de que `mod_rewrite` esté habilitado en Apache

3. **Configurar el archivo de configuración**
   - Copia el archivo de ejemplo:
   ```bash
   cp config/config.example.php config/config.php
   ```
   - Edita `config/config.php` y ajusta la constante `BASE_URL` según tu entorno:
   ```php
   const BASE_URL = "http://localhost/";
   ```
   
   > **Nota de Seguridad:** El archivo `config/config.php` está en `.gitignore` para proteger información sensible. Nunca subas este archivo al repositorio.

4. **Acceder a la aplicación**
   - Abre tu navegador y visita: `http://localhost/`

## 📖 Uso

### Crear un Controlador

```php
<?php

declare(strict_types=1);

class Products extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(string $params)
    {
        $this->views->getView($this, "products");
    }

    public function show(string $params)
    {
        // $params contiene los parámetros de la URL
        $this->views->getView($this, "product_detail");
    }
}
```

### Crear un Modelo

```php
<?php

declare(strict_types=1);

class ProductsModel
{
    public function __construct()
    {
        // Inicialización del modelo
    }

    public function getProducts()
    {
        // Lógica para obtener productos
        return [];
    }
}
```

### Crear una Vista

Crea un archivo en `views/products/products.php`:

```php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
</head>
<body>
    <h1>Lista de Productos</h1>
</body>
</html>
```

### Sistema de Rutas

El framework utiliza URLs amigables con el siguiente formato:

```
http://localhost/?url=controlador/metodo/parametros
```

**Ejemplos:**

- `?url=home/home` → Controlador: `Home`, Método: `home()`
- `?url=products/show/123` → Controlador: `Products`, Método: `show("123")`
- `?url=users/edit/5,admin` → Controlador: `Users`, Método: `edit("5,admin")`

### 🆕 Controladores en Subdirectorios (v1.3.0)

Ahora puedes organizar tus controladores en subdirectorios para mejor estructura:

```
controllers/
├── home.controller.php
├── error.controller.php
└── admin/
    ├── dashboard.controller.php
    ├── users.controller.php
    └── settings.controller.php
```

**Acceso mediante URL:**

- `?url=admin/dashboard/index` → `controllers/admin/dashboard.controller.php`
- `?url=admin/users/edit/5` → `controllers/admin/users.controller.php`

**Ejemplo de controlador en subdirectorio:**

```php
<?php
// controllers/admin/dashboard.controller.php

declare(strict_types=1);

class Dashboard extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(string $params = ""): void
    {
        $data['title'] = 'Dashboard Admin';
        $this->views->getView($this, "admin/dashboard/index", $data);
    }
}
```

### 🆕 Rutas Personalizadas (v1.3.0)

Define URLs amigables en `config/routes.php`:

```php
<?php
// config/routes.php

return [
    'dashboard' => 'admin/dashboard/index',
    'usuarios' => 'admin/users/index',
    'perfil' => 'user/profile/index',
];
```

**Ahora puedes usar URLs más cortas:**

- `?url=dashboard` en lugar de `?url=admin/dashboard/index`
- `?url=usuarios` en lugar de `?url=admin/users/index`
- `?url=perfil` en lugar de `?url=user/profile/index`

### 🆕 Helper para Templates Admin (v1.3.0)

Carga componentes del template admin de forma sencilla con `getAdminTemplate()`:

**Estructura de template:**

```
views/admin/template/
├── header.php       # Meta tags, CSS, fuentes
├── nav.php          # Sidebar principal
├── nav_mobile.php   # Menú móvil (offcanvas)
├── top_bar.php      # Barra superior
├── footer.php       # Footer
└── scripts.php      # Scripts JS
```

**Uso en vistas:**

```php
<!DOCTYPE html>
<html lang="es">
<head>
    <?php getAdminTemplate('header', $data); ?>
</head>
<body>
    <!-- Sidebar -->
    <?php getAdminTemplate('nav'); ?>
    
    <!-- Menú móvil -->
    <?php getAdminTemplate('nav_mobile'); ?>
    
    <div class="main-wrapper">
        <!-- Barra superior -->
        <?php getAdminTemplate('top_bar'); ?>
        
        <!-- Tu contenido aquí -->
        <main class="main-content">
            <h1><?php echo $data['title']; ?></h1>
        </main>
        
        <!-- Footer -->
        <?php getAdminTemplate('footer'); ?>
    </div>
    
    <!-- Scripts -->
    <?php getAdminTemplate('scripts'); ?>
</body>
</html>
```

## 🎯 Características Técnicas

### Tipado Estricto

Todos los archivos PHP utilizan `declare(strict_types=1)` para garantizar la seguridad de tipos:

```php
<?php
declare(strict_types=1);
```

### Autoloading

El framework carga automáticamente las clases del core sin necesidad de `require_once` manual:

```php
// libraries/core/autoload.php
spl_autoload_register(function ($class) {
    if (file_exists(LIBS . 'core/' . $class . ".php")) {
        require_once(LIBS . 'core/' . $class . ".php");
    }
});
```

### Sistema de Vistas Flexible

El sistema de vistas busca automáticamente en múltiples ubicaciones:

1. `views/controlador/vista.php`
2. `views/vista.php` (fallback)

### Manejo de Errores

El framework incluye un controlador de errores que se activa automáticamente cuando:
- Un controlador no existe
- Un método no existe en el controlador

## 🛠️ Configuración

### Archivo de Configuración

El framework utiliza un archivo de configuración centralizado. Por seguridad, debes crear tu propio archivo `config.php` a partir del ejemplo:

```bash
cp config/config.example.php config/config.php
```

Luego edita `config/config.php` con tus configuraciones:

```php
<?php

// URL base de la aplicación
const BASE_URL = "http://localhost/";

// Ruta de librerías
const LIBS = "libraries/";

// Ruta de vistas
const VIEWS = "views/";

// Configuración de base de datos (opcional)
// const DB_HOST = "localhost";
// const DB_NAME = "tu_base_datos";
// const DB_USER = "tu_usuario";
// const DB_PASS = "tu_contraseña";
```

> **⚠️ Importante:** Nunca subas `config/config.php` al repositorio. Este archivo está en `.gitignore` para proteger información sensible como contraseñas de base de datos.

## 📝 Buenas Prácticas

1. **Nombres de archivos**: Usa el formato `nombre.controller.php` para controladores
2. **Nombres de clases**: Usa PascalCase (ej: `Home`, `Products`)
3. **Tipado**: Siempre declara tipos en parámetros y retornos
4. **Estructura de carpetas**: Organiza las vistas en subcarpetas por controlador
5. **Modelos**: Usa el sufijo `Model` (ej: `HomeModel`, `ProductsModel`)

## 🤝 Contribuir

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 👤 Autor

**OviSoft**

- GitHub: [@JorgeOviedoL](https://github.com/JorgeOviedoL)

## 🙏 Agradecimientos

- Inspirado en frameworks MVC modernos
- Construido con las mejores prácticas de PHP

---

⭐ Si este proyecto te fue útil, considera darle una estrella en GitHub
