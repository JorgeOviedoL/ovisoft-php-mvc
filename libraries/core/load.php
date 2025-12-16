<?php

declare(strict_types=1);

/**
 * Cargador de Controladores
 * 
 * Este archivo se encarga de:
 * 1. Cargar dinámicamente el archivo del controlador solicitado
 * 2. Instanciar el controlador
 * 3. Ejecutar el método solicitado con los parámetros
 * 4. Manejar errores si el controlador o método no existe
 * 
 * Soporta controladores en subcarpetas:
 * - URL: /admin/dashboard → controllers/admin/dashboard.controller.php
 * - URL: /user → controllers/user.controller.php
 * 
 * Variables disponibles (definidas en index.php):
 * - $controller: Nombre del controlador a cargar (puede incluir subcarpetas)
 * - $method: Nombre del método a ejecutar
 * - $params: Parámetros a pasar al método
 */

// Validación de seguridad: prevenir directory traversal attacks
// Eliminar caracteres peligrosos como ../ o ..\
$controller = str_replace(['../', '..\\'], '', $controller);

// Construir la ruta del archivo del controlador
// Soporta subcarpetas: admin/dashboard → controllers/admin/dashboard.controller.php
$controllerFile = "controllers/" . $controller . ".controller.php";

// Verificar si el archivo del controlador existe
if (file_exists($controllerFile)) {
    // Cargar el archivo del controlador
    require_once($controllerFile);

    // Extraer el nombre de la clase del controlador
    // Si es admin/dashboard, la clase será "dashboard"
    // Si es user, la clase será "user"
    $controllerParts = explode('/', $controller);
    $controllerClassName = end($controllerParts);

    // Instanciar el controlador
    $controllerInstance = new $controllerClassName();

    // Verificar si el método existe en el controlador
    if (method_exists($controllerInstance, $method)) {
        // Ejecutar el método con los parámetros
        $controllerInstance->{$method}($params);
    } else {
        // Método no encontrado - cargar página de error
        require_once("controllers/error.controller.php");
        exit;
    }
} else {
    // Controlador no encontrado - cargar página de error
    require_once("controllers/error.controller.php");
    exit;
}