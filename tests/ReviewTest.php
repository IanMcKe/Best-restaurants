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

    class ReviewTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
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

            $user = "yoloswag1959";
            $stars = 3;
            $headline = "It's aight.";
            $body = "Yeah, pretty aight bro";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($user, $stars, $headline, $body, $restaurant_id);
            $test_review->save();

            $result = $test_review->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_getRestaurantId()
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
            //var_dump($test_restaurant);


            $user = "yoloswag1959";
            $stars = 3;
            $headline = "It is aight.";
            $body = "Yeah pretty aight bro";
            $restaurant_id =$test_restaurant->getId();
            //var_dump($restaurant_id);
            $test_review = new Review($user, $stars, $headline, $body, $restaurant_id);
            $test_review->save();
            //var_dump($test_review);

            $result = $test_review->getRestaurantId();

            $this->assertEquals($restaurant_id, $result);
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

            $user = "yoloswag1959";
            $stars = 3;
            $headline = "It is aight.";
            $body = "Yeah, pretty aight bro";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($user, $stars, $headline, $body, $restaurant_id);
            $test_review->save();

            $result = Review::getAll();

            $this->assertEquals($test_review, $result[0]);
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

            $result = Review::getAll();
            $this->assertEquals([$test_review, $test_review2], $result);

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

            Review::deleteAll();
            $result = Review::getAll();

            $this->assertEquals([], $result);
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
            $test_review->update($user2, $stars2, $headline2, $body2, $restaurant_id2);

            $result = $test_review->getUser();

            $this->assertEquals("6969babygirl", $result);
        }
    }

?>
