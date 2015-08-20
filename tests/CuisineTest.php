<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";
    require_once "src/Review.php";

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

            $search_cuisine = $test_cuisine->getId();
            $result = Cuisine::find($search_cuisine);

            $this->assertEquals($test_cuisine, $result);
        }
        
        function test_delete()
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
            
            $restaurant_name2 = "The Red Dragon";
            $location2 = "899 SW 5th Ave, Portland, OR";
            $description2 = "A Intense Asian experince";
            $price2 = "$$$";
            $cuisine_id2 = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($restaurant_name2, $location2, $description2, $price2, $cuisine_id2);
            $test_restaurant2->save();

            $user = "yoloswag1959";
            $stars = 3;
            $headline = "It is aight.";
            $body = "Yeah, pretty aight bro";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($user, $stars, $headline, $body, $restaurant_id);
            $test_review->save();

            $user2 = "6969babygirl";
            $stars2 = 3;
            $headline2 = "XOXO";
            $body2 = "I cant even";
            $restaurant_id2 = $test_restaurant->getId();
            $test_review2 = new Review($user2, $stars2, $headline2, $body2, $restaurant_id2);
            $test_review2->save();
            
            $test_cuisine->delete();
            $result = Review::getAll();
            //var_dump($result);
            
            $this->assertEquals([], $result);
        }

    }

?>
