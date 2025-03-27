<?php
const BASE_URL = "http://localhost/Student-Management/";
const BASE_IMAGE = "http://localhost/Student-Management/public/images/";
const DBHOST = "localhost";
const DBNAME = "student_management";
const DBCHARSET = "utf8";
const DBUSER = "root";
const DBPASS = "";

function redirect($key = "", $msg = "", $url = "")
{
    $_SESSION[$key] = $msg;
    switch ($key) {
        case "errors":
            unset($_SESSION['success']);
            break;
        case "success":
            unset($_SESSION['errors']);
            break;
    }
    header('location: ' . BASE_URL . $url . "?msg=" . $key);
    die;
}

function route($name)
{
    return BASE_URL . $name;
}
