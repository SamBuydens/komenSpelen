<?php

$bandBattlesDAO = new BandBattlesDAO();

// --- Getters --------------------------
$app->get('/bandbattles/?',function() use ($bandBattlesDAO){
    header("Content-Type: application/json");
    echo json_encode($bandBattlesDAO->getBandbattles(), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/bandbattles/:id/?', function($id) use ($bandBattlesDAO){
    header("Content-Type: application/json");
    echo json_encode($bandBattlesDAO->getBandbattleById($id), JSON_NUMERIC_CHECK);
    exit();
});

// --- Validation --------------------------
$app->post('/validate/bandbattledata/?', function() use ($app, $bandBattlesDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandBattlesDAO->validateBandbattleData($post), JSON_NUMERIC_CHECK);
    exit();
});

// --- Setters --------------------------
$app->post('/bandbattles/?', function() use ($app, $bandBattlesDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandBattlesDAO->insertBandbattle($post), JSON_NUMERIC_CHECK);
    exit();
});

$app->put('/bandbattles/:id/?', function($id) use ($app, $bandBattlesDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandBattlesDAO->update($id, $post), JSON_NUMERIC_CHECK);
    exit();
});

// --- Delete --------------------------
$app->delete('/bandbattles/:id/?', function($id) use ($bandBattlesDAO){
    header("Content-Type: application/json");
    echo json_encode($bandBattlesDAO->deleteBandbattle($id));
    exit();
});