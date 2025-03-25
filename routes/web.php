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

$router->get('login', [\App\Controllers\Auth\AuthController::class, "showLogin"]);
$router->post('login', [\App\Controllers\Auth\AuthController::class, "login"]);
$router->post('logout', [\App\Controllers\Auth\AuthController::class, "logout"]);
$router->get('register', [\App\Controllers\Auth\AuthController::class, "showRegister"]);
$router->post('res', [\App\Controllers\Auth\AuthController::class, "register"]);

$router->group(['prefix' => 'admin', 'before' => 'auth'], function ($router) {
    $router->get('/', [\App\Controllers\Admin\HomeController::class, "index"]);

    $router->get('course', [\App\Controllers\Admin\CourseController::class, "index"]);
    $router->get('course/add', [\App\Controllers\Admin\CourseController::class, "add"]);
    $router->post('course/post', [\App\Controllers\Admin\CourseController::class, "post"]);
    $router->get('course/edit/{id}', [\App\Controllers\Admin\CourseController::class, "edit"]);
    $router->post('course/update/{id}', [\App\Controllers\Admin\CourseController::class, "update"]);
    $router->get('course/delete/{id}', [\App\Controllers\Admin\CourseController::class, "delete"]);

    $router->get('major', [\App\Controllers\Admin\MajorController::class, "index"]);
    $router->get('major/add', [\App\Controllers\Admin\MajorController::class, "add"]);
    $router->post('major/post', [\App\Controllers\Admin\MajorController::class, "post"]);
    $router->get('major/edit/{id}', [\App\Controllers\Admin\MajorController::class, "edit"]);
    $router->post('major/update/{id}', [\App\Controllers\Admin\MajorController::class, "update"]);
    $router->get('major/delete/{id}', [\App\Controllers\Admin\MajorController::class, "delete"]);

    $router->get('student', [\App\Controllers\Admin\StudentController::class, "index"]);
    $router->get('student/add', [\App\Controllers\Admin\StudentController::class, "add"]);
    $router->post('student/post', [\App\Controllers\Admin\StudentController::class, "post"]);
    $router->get('student/edit/{id}', [\App\Controllers\Admin\StudentController::class, "edit"]);
    $router->post('student/update/{id}', [\App\Controllers\Admin\StudentController::class, "update"]);
    $router->get('student/delete/{id}', [\App\Controllers\Admin\StudentController::class, "delete"]);
});


$dispatcher = new Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

echo $response;
