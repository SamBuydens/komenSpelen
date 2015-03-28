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

$app->get('/bandbattles/:id/events/?', function($id) use ($bandBattlesDAO){
    header("Content-Type: application/json");
    echo json_encode($bandBattlesDAO->getBandbattleEventsByBandbattleId($id), JSON_NUMERIC_CHECK);
    exit();
});

$app->get('/bandbattlegigs/:id/?', function($id) use ($bandBattlesDAO){
    header("Content-Type: application/json");
    echo json_encode($bandBattlesDAO->getBandbattleEventById($id), JSON_NUMERIC_CHECK);
    exit();
});

// --- Invites --------------------------

$invitesDAO = new InvitesDAO();

$app->get('/bandbattles/invites/checkcode/:code/?', function($code) use ($invitesDAO){
    header("Content-Type: application/json");
    echo json_encode($invitesDAO->getInviteByCode($code), JSON_NUMERIC_CHECK);
    exit();
});

$app->post('/bandbattles/:id/invites/sendcode/?', function($id) use ($app, $invitesDAO){
    header("Content-Type: application/json");
    
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }

    $uniqid = uniqid();
    echo json_encode($invitesDAO->insertInvite($id, $uniqid), JSON_NUMERIC_CHECK);

    $to = $post['email'];
    $from = "admin@bandbattle.komenspelen.be";
    $subject = "Uw registratie bij BandBattle";

    $headers = "MIME-Version: 1.0\r\n";
    $date = date('D, d\t\h M Y h:i:s O');
    $headers .= "Date: {$date}\r\n";
    $headers .= "From: {$from}\r\n";
    $headers .= "Reply-To: {$from}\r\n";
    $headers .= "Subject: {$subject}\r\n";
    $headers .= "X-Sender: {$from}\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = "<html>\r\n";
    $message .= "<body>\r\n";
    $message .= "   <h2>Je band werd uitgenodigd voor een Bandbattle!</h2>";
    $message .= "   <p>-------------------------------</p>";
    $message .= "   <h1>Klik op onderstaande link als je je bands participatie wil bevestigen:</h1>";
    $message .= "   <p><a href=\"http://student.howest.be/thorr.stevens/20142015/MAIV/KOMEN/?p=app&amp;bbid={$id}&amp;invite={$uniqid}\" target=\"_blank\">http://student.howest.be/thorr.stevens/20142015/MAIV/KOMEN/?p=app&amp;bbid={$id}&amp;invite={$uniqid}</a></p>\r\n";
    $message .= "</body>\r\n";
    $message .= "</html>\r\n";

    mail($to, $subject, $message, $headers);

    exit();
});

$app->delete('/bandbattles/invites/:id/?', function($id) use ($invitesDAO){
    header("Content-Type: application/json");
    echo json_encode($invitesDAO->deleteInvite($id));
    exit();
});

// --- Validation --------------------------
/*$app->post('/validate/bandbattledata/?', function() use ($app, $bandBattlesDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandBattlesDAO->validateBandbattleData($post), JSON_NUMERIC_CHECK);
    exit();
});*/

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

$app->post('/bandbattles/:id/events/?', function($id) use ($app, $bandBattlesDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandBattlesDAO->insertBandbattleEvent($id, $post), JSON_NUMERIC_CHECK);
    exit();
});

$app->put('/bandbattles/:id/?', function($id) use ($app, $bandBattlesDAO){
    header("Content-Type: application/json");
    $post = $app->request->post();
    if(empty($post)){
        $post = (array) json_decode($app->request()->getBody());
    }
    echo json_encode($bandBattlesDAO->update($id, $post['name']), JSON_NUMERIC_CHECK);
    exit();
});

// --- Delete --------------------------
$app->delete('/bandbattles/:id/?', function($id) use ($bandBattlesDAO){
    header("Content-Type: application/json");
    echo json_encode($bandBattlesDAO->deleteBandbattle($id));
    exit();
});