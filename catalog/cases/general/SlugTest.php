<?php

use PHPUnit\Framework\TestCase;

class SlugTest extends TestCase
{
    private Slug $slug;

    public function setUp(): void
    {
        $this->slug = new Slug();
    }

    public function testSlug1()
    {
        $slug = $this->slug->create(" Category Name ");
        $this->assertEquals("category-name", $slug);
    }

    public function testSlug2()
    {
        $slug = $this->slug->create(" Some Category-Name ");
        $this->assertEquals("some-category-name", $slug);
    }

    public function testSlug3()
    {
        $slug = $this->slug->create("Some  Category  +   Name   ");
        $this->assertEquals("some-category-name", $slug);
    }

    public function testSlug4()
    {
        $slug = $this->slug->create("Some  ' Ca<teg>ory  +   Name   ");
        $this->assertEquals("some-category-name", $slug);
    }

    public function testSlug5()
    {
        $slug = $this->slug->create("Latest Released (#400) items!");
        $this->assertEquals("latest-released-400-items", $slug);
    }

    public function testSlug6()
    {
        $slug = $this->slug->create("bingo");
        $this->assertEquals("bingo", $slug);
    }

    public function testSlug7()
    {
        $slug = $this->slug->create("70'th bingo");
        $this->assertEquals("70th-bingo", $slug);
    }

    public function testSlug8()
    {
        $slug = $this->slug->create("pages: 76");
        $this->assertEquals("pages-76", $slug);
    }

    public function testSlug9()
    {
        $slug = $this->slug->create("important: read-me");
        $this->assertEquals("important-read-me", $slug);
    }

    public function testSlug10()
    {
        $slug = $this->slug->create("!Learn </XML>");
        $this->assertEquals("learn-xml", $slug);
    }

    public function testSlug11()
    {
        $slug = $this->slug->create_from_path("c:/test/example.txt");
        $this->assertEquals("example-txt", $slug);
    }

    public function testSlug12()
    {
        $slug = $this->slug->create_from_path("c:/test/example-txt");
        $this->assertEquals("example-txt", $slug);
    }

    public function testSlug13()
    {
        $slug = $this->slug->create_from_path("/test/example.txt");
        $this->assertEquals("example-txt", $slug);
    }
}
