<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();





/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim(array(
    'log.enabled' => true,
	'log.level' => \Slim\Log::DEBUG
));


/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, and `Slim::delete`
 * is an anonymous function.
 */

 
 // GET route
$app->get('/getSegnalazioni', function () use ($app) {
    $callback = $app->request()->get('_callName');
	$id_movicentro = $app->request()->get('movicentro');
    	
	try {
		$dbh = new PDO("pgsql:dbname=tpl;host=localhost;port=35432","user","user" );
	} catch (Exception $e) {
		echo "Failed: " . $e->getMessage();
	}

	$query = "select id, name, timeStart, timeEnd, level from tplView.events where id_movicentro=$id_movicentro";

	$data = $dbh->query($query);
	
    $app->contentType('application/javascript');
    echo sprintf("e=%s(%s)", $callback, json_encode($data));
}); 
 
$app->get('/getMovicentri', function () use ($app) {
    $callback = $app->request()->get('_callName');
	$longitude = $app->request()->get('longitude');
	$latitude = $app->request()->get('latitude');
    	
	try {
		$dbh = new PDO("pgsql:dbname=tpl;host=localhost;port=35432","user","user" );
	} catch (Exception $e) {
		echo "Failed: " . $e->getMessage();
	}

	$query = "select id, name, latitude, longitude, distance from tplView.movicentri where longitude=$longitude and latitude=$latitude";

	$data = $dbh->query($query);
	

    $app->contentType('application/javascript');
    echo sprintf("e=%s(%s)", $callback, json_encode($data));
}); 
 
 
$app->get('/getArrivi', function () use ($app) {
    $callback = $app->request()->get('_callName');
	$id_movicentro = $app->request()->get('movicentro');
    	
	try {
		$dbh = new PDO("pgsql:dbname=tpl;host=localhost;port=35432","user","user" );
	} catch (Exception $e) {
		echo "Failed: " . $e->getMessage();
	}

	$query = "select id, time, placeName, transportationTypeId, transportationType, company, transportationTypeIcon from tplView.arrivi where id_movicentro=$id_movicentro";

	$data = $dbh->query($query);
	

    $app->contentType('application/javascript');
    echo sprintf("e=%s(%s)", $callback, json_encode($data));
}); 
 
 
$app->get('/getPartenze', function () use ($app) {
    $callback = $app->request()->get('_callName');
	$id_movicentro = $app->request()->get('movicentro');
    	
	try {
		$dbh = new PDO("pgsql:dbname=tpl;host=localhost;port=35432","user","user" );
	} catch (Exception $e) {
		echo "Failed: " . $e->getMessage();
	}

	$query = "select id, time, placeName, transportationTypeId, transportationType, company, transportationTypeIcon from tplView.partenze where id_movicentro=$id_movicentro";

	$data = $dbh->query($query);
	

    $app->contentType('application/javascript');
    echo sprintf("e=%s(%s)", $callback, json_encode($data));
}); 
 
 
 /**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();





?>