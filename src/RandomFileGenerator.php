<?php

namespace Siestacat\RandomFileGenerator;

class RandomFileGenerator
{
    const DEFAULT_FILE_SIZE = 1024 * 1024; //1MB

    const WRITE_CHUNK = 1024;

    public static function generate(?string $tmp_dir = null, ?string $prefix = null, int $file_size = self::DEFAULT_FILE_SIZE):string
    {
        $file_path = tempnam
        (
            ($tmp_dir ?: sys_get_temp_dir()),
            ($prefix ?: substr(hash('md5', random_bytes(32)), 0, 8))
        );

        //Credits: @antikirra on Github https://gist.github.com/antikirra/c5391f67e81fe4e6a9f8486ed3b5ee1f

        $fp = fopen($file_path, 'wb+');

        while ($file_size > self::WRITE_CHUNK) {
            fwrite($fp, random_bytes(self::WRITE_CHUNK));
            $file_size -= self::WRITE_CHUNK;
        }
    
        if ($file_size > 0 && $file_size <= self::WRITE_CHUNK) {
            fwrite($fp, random_bytes($file_size));
        }
    
        fclose($fp);

        return $file_path;

    }
}