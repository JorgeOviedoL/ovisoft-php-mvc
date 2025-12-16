<?php

declare(strict_types=1);

/**
 * Clase Connection
 * 
 * Maneja la conexión a la base de datos MySQL usando PDO.
 * Implementa el patrón Singleton implícito para la conexión.
 */
class Connection
{
    /**
     * Instancia de la conexión PDO
     * @var \PDO|string
     */
    private \PDO|string $connect;

    /**
     * Constructor - Establece la conexión a la base de datos
     * 
     * Crea una nueva conexión PDO usando las constantes definidas en config.php.
     * Configura el modo de errores a excepciones para mejor manejo de errores.
     * 
     * @throws \PDOException Si la conexión falla
     */
    public function __construct()
    {
        $connectionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        try {
            $this->connect = new \PDO($connectionString, DB_USER, DB_PASSWORD);
            $this->connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Configurar zona horaria de MySQL para que coincida con PHP
            // Esto asegura que CURRENT_TIMESTAMP, NOW() y otras funciones de fecha
            // usen la misma zona horaria que PHP, independientemente del servidor
            if (defined('DB_TIMEZONE')) {
                $this->connect->exec("SET time_zone = '" . DB_TIMEZONE . "'");
            }
        } catch (\PDOException $e) {
            $this->connect = 'Error de conexión';
            echo "ERROR: " . $e->getMessage();
        }
    }

    /**
     * Obtiene la instancia de conexión PDO
     * 
     * @return \PDO|string Instancia de PDO o mensaje de error
     */
    public function connect(): \PDO|string
    {
        return $this->connect;
    }
}
