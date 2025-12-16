<?php

declare(strict_types=1);

/**
 * Controlador Dashboard
 * 
 * Maneja las peticiones relacionadas con el dashboard de administración.
 */
class Dashboard extends Controllers
{
    /**
     * Constructor - Inicializa el controlador
     * 
     * Llama al constructor padre para cargar el modelo y las vistas.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Método principal - Muestra la página de inicio
     * 
     * Prepara los datos de la página principal y los pasa a la vista home.
     * Los datos incluyen título, contenido, iconos y metadatos de la página.
     * 
     * @return void
     */
    public function dashboard(): void
    {
        $data['id_page'] = "2";
        $data['tag_page'] = "Dashboard";
        $data['icon_page'] = "fa-solid fa-dashboard";
        $data['title_page'] = "Dashboard";
        $data['subtitle_page'] = "Bienvenido al panel de control de Ovisoft.";
        $data['name_page'] = "Dashboard";


        $this->views->getView($this, "admin/dashboard/dashboard", $data);
    }
}
