<?php

namespace App\Utils;

use Illuminate\Support\Facades\Storage;
use Exception;

class FileUploader
{
    const STORAGE_DISK = 'r2';

    public static function uploadFile($file_or_url, $path, $image_name, $isUrl = false)
    {
        $disk = self::STORAGE_DISK;

        $file_name = $isUrl ? basename(parse_url($file_or_url, PHP_URL_PATH)) : time() . '/' . $image_name;
        $full_path = $path . '/' . $file_name;

        if ($isUrl) {
            $content = file_get_contents($file_or_url);
        } else {
            $content = $file_or_url instanceof \Intervention\Image\Image
                ? (string) $file_or_url->encode()  // 画像オブジェクトからのエンコード
                : file_get_contents($file_or_url->getRealPath());  // 一般的なファイルからの取得
        }

        if (!$content) {
            throw new Exception('ファイルのロードに失敗しました');
        }

        if ($disk === 'r2' || $disk === 's3') {
            $res = Storage::disk($disk)->put($full_path, $content);
        } else {
            $full_path = $file_or_url->store("public/" . $path, $disk);
        }

        return Storage::disk($disk)->url($full_path);
    }
}
