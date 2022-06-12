<?php

class Slug
{
    public function create_from_path($path = "/directory/path"): string
    {
        $paths = pathinfo($path);
        $slug = $this->create(str_replace(".", "-", $paths["basename"]));

        return $slug;
    }

    /**
     * Create a slug from text
     *
     * @param string $name
     * @return string
     */
    public function create(string $name = ""): string
    {
        $slug = strtolower(trim(preg_replace("/[^a-zA-Z0-9- ]/", "", $name)));
        $slug = preg_replace("/([^a-z0-9\-])+/is", "-", $slug);
        $slug = trim($slug);

        return $slug;
    }
}