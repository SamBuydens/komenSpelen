<?php

$bandImagesDAO = new BandImagesDAO();

// --- Getters --------------------------
$app->get('/images/?',function() use ($bandImagesDAO){
    header("Content-Type: application/json");
    echo json_encode($bandImagesDAO->getBandImages(), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/images/bandbattle/:id/?',function($id) use ($bandImagesDAO){
    header("Content-Type: application/json");
    echo json_encode($bandImagesDAO->getBandImagesByBandbattleId($id), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/images/:id/?', function($id) use ($bandImagesDAO){
    header("Content-Type: application/json");
    echo json_encode($bandImagesDAO->getBandImageById($id), JSON_NUMERIC_CHECK);
    exit();
});

// --- Validation --------------------------
$app->post('/validate/imagedata/?', function() use ($app, $bandImagesDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandImagesDAO->insertBandImage($post), JSON_NUMERIC_CHECK);
    exit();
});

// --- Setters --------------------------
$app->post('/images/?', function() use ($app, $bandImagesDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandImagesDAO->insertBandImage($post), JSON_NUMERIC_CHECK);
    exit();
});

// --- Delete --------------------------
$app->delete('/images/:id/?', function($id) use ($bandImagesDAO){
    header("Content-Type: application/json");
    echo json_encode($bandImagesDAO->deleteBandImage($id));
    exit();
});