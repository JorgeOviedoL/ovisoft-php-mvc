<?php

declare(strict_types=1);

/**
 * Punto de Entrada del Framework OviSoft PHP MVC
 * 
 * Este archivo es el front controller que maneja todas las peticiones.
 * Funciona de la siguiente manera:
 * 
 * 1. Recibe la URL desde el parámetro GET 'url'
 * 2. Parsea la URL para extraer: controlador, método y parámetros
 * 3. Carga el autoloader para las clases del core
 * 4. Carga el loader que instancia y ejecuta el controlador
 * 
 * Formato de URL:
 * ?url=controlador/metodo/parametro1,parametro2
 * 
 * Ejemplo:
 * ?url=home/home           → Home::home()
 * ?url=users/show/5        → Users::show("5")
 * ?url=products/edit/1,admin → Products::edit("1,admin")
 */

// Cargar archivo de configuración
require_once("config/config.php");

//Cargar archivo helpers
require_once("helpers/helpers.php");

// Cargar rutas personalizadas
$routes = require_once("config/routes.php");

// Obtener la URL desde el parámetro GET, por defecto 'home/home'
$url = !empty($_GET['url']) ? $_GET['url'] : 'home/home';

// Verificar si existe una ruta personalizada para esta URL
if (isset($routes[$url])) {
    $url = $routes[$url];
}

// Dividir la URL en partes usando '/' como separador
$arrUrl = explode("/", $url);

// Variables para controlador, método y parámetros
$controller = '';
$method = '';
$params = "";

// Intentar encontrar el controlador (puede estar en subcarpetas)
// Ejemplo: admin/dashboard/index → busca controllers/admin/dashboard.controller.php
$controllerFound = false;
$controllerPath = '';

// Intentar con 2 niveles (subcarpeta/controlador)
if (count($arrUrl) >= 2) {
    $testPath = $arrUrl[0] . '/' . $arrUrl[1];
    if (file_exists("controllers/" . $testPath . ".controller.php")) {
        $controller = $testPath;
        $method = !empty($arrUrl[2]) ? $arrUrl[2] : $arrUrl[1]; // método o nombre del controlador
        $controllerFound = true;
        $paramStartIndex = 3; // parámetros empiezan desde índice 3
    }
}

// Si no se encontró, intentar con 1 nivel (controlador en raíz)
if (!$controllerFound && count($arrUrl) >= 1) {
    $testPath = $arrUrl[0];
    if (file_exists("controllers/" . $testPath . ".controller.php")) {
        $controller = $testPath;
        $method = !empty($arrUrl[1]) ? $arrUrl[1] : $arrUrl[0]; // método o nombre del controlador
        $controllerFound = true;
        $paramStartIndex = 2; // parámetros empiezan desde índice 2
    }
}

// Si no se encontró ningún controlador, usar el primero de la URL
if (!$controllerFound) {
    $controller = $arrUrl[0];
    $method = !empty($arrUrl[1]) ? $arrUrl[1] : $arrUrl[0];
    $paramStartIndex = 2;
}

// Extraer parámetros desde el índice correspondiente
if (isset($paramStartIndex) && count($arrUrl) > $paramStartIndex) {
    for ($i = $paramStartIndex; $i < count($arrUrl); $i++) {
        if ($arrUrl[$i] !== "") {
            $params .= $arrUrl[$i] . ',';
        }
    }
    // Eliminar la última coma
    $params = trim($params, ',');
}

// Cargar el autoloader para las clases del core
require_once("libraries/core/autoload.php");

// Cargar el loader que instancia y ejecuta el controlador
require_once("libraries/core/load.php");
