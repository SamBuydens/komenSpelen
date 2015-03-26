<?php

$bandRatingsDAO = new BandRatingsDAO();

$app->get('/ratings/?',function() use ($bandRatingsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandRatingsDAO->getRatings(), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/ratings/for/:id/?',function($id) use ($bandRatingsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandRatingsDAO->getRatingsForBand($id), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/ratings/by/:id/?',function($id) use ($bandRatingsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandRatingsDAO->getRatingsByBand($id), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/ratings/:id/?', function($id) use ($bandRatingsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandRatingsDAO->getRatingById($id), JSON_NUMERIC_CHECK);
    exit();
});

$app->post('/ratings/for/:id/?', function($id) use ($app, $bandRatingsDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandRatingsDAO->insertRating($id, $post['rater_id'], $post['quota_id'], $post['score']), JSON_NUMERIC_CHECK);
    exit();
});

$app->put('/ratings/:id/?', function() use ($app, $bandRatingsDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandRatingsDAO->updateRating($id, $post['score']), JSON_NUMERIC_CHECK);
    exit();
});

$app->delete('/ratings/:id/?', function($id) use ($bandRatingsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandRatingsDAO->deleteRating($id));
    exit();
});