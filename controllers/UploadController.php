<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class UploadController extends Controller
{

    public function __construct()
    {
        // $this->registerMiddleware(new AuthMiddleware(['profile']));
    }


    public function upload()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if (isset($_FILES['file'])) {
            $errors = array();
            $file_name = $_FILES['file']['name'];
            $file_size = $_FILES['file']['size'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_type = $_FILES['file']['type'];
            $ext = explode('.', $_FILES['file']['name']);
            $file_ext = strtolower(end($ext));

            $extensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "uploads/" . $file_name);
                http_response_code(200);
                echo json_encode([
                    "url" => "/uploads/" . $file_name
                ]);
            } else {
                http_response_code(400);
                echo json_encode([
                    "errors" => $errors,
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                "errors" => "error",
            ]);
        }
    }
}
