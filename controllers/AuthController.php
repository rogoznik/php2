<?php

namespace app\controllers;


class AuthController extends Controller
{
    public function actionIndex()
    {
        echo $this->render("formAuth", []);
    }
}