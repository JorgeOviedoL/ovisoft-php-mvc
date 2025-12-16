<?php

declare(strict_types=1);

/**
 * Clase Views
 * 
 * Maneja la carga y renderizado de vistas del framework.
 * Busca automáticamente las vistas en la estructura de carpetas
 * y extrae las variables del array $data para usarlas en las vistas.
 */
class Views
{
    /**
     * Carga y renderiza una vista
     * 
     * Busca la vista en diferentes ubicaciones:
     * 1. Si $view contiene '/', usa la ruta exacta: views/$view.php
     * 2. Si no, busca en views/controlador/vista.php
     * 3. Como fallback, busca en views/vista.php
     * 
     * Extrae las variables del array $data para que estén disponibles en la vista.
     *
     * @param object $controller Instancia del controlador que llama a la vista
     * @param string $view Nombre o ruta de la vista a cargar (sin extensión .php)
     *                     Ejemplos: "home", "admin/dashboard/index"
     * @param array $data Array asociativo con datos a pasar a la vista
     * @return void
     * 
     * @example
     * // Vista simple
     * $this->views->getView($this, "home");
     * 
     * // Vista en subcarpeta (controlador en admin/)
     * $this->views->getView($this, "admin/dashboard/index");
     */
    public function getView(object $controller, string $view, array $data = []): void
    {
        $viewPath = '';

        // Si la vista contiene '/', es una ruta completa
        if (strpos($view, '/') !== false) {
            // Usar la ruta exacta proporcionada
            $viewPath = "views/" . $view . ".php";
        } else {
            // Comportamiento original: buscar por nombre de controlador
            $controllerName = get_class($controller);

            // Convertir el nombre del controlador a minúsculas para la carpeta
            $controllerFolder = strtolower($controllerName);

            // Casos especiales para mapear nombres de controladores a carpetas
            if ($controllerName === "Errors") {
                $controllerFolder = "error";
            }

            // Intentar primero con la estructura de carpetas
            $viewPath = "views/" . $controllerFolder . "/" . $view . ".php";

            // Si no existe, intentar directamente en views/
            if (!file_exists($viewPath)) {
                $viewPath = "views/" . $view . ".php";
            }
        }

        // Verificar que el archivo existe antes de cargarlo
        if (file_exists($viewPath)) {
            // Extraer variables del array $data para usarlas en la vista
            extract($data);
            require_once($viewPath);
        } else {
            die("Error: Vista no encontrada - " . $viewPath);
        }
    }
}
