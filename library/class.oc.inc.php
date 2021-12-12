<?php

namespace library;

class oc
{
    /**
     * @throws \Exception
     */
    function must_include($directory = ".", $file="config.php"): void
    {
        if ($directory != "" && is_dir($directory) && is_file("{$directory}/{$file}")) {
            require_once "{$directory}/{$file}";
        }
        else
        {
            throw new \Exception("Cannot include: {$directory}/{$file}");
        }
    }

    function must_define($constant=""): void
    {
        if(!defined($constant))
        {
            throw new \Exception("Must define: {$constant}");
        }
    }
}