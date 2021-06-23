<?php

class DB {
    private static $instance;

    public static function get_instance() {
        include __DIR__."/../../config/config.php";
        if (!self::$instance) {
            self::$instance = new PDO(
                "mysql:host=".$DB_HOST.";port=".$DB_PORT.";dbname=".$DB_NAME,
                $DB_USERNAME,
                $DB_PASSWORD
            );
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}

