<?php

namespace App\Services\Animal\Factory;

class Singleton
{
    private static $instance;


    private function __construct() { /* ... @return Singleton */ }  // Защищаем от создания через new Singleton
    private function __clone() { /* ... @return Singleton */ }  // Защищаем от создания через клонирование
    public function __wakeup() { /* ... @return Singleton */ }  // Защищаем от создания через unserialize


    /**
     * Returns a singleton of the class instance.
     * @param string $class
     * @return Factory
     */
    public static function getInstanceBy(string $class): Factory {
        return
            static::$instance ??
            static::$instance = new $class();
    }
}
