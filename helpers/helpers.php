<?php

declare(strict_types=1);

/**
 * Funciones Helper Globales
 * 
 * Este archivo contiene funciones auxiliares que están disponibles
 * globalmente en toda la aplicación.
 */

/**
 * Obtiene la URL base de la aplicación
 * 
 * Retorna la URL base definida en config.php.
 * Útil para construir URLs absolutas en vistas y controladores.
 * 
 * @return string URL base de la aplicación
 * 
 * @example
 * echo base_url(); // http://localhost/
 * echo base_url() . 'assets/css/style.css'; // http://localhost/assets/css/style.css
 */
function base_url(): string
{
    return BASE_URL;
}

/**
 * Obtiene la URL de la carpeta assets o de un recurso específico
 * 
 * Retorna la URL completa a la carpeta assets para acceder a recursos estáticos
 * como CSS, JavaScript, imágenes, etc. Si se proporciona una ruta, retorna
 * la URL completa del recurso.
 * 
 * @param string $path Ruta opcional del recurso dentro de assets
 * @return string URL de la carpeta assets o del recurso específico
 * 
 * @example
 * echo media(); // http://localhost/assets/
 * echo media('css/style.css'); // http://localhost/assets/css/style.css
 * echo media('image/logo.png'); // http://localhost/assets/image/logo.png
 * echo media('js/app.js'); // http://localhost/assets/js/app.js
 * 
 * // Uso en HTML
 * <img src="<?php echo media('image/logo.png'); ?>" alt="Logo" />
 * <link rel="stylesheet" href="<?php echo media('css/style.css'); ?>" />
 */
function media(string $path = ''): string
{
    $baseAssets = BASE_URL . "assets/";

    if (empty($path)) {
        return $baseAssets;
    }

    // Eliminar barra inicial si existe para evitar doble barra
    $path = ltrim($path, '/');

    return $baseAssets . $path;
}

/**
 * ============================================================
 * FUNCIÓN HELPER PARA TEMPLATE ADMIN
 * ============================================================
 * Función única para cargar cualquier componente del template admin
 */

/**
 * Carga componentes del template de administración
 * 
 * Función genérica que carga cualquier vista del template admin.
 * Busca el archivo en views/admin/template/{$view}.php
 * 
 * @param string $view Nombre de la vista a cargar (sin extensión .php)
 * @param array $data Datos opcionales a pasar a la vista (solo para header)
 * @return void
 * 
 * @example
 * // Cargar header
 * getAdminTemplate('header', $data);
 * 
 * // Cargar sidebar
 * getAdminTemplate('nav');
 * 
 * // Cargar topbar
 * getAdminTemplate('top_bar');
 * 
 * // Cargar menú móvil
 * getAdminTemplate('nav_mobile');
 * 
 * // Cargar footer
 * getAdminTemplate('footer');
 * 
 * // Cargar scripts
 * getAdminTemplate('list_scripts');
 */
function getAdminTemplate(string $view, array $data = []): void
{
    $templatePath = "views/admin/template/{$view}.php";

    if (file_exists($templatePath)) {
        require_once $templatePath;
    } else {
        die("Error: Template admin no encontrado - {$templatePath}");
    }
}

/**
 * Muestra el contenido de un array de forma legible (Debug)
 * 
 * Imprime un array con formato HTML <pre> para facilitar la depuración.
 * Útil durante el desarrollo para inspeccionar datos.
 * 
 * @param array $data Array a mostrar
 * @return void
 * 
 * @example
 * dep(['nombre' => 'Juan', 'edad' => 25]);
 */
function dep(array $data): void
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

/**
 * Limpia y sanitiza una cadena de texto
 * 
 * Elimina espacios extras, caracteres peligrosos y posibles inyecciones SQL básicas.
 * 
 * ADVERTENCIA DE SEGURIDAD:
 * Esta función NO es suficiente para prevenir inyección SQL.
 * SIEMPRE debes usar prepared statements en tus consultas SQL.
 * Esta función solo sirve como capa adicional de limpieza.
 * 
 * USO CORRECTO:
 * $name = strClean($_POST['name']);
 * $query = "INSERT INTO users (name) VALUES (?)";
 * $this->insert($query, [$name]);  // ← Prepared statement
 * 
 * USO INCORRECTO (INSEGURO):
 * $name = strClean($_POST['name']);
 * $query = "INSERT INTO users (name) VALUES ('$name')";  // ← VULNERABLE
 * 
 * @param string $string Cadena a limpiar
 * @return string Cadena limpia y sanitizada
 * 
 * @example
 * $name = strClean($_POST['name']);
 * $message = strClean($_POST['message']);
 */
function strClean(string $string): string
{
    // Normalizar espacios en blanco
    $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $string);
    $string = trim($string);
    $string = stripslashes($string);

    // Eliminar etiquetas script
    $string = str_ireplace("<script>", "", $string);
    $string = str_ireplace("</script>", "", $string);
    $string = str_ireplace("<script src>", "", $string);
    $string = str_ireplace("<script type=>", "", $string);

    // Eliminar comandos SQL comunes (protección adicional, NO reemplaza prepared statements)
    $sqlPatterns = [
        "SELECT * FROM",
        "DELETE FROM",
        "INSERT INTO",
        "UPDATE ",
        "DROP TABLE",
        "SELECT COUNT(*) FROM",
        "OR '1'='1",
        'OR "1"="1"',
        'OR ´1´=´1´',
        "is NULL; --",
        "LIKE '",
        'LIKE "',
        "LIKE ´",
        "OR 'a'='a",
        'OR "a"="a',
        "OR ´a´=´a",
        "--"
    ];

    foreach ($sqlPatterns as $pattern) {
        $string = str_ireplace($pattern, "", $string);
    }

    // Eliminar caracteres especiales peligrosos
    $dangerousChars = ["^", "[", "]", "=="];
    foreach ($dangerousChars as $char) {
        $string = str_ireplace($char, "", $string);
    }

    return $string;
}

/**
 * Genera una contraseña aleatoria segura
 * 
 * Crea una contraseña con letras mayúsculas, minúsculas y números.
 * Útil para generar contraseñas temporales o tokens.
 * 
 * @param int $length Longitud de la contraseña (por defecto 10)
 * @return string Contraseña generada
 * 
 * @example
 * $password = passGenerator(12); // "aB3xK9mP2qR1"
 * $tempPass = passGenerator(16); // "xY9kL2mN4pQ8rS1t"
 */
function passGenerator(int $length = 10): string
{
    $password = "";
    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $charactersLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $position = rand(0, $charactersLength - 1);
        $password .= substr($characters, $position, 1);
    }

    return $password;
}

/**
 * Genera un token único aleatorio
 * 
 * Crea un token criptográficamente seguro de 80 caracteres hexadecimales
 * separado por guiones. Útil para tokens de sesión, verificación de email,
 * reset de contraseñas, etc.
 * 
 * @return string Token generado en formato xxxx-xxxx-xxxx-xxxx
 * 
 * @example
 * $sessionToken = token(); // "a1b2c3d4e5f6g7h8i9j0-k1l2m3n4o5p6q7r8s9t0-..."
 * $verificationToken = token();
 */
function token(): string
{
    $part1 = bin2hex(random_bytes(10));
    $part2 = bin2hex(random_bytes(10));
    $part3 = bin2hex(random_bytes(10));
    $part4 = bin2hex(random_bytes(10));

    return $part1 . '-' . $part2 . '-' . $part3 . '-' . $part4;
}

/**
 * Formatea un número como moneda
 * 
 * Convierte un número a formato de moneda con separadores de miles y decimales.
 * Usa las constantes SPD, SPM y SMONEY definidas en config.php por defecto.
 * 
 * @param float|int $amount Cantidad a formatear
 * @param bool $showSymbol Mostrar símbolo de moneda (por defecto true)
 * @param string|null $decimalSeparator Separador de decimales (null usa SPD de config.php)
 * @param string|null $thousandsSeparator Separador de miles (null usa SPM de config.php)
 * @param string|null $currencySymbol Símbolo de moneda (null usa SMONEY de config.php)
 * @param bool $symbolBefore Símbolo antes del monto (true) o después (false)
 * @return string Cantidad formateada
 * 
 * @example
 * echo formatMoney(1234.56); // "$1,234.56" (usa SPD, SPM y SMONEY de config)
 * echo formatMoney(1234.56, false); // "1,234.56" (sin símbolo)
 * echo formatMoney(1234.56, true, ',', '.', '€'); // "€1.234,56" (euros)
 * echo formatMoney(1234.56, true, ',', '.', '€', false); // "1.234,56€" (símbolo después)
 */
function formatMoney(
    float|int $amount,
    bool $showSymbol = true,
    ?string $decimalSeparator = null,
    ?string $thousandsSeparator = null,
    ?string $currencySymbol = null,
    bool $symbolBefore = true
): string {
    // Usar constantes de config.php si no se especifican separadores
    $decimalSeparator = $decimalSeparator ?? (defined('SPD') ? SPD : '.');
    $thousandsSeparator = $thousandsSeparator ?? (defined('SPM') ? SPM : ',');
    $currencySymbol = $currencySymbol ?? (defined('SMONEY') ? SMONEY : '$');

    $formatted = number_format($amount, 2, $decimalSeparator, $thousandsSeparator);

    if ($showSymbol) {
        return $symbolBefore ? $currencySymbol . $formatted : $formatted . $currencySymbol;
    }

    return $formatted;
}

/**
 * Sanitiza y valida un email
 * 
 * Limpia y valida una dirección de email usando filtros de PHP.
 * Retorna el email limpio o false si no es válido.
 * 
 * @param string $email Email a validar
 * @return string|false Email sanitizado o false si es inválido
 * 
 * @example
 * $email = cleanEmail($_POST['email']);
 * if ($email === false) {
 *     echo "Email inválido";
 * }
 */
function cleanEmail(string $email): string|false
{
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $email;
    }

    return false;
}

/**
 * Sanitiza una URL
 * 
 * Limpia y valida una URL usando filtros de PHP.
 * Retorna la URL limpia o false si no es válida.
 * 
 * @param string $url URL a validar
 * @return string|false URL sanitizada o false si es inválida
 * 
 * @example
 * $website = cleanUrl($_POST['website']);
 * if ($website === false) {
 *     echo "URL inválida";
 * }
 */
function cleanUrl(string $url): string|false
{
    $url = filter_var($url, FILTER_SANITIZE_URL);

    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return $url;
    }

    return false;
}

