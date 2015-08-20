<?php
    class Restaurant
    {
        private $name;
        private $location;
        private $description;
        private $price;
        private $cuisine_id;
        private $id;

        function __construct($name, $location, $description, $price, $cuisine_id, $id=null)
        {
            $this->name = $name;
            $this->location = $location;
            $this->description = $description;
            $this->price = $price;
            $this->cuisine_id = $cuisine_id;
            $this->id = $id;

        }

        function getName()
        {
            return $this->name;
        }

        function getLocation()
        {
            return $this->location;
        }

        function getDescription()
        {
            return $this->description;
        }

        function getPrice()
        {
            return $this->price;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function getId()
        {
            return $this->id;
        }

        function updateName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE restaurants SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->name = $new_name;
        }

        function updateLocation($new_location)
        {
            $GLOBALS['DB']->exec("UPDATE restaurants SET location = '{$new_location}' WHERE id = {$this->getId()};");
            $this->location = $new_location;
        }

        function updateDescription($new_description)
        {
            $GLOBALS['DB']->exec("UPDATE restaurants SET description = '{$new_description}' WHERE id = {$this->getId()};");
            $this->description = $new_description;
        }

        function updatePrice($new_price)
        {
            $GLOBALS['DB']->exec("UPDATE restaurants SET price = '{$new_price}' WHERE id = {$this->getId()};");
            $this->price = $new_price;
        }

        function updateCuisineId($new_cuisine_id)
        {
            $GLOBALS['DB']->exec("UPDATE restaurants SET cuisine_id = {$new_cuisine_id} WHERE id = {$this->getId()};");
            $this->cuisine_id = $new_cuisine_id;
        }

        function update($new_name, $new_location, $new_description, $new_price, $new_cuisine_id)
        {
            $this->updateName($new_name);
            $this->updateLocation($new_location);
            $this->updateDescription($new_description);
            $this->updatePrice($new_price);
            $this->updateCuisineId($new_cuisine_id);
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, location, description, price, cuisine_id) VALUES ('{$this->getName()}', '{$this->getLocation()}', '{$this->getDescription()}', '{$this->getPrice()}', {$this->getCuisineId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        
        function delete()
        {
            $reviews = Review::getAll();
            foreach ($reviews as $review){
                if($review->getRestaurantId() == $this->getId()){
                    $review->delete();
                }
            }
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE id = {$this->getId()};");
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $location = $restaurant['location'];
                $description = $restaurant['description'];
                $price = $restaurant['price'];
                $cuisine_id = $restaurant['cuisine_id'];
                $id = $restaurant['id'];
                $new_restaurant = new Restaurant($name, $location, $description, $price, $cuisine_id, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

        static function find($search_id)
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            foreach($restaurants as $restaurant) {
                $restaurant_id = $restaurant->getId();
                if($restaurant_id == $search_id) {
                    $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }
    }
?>
