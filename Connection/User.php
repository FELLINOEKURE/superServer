<?php

declare(strict_types=1);

namespace Connection;

use Interfaces\EntityInterface;

class User implements EntityInterface
{
    private ?string $login;
    private ?string $mail;
    private ?string $password;
    public ?int $id = null;

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param string|null $login
     */
    public function setLogin(?string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string|null
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * @param string|null $mail
     */
    public function setMail(?string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }
    public function getId(): ?int {
        return $this->id;
    }

    public function getTableName(): string {

        return 'User';
    }

    public function getTableColumns(): array
    {
        return [
            ['name' => 'ID', 'type' => 'INT AUTO_INCREMENT PRIMARY KEY'],
            ['name' => 'login', 'type' => 'VARCHAR(255)'],
            ['name' => 'mail', 'type' => 'VARCHAR(255)'],
            ['name' => 'password', 'type' => 'VARCHAR(255)']
        ];
    }

    public function getData(): array
    {
        return [$this->login, $this->mail, $this->password];

    }


}


