<?php


namespace App\Services\Uploader;


use App\Contracts\Uploader;

class VideoUploader implements Uploader {

	public function __construct() {
		dump('upload video');
	}

	public function upload($item) {
		// TODO: Implement upload() method.
	}
}
