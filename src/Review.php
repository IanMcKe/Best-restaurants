<?php
    class Review
    {
        private $user;
        private $stars;
        private $headline;
        private $body;
        private $restaurant_id;
        private $id;

        function __construct($user, $stars, $headline, $body, $restaurant_id, $id=null)
        {
            $this->user = $user;
            $this->stars = $stars;
            $this->headline = $headline;
            $this->body = $body;
            $this->restaurant_id = $restaurant_id;
            $this->id = $id;
        }

        function getUser()
        {
            return $this->user;
        }

        function getStars()
        {
            return $this->stars;
        }

        function getHeadline()
        {
            return $this->headline;
        }

        function getBody()
        {
            return $this->body;
        }

        function getRestaurantId()
        {
            return $this->restaurant_id;
        }

        function getId()
        {
            return $this->id;
        }

        function updateUser($new_user)
        {
            $GLOBALS['DB']->exec("UPDATE reviews SET user = '{$new_user}' WHERE id = {$this->getId()};");
            $this->user = $new_user;
        }

        function updateStars($new_stars)
        {
            $GLOBALS['DB']->exec("UPDATE reviews SET stars = {$new_stars} WHERE id = {$this->getId()};");
            $this->stars = $new_stars;
        }

        function updateHeadline($new_headline)
        {
            $GLOBALS['DB']->exec("UPDATE reviews SET headline = '{$new_headline}' WHERE id = {$this->getId()};");
            $this->headline = $new_headline;
        }

        function updateBody($new_body)
        {
            $GLOBALS['DB']->exec("UPDATE reviews SET body = '{$new_body}' WHERE id = {$this->getId()};");
            $this->body = $new_body;
        }

        function updateRestaurantId($new_restaurant_id)
        {
            $GLOBALS['DB']->exec("UPDATE reviews SET restaurant_id = '{$new_restaurant_id}' WHERE id = {$this->getId()};");
            $this->restaurant_id = $new_restaurant_id;
        }

        function update($user, $stars, $headline, $body, $restaurant_id)
        {
            $this->updateUser($user);
            $this->updateStars($stars);
            $this->updateHeadline($headline);
            $this->updateBody($body);
            $this->updateRestaurantId($restaurant_id);
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO reviews (user, stars, headline, body, restaurant_id) VALUES ('{$this->getUser()}', {$this->getStars()}, '{$this->getHeadline()}', '{$this->getBody()}', {$this->getRestaurantId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews;");
            $reviews = array();
            foreach($returned_reviews as $review){
                $user = $review['user'];
                $stars = $review['stars'];
                $headline = $review['headline'];
                $body = $review['body'];
                $restaurant_id = $review['restaurant_id'];
                $id = $review['id'];
                $new_review = new Review($user, $stars, $headline, $body, $restaurant_id, $id);
                array_push($reviews, $new_review);
            }
            return $reviews;
        }
        
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM reviews WHERE id = {$this->getId()};");
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM reviews;");
        }
    }

?>
