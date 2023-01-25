<?php


namespace App\Services\Animal;


final class Cat implements Animal
{

    public static int $mm = 2;
    public function voice()
    {
        dump('Cat');
    }
}
