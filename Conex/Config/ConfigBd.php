<?php

namespace Config;

class ConfigBd
{

    public static function getConfig()
    {
        return[
            'host' => getenv('MYSQL_HOST') ?: 'localhost',
            'user' => getenv('MYSQL_USER') ?: 'root',
            'password' => getenv('MYSQL_PASSWORD') ?: '',
            'database' => getenv('MYSQL_DATABASE') ?: '',
        ];
    }
}