<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    //require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=food_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
            Review::deleteAll();
        }

        function test_getType()
        {
            $type = "Mexican";
            $test_cuisine = new Cuisine($type);

            $result = $test_cuisine->getType();

            $this->assertEquals($type, $result);
        }

        function test_getId()
        {
            $type = "Japanese";
            $id = 1;
            $test_cuisine = new Cuisine($type, $id);

            $result = $test_cuisine->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_getAll()
        {
            $type = "Argentinian";
            $type2 = "Ethiopian";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($type2);
            $test_cuisine2->save();

            $result = Cuisine::getAll();

            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);
        }

        function test_save()
        {
            $type = "Korean";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();

            $result = Cuisine::getAll();

            $this->assertEquals($test_cuisine, $result[0]);
        }

        function test_deleteAll()
        {
            $type = "Chinese";
            $type2 = "American";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($type2);
            $test_cuisine2->save();

            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            $this->assertEquals([], $result);
        }

        function test_update()
        {
            $type = "Chinese";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();

            $test_cuisine->update("Mexican");

            $result = $test_cuisine->getType();

            $this->assertEquals("Mexican", $result);
        }

        // function test_getRestaurants()
        // {
        //
        // }

        function test_find()
        {
            $type = "Mexican";
            $type2 = "Southern";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($type2);
            $test_cuisine2->save();

            $search_cuisine = $test_cuisine->getType();
            $result = Cuisine::find($search_cuisine);

            $this->assertEquals($test_cuisine, $result);
        }

    }

?>
