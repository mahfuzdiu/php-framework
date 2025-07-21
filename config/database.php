<?php

return [
    "use" => "pdo_mysql",
    "drivers" => [
        "pdo_mysql" => [
            'driver' => 'pdo_mysql',
            'user' => 'root',
            'password' => '',
            'dbname' => 'mvc',
            'host' => '127.0.0.1',
            'port' => 3306,
            'charset' => 'utf8mb4'
        ],
        "pdo_pgsql" => [
            'driver' => 'pdo_pgsql',
            'user' => 'your_pg_user',
            'password' => 'your_pg_password',
            'dbname' => 'your_pg_database',
            'host' => '127.0.0.1',
            'port' => 5432, // ✅ Default PostgreSQL port
        ]
    ]
];