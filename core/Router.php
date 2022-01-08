<?php

namespace app\core;

use app\core\exception\NotFoundException;

class Router
{

    public Request $request;
    public Response $response;

    public array $routes = [
        // 'get' => [
        //     '/' => "home callback function",
        //     '/contact' => 'contact callback function get'
        // ],

        // 'post' => [
        //     '/contact' => 'contact callback function created'
        // ]

        // 'delete' => [
        //     '/contact' => 'contact callback function created'
        // ]
    ];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {

        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        
        if (!$callback) {
            throw new NotFoundException();
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $controller = new $callback[0];
            $controller->action = $callback[1];
            Application::$app->controller = $controller;
            $middlewares = $controller->getMiddlewares();
            foreach ($middlewares as $middleware) {
                $middleware->execute();
            }
            $callback[0] = $controller;
        }
        return call_user_func($callback,$this->request, $this->response);
    }



    public function renderView($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function renderViewOnly($view, $params = [])
    {
        return Application::$app->view->renderViewOnly($view, $params);
    }


    public function renderContent($viewContent)
    {

        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }


    public function layoutContent()
    {
        ob_start();
        include_once(Application::$ROOT_DIR . "/views/layouts/main.php");
        return ob_get_clean();
    }

    public function renderOnlyView($view)
    {
        ob_start();
        include_once(Application::$ROOT_DIR . "/views/$view.php");
        return ob_get_clean();
    }
}
