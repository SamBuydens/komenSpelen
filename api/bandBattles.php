<?php

$bandBattlesDAO = new BandBattlesDAO();

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

$app->post('/bandbattles/?', function() use ($app, $bandBattlesDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandBattlesDAO->insertBandbattle($post['band_id'], $post['gig_date'], $post['location'], $post['latitude'], $post['longitude']), JSON_NUMERIC_CHECK);
    exit();
});

$app->delete('/bandbattles/:id/?', function($id) use ($bandBattlesDAO){
    header("Content-Type: application/json");
    echo json_encode($bandBattlesDAO->deleteBandbattle($id));
    exit();
});

$app->put('/bandbattles/:id/?', function($id) use ($app, $bandBattlesDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandBattlesDAO->update($id, $post['bandname'], $post['email'], $post['band_image']), JSON_NUMERIC_CHECK);
    exit();
});