<?php
if ($_POST['param']) {
    $param = json_decode($_POST['param']);
    $my_array = gettext($param->id);
    $fo = fopen('list.csv', OR die ("Can't open list.csv");

    echo "OK";
    exit();
}