<?php

return [
    "use"     => "pdo_mysql",
    "drivers" => [
        "pdo_mysql" => [
            'driver'   => 'pdo_mysql',
            'dbname'   => $_ENV["DB_DATABASE"],
            'user'     => $_ENV["DB_USERNAME"],
            'password' => $_ENV["DB_PASSWORD"],
            'host'     => $_ENV["DB_HOST"] ?? "127.0.0.1",
            'port'     => $_ENV["DB_PORT"] ?? 3306,
            'charset'  => $_ENV["DB_CHARSET"] ?? 'utf8mb4'
        ],
        "pdo_pgsql" => [
            'driver'   => 'pdo_pgsql',
            'dbname'   => $_ENV["DB_DATABASE"],
            'user'     => $_ENV["DB_USERNAME"],
            'password' => $_ENV["DB_PASSWORD"],
            'host'     => $_ENV["DB_HOST"] ?? "127.0.0.1",
            'port'     => $_ENV["DB_PORT"] ?? 5432,
            'charset'  => $_ENV["DB_CHARSET"] ?? 'utf8mb4'
        ]
    ]
];
