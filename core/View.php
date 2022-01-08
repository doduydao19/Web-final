<?php

namespace app\core;

class View
{
    public string $title = '';

    public function renderView($view, array $params)
    {
        $layoutName = Application::$app->layout;

        if (Application::$app->controller) {
            $layoutName = Application::$app->controller->layout;
        }

        $viewContent = $this->renderViewOnly($view, $params);
        
        ob_start();
        if ($layoutName) {
            foreach ($params as $key => $value) {
                $$key = $value;
            }
            include_once Application::$ROOT_DIR . "/views/layouts/$layoutName.php";

            $layoutContent = ob_get_clean();

            // split css

            // split script
            $pattern = "/(?<=@script)(.|\s)+(?=@endScript)/im";
            preg_match($pattern, strval($viewContent), $scriptCode);

            $pattern = "/@script(.|\s)+@endScript/im";
            $viewContent = preg_replace($pattern, '', $viewContent);

            $pattern = "/@script/im";
            if (is_array($scriptCode) && count($scriptCode) > 0) {
                $layoutContent = preg_replace($pattern, $scriptCode[0], $layoutContent);
            }

            return str_replace('{{content}}', $viewContent, $layoutContent);

        } else {
            return $viewContent;
        }
    }

    public function renderViewOnly($view, array $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
