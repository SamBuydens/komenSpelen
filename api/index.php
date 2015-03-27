<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

define("WWW_ROOT",dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);

/* --- DAO Classes ---------------------- */
require_once WWW_ROOT. "dao" .DIRECTORY_SEPARATOR. 'BandsDAO.php';
require_once WWW_ROOT. "dao" .DIRECTORY_SEPARATOR. 'BandBattlesDAO.php';
require_once WWW_ROOT. "dao" .DIRECTORY_SEPARATOR. 'BandImagesDAO.php';
require_once WWW_ROOT. "dao" .DIRECTORY_SEPARATOR. 'BandRatingsDAO.php';
require_once WWW_ROOT. "api" .DIRECTORY_SEPARATOR. 'Slim'. DIRECTORY_SEPARATOR .'Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app -> config('debug', true);

/* --- API Classes ---------------------- */
require_once WWW_ROOT. "api" .DIRECTORY_SEPARATOR. 'routes' .DIRECTORY_SEPARATOR. 'bands.php';
require_once WWW_ROOT. "api" .DIRECTORY_SEPARATOR. 'routes' .DIRECTORY_SEPARATOR. 'bandBattles.php';
require_once WWW_ROOT. "api" .DIRECTORY_SEPARATOR. 'routes' .DIRECTORY_SEPARATOR. 'bandImages.php';
require_once WWW_ROOT. "api" .DIRECTORY_SEPARATOR. 'routes' .DIRECTORY_SEPARATOR. 'bandRatings.php';

$app->run();

