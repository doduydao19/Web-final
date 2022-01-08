<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\models\ClassRoom;
use app\models\Device;
use app\models\Teacher;
use app\models\Transaction;
use DateTime;

class TransactionController extends Controller
{
    public function __construct()
    {
        // $this->registerMiddleware(new AuthMiddleware(['index']));
    }

    public function index()
    {
        $q =  isset($_GET['q']) ? $_GET['q'] : null;
        $teacher =  isset($_GET['teacher']) ? $_GET['teacher'] : null;

        $filter = [];

        if ($q) {
            $filter["name"] = "%$q%";
        }

        if ($teacher) {
            $filter["teacher"] = $teacher;
        }

        $data = Transaction::whereLike($filter)->orderBy("created_at DESC")->get();
        $teachers = Teacher::get();

        $this->setLayout('admin');
        return $this->render('admin/transaction/index', [
            "q" => $q,
            "teacher" => $teacher,
            "data" => $data,
            "teachers" => $teachers,
            "title" => "Transaction",
            "breadcrumbs" => [
                [
                    "link" => "/admin/transaction",
                    "label" => "Transaction"
                ],
                [
                    "link" => "#",
                    "label" => "index"
                ],
            ]
        ]);
    }


    public function createView()
    {
        $teachers = Teacher::get();
        $classRooms = ClassRoom::get();
        $devices = Device::get();
        
        $this->setLayout('admin');
        return $this->render(
            'admin/transaction/create',

            [
                "teachers" => $teachers,
                "classRooms" => $classRooms,
                "devices" => $devices,

                "title" => "Transaction",
                "breadcrumbs" => [
                    [
                        "link" => "/admin/transaction",
                        "label" => "Transaction"
                    ],
                    [
                        "link" => "#",
                        "label" => "create"
                    ],
                ]
            ]
        );
    }


    public function create(Request $request)
    {


        $classModel = new Transaction();
        print_r($request->getbody());
        $classModel->loadData($request->getBody());
        $now = new DateTime();
        $classModel->updated_at = $now->format('Y-m-d H:i:s');
        $classModel->start_transaction_plan = date("Y-m-d", strtotime($classModel->start_transaction_plan) );
        $classModel->end_transaction_plan = date("Y-m-d", strtotime($classModel->end_transaction_plan) );

        if ($classModel->validate() && $classModel->save()) {
            Application::$app->session->setFlash('msg', 'Create item success');
            Application::$app->response->redirect('/admin/transaction/create');
        } else {
            Application::$app->session->setFlash('errors', $classModel->errors);
            Application::$app->response->redirect('/admin/transaction/create');
        }
    }

    public function editView()
    {
        $id = $_GET['id'];
        $data = Transaction::findOne(["id" => $id]);

        $this->setLayout('admin');
        return $this->render('admin/transaction/edit', [
            "data" => $data,
            "title" => "Transaction",
            "breadcrumbs" => [
                [
                    "link" => "/admin/transaction",
                    "label" => "Transaction"
                ],
                [
                    "link" => "#",
                    "label" => "create"
                ],
            ]
        ]);
    }

    public function edit(Request $request)
    {
        $id = $_GET['id'];
        $classModel = new Transaction();
        $classModel->loadData($request->getBody());
        $classModel->id = $id;
        $now = new DateTime();
        $classModel->updated_at = $now->format('Y-m-d H:i:s');
        if ($classModel->validate() && $classModel->update()) {
            Application::$app->session->setFlash('msg', 'Update item success');
            Application::$app->response->redirect("/admin/transaction/edit?id=$id");
        } else {
            Application::$app->session->setFlash('errors', $classModel->errors);
            Application::$app->response->redirect("/admin/transaction/edit?id=$id");
        }
    }

    public function destroy()
    {
        $id = $_GET['id'];
        $cmd = Transaction::destroy($id);
        if ($cmd) {
            Application::$app->session->setFlash('msg', 'Delete item success');
            Application::$app->response->redirect('/admin/transaction');
        } else {
            Application::$app->session->setFlash('msg', 'Delete item error');
            Application::$app->response->redirect('/admin/transaction');
        }
    }
}
