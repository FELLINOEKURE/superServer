<?php

declare(strict_types=1);

namespace Connection;

use Exception;
use mysqli;
use Interfaces\EntityInterface;
use Interfaces\ConnectionInterface;


class MysqliConnection implements ConnectionInterface {

    private static ?mysqli $instance = null;
    public function __construct() {}

    /**
     * @return mysqli
     */
    public static function getInstance(): mysqli
    {
        if (self::$instance === null) {
            self::$instance = new mysqli("my_sql", "ROMIK", "1488", "baZa");
        }

        return self::$instance;
    }

    /**
     * @param EntityInterface $entity
     * @param string $tableName
     * @param array $columns [['name' => '', 'type' => ''], [],....]
     * @return void
     */
    public static function createTable(EntityInterface $entity, string $tableName, array $columns): void {
        $arr = [];
        if (self::isEntityTableExists($entity)) {
            return;
        }
        foreach ($columns as $columValue) {

            $arr[] = implode(" ", $columValue);

        }
        $arr = implode(", ", $arr);
        self::getInstance()->query("CREATE TABLE $tableName ($arr)");
    }

    /**
     * @param EntityInterface $entity
     * @return void
     */
    public static function createEntityTable(EntityInterface $entity): void {
        self::createTable($entity, $entity->getTableName(), $entity->getTableColumns());
    }
    public static function isTableExists(string $tableName): bool
    {
        $table = self::getInstance()->query("SHOW TABLES LIKE '$tableName'");
        $row = $table->fetch_row();
        return $row !== null && $row[0] === $tableName;
    }
    public static function isEntityTableExists(EntityInterface $entity): bool
    {
        $tableName = $entity->getTableName();
        return static::isTableExists($tableName);
    }

    /**
     * @throws Exception
     */
    public static function save(EntityInterface $entity): void

    {
        $cols = [];
        foreach ($entity->getTableColumns() as $tableColumn) {
            if ($tableColumn['name'] !== 'ID')
            {
                $cols[] = $tableColumn['name'];
            }
        }

        if (!self::isEntityTableExists($entity)) {
            throw new Exception(sprintf('Table %s is not exist', $entity->getTableName()));
        }

        if (!$entity->getId()){
            $mysqli_request = 'INSERT INTO %1$s(%2$s) VALUES ("%3$s")';
            self::getInstance()->query(
                sprintf(
                    $mysqli_request,
                    $entity->getTableName(),
                    implode(", ", $cols),
                    implode('", "', $entity->getData())
                )
            );
        }else {
            $colsData =[]; //array [col=>value]

            foreach (array_combine($cols, $entity->getData()) as $key => $value) {
                $colsData[] = $key . '=' . "'".$value."'";
            }
            self::getInstance()->query(
                sprintf('UPDATE %s set %s WHERE id= %s', $entity->getTableName(),
                    implode(", ", $colsData), $entity->getId())
            );

        }
    }
}



