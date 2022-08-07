<?php

namespace App\Contracts;

use Illuminate\Http\Request;


interface Uploader {

	public function upload($item);
}