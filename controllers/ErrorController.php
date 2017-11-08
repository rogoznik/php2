<?php
/**
 * Created by PhpStorm.
 * User: darkfenix
 * Date: 08.11.17
 * Time: 14:12
 */

namespace app\controllers;


class ErrorController extends Controller
{
    public function actionIndex()
    {
        $this->action404();
    }

    public function action404()
    {
        $templateName = $this->controllerName . "/404";
        echo $this->render($templateName, ['message' => 'Запрашиваемая страница не найдена']);
    }
}