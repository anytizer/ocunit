<?php

use PHPUnit\Framework\TestCase;

class SlugTest extends TestCase
{

    public function testSlug1()
    {
        $slug = (new Slug())->create(" Category Name ");
        $this->assertEquals("category-name", $slug);
    }

    public function testSlug2()
    {
        $slug = (new Slug())->create(" Some Category Name ");
        $this->assertEquals("some-category-name", $slug);
    }

    public function testSlug3()
    {
        $slug = (new Slug())->create("Some  Category  +   Name   ");
        $this->assertEquals("some-category-name", $slug);
    }

    public function testSlug4()
    {
        $slug = (new Slug())->create("Some  ' Ca<teg>ory  +   Name   ");
        $this->assertEquals("some-ca-teg-ory-name", $slug);
    }
}
