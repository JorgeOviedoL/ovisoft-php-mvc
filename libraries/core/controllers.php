<?php

declare(strict_types=1);

/**
 * Clase Controllers
 * 
 * Clase base para todos los controladores del framework.
 * Proporciona funcionalidad común como carga automática de modelos y vistas.
 */
class Controllers
{
    /**
     * Instancia del modelo asociado al controlador
     * @var object|null
     */
    public object|null $model = null;

    /**
     * Instancia de la clase Views para renderizar vistas
     * @var Views
     */
    public Views $views;

    /**
     * Constructor - Inicializa el controlador
     * 
     * Crea una instancia de Views y carga automáticamente el modelo
     * asociado al controlador si existe.
     */
    public function __construct()
    {
        $this->views = new Views();
        $this->loadModel();
    }

    /**
     * Carga automáticamente el modelo asociado al controlador
     * 
     * Busca un archivo de modelo con el nombre del controlador + "model".
     * Por ejemplo, para el controlador "Home" busca "Homemodel.php".
     * Si el archivo existe, lo carga y crea una instancia del modelo.
     * 
     * @return void
     */
    public function loadModel(): void
    {
        $model = get_class($this) . "model";
        $routClass = "models/" . $model . ".php";

        if (file_exists($routClass)) {
            require_once($routClass);
            $this->model = new $model();
        }
    }
}
