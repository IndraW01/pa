<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'laundry';

$conn = mysqli_connect($host, $user, $password, $db) or die(mysqli_error($conn));
