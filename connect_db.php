<?php
$db_server = "sql207.infinityfree.com";
$root = "if0_38134767";
$password = "40H0OOJC2QjD6";
$data_base_name = "if0_38134767_attendance_db";

try {
    $conn = mysqli_connect($db_server, $root, $password, $data_base_name);
} catch (Exception $e) {
    die("Connection Failed: " . $e->getMessage());
}
