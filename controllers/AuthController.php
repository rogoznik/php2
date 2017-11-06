<?php

namespace app\controllers;


class AuthController extends Controller
{
    public function actionIndex()
    {
        $templateName = $this->controllerName . "/auth";
        echo $this->render($templateName, []);
    }
}