<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\models\ClassRoom;
use app\models\Device;
use app\models\Teacher;
use app\models\Transaction;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->registerMiddleware(new AuthMiddleware(['index']));
    }

    public function index()
    {

        $teachers = Teacher::get();
        $classRooms = ClassRoom::get();
        $devices = Device::get();
        $transactions = Transaction::get();
        
        $this->setLayout('admin');
        return $this->render(
            'dashboard',
            [
                "teachers" => $teachers,
                "classRooms" => $classRooms,
                "devices" => $devices,
                "transactions" => $transactions,


                "title" => "Dashboard",
                "breadcrumbs" => [
                    [
                        "link" => "/admin/class-room",
                        "label" => "Dashboard"
                    ]
                ]
            ]
        );
    }
}
