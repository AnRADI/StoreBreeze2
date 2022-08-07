<?php

namespace App\Services\Uploader;

use App\Contracts\Uploader;
use Illuminate\Http\Request;


class ImageUploader implements Uploader {


	public function upload($item) {

		// ------ Upload to disk: storage/app/public/uploads ------

		$imageName = $item->getClientOriginalName();

		$item->storeAs('uploads', $imageName, 'public');


		//  ------ Image path ------

		$fileHash = substr(md5_file($item->getRealPath()), -20);

		return '/storage/uploads/' . $imageName . '?id=' . $fileHash;
	}
}