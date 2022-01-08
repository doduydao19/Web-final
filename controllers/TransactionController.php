<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\db\Database;
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

        $where = "where true ";

        if ($q) {
            $where .=   "and d.name like '%$q%'";
        }

        if ($teacher) {
            $where .=   "and t.name = '$teacher'";
        }

        // $data = Transaction::whereLike($filter)->orderBy("created_at DESC")->get();
        $sql = "select t.id, d.name as deviceName, dt.start_transaction_plan , dt.end_transaction_plan , returned_date , t.name 
        from device_transactions dt 
        join teachers t ON dt.teacher_id = t.id 
        join devices d on d.id = dt.device_id 
         " . $where;

        $data = Application::$app->db->query($sql);


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
        $deviceId =  isset($_GET['device_id']) ? $_GET['device_id'] : null;
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
                "deviceId" => $deviceId,

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
        $classModel->loadData($request->getBody());
        $now = new DateTime();
        $classModel->updated_at = $now->format('Y-m-d H:i:s');
        $classModel->start_transaction_plan = date("Y-m-d", strtotime($classModel->start_transaction_plan));
        $classModel->end_transaction_plan = date("Y-m-d", strtotime($classModel->end_transaction_plan));

        if ($classModel->validate() && $classModel->save()) {
            

            $device = Device::findOne(["id" => $classModel->device_id]);
            $device->status = 1;
            $device->update();

            Application::$app->session->setFlash('msg', 'Thêm mới bản ghi thành công');
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

        $oldTransaction = Transaction::findOne(["id" => $id]);
        print_r($oldTransaction);
        die();

        $classModel = new Transaction();
        $classModel->loadData($request->getBody());
        $classModel->id = $id;
        $now = new DateTime();
        $classModel->updated_at = $now->format('Y-m-d H:i:s');
        if ($classModel->validate() && $classModel->update()) {

            $device = Device::findOne(["id" => $classModel->device_id]);
            $device->status = 1;
            $device->update();

            Application::$app->session->setFlash('msg', 'Cập nhật bản ghi thành công');
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
            Application::$app->session->setFlash('msg', 'Xóa bản ghi thành công');
            Application::$app->response->redirect('/admin/transaction');
        } else {
            Application::$app->session->setFlash('msg', 'Delete item error');
            Application::$app->response->redirect('/admin/transaction');
        }
    }
}
