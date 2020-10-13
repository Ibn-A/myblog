<?php
namespace App\Table;
use \PDO;

abstract class Table {

    protected $pdo;
    protected $table = null;
    protected $class = null;
    protected $id = null;

    public function __construct(PDO $pdo) {
        if ($this->table === null) {
            throw new \Exception("La class ". get_class($this)." n'a pas de propriété \$table");
        }
        if ($this->class === null) {
            throw new \Exception("La class ". get_class($this) . " n'a pas de propriété \$class");
        }
        $this->pdo = $pdo;
    }

    public function find(int $id) {

        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table .' WHERE '. $this->id.' = :id');
        $query->execute(['id' => $id ]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        /** @var Category|false */
        $result = $query->fetch();
        if ($result === false) {
            throw new NotFoundException($this->table, $id);
        }
        return $result;
    }

    /**
     * Vérifie si une valeur existe dans une table en bdd
     * @param string $field Champ à rechercher
     * @param string $value Valeur associée au Champs
     */
    public function exists(string $field, $value, ?int $except = null): bool {
        $sql = "SELECT COUNT(id_post) FROM {$this->table} WHERE $field = ?";
        $params = [$value];
        if($except !== null) {
            $sql .= " AND id_post != ?";
            $params[] = $except;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        $result = (int)$query->fetch(PDO::FETCH_NUM[0]) > 0;
        return $result;
        
    }

    public function findAll(): array {
        $sql = "SELECT * FROM {$this->table}";
        $result = $this->pdo->query($sql, PDO::FETCH_CLASS,$this->class)->fetchAll();
        return $result;
    }
   
}