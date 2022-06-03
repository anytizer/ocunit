<?php

namespace ocunit\library;

class FileToucher
{
    /**
     * @param string $file
     * @return int File size in bytes
     */
    public function touch($file="")
    {
        touch($file);

        assert(is_file($file));
        return filesize($file);
    }
}