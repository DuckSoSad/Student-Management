<?php

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$url = !isset($_GET['url']) ? "/" : $_GET['url'];

$router = new RouteCollector();

$router->filter('auth', function () {
    if (!isset($_SESSION['auth']) || empty($_SESSION['auth'])) {
        header('location: ' . BASE_URL . 'login');
        die;
    }
});

$router->get('/', [\App\Controllers\HomeController::class, "index"]);

$router->get('course', [\App\Controllers\CourseController::class, "index"]);
$router->get('course/add', [\App\Controllers\CourseController::class, "add"]);
$router->post('course/post', [\App\Controllers\CourseController::class, "post"]);
$router->get('course/edit/{id}', [\App\Controllers\CourseController::class, "edit"]);
$router->post('course/update/{id}', [\App\Controllers\CourseController::class, "update"]);
$router->get('course/delete/{id}', [\App\Controllers\CourseController::class, "delete"]);

$router->get('major', [\App\Controllers\MajorController::class, "index"]);
$router->get('major/add', [\App\Controllers\MajorController::class, "add"]);
$router->post('major/post', [\App\Controllers\MajorController::class, "post"]);
$router->get('major/edit/{id}', [\App\Controllers\MajorController::class, "edit"]);
$router->post('major/update/{id}', [\App\Controllers\MajorController::class, "update"]);
$router->get('major/delete/{id}', [\App\Controllers\MajorController::class, "delete"]);

$router->get('student', [\App\Controllers\StudentController::class, "index"]);
$router->get('student/add', [\App\Controllers\StudentController::class, "add"]);
$router->post('student/post', [\App\Controllers\StudentController::class, "post"]);
$router->get('student/edit/{id}', [\App\Controllers\StudentController::class, "edit"]);
$router->post('student/update/{id}', [\App\Controllers\StudentController::class, "update"]);
$router->get('student/delete/{id}', [\App\Controllers\StudentController::class, "delete"]);

$dispatcher = new Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

echo $response;
