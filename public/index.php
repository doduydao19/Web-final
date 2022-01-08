<?php

require_once __DIR__ . './../vendor/autoload.php';

use app\controllers\AboutController;
use app\controllers\AuthController;
use app\controllers\CategoryController;
use app\controllers\ClassRoomController;
use app\controllers\DashboardController;
use app\controllers\DeviceController;
use app\controllers\SiteController;
use app\controllers\TeacherController;
use app\controllers\TransactionController;
use app\controllers\UploadController;
use app\core\Application;
use app\models\Teacher;

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];



$app = new Application(dirname(__DIR__), $config);


$app->router->get('/', [SiteController::class, 'home']);

// XU LY XAC THUC NGUOI DUNG [DANG KY , DANG NHAP]

$app->router->get('/register', [AuthController::class, 'showRegister']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/login', [AuthController::class, 'showLogin']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/logout', [AuthController::class, 'logout']);

// UPLOAD FILE

$app->router->post('/upload', [UploadController::class, 'upload']);

// ADMIN DASHBOARD

$app->router->get('/admin/dashboard', [DashboardController::class, 'index']);

// ADMIN CLASS ROOM
$app->router->get('/admin/class-room', [ClassRoomController::class, 'index']);
$app->router->get('/admin/class-room/create', [ClassRoomController::class, 'createView']);
$app->router->post('/admin/class-room/create', [ClassRoomController::class, 'create']);
$app->router->get('/admin/class-room/edit', [ClassRoomController::class, 'editView']);
$app->router->post('/admin/class-room/edit', [ClassRoomController::class, 'edit']);
$app->router->get('/admin/class-room/destroy', [ClassRoomController::class, 'destroy']);



// ADMIN TEACHER
$app->router->get('/admin/teacher', [TeacherController::class, 'index']);
$app->router->get('/admin/teacher/create', [TeacherController::class, 'createView']);
$app->router->post('/admin/teacher/create', [TeacherController::class, 'create']);
$app->router->get('/admin/teacher/edit', [TeacherController::class, 'editView']);
$app->router->post('/admin/teacher/edit', [TeacherController::class, 'edit']);
$app->router->get('/admin/teacher/destroy', [TeacherController::class, 'destroy']);

// ADMIN DEVICE
$app->router->get('/admin/device', [DeviceController::class, 'index']);
$app->router->get('/admin/device/create', [DeviceController::class, 'createView']);
$app->router->post('/admin/device/create', [DeviceController::class, 'create']);
$app->router->get('/admin/device/edit', [DeviceController::class, 'editView']);
$app->router->post('/admin/device/edit', [DeviceController::class, 'edit']);
$app->router->get('/admin/device/destroy', [DeviceController::class, 'destroy']);


// ADMIN DEVICE
$app->router->get('/admin/transaction', [TransactionController::class, 'index']);
$app->router->get('/admin/transaction/create', [TransactionController::class, 'createView']);
$app->router->post('/admin/transaction/create', [TransactionController::class, 'create']);
$app->router->get('/admin/transaction/edit', [TransactionController::class, 'editView']);
$app->router->post('/admin/transaction/edit', [TransactionController::class, 'edit']);
$app->router->get('/admin/transaction/destroy', [TransactionController::class, 'destroy']);




// CLIENT PAGE

$app->router->get('/about', [AboutController::class, 'index']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->get('/profile', [SiteController::class, 'profile']);

// CODE EXAMPLE ==============================


$app->router->get('/category',[CategoryController::class, 'index']);


// $app->on(Application::EVENT_BEFORE_REQUEST, function(){
//     echo "Su kien xay ra truoc khi truy cap trang about";
// });

$app->run();

