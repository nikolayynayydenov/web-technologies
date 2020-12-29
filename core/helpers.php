<?php

function view(string $name, array $data = [])
{
    require_once("./../app/Views/$name.php");
    die;
}

function config($name)
{
    global $config;
    return $config[$name];
}

function response($text = '', $statusCode = 200, $redirectPath = null)
{
    if (!$redirectPath) {
        $redirectPath = $_SERVER['REQUEST_URI'];
    }
    header('Location: ' . $redirectPath);
    http_response_code($statusCode);
    die($text);
}

function d($data)
{
    if (is_null($data)) {
        $str = "<i>NULL</i>";
    } elseif ($data == "") {
        $str = "<i>Empty</i>";
    } elseif (is_array($data)) {
        if (count($data) == 0) {
            $str = "<i>Empty array.</i>";
        } else {
            $str = "<table style=\"border-bottom:0px solid #000;\" cellpadding=\"0\" cellspacing=\"0\">";
            foreach ($data as $key => $value) {
                $str .= "<tr><td style=\"background-color:#008B8B; color:#FFF;border:1px solid #000;\">" . $key . "</td><td style=\"border:1px solid #000;\">" . d($value) . "</td></tr>";
            }
            $str .= "</table>";
        }
    } elseif (is_resource($data)) {
        while ($arr = mysqli_fetch_array($data)) {
            $data_array[] = $arr;
        }
        $str = d($data_array);
    } elseif (is_object($data)) {
        $str = d(get_object_vars($data));
    } elseif (is_bool($data)) {
        $str = "<i>" . ($data ? "True" : "False") . "</i>";
    } else {
        $str = $data;
        $str = preg_replace("/\n/", "<br>\n", $str);
    }
    return $str;
}

function dnl($data)
{
    echo d($data) . "<br>\n";
}

function dd($data){
    echo dnl($data);
    exit;
}
