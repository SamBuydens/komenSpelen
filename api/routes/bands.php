<?php

$bandsDAO = new BandsDAO();

// --- Getters --------------------------
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

$app->get('/bandmembers/:id/?', function($id) use ($bandsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandsDAO->getBandmemberById($id), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/bands/:id/members/?', function($id) use ($bandsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandsDAO->getBandmembersByBandId($id), JSON_NUMERIC_CHECK);
    exit();
});

// --- Validation --------------------------
$app->post('/validate/banddata/?', function() use ($app, $bandsDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandsDAO->register($post), JSON_NUMERIC_CHECK);
    exit();
});

// --- Setters --------------------------
$app->post('/bands/?', function() use ($app, $bandsDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandsDAO->register($post), JSON_NUMERIC_CHECK);
    exit();
});

$app->post('/bands/:id/members/?', function() use ($app, $bandsDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandsDAO->insertBandmember($id, $post['name'], $post['instrument'], $post['image']), JSON_NUMERIC_CHECK);
    exit();
});

$app->put('/bands/:id/?', function($id) use ($app, $bandsDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandsDAO->update($id, $post), JSON_NUMERIC_CHECK);
    exit();
});

// --- Delete --------------------------
$app->delete('/bands/:id/?', function($id) use ($bandsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandsDAO->deleteBand($id));
    exit();
});

// --- Check User Session --------------------------
/*$app->get('/checkusersession/?', function() use ($bandsDAO){
    header("Content-Type: application/json");
    echo json_encode($bandsDAO->checkUserSession(), JSON_NUMERIC_CHECK);
    exit();
});*/

