<?php

declare(strict_types=1);

namespace Interfaces;

interface EntityInterface {
    public function getTableName(): string;

    public function getTableColumns(): array;

    public function getData(): array;

    public function getId(): ?int;

}