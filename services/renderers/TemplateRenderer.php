<?php

namespace app\services\renderers;

class TemplateRenderer implements IRender
{
    public function render($template, $params)
    {
        extract($params);
        ob_start();
        $templatePath = VIEWS_DIR . "{$template}.php";
        include $templatePath;
        return ob_get_clean();

    }
}