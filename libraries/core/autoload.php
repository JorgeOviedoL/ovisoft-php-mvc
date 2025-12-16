<?php

declare(strict_types=1);

/**
 * Autoloader del Framework
 * 
 * Registra una función de autocarga para las clases del core.
 * Cuando se intenta usar una clase que no ha sido cargada,
 * PHP automáticamente busca el archivo correspondiente en libraries/core/
 * 
 * Ejemplo: Al usar "new Views()", PHP buscará y cargará automáticamente
 * el archivo "libraries/core/Views.php"
 */

spl_autoload_register(function (string $class): void {
    $classFile = "libraries/core/" . $class . ".php";

    if (file_exists($classFile)) {
        require_once($classFile);
    }
});