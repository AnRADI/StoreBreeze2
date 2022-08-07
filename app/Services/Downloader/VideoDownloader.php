<?php


namespace App\Services\Downloader;


use App\Contracts\Downloader;

class VideoDownloader implements Downloader {

	public function __construct() {
		dump('download video');
	}

	public function download() {
		// TODO: Implement upload() method.
	}
}