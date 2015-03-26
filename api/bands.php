<?php

$bandsDAO = new BandsDAO();

$app->get('/bands/?',function() use ($bandsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandsDAO->getBands(), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/bands/:id/?', function($id) use ($bandsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandsDAO->getBandById($id), JSON_NUMERIC_CHECK);
    exit();
});

$app->post('/bands/?', function() use ($app, $bandsDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandsDAO->register($post['bandname'], $post['email'], $post['password'], $post['band_image']), JSON_NUMERIC_CHECK);
    exit();
});

$app->delete('/bands/:id/?', function($id) use ($bandsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandsDAO->deleteBand($id));
    exit();
});

$app->put('/bands/:id/?', function($id) use ($app, $bandsDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandsDAO->update($id, $post['bandname'], $post['email'], $post['band_image']), JSON_NUMERIC_CHECK);
    exit();
});