<?php


namespace App\Services\Downloader;


use App\Contracts\Downloader;
use App\Contracts\Uploader;
use App\Services\Uploader\ImageUploader;
use App\Services\Uploader\VideoUploader;

class ImageDownloader implements Downloader {



	public function __construct() {
		//dump('download image');
	}

	public function download() {
		// TODO: Implement upload() method.
	}
}
