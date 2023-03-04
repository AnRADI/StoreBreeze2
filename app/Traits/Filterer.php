<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;


trait Filterer {

	private Builder $builder;

    /**
     * Applying filters.
     *
     * @param Builder $builder
     * @param array $requestItems
     * @return Builder
     */
    public static function apply(Builder $builder, array $requestItems): Builder {

        $yourFilterer = new static();
        $yourFilterer->builder = $builder;


        foreach($requestItems as $requestName => $requestItem) {

            if(method_exists($yourFilterer, $requestName)) {

                call_user_func_array([$yourFilterer, $requestName], array_filter([$requestItem]));
            }
        }

        return $yourFilterer->builder;
    }


}
