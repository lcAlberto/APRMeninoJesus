<?php
/**
 * Created by PhpStorm.
 * User: lucka
 * Date: 24/06/22
 * Time: 23:43
 */

use App\Enums\UserRolesEnum;

return [
    UserRolesEnum::ROOT => [
        'organizations' => ['index', 'view', 'create', 'update', 'delete'],
        'users' => ['index', 'view', 'create', 'update', 'delete'],
        'patrimonies' => ['index', 'view', 'create', 'update', 'delete'],
        'partners' => ['index', 'view', 'create', 'update', 'delete'],
        'management' => ['index', 'view', 'create', 'update', 'delete'],
        'borrowings' => ['index', 'view', 'create', 'update', 'delete'],
        'cash_books' => ['index', 'view', 'create', 'update', 'delete'],
    ],

    UserRolesEnum::ADMIN => [
        'users' => ['index', 'view', 'create', 'update', 'delete'],
        'patrimonies' => ['index', 'view', 'create', 'update', 'delete'],
        'partners' => ['index', 'view', 'create', 'update', 'delete'],
        'management' => ['index', 'view', 'create', 'update', 'delete'],
        'borrowings' => ['index', 'view', 'create', 'update', 'delete'],
        'cash_books' => ['index', 'view', 'create', 'update', 'delete'],
    ],

    UserRolesEnum::TREASURER => [
        'cash_books' => ['index', 'view', 'create', 'update', 'delete'],
    ],

    UserRolesEnum::PARTNER => [
        'borrowings' => ['index', 'view', 'create', 'update', 'delete'],
    ],
];
