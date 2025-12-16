<?php

declare(strict_types=1);

/**
 * Controlador Errors
 * 
 * Maneja las páginas de error del framework.
 * Se invoca automáticamente cuando no se encuentra un controlador o método.
 */
class Errors extends Controllers
{
    /**
     * Constructor - Inicializa el controlador de errores
     * 
     * Llama al constructor padre para cargar el modelo y las vistas.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Muestra la página de error 404 (No encontrado)
     * 
     * Este método se ejecuta cuando:
     * - Un controlador solicitado no existe
     * - Un método solicitado no existe en el controlador
     * 
     * @param string $params Parámetros adicionales (opcional, no se usa actualmente)
     * @return void
     */
    public function notFound(string $params = ""): void
    {
        $this->views->getView($this, "error");
    }
}

// Instanciar y ejecutar el controlador de errores
$notFound = new Errors();
$notFound->notFound("");
