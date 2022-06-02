<?php

class Slug
{
    public function create($name=""): string
    {
        $slug = strtolower(trim($name));
        $slug = preg_replace("/([^a-z])+/is", "-", $slug);

        return $slug;
    }
}