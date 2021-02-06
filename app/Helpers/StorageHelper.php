<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageHelper {

    public static function uploadGambar(Request $request, String $kind, String $file_name = "noname", String $attribute = 'gambar',String $default = "assets/images/tumbnail_pupuk.png"){
        if ($request->hasFile($attribute)) {
            $fileName = date('YmdHis') .'-'. $file_name .'-'. Str::random(25) . "." .$request->file($attribute)->getClientOriginalExtension();
            $request->file($attribute)->storeAs('public/'.$kind, $fileName);
            $path = 'storage/'.$kind.'/'.$fileName;
        }else{
            $path = $default;
        }
        return $path;
    }
}

