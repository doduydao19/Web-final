<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\models\Device;
use DateTime;

class DeviceController extends Controller
{
    public function __construct()
    {
        // $this->registerMiddleware(new AuthMiddleware(['index']));
    }

    public function index()
    {
        $q =  isset($_GET['q']) ? $_GET['q'] : null;
        $status =  isset($_GET['status']) ? $_GET['status'] : null;

        $filter = [];

        if ($q != null) {
            $filter["name"] = "%$q%";
        }

        // if ($status) {
        //     $filter["status"] = $status;
        // }


        $data = Device::whereLike($filter)->orderBy("created_at DESC")->get();


        $this->setLayout('admin');
        return $this->render('admin/device/index', [
            "q" => $q,
            "status" => $status,
            "data" => $data,
            "title" => "Device",
            "breadcrumbs" => [
                [
                    "link" => "/admin/device",
                    "label" => "Device"
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
        $this->setLayout('admin');
        return $this->render(
            'admin/device/create',

            [
                "title" => "Device",
                "breadcrumbs" => [
                    [
                        "link" => "/admin/device",
                        "label" => "Device"
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
        $classModel = new Device();
        $classModel->loadData($request->getBody());
        $now = new DateTime();
        $classModel->updated_at = $now->format('Y-m-d H:i:s');

        if ($classModel->validate() && $classModel->save()) {
            Application::$app->session->setFlash('msg', 'Create item success');
            Application::$app->response->redirect('/admin/device/create');
        } else {
            Application::$app->session->setFlash('errors', $classModel->errors);
            Application::$app->response->redirect('/admin/device/create');
        }
    }

    public function editView()
    {
        $id = $_GET['id'];
        $data = Device::findOne(["id" => $id]);

        $this->setLayout('admin');
        return $this->render('admin/device/edit', [
            "data" => $data,
            "title" => "Device",
            "breadcrumbs" => [
                [
                    "link" => "/admin/device",
                    "label" => "Device"
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
        $classModel = new Device();
        $classModel->loadData($request->getBody());
        $classModel->id = $id;
        $now = new DateTime();
        $classModel->updated_at = $now->format('Y-m-d H:i:s');
        if ($classModel->validate() && $classModel->update()) {
            Application::$app->session->setFlash('msg', 'Update item success');
            Application::$app->response->redirect("/admin/device/edit?id=$id");
        } else {
            Application::$app->session->setFlash('errors', $classModel->errors);
            Application::$app->response->redirect("/admin/device/edit?id=$id");
        }
    }

    public function destroy()
    {
        $id = $_GET['id'];
        $cmd = Device::destroy($id);
        if ($cmd) {
            Application::$app->session->setFlash('msg', 'Delete item success');
            Application::$app->response->redirect('/admin/device');
        } else {
            Application::$app->session->setFlash('msg', 'Delete item error');
            Application::$app->response->redirect('/admin/device');
        }
    }


    public function edit_confirmView()
    {
        $id = $_GET['id'];
        $data = Device::findOne(["id" => $id]);

        $this->setLayout('admin');
        return $this->render('admin/device/edit_confirm', [
            "data" => $data,
            "title" => "Device",
            "breadcrumbs" => [
                [
                    "link" => "/admin/device",
                    "label" => "Device"
                ],
                [
                    "link" => "#",
                    "label" => "create"
                ],
            ]
        ]);
    }
    public function completeView()
    {
        $id = $_GET['id'];
        $data = Device::findOne(["id" => $id]);

        $this->setLayout('admin');
        return $this->render('admin/device/complete', [
            "data" => $data,
            "title" => "Device",
            "breadcrumbs" => [
                [
                    "link" => "/admin/device",
                    "label" => "Device"
                ],
                [
                    "link" => "#",
                    "label" => "create"
                ],
            ]
        ]);
    }

    public function complete(Request $request)
    {
        $id = $_GET['id'];
        $classModel = new Device();
        $classModel->loadData($request->getBody());
        $classModel->id = $id;
        $now = new DateTime();
        $classModel->updated_at = $now->format('Y-m-d H:i:s');
        if ($classModel->validate() && $classModel->update()) {
            Application::$app->session->setFlash('msg', 'Update item success');
            Application::$app->response->redirect("/admin/device/complete?id=$id");
        } else {
            Application::$app->session->setFlash('errors', $classModel->errors);
            Application::$app->response->redirect("/admin/device/complete?id=$id");
        }
    }

   // phan cua kien
   





}
