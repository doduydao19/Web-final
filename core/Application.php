<?php

namespace app\core;

use app\core\db\Database;
use app\models\User;

class Application
{

    const EVENT_BEFORE_REQUEST = 'beforeRequest';
    const EVENT_AFTER_REQUEST = 'afterRequest';

    public static string $ROOT_DIR;
    public static Application $app;

    public Router $router;

    public Request $request;
    public Response $response;

    public ?Controller  $controller = null;

    public View $view;
    public string $layout = 'main';

    public Database $db;

    public Session $session;

    public ?User $user;


    public function __construct($rootPath, $config)
    {


        $this->user = null;
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $this->db = new Database($config['db']);

        $this->session = new Session();

        $userId = Application::$app->session->get('user');
        if ($userId) {
            $key = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$key => $userId]);
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function login(User $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $value = $user->{$primaryKey};
        Application::$app->session->set('user', $value);

        return true;
    }

    public function logout()
    {
        $this->user = null;
        self::$app->session->remove('user');
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            echo $this->router->renderViewOnly('_error', [
                'exception' => $e,
            ]);
        }
    }

    public function triggerEvent($eventName)
    {
        $callbacks = $this->eventListeners[$eventName] ?? [];
        foreach ($callbacks as $callback) {
            call_user_func($callback);
        }
    }

    public function on($eventName, $callback)
    {
        $this->eventListeners[$eventName][] = $callback;
    }

    public function showMsg($status)
    {
        if ($this->session->getFlash('msg')) {
            $msg = "";
            $msg = "<div class='alert alert-$status p-2'><p>" ;
            $msg .= $this->session->getFlash('msg');
            $msg .= '</p></div>';
            echo ($msg);
        }
    }


    public function showErrorMsgs()
    {
        if ($this->session->getFlash('errors')) {
            $errors = "";
            $errors = "<div class='alert alert-danger p-2'>";
            foreach ($this->session->getFlash('errors') as $key => $values) {
                foreach ($values as $value) {
                    $errors .= "<p>$key $value</p>";
                }
            }
            $errors .= '</div>';
            echo ($errors);
        }
    }
}
