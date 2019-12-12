<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTrait 
{
    public function uploadOne(UploadedFile $uploadedFile, $folder = null, 
    	$disk = 'public', $fileName = null
    ) {

    	$name = !is_null($fileName) ? $fileName : Str::Random(25);
    	return $uploadedFile->storeAs(
    			$folder, 
    			$name.'.'.$uploadedFile->getClientOriginalExtension(), 
    			$disk
    	);
    }
}