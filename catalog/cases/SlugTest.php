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
        $this->assertEquals("some-category-name", $slug);
    }

    public function testSlug5()
    {
        $slug = (new Slug())->create("Latest Released (#400) items!");
        $this->assertEquals("latest-released-400-items", $slug);
    }

    public function testSlug6()
    {
        $slug = (new Slug())->create("bingo");
        $this->assertEquals("bingo", $slug);
    }

    public function testSlug7()
    {
        $slug = (new Slug())->create("70'th bingo");
        $this->assertEquals("70th-bingo", $slug);
    }
}
