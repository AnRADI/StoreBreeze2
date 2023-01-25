<?php


namespace App\Services\Animal;


use App\Traits\Singleton;

class Factory
{
    use Singleton;

    public static $data = [
        'class' => '',
        'count' => 0
    ];

    public static function data(array $data) {

        Factory::$data = $data;

        return Factory::getInstanceBy(static::class);
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
