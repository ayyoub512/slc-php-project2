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


function isCheckingDatesValid($checkInDate, $checkOutDate)
{
    // https://www.geeksforgeeks.org/php/comparing-two-dates-in-php/

    // Get current date
    $dateNow = date("Y-m-d");

    // Check if the check-in date is in the past
    if ($checkInDate < $dateNow) {
        return false;
    }

    // Check if the check-out date is on or before the check-in date
    if ($checkOutDate <= $checkInDate) {
        return false;
    }

    return true;


    // $dateNow = date("Y-m-d");
    // if ($checkOutDate >= $checkInDate || $checkInDate < $dateNow)
    //     return false;

    // return true;
}