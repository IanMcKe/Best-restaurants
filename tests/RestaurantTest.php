<?php
    /**
    * @backupGlobals disabled
    * @backSuptaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=food_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
            protected function tearDown()
            {
                Restaurant::deleteAll();
                Cuisine::deleteAll();
            }

            function test_getId()
            {
                $name = "Asian";
                $id = null;
                $test_cuisine = new Cuisine($name, $id);
                $test_cuisine->save();

                $restaurant_name = "The Golden Duck";
                $location = "898 SW 5th Ave, Portland, OR";
                $description = "A Chill Asian experince";
                $price = "$$";
                $cuisine_id = $test_cuisine->getId();
                $test_restaurant = new Restaurant($restaurant_name, $location, $description, $price, $cuisine_id);
                $test_restaurant->save();

                $result = $test_restaurant->getId();
                $this->assertEquals(true, is_numeric($result));
            }
    }
?>
