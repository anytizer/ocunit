<?php
class BuilderTest extends \PHPUnit\Framework\TestCase
{
    function testImportImages()
    {
        $categries = scandir("D:/desktop/stores");
        #$categries = array_diff(scandir($mydir), array('.', '..'));
        foreach($categries as $category)
        {
            /*
            $images = scandir($category);
            $price = price();
            $description = $description();
            $name = name();
            $slug = slug();
            */
        }

        print_r($categries);
    }
}