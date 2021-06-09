<?php
session_start();
set_time_limit(0);
error_reporting(E_ALL);

if (file_exists('env.php')) include('env.php');

if (!$_ENV['PATH']) $_ENV['PATH'] = '';

// Informatii baza de date

$AdresaBazaDate = $_ENV['DB_URL'];
$UtilizatorBazaDate = $_ENV['DB_USER'];
$ParolaBazaDate = $_ENV['DB_PASS'];
$NumeBazaDate = $_ENV['DB_NAME'];

$conexiune = mysqli_connect($AdresaBazaDate, $UtilizatorBazaDate, $ParolaBazaDate, $NumeBazaDate) or die("Can not connect to MySQL Server");

function addentities($data)
{
    if (trim($data) != '') {
        $data = htmlentities($data, ENT_QUOTES);
        return str_replace('\\', '&#92;', $data);
    } else return $data;
} // End addentities() --------------

function altEach(&$data)
{
    $key = key($data);
    $ret = ($key === null) ? false : [$key, current($data), 'key' => $key, 'value' => current($data)];
    next($data);
    return $ret;
}

if (!isset($_SESSION['logat'])) {
    $_SESSION['logat'] = "Nu";
}
include('image.php');
