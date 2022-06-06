<?php

class Slug
{
    /**
     * Create a slug from text
     *
     * @param string $name
     * @return string
     */
    public function create($name=""): string
    {
        $slug = strtolower(trim(preg_replace("/[^a-zA-Z0-9\- \ ]/", "", $name)));
        $slug = preg_replace("/([^a-z0-9\-])+/is", "-", $slug);
        $slug = trim($slug);

        return $slug;
    }

    public function create_from_path($path="/directory/path")
    {
        $paths = pathinfo($path);
        $slug = $this->create(str_replace(".", "-", $paths["basename"]));

        return $slug;
    }
}