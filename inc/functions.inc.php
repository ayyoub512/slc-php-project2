<?php

function e($val)
{
    return htmlspecialchars($val, ENT_QUOTES, "UTF-8");
}

function render($view, $params)
{
    extract($params);
    ob_start();
    include __DIR__ . '/../views/pages/' . $view . '.php';
    $content = ob_get_clean();
    include __DIR__ . '/../views/layout/main.layout.php';
}