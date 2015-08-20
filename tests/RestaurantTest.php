<?php
    /**
    * @backupGlobals disabled
    * @backuptaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Review.php";
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
                Review::deleteAll();
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

            function test_getCuisineId()
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

                $result = $test_restaurant->getCuisineId();
                $this->assertEquals(true, is_numeric($result));
            }

            function test_save()
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

                $result = Restaurant::getAll();
                $this->assertEquals($test_restaurant, $result[0]);
            }

            function test_getAll()
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

                $result = Restaurant::getAll();
                $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
            }

            function test_deleteAll()
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

                Restaurant::deleteAll();

                $result = Restaurant::getAll();
                $this->assertEquals([], $result);
            }

            function test_find()
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

                $result = Restaurant::find($test_restaurant->getId());
                $this->assertEquals($test_restaurant, $result);
            }

            function test_update()
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
                $test_restaurant->update($restaurant_name2, $location2, $description2, $price2, $cuisine_id2);

                $result = $test_restaurant->getName();
                $this->assertEquals("The Red Dragon", $result);
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
                
                $test_restaurant->delete();
                $result = Restaurant::getAll();

                $this->assertEquals($test_restaurant2, $result[0]);
            }
            
        function test_deleteReviews()
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
            
            $test_restaurant->delete();
            $result = Review::getAll();
            //var_dump($result);
            
            $this->assertEquals([], $result);
        }
    }
?>
