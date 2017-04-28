<?php
if ($_POST['param']) {
    $param = json_decode($_POST['param']);
    $row = gettext($param->id);
    echo json_decode($row);
    exit();
}