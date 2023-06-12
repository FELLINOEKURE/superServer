<?php

declare(strict_types=1);

namespace Interfaces;
use mysqli;

interface ConnectionInterface {

    public static function getInstance(): mysqli;
    public static function isEntityTableExists(EntityInterface $entity): bool;

    public static function createTable(EntityInterface $entity, string $tableName, array $columns): void;

    public static function createEntityTable(EntityInterface $entity): void;

}