<?php

namespace App\Services\Uploader;

use App\Contracts\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageUploader implements Uploader {


	public function upload($item) {

		// ------ Upload to disk: storage/app/public/uploads ------

		$imageName = $item->getClientOriginalName();

		$item->storeAs('images/products', $imageName, 'public');


		//  ------ Image path ------

		$fileHash = substr(md5_file($item->getRealPath()), -20);

		return '/storage/images/products/' . $imageName . '?id=' . $fileHash;
	}
}