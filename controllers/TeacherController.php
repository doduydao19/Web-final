<?php 

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\models\Teacher;
use DateTime;

class TeacherController extends Controller 
{
    public function __construct()
    {
        
    }

    public function index(){
        $q =  isset($_GET['q']) ? $_GET['q'] : null;
        $specialized =  isset($_GET['specialized']) ? $_GET['specialized'] : null;

        $filter = [];

        if ($q) {
            $filter["name"] = "%$q%";
        }

        if ($specialized) {
            $filter["specialized"] = $specialized;
        }

        $data = Teacher::whereLike($filter)->get();
        $specializeds = Teacher::get(["specialized"]);


        $this->setLayout('admin');
        return $this->render('admin/teacher/index', [
            "q" => $q,
            "specialized" => $specialized,
            "specializeds" => $specializeds,
            "data" => $data,
            "title" => "Teacher",
            "breadcrumbs" => [
                [
                    "link" => "/admin/teacher",
                    "label" => "Teacher"
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
            'admin/teacher/create',

            [
                "title" => "Teacher",
                "breadcrumbs" => [
                    [
                        "link" => "/admin/teacher",
                        "label" => "Teacher"
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
        $classModel = new Teacher();
        $classModel->loadData($request->getBody());
        $now = new DateTime();
        $classModel->updated_at = $now->format('Y-m-d H:i:s');

        if ($classModel->validate() && $classModel->save()) {
            Application::$app->session->setFlash('msg', 'Create item success');
            Application::$app->response->redirect('/admin/teacher/create');
        } else {
            Application::$app->session->setFlash('errors', $classModel->errors);
            Application::$app->response->redirect('/admin/teacher/create');
        }
    }

    public function editView()
    {
        $id = $_GET['id'];
        $data = Teacher::findOne(["id" => $id]);

        $this->setLayout('admin');
        return $this->render(
            'admin/teacher/edit',
            [
                "data" => $data,
                "title" => "Teacher",
                "breadcrumbs" => [
                    [
                        "link" => "/admin/teacher",
                        "label" => "Teacher"
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
        $classModel = new Teacher();
        $classModel->loadData($request->getBody());
        $classModel->id = $id;
        $now = new DateTime();
        $classModel->updated_at = $now->format('Y-m-d H:i:s');
        if ($classModel->validate() && $classModel->update()) {
            Application::$app->session->setFlash('msg', 'Update item success');
            Application::$app->response->redirect("/admin/teacher/edit?id=$id");
        } else {
            Application::$app->session->setFlash('errors', $classModel->errors);
            Application::$app->response->redirect("/admin/teacher/edit?id=$id");
        }
    }

    public function destroy(Request $request)
    {
        $id = $_GET['id'];
        $cmd = Teacher::destroy($id);
        if ($cmd) {
            Application::$app->session->setFlash('msg', 'Delete item success');
            Application::$app->response->redirect('/admin/teacher');
        } else {
            Application::$app->session->setFlash('msg', 'Delete item error');
            Application::$app->response->redirect('/admin/teacher');
        }
    }
}