<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\models\ClassRoom;
use DateTime;

class ClassRoomController extends Controller
{
    public function __construct()
    {
        // $this->registerMiddleware(new AuthMiddleware(['index']));
    }

    public function index()
    {
        $q =  isset($_GET['q']) ? $_GET['q'] : null;
        
        $building =  isset($_GET['building']) ? $_GET['building'] : null;

        $filter = [];

        if ($building != null & $q == null) {
            $filter["building"] = $building;
            $data = ClassRoom::where($filter)->orderBy("created_at DESC")->get();
        }

        if ($building == null & $q != null) {
            $filter["name"] = $q;
            $filter["description"] = $q;
            
            $data = ClassRoom::whereLike($filter)->orderBy("created_at DESC")->get();
        }

        if ($q != null & $building != null) {
            $filter["building"] = $building;
            $filter["name"] = $q;
            $filter["description"] = $q;
            $data = ClassRoom::whereLike($filter)->orderBy("created_at DESC")->get();
            
        }

        if ($q == null & $building == null) {
            $data = ClassRoom::whereLike($filter)->orderBy("created_at DESC")->get();
        }


        $buildings = ClassRoom::get(["building"]);
        $this->setLayout('admin');
        return $this->render('admin/class_room/index', [
            "q" => $q,
            "building" => $building,
            "buildings" => $buildings,
            "data" => $data,
            "title" => "Classroom",
            "breadcrumbs" => [
                [
                    "link" => "/admin/class-room",
                    "label" => "Classroom"
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
            'admin/class_room/create',

            [
                "title" => "Class room",
                "breadcrumbs" => [
                    [
                        "link" => "/admin/class-room",
                        "label" => "Class room"
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
        $classModel = new ClassRoom();
        $classModel->loadData($request->getBody());
        $now = new DateTime();
        $classModel->updated_at = $now->format('Y-m-d H:i:s');

        if ($classModel->validate() && $classModel->save()) {
            Application::$app->session->setFlash('msg', 'Create item success');
            Application::$app->response->redirect('/admin/class-room/create');
        } else {
            Application::$app->session->setFlash('errors', $classModel->errors);
            Application::$app->response->redirect('/admin/class-room/create');
        }
    }

    public function editView()
    {
        $id = $_GET['id'];
        $data = ClassRoom::findOne(["id" => $id]);

        $this->setLayout('admin');
        return $this->render(
            'admin/class_room/edit',
            [
                "data" => $data,
                "title" => "Class room",
                "breadcrumbs" => [
                    [
                        "link" => "/admin/class-room",
                        "label" => "Class room"
                    ],
                    [
                        "link" => "#",
                        "label" => "create"
                    ],
                ]
            ]
        );
    }

    public function edit(Request $request)
    {
        $id = $_GET['id'];
        $classModel = new ClassRoom();
        $classModel->loadData($request->getBody());
        $classModel->id = $id;
        $now = new DateTime();
        $classModel->updated_at = $now->format('Y-m-d H:i:s');
        if ($classModel->validate() && $classModel->update()) {
            // Application::$app->session->setFlash('msg', 'Update item success');
            Application::$app->response->redirect("/admin/class-room/edit_confirm?id=$id");
        } else {
            Application::$app->session->setFlash('errors', $classModel->errors);
            Application::$app->response->redirect("/admin/class-room/edit_confirm?id=$id");
        }
    }

    public function edit_confirm(Request $request)
    {
        $id = $_GET['id'];
        $classModel = new ClassRoom();
        $classModel->loadData($request->getBody());
        $classModel->id = $id;
        $now = new DateTime();
        $classModel->updated_at = $now->format('Y-m-d H:i:s');
        if ($classModel->validate() && $classModel->update()) {
            
            Application::$app->session->setFlash('msg', 'Update item success');
            Application::$app->response->redirect("/admin/class-room/edit_confirm?id=$id");
        } else {
            Application::$app->session->setFlash('errors', $classModel->errors);
            Application::$app->response->redirect("/admin/class-room/edit_confirm?id=$id");
        }
    }

    public function edit_confirm_view()
    {
        
        $id = $_GET['id'];
        $data = ClassRoom::findOne(["id" => $id]);

        $this->setLayout('admin');
        return $this->render('admin/class_room/edit_confirm',
            [
                "data" => $data,
                "title" => "Class room",
                "breadcrumbs" => [
                    [
                        "link" => "/admin/class-room",
                        "label" => "Class room"
                    ],
                    [
                        "link" => "#",
                        "label" => "create"
                    ],
                ]
            ]
        );
    }


    public function complete_view()
    {

        $id = $_GET['id'];
        $data = ClassRoom::findOne(["id" => $id]);

        $this->setLayout('admin');
        return $this->render(
            'admin/class_room/complete',
            [
                "data" => $data,
                "title" => "Class room",
                "breadcrumbs" => [
                    [
                        "link" => "/admin/class-room",
                        "label" => "Class room"
                    ],
                    [
                        "link" => "#",
                        "label" => "create"
                    ],
                ]
            ]
        );
    }

    public function complete(Request $request)
    {
        echo $request->getBody();
        $id = $_GET['id'];
        
        $classModel = new ClassRoom();
        $classModel->loadData($request->getBody());
        $classModel->id = $id;
        $now = new DateTime();
        $classModel->updated_at = $now->format('Y-m-d H:i:s');
        if ($classModel->validate()) {

            // Application::$app->session->setFlash('msg', 'Update item success');
            Application::$app->response->redirect("/admin/class-room/complete?id=$id");
        } else {
            Application::$app->session->setFlash('errors', $classModel->errors);
            Application::$app->response->redirect("/admin/class-room/complete?id=$id");
        }
    
        
    }

    public function destroy()
    {
        $id = $_GET['id'];
        $cmd = ClassRoom::destroy($id);
        if ($cmd) {
            Application::$app->session->setFlash('msg', 'Delete item success');
            Application::$app->response->redirect('/admin/class-room');
        } else {
            Application::$app->session->setFlash('msg', 'Delete item error');
            Application::$app->response->redirect('/admin/class-room');
        }
    }
}
