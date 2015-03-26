<?php

$bandRatingsDAO = new BandRatingsDAO();

// --- Getters --------------------------
$app->get('/ratings/?',function() use ($bandRatingsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandRatingsDAO->getRatings(), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/ratings/for/:band_id/?',function($band_id) use ($bandRatingsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandRatingsDAO->getRatingsForBand($band_id), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/ratings/by/:band_id/?',function($band_id) use ($bandRatingsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandRatingsDAO->getRatingsByBand($band_id), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/ratings/:id/?', function($id) use ($bandRatingsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandRatingsDAO->getRatingById($id), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/ratings/quota/options/?',function() use ($bandRatingsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandRatingsDAO->getRatingQuota(), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/ratings/quota/options/:id/?',function($id) use ($bandRatingsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandRatingsDAO->getRatingQuotaById($id), JSON_NUMERIC_CHECK);
    exit();
});

// --- Validation --------------------------
$app->post('/validation/ratingData/?', function($band_id) use ($app, $bandRatingsDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandRatingsDAO->validateRatingData($post), JSON_NUMERIC_CHECK);
    exit();
});

$app->post('/validation/ratingData/scoreUpdate/?', function($band_id) use ($app, $bandRatingsDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandRatingsDAO->validateScoringData($post), JSON_NUMERIC_CHECK);
    exit();
});

// --- Setters --------------------------
$app->post('/ratings/for/:band_id/?', function($band_id) use ($app, $bandRatingsDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandRatingsDAO->insertRating($band_id, $post), JSON_NUMERIC_CHECK);
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

// --- Delete --------------------------
$app->delete('/ratings/:id/?', function($id) use ($bandRatingsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandRatingsDAO->deleteRating($id));
    exit();
});