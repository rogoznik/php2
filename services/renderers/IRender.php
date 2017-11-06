<?php

namespace app\services\renderers;


interface IRender
{
    public function render($template, $params);
}