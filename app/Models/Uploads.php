<?php

namespace App\Models;

use Illuminate\Support\Str;

class Uploads
{

    public static function startUpload($folderTujuan, $objFile, $file_lama, $maxSize = 0)
    {
        if ($objFile == null) {
            return ['status' => 'success', 'file_name' => $file_lama];
        } else {
            $full_name = $objFile->getClientOriginalName();
            $file_name_only = Str::substr($full_name, 0, strrpos($full_name, '.'));
            $file_name_slug = Str::slug($file_name_only, '_');
            $file_extension = $objFile->getClientOriginalExtension();
            $file_name = $file_name_slug . '.' . $file_extension;
            $file_name_slug_temp = $file_name_slug;
            $file_size = $objFile->getSize();
            $real_path = $objFile->getRealPath();
            $mime_type = $objFile->getMimeType();

            if ($maxSize != 0) {
                if (($file_size / 1000) > $maxSize) { //Kb
                    return ['status' => 'fail', 'message' => 'Ukuran file maksimal ' . $maxSize . 'Kb'];
                }
            }

            //hapus file lama jika ada
            if (!empty($file_lama)) {
                if (file_exists($folderTujuan . '/' . $file_lama)) {
                    unlink($folderTujuan . '/' . $file_lama);
                }
            }


            $i = 1;
            while (file_exists($folderTujuan . '/' . $file_name_slug_temp . '.' . $file_extension)) {
                $file_name_slug_temp = (string)$file_name_slug . $i;
                $file_name = (string)$file_name_slug . $i . '.' . $file_extension;
                $i++;
            }

            $objFile->move($folderTujuan, $file_name);
            return ['status' => 'success', 'file_name' => $file_name];
        }
    }

    public static function hapusFile($folderTujuan, $filename)
    {
        if (!empty($filename)) {
            if (file_exists($folderTujuan . '/' . $filename)) {
                unlink($folderTujuan . '/' . $filename);
            }
        }
        return true;
    }
}
