<?php


namespace App\Traits;


trait Singleton {
    private static $instance;

    private function __construct() { /* ... @return Singleton */ }  // Защищаем от создания через new Singleton
    private function __clone() { /* ... @return Singleton */ }  // Защищаем от создания через клонирование
    private function __wakeup() { /* ... @return Singleton */ }  // Защищаем от создания через unserialize

    public static function getInstanceBy(string $class) {
        return
            static::$instance ??
            static::$instance = new $class();
    }
}
