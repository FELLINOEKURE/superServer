<?php

declare(strict_types=1);

namespace Interfaces;

interface UserManagementInterface {
   public static function authorize(string $login, string $password): bool;

}
//TODO посмотреть паттерн программирования repository and ресурсная model
//TODO и создать классы для User'a
//TODO создать класс UserManagement, в нем фунецию авторизации,
//TODO добавить глобал isLoggedIn:bool и getUser(получить текущего пользователя)
//TODO добавить hello ф.и.о в шапку