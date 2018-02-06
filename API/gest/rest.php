<?php
require '../src/vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

$settings = require_once '../src/conf/api_settings.php';
$errors = require_once '../src/conf/api_errors.php';
$dependencies = require_once '../src/conf/api_deps.php';

$config = parse_ini_file("../src/conf/geo.db.conf.ini");

$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();

$configuration = array_merge($settings, $errors, $dependencies);
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

$app->post('/users[/]','\geo\control\GestController:addUser');

$app->get('/series[/]','\geo\control\GestController:getSeries');

$app->post('/series/{id}/photos[/]','\geo\control\GestController:addPhoto');

$app->post('/series[/]','\geo\control\GestController:addSerie');

$app->get('/users/{id}[/]','\geo\control\GestController:user');

$app->post('/users/signin[/]','\geo\control\GestController:login');

$app->run();