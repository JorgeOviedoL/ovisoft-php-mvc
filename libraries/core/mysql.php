<?php

declare(strict_types=1);

/**
 * Clase Mysql
 * 
 * Proporciona métodos para realizar operaciones CRUD en la base de datos MySQL.
 * Extiende de Connection para heredar la funcionalidad de conexión.
 * Utiliza PDO con prepared statements para prevenir inyección SQL.
 */
class Mysql extends Connection
{
    /**
     * Instancia de la conexión PDO
     * @var \PDO|string
     */
    private \PDO|string $connection;

    /**
     * Query SQL a ejecutar
     * @var string
     */
    private string $strquery;

    /**
     * Valores para prepared statements
     * @var array
     */
    private array $arrValues;

    /**
     * Constructor - Inicializa la conexión a la base de datos
     */
    public function __construct()
    {
        $connectionInstance = new Connection();
        $this->connection = $connectionInstance->connect();
    }

    /**
     * Inserta un nuevo registro en la base de datos
     * 
     * Ejecuta una query INSERT usando prepared statements para seguridad.
     * Retorna el ID del último registro insertado.
     *
     * @param string $query Query SQL con placeholders (?)
     * @param array $arrValues Array de valores para los placeholders
     * @return int ID del último registro insertado, 0 si falla
     * 
     * @example
     * $query = "INSERT INTO users (name, email) VALUES (?, ?)";
     * $values = ["Juan", "juan@example.com"];
     * $id = $this->insert($query, $values);
     */
    public function insert(string $query, array $arrValues): int
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;

        $insert = $this->connection->prepare($this->strquery);
        $resInsert = $insert->execute($this->arrValues);

        if ($resInsert) {
            $lastInsert = (int) $this->connection->lastInsertId();
        } else {
            $lastInsert = 0;
        }

        return $lastInsert;
    }

    /**
     * Busca un único registro en la base de datos
     * 
     * Ejecuta una query SELECT y retorna el primer resultado como array asociativo.
     * Útil para buscar un registro específico por ID u otro criterio único.
     *
     * @param string $query Query SQL SELECT
     * @return array|false Array asociativo con los datos del registro, false si no existe
     * 
     * @example
     * $query = "SELECT * FROM users WHERE id = 1";
     * $user = $this->select($query);
     */
    public function select(string $query): array|false
    {
        $this->strquery = $query;

        $result = $this->connection->prepare($this->strquery);
        $result->execute();
        $data = $result->fetch(\PDO::FETCH_ASSOC);

        return $data;
    }

    /**
     * Busca todos los registros que coincidan con la query
     * 
     * Ejecuta una query SELECT y retorna todos los resultados como array de arrays asociativos.
     * Útil para listar múltiples registros.
     *
     * @param string $query Query SQL SELECT
     * @return array Array de arrays asociativos con los datos de los registros
     * 
     * @example
     * $query = "SELECT * FROM users WHERE active = 1";
     * $users = $this->select_all($query);
     */
    public function select_all(string $query): array
    {
        $this->strquery = $query;

        $result = $this->connection->prepare($this->strquery);
        $result->execute();
        $data = $result->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    /**
     * Actualiza registros en la base de datos
     * 
     * Ejecuta una query UPDATE usando prepared statements para seguridad.
     * Retorna true si la actualización fue exitosa.
     *
     * @param string $query Query SQL UPDATE con placeholders (?)
     * @param array $arrValues Array de valores para los placeholders
     * @return bool True si la actualización fue exitosa, false en caso contrario
     * 
     * @example
     * $query = "UPDATE users SET name = ?, email = ? WHERE id = ?";
     * $values = ["Juan Pérez", "juan.perez@example.com", 1];
     * $success = $this->update($query, $values);
     */
    public function update(string $query, array $arrValues): bool
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;

        $update = $this->connection->prepare($this->strquery);
        $resExecute = $update->execute($this->arrValues);

        return $resExecute;
    }

    /**
     * Elimina registros de la base de datos
     * 
     * Ejecuta una query DELETE para eliminar registros.
     * Retorna el objeto PDOStatement para verificar el resultado.
     *
     * @param string $query Query SQL DELETE
     * @return \PDOStatement Objeto PDOStatement con el resultado de la operación
     * 
     * @example
     * $query = "DELETE FROM users WHERE id = 1";
     * $result = $this->delete($query);
     */
    public function delete(string $query): \PDOStatement
    {
        $this->strquery = $query;

        $result = $this->connection->prepare($this->strquery);
        $result->execute();

        return $result;
    }
}