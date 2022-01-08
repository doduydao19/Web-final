<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{


    public function showLogin()
    {
        $loginForm = new LoginForm();

        $this->setLayout(false);
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function login(Request $request)
    {
        $loginForm = new LoginForm();
        $loginForm->loadData($request->getBody());
        if ($loginForm->validate() && $loginForm->login()) {
            Application::$app->response->redirect('/admin/dashboard');
        } else {
            Application::$app->session->setFlash('errors', $loginForm->errors);
            Application::$app->response->redirect('/login');
        }
    }


    public function showRegister()
    {
        $registerModel = new User();

        $this->setLayout(false);
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }

    public function register(Request $request)
    {
        $registerModel = new User();

        $registerModel->loadData($request->getBody());
        if ($registerModel->validate() && $registerModel->save()) {
            Application::$app->session->setFlash('msg', 'Thanks for registering');
            Application::$app->response->redirect('/register');
        }
        else {
            Application::$app->session->setFlash('errors', $registerModel->errors);
            Application::$app->response->redirect('/register');
        }
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
}
