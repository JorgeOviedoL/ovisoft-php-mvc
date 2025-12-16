# Changelog

Todos los cambios notables de este proyecto serán documentados en este archivo.

El formato está basado en [Keep a Changelog](https://keepachangelog.com/es-ES/1.0.0/),
y este proyecto adhiere a [Semantic Versioning](https://semver.org/lang/es/).

## [1.2.0] - 2025-12-14

### Agregado
- ✨ Funciones helper completas en `helpers/helpers.php`
  - `media()` - URL de carpeta assets
  - `strClean()` - Sanitización de strings con protección SQL
  - `passGenerator()` - Generador de contraseñas aleatorias
  - `token()` - Generador de tokens únicos
  - `formatMoney()` - Formateo de moneda con configuración
  - `cleanEmail()` - Validación y sanitización de emails
  - `cleanUrl()` - Validación y sanitización de URLs
- ✨ Constantes de configuración de moneda
  - `SPD` - Separador decimal
  - `SPM` - Separador de millares
  - `SMONEY` - Símbolo de moneda
- ✨ Estructura de carpetas assets
  - `assets/css/` - Hojas de estilo
  - `assets/js/` - Scripts JavaScript
  - `assets/images/uploads/` - Imágenes de usuarios
  - `assets/fonts/` - Fuentes tipográficas


### Cambiado
- 🔄 `formatMoney()` ahora usa constantes `SPD`, `SPM` y `SMONEY` por defecto
- 🔄 Documentación de seguridad mejorada en `strClean()`
- 🔄 `config.example.php` actualizado con todas las constantes nuevas

### Mejorado
- 📚 Documentación completa de seguridad sobre prepared statements
- 📚 Ejemplos de uso en todas las funciones helper
- 📚 Advertencias claras sobre limitaciones de `strClean()`
- 📚 `.gitignore` actualizado para ignorar uploads de usuarios

### Seguridad
- 🔒 Protección de carpeta `assets/images/uploads/` en `.gitignore`
- 🔒 Documentación clara sobre uso correcto de sanitización

---

## [1.1.0] - 2025-12-14

### Agregado
- ✨ Documentación PHPDoc completa en todas las clases, métodos y propiedades
- ✨ Tipos de retorno en todos los métodos del framework
- ✨ Tipos de propiedades declarados en todas las clases
- ✨ Configuración de zona horaria MySQL (`DB_TIMEZONE`)
- ✨ Sincronización automática de zona horaria PHP ↔ MySQL
- ✨ Clase `Connection` para manejo de conexión a base de datos
- ✨ Clase `Mysql` con métodos CRUD completos (insert, select, select_all, update, delete)
- ✨ Funcionalidad `extract()` en Views para pasar datos a vistas
- ✨ Ejemplos de uso en métodos complejos
- ✨ Comentarios explicativos en todo el código
- ✨ Configuración de errores en `config.php`

### Cambiado
- 🔄 `HomeModel` ahora extiende de `Mysql` para acceso a base de datos
- 🔄 `DB_CHARSET` corregido de `"charset=utf8"` a `"utf8mb4"`
- 🔄 `config.example.php` actualizado con `DB_TIMEZONE` y `DB_PASSWORD`
- 🔄 Comparaciones estrictas (`===`, `!==`) en lugar de (`==`, `!=`)
- 🔄 Todos los archivos ahora usan `declare(strict_types=1)`

### Mejorado
- 📚 Documentación completa de sistema de routing en `index.php`
- 📚 Documentación de autoloader en `autoload.php`
- 📚 Documentación de cargador de controladores en `load.php`
- 📚 Mejoras en documentación de `README.md` con instrucciones de configuración

### Corregido
- 🐛 Error en `DB_CHARSET` que causaba problemas de conexión
- 🐛 Falta de tipos de retorno en métodos
- 🐛 Propiedades sin tipos declarados

---

## [1.0.0] - 2025-12-13

### Agregado
- ✨ Sistema MVC completo con arquitectura modular
- ✨ Tipado estricto en todos los archivos PHP
- ✨ Sistema de routing con URLs amigables
- ✨ Autoloader para clases del core
- ✨ Sistema de vistas flexible con fallback automático
- ✨ Controlador de errores integrado
- ✨ Clase base `Controllers` con carga automática de modelos
- ✨ Configuración centralizada en `config/config.php`
- ✨ Soporte para parámetros múltiples en URLs
- ✨ Documentación completa en README.md

### Estructura Inicial
- 📁 Carpetas: assets, config, controllers, helpers, libraries, models, views
- 📄 Archivos core: autoload.php, controllers.php, load.php, views.php
- 🎯 Controladores de ejemplo: Home, Errors
- 📝 Vistas de ejemplo: home.php, error/error.php

### Configuración
- ⚙️ .htaccess configurado para mod_rewrite
- ⚙️ Constantes BASE_URL, LIBS, VIEWS
- ⚙️ Soporte para JSON en Apache

---

## Formato de Versiones

- **[Major]**: Cambios incompatibles con versiones anteriores
- **[Minor]**: Nueva funcionalidad compatible con versiones anteriores
- **[Patch]**: Correcciones de bugs compatibles con versiones anteriores

## Tipos de Cambios

- `Agregado` - Nueva funcionalidad
- `Cambiado` - Cambios en funcionalidad existente
- `Obsoleto` - Funcionalidad que será removida
- `Removido` - Funcionalidad removida
- `Corregido` - Corrección de bugs
- `Seguridad` - Vulnerabilidades corregidas
