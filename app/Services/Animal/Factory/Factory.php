<?php


namespace App\Services\Animal\Factory;


use App\Services\Animal\Cat;
use App\Services\Animal\Lion;


class Factory {

    public static array $data = [];


    /**
     * Sets factory settings.
     * @param string $class Class name.
     * @param int $count
     * @return Factory
     */
    public static function init(string $class, int $count): Factory {

        Factory::$data =
        [
            'class' => $class,
            'count' => $count
        ];


        return Singleton::getInstanceBy(static::class);
    }


    public function create() {

        switch (Factory::$data['class']) {

            case Cat::class:
                dump('Cat');
                break;
            case Lion::class:
                return new Lion();
                break;
        }
    }
}
