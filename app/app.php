<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Review.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=food';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__."/../views"
    ));

    $app->get("/", function() use ($app){
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/cuisines", function() use ($app) {
            $cuisine = new Cuisine($_POST['type']);
            $cuisine->save();
            return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/cuisines/{id}", function($id) use ($app) {
            $cuisine = Cuisine::find($id);
            return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => Restaurant::getAll()));
    });
    
    $app->get("/cuisines/{id}/edit", function($id) use ($app){
            $cuisine = Cuisine::find($id);
            return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $cuisine)); 
    });
    
    $app->patch("/cuisines/{id}", function($id) use ($app){
            $new_type = $_POST['type'];
            $cuisine = Cuisine::find($id);
            $cuisine->update($new_type);
            return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => Restaurant::getAll())); 
    });
    
    $app->delete("/cuisines/{id}", function($id) use ($app){
       $cuisine = Cuisine::find($id);
       $cuisine->delete();
       return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll())); 
    });
    
    $app->post("/restaurants", function() use ($app) {
            $restaurant = new Restaurant($_POST['name'], $_POST['location'], $_POST['description'], $_POST['price'], $_POST['cuisine_id']);
            $restaurant->save();
            $cuisine = Cuisine::find($restaurant->getCuisineId());
            return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => Restaurant::getAll()));
    });

    $app->get("/restaurants/{id}", function($id) use ($app) {
            $restaurant = Restaurant::find($id);
            return $app['twig']->render('restaurant.html.twig', array('restaurant' => $restaurant, 'reviews' => Review::getAll()));
    });
    
    $app->post("/reviews", function() use ($app) {
            $review = new Review($_POST['user'], $_POST['stars'], $_POST['headline'], $_POST['body'], $_POST['restaurant_id']);
            $review->save();
            $restaurant = Restaurant::find($review->getRestaurantId());
            return $app['twig']->render('restaurant.html.twig', array('restaurant' => $restaurant, 'reviews' => Review::getAll()));
    });

    return $app;
?>
