<?php

namespace App\Services\Faker\Provider;

use Faker\Provider\Base;


class Unsplash extends Base{

	/**
	 * Generate the URL that will return a random image
	 *
	 * Set randomize to false to remove the random GET parameter at the end of the url.
	 *
	 * @param  integer  $width
	 * @param  integer  $height
	 * @param  array  $keywords
	 * @param  bool  $randomize
	 *
	 * @return string
	 * @example 'https://source.unsplash.com/random/300x300/?wallpaper,landscape&r=345'
	 *
	 */
	public static function imageUrl($width = 300, $height = 300, array $keywords = [], $randomize = true)
	{
		$baseUrl = "https://source.unsplash.com";
		$urlPath = '';
		$urlParameters = '';

		$strRand = '';


		if($randomize) {

			$urlPath .= '/random';

			$strRand = 'r=' . mt_rand(1, 1024);
		}


		$urlPath .= "/{$width}x{$height}";


		if(is_array($keywords) && count($keywords)) {

			$urlParameters .= '/?' . implode(',', $keywords) . '&' .  $strRand;
		} else {
			$urlParameters .= '/?' . $strRand;
		}


		return $baseUrl . $urlPath . $urlParameters;
	}
}