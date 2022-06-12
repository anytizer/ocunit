<?php

namespace ocunit\library;

class FileToucher
{
    /**
     * @param string $file
     * @return int File size in bytes
     */
    public function touch(string $file = ""): int
    {
        touch($file);

        //assert(is_file($file));
        return filesize($file);
    }
}