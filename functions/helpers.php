<?php

//config
define("BASE_URL", "http://localhost/php-blog-project");

function redirect($url)
{
    header('location: '. trim(BASE_URL, '/ ') . '/'. trim($url, '/ '));

}

function asset($file)
{
    return trim(BASE_URL,'/ '). '/'. trim($file, '/ ');
}
// for href of link
function url($url)
{
    return trim(BASE_URL,'/ '). '/'. trim($url, '/ ');
}

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    exit;
}

