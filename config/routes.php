<?php

declare(strict_types=1);

/**
 * Configuración de Rutas Personalizadas
 * 
 * Define alias de rutas para URLs más amigables.
 * Permite mapear URLs cortas a controladores en subcarpetas.
 * 
 * Formato:
 * 'url-amigable' => 'ruta/completa/metodo'
 * 
 * Ejemplos:
 * '/dashboard' → controllers/admin/dashboard.controller.php::dashboard()
 * '/usuarios' → controllers/admin/users.controller.php::index()
 */

return [
    // Rutas de administración
    'dashboard' => 'admin/dashboard/dashboard',
    'admin' => 'admin/dashboard/dashboard',

    // Puedes agregar más rutas aquí
    // 'usuarios' => 'admin/users/index',
    // 'configuracion' => 'admin/settings/index',
    // 'perfil' => 'user/profile/index',
];
