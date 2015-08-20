<?php
    class Cuisine
    {
        private $type;
        private $id;

        function __construct($type, $id=null)
        {
            $this->type = $type;
            $this->id = $id;
        }

        function getType()
        {
            return $this->type;
        }

        function setType($new_type)
        {
            $this->type = $new_type;
        }

        function getId()
        {
            return $this->id;
        }

        function getRestaurants()
        {
            $restaurants = array();
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = {$this->getId()};");
            foreach($returned_restaurants as $restaurant){
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

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisines (type) VALUES ('{$this->getType()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($new_type)
        {
            $GLOBALS['DB']->exec("UPDATE cuisines SET type = '{$new_type}' WHERE id = {$this->getId()};");
            $this->setType($new_type);
        } 
        
        function delete()
        {
            $restaurants = Restaurant::getAll();
            foreach ($restaurants as $restaurant){
                if($restaurant->getCuisineId() == $this->getId()){
                    $restaurant->delete();
                }
            }
            $GLOBALS['DB']->exec("DELETE FROM cuisines WHERE id = {$this->getId()};");
        }

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine){
                $type = $cuisine['type'];
                $id = $cuisine['id'];
                $new_cuisine = new Cuisine($type, $id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }

        static function find($search_id)
        {
            $found_cuisine = NULL;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $cuisine_id = $cuisine->getId();
                if($cuisine_id == $search_id){
                    $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }
    }

?>
