<?php

namespace app\services\renderers;

use Twig_Environment;
use Twig_Loader_Filesystem;

class TwigRenderer implements IRender
{
    /**
     * @param $template
     * @param $params
     * @return mixed
     */
    public function render($template, $params)
    {
        $loader = new Twig_Loader_Filesystem(VIEWS_DIR . "twig/");
        $twig = new Twig_Environment($loader);
        $templateName = "{$template}.php";
        $tpl = $twig->loadTemplate($templateName);
        return $tpl->render($params);

    }

}