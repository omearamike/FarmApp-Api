<?php
// Routes

// Test route
$app->get('/{name}', function ($request, $response, $args) {
    $this->logger->info("Slim-Skeleton '/' route"); // Sample log message
    $name = $request->getAttribute('name');
    return $name;
});

/*
@RETURNS all animal records in database
@FORMAT JSON FORMAT
*/
$app->get('/api/v1/animals.json', function ($request, $response) {

    $animal = new Animal($this->db); // Pass DB credentials to Animal Object
    $animals = $animal->animals();

    echo json_encode($animals, JSON_PRETTY_PRINT); // send the result now

    // return $response->withHeader('Content-Type', 'application/json', 'content-encoding', 'gzip'); // GZIP working check if it is actually faster
    return $response->withHeader('Content-Type', 'application/json');
});

/*
@RETURNS all feedlot records in database
@FORMAT JSON FORMAT
*/
$app->get('/api/v1/feedlots.json', function ($request, $response) {

    $feedlot = new Feedlot($this->db); // Pass DB credentials to Animal Object
    $feedlots = $feedlot->feedlots();

    echo json_encode($feedlots, JSON_PRETTY_PRINT); // send the result now

    return $response->withHeader('Content-Type', 'application/json');
});
